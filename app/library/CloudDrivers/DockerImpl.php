<?php
/**
* class implements IProvder and Function List:
* Interface list:
* - authenticate()
* - startInstance()
* - stopInstances()
* - restartInstances()
* - terminateInstances()
* * Classes list:
* - DockerImpl
*/


class DockerImpl extends AbstractProvider
{
	private $ec2Client;
	
	private function init() 
	{
		
	}
	
	public function __construct($acct) 
	{
	   parent::__construct($acct) ;
    }
	
	public function authenticate() 
	{
       $credentials = json_decode($this->account->credentials);
	   try
	   {
	   		$client = new Docker\Http\DockerClient(array(), $credentials->host . ':'.$credentials->port. '/containers/json');
    		$docker = new Docker\Docker($client);
			$containers = $docker->getContainerManager()->findAll();
			if(empty($containers)) return false; else return true;
	   }
	   catch(Exception $ex)
	   {
	   		Log::error('Failed with Authentication!' . $ex->getMessage());
			return false;
	   }
	}
	
	
	
}
		