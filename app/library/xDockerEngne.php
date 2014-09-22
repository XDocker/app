<?php
/**
* Class and Function List:
* Function list:
* - AWSAuth()
* - authenticate()
* Classes list:
* - CloudProvider
*/
class xDockerEngine 
{
    private $connection;
	private $curl;

	
	function __construct() 
	{
		$this->curl = new Curl();
		$this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, FALSE);
		$this->curl->setOpt(CURLOPT_SSL_VERIFYHOST, FALSE);
	}
	
	function server($url, $request_method, $data='') 
	{
		$request_method = strtolower($request_method);
		$this->curl->$request_method($url . $request_method, $data);
		return $this->curl->response;
	} 
	
}