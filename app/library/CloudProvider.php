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
				$response = CloudProvider::startInstances($account, array('InstanceIds' =>array($instanceID), 'DryRun' => false, ));
				break;
			case 'stop' :
				$response = CloudProvider::stopInstances($account, array('DryRun' => false, 'InstanceIds' =>array($instanceID)));
				break;
			case 'restart' :
				$response = CloudProvider::restartInstances($account, array('DryRun' => false, 'InstanceIds' =>array($instanceID)));
				break;
			case 'terminate' :
				$response = CloudProvider::terminateInstances($account, array('DryRun' => false, 'InstanceIds' =>array($instanceID)));
				break;	
		}
		return $response;
	}
	
	
	public static function startInstances($account, $params){
		if(self::AWSAuth($account))
		{
			try
			{	
				$instanceResult = self::$ec2Compute->startInstances($params);
				if (!empty($instanceResult))
				{
					return array('status' => 'OK', 'result' => 'start', 'message'  => $instanceResult-> toArray());
				} 
			}
			catch(Exception $ex)
			{
				Log::error($ex);
				return array('status' => 'error', 'message' => 'Error occured during startingInstances - '.$params['InstanceIds'][0]);
			}
		} 
		else
		{
			Log::error(Auth::check() ? Auth::user()->username : '__Guest__');
			Log::error('startInstances '. $instanceAction .' request');
			Log::error('startInstances '. $instanceAction .' Authentication failure! API key and secret key for account is not correct');
			return array('status' => 'error', 'message' => 'Authentication failure! API key and secret key for account is not correct');
		}
	}

	public static function stopInstances($account, $params){
		if(self::AWSAuth($account))
		{
			try
			{	
				$instanceResult = self::$ec2Compute -> stopInstances($params);
				if (!empty($instanceResult))
				{
					return array('status' => 'OK', 'result' => 'stop', 'message'  => $instanceResult-> toArray());
				} 
			}
			catch(Exception $ex)
			{
				Log::error($ex);
				return array('status' => 'error', 'message' => 'Error occured during stopInstances - '.$params['InstanceIds'][0]);
			}
		} 
		else
		{
			Log::error(Auth::check() ? Auth::user()->username : '__Guest__');
			Log::error('stopInstances '. $instanceAction .' request');
			Log::error('stopInstances '. $instanceAction .' Authentication failure! API key and secret key for account is not correct');
			return array('status' => 'error', 'message' => 'Authentication failure! API key and secret key for account is not correct');
		}
	}
	
	public static function restartInstances($account, $params){
		if(self::AWSAuth($account))
		{
			try
			{	
				$instanceResult = self::$ec2Compute -> restartInstances($params);
				if (!empty($instanceResult))
				{
					return array('status' => 'OK', 'message'  => $instanceResult-> toArray());
				} 
			}
			catch(Exception $ex)
			{
				Log::error($ex);
				return array('status' => 'error', 'message' => 'Error occured during restartInstances - '.$params['InstanceIds'][0]);
			}
		} 
		else
		{
			Log::error(Auth::check() ? Auth::user()->username : '__Guest__');
			Log::error('restartInstances '. $instanceAction .' request');
			Log::error('restartInstances '. $instanceAction .' Authentication failure! API key and secret key for account is not correct');
			return array('status' => 'error', 'message' => 'Authentication failure! API key and secret key for account is not correct');
		}
	}

	public static function terminateInstances($account, $params){
		if(self::AWSAuth($account))
		{
			try
			{	
				$instanceResult = self::$ec2Compute -> terminateInstances($params);
				if (!empty($instanceResult))
				{
					return array('status' => 'OK', 'message'  => $instanceResult-> toArray());
				} 
			}
			catch(Exception $ex)
			{
				Log::error($ex);
				return array('status' => 'error', 'message' => 'Error occured during terminateInstances - '.$params['InstanceIds'][0]);
			}
		} 
		else
		{
			Log::error(Auth::check() ? Auth::user()->username : '__Guest__');
			Log::error('terminateInstances '. $instanceAction .' request');
			Log::error('terminateInstances '. $instanceAction .' Authentication failure! API key and secret key for account is not correct');
			return array('status' => 'error', 'message' => 'Authentication failure! API key and secret key for account is not correct');
		}
	}
}
