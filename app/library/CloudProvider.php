<?php
//require_once SHARED_ADDONPATH . 'libraries/aws/aws.phar';
class CloudProvider
{
	private $aws;
	private function AWSAuth($account)
	{
		$credentials = json_decode($account->credentials);
		$config['key'] 	  =	$credentials->apiKey;
		$config['secret'] = $credentials->secretKey;
		$config['region'] = 'us-east-1';
		$this -> aws = Aws\Common\Aws::factory($config);

		$conSTatus = false;
		try
		{
			$ec2Compute = $this -> aws -> get('ec2');
			$result = $ec2Compute->getRegions();
			$conSTatus = (!empty($result) && count($result) > 0);

		} catch(Exception $ex)
		{
			$conSTatus = false;
			Log::error($ex);
			//log_message('error', 'Connection failed with API and Secret .' . $ex->getMessage());
		}
		return $conSTatus;
	}
	
	public static function authenticate($account)
	{
		switch($cloudProvider->cloudProvider)
		{
			case 'Amazon AWS' : return $this->AWSAuth($account); break;
		}
	}
}
