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


abstract class AbstractProvider implements IProvider
{
	protected $account;
	
	private function init() 
	{
		
	}
	
	protected function __construct($acct) 
	{
	   $this->account = $acct;
    }
	
	
	
	public function startInstances($params){}
	
	public function stopInstances($params){}
	
	public function restartInstances($params){}
	
	public function terminateInstances($params){}
	
	public function describeInstances($params){}
	
}
		