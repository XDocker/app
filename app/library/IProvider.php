<?php
/**
* Interface and Function List:
* Interface list:
* - AWSAuth()
* - authenticate()
* - startInstance()
* - stopInstances()
* - restartInstances()
* - terminateInstances()
* * Classes list:
* - CloudProvider
*/

interface IProvider
{
	public function authenticate($account);
	
	public function startInstances($account, $params);
	
	public function stopInstances($account, $params);
	
	public function restartInstances($account, $params);
	
	public function terminateInstances($account, $params);
}
