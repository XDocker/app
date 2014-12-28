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


class DockerImpl implements IProvider
{
	private $ec2Client;
	private $account;
	
	private function init() 
	{
		
	}
	
	public function __construct($acct) 
	{
	   $this->account = $acct;
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
	
	/*
	 * $client = new Docker\Http\DockerClient(array(), $url . ':4243/containers/json');
        $docker = new Docker\Docker($client);
		try
		{
			$containers = $docker->getContainerManager()->findAll();
			$arr = [];
			foreach($containers as $container)
			{
				$obj = $docker->getContainerManager()->find($container->getId());
				$arr[] = $obj;
			}
			return $arr;
		}
		catch(Exception $ex)
		{
			Log::error('Error file getting all containers');
			return array();
		}
	 */
	
}
		