<?php
/**
* Class and Function List:
* Function list:
* - AWSAuth()
* - authenticate()
* - startInstance()
* Classes list:
* - CloudProvider
*/

class CloudProvider {
    private static $aws;
	private static $ec2Compute;
    private static function AWSAuth($account) {
        $credentials = json_decode($account->credentials);
        $config['key'] = $credentials->apiKey;
        $config['secret'] = $credentials->secretKey;
        $config['region'] = empty($credentials -> instanceRegion) ? 'us-east-1' : $credentials->instanceRegion;
		$conStatus = FALSE;
        try 
        {
            $ec2Client = \Aws\Ec2\Ec2Client::factory($config);
			self::$ec2Compute = $ec2Client;
			$result = $ec2Client->DescribeInstances(array(
		        'Filters' => array(
		                array('Name' => 'instance-type', 'Values' => array('m1.small')),
		        )
			));
		
			$reservations = $result->toArray();
			if(isset($reservations['requestId'])) $conStatus = TRUE; else $conStatus = FALSE;
        }
        catch(Exception $ex) {
            $conStatus = FALSE;
            Log::error($ex);
       }
        return $conStatus;
    }
    
   public static function authenticate($account) 
	{
	 	return self::getDriver($account)->authenticate();
    }
	 
	public static function getDriver($account)
	{
		$iProvider = '';
        switch ($account->cloudProvider) {
            case 'Amazon AWS':
				$iProvider = new AWSPRoviderImpl($account);
                return $iProvider;
            break;
        }
	}
	 
	public static function executeAction($instanceAction, $account, $deployment, $instanceID)
	{
		$response = '';
		switch ($instanceAction)
		{
			case 'start' :
				$response = self::getDriver($account)->startInstances(array('DryRun' => false, 'InstanceIds' =>array($instanceID),  ));
				break;
			case 'stop' :
				$response = self::getDriver($account)->stopInstances(array('DryRun' => false, 'InstanceIds' =>array($instanceID)));
				break;
			case 'restart' :
				$response =  self::getDriver($account)->restartInstances(array('DryRun' => false, 'InstanceIds' =>array($instanceID)));
				break;
			case 'terminate' :
				$response = self::getDriver($account)->terminateInstances(array('DryRun' => false, 'InstanceIds' =>array($instanceID)));
				break;	
				
			case 'describeInstances':
				$response = self::getDriver($account)->describeInstances(array('DryRun' => false, 'InstanceIds' =>array($instanceID)));
				break;	
			case 'downloadKey' :
				$responseJson = xDockerEngine::authenticate(array('username' => Auth::user()->username, 'password' => md5(Auth::user()->engine_key)));
		 		EngineLog::logIt(array('user_id' => Auth::id(), 'method' => 'authenticate-executeAction', 'return' => $responseJson));
		 		$obj = json_decode($responseJson);
				if(empty($deployment))
				{
					return array('status' => 'error', 'message'=> 'Not a valid executeAction without deplayment parameters!');
				}
				if(!empty($obj) && $obj->status == 'OK')
		 		{
		 			$parameters = json_decode($deployment->parameters);
					$response = xDockerEngine::downloadKey(array('token' =>$obj->token, 'cloudProvider' => $account->cloudProvider, 'instanceRegion' => $parameters->instanceRegion));
					$response = StringHelper::isJson($response) ? json_decode($response) : array('status' => 'errpr', 'message' => 'Error occured while downloading keys');
				}
				if(!empty($obj) && $obj->status == 'error')
		 		{
					Log::error('Error occured while downloading key' . $obj->message);
					$response = array('status' => $obj->status, 'message' => 'Unexpected error! Contact Support' );
				}
				break;
		}
		return $response;
	}

	public static function getState($cloudAccountId, $instanceID)
	{
		$account = CloudAccount::where('user_id', Auth::id())->findOrFail($cloudAccountId) ;
		$data = self::executeAction('describeInstances', $account, '', $instanceID);
		if($data['status'] == 'OK')
		{
			if(!empty($data['message']['Reservations'][0]['Instances'][0]['State']['Name']))
			
				return UIHelper::getLabel($data['message']['Reservations'][0]['Instances'][0]['State']['Name']);
			else
				return UIHelper::getLabel('NA');
		}
		else if($data['status'] == 'error')
		{
			return UIHelper::getLabel($data['status']);
		}
		else
		{
			return UIHelper::getLabel('NA');
		}
	}
	
	
}
