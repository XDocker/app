<?php
//require_once SHARED_ADDONPATH . 'libraries/aws/aws.phar';
class CloudProvider
{
	private $aws;
	private function AWSAuth($account)
	{
		$config['key'] =$account->api_key;
		$config['secret'] = $account->secret_key;
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
			//log_message('error', 'Connection failed with API and Secret .' . $ex->getMessage());
		}
		return $conSTatus;
	}
	
	public function authenticate($cloudProvider, $account)
	{
		switch($cloudProvider)
		{
			case 'Amazon AWS' : return $this->AWSAuth($account); break;
		}
	}
}
