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
	public function authenticate();
	
	public function startInstances($params);
	
	public function stopInstances($params);
	
	public function restartInstances($params);
	
	public function terminateInstances($params);
	
	public function describeInstances($params);
}
