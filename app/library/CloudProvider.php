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
	 
	public static function executeAction($instanceAction, $account, $instanceID)
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
			case 'download' :
				$responseJson = xDockerEngine::authenticate(array('username' => Auth::user()->username, 'password' => md5(Auth::user()->engine_key)));
		 		EngineLog::logIt(array('user_id' => Auth::id(), 'method' => 'authenticate-executeAction', 'return' => $responseJson));
		 		$obj = json_decode($responseJson);
				if(!empty($obj) && $obj->status == 'OK')
		 		{
					$resonse = xDockerEngine::downloadKey(array('token' =>$obj->token));
				}
				break;
		}
		return $response;
	}

	public static function getState($cloudAccountId, $instanceID)
	{
		$account = CloudAccount::where('user_id', Auth::id())->findOrFail($deployment->cloudAccountId) ;
		$data = self::executeAction('describeInstances', $account, $instanceID);
		print_r($data);	
	}
	
	
}
