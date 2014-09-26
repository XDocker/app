<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - request()
* Classes list:
* - xDockerEngine
*/
class xDockerEngine 
{
    private static $connection;
	private static $orchestrationParams;
	private static function init($url) 
	{
		self::$connection = curl_init();
		curl_setopt(self::$connection, CURLOPT_CUSTOMREQUEST, "POST"); 
		curl_setopt(self::$connection, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt(self::$connection, CURLOPT_SSL_VERIFYPEER, FALSE);
		
		self::$orchestrationParams = Config::get('orchestration');
	}
	
	public static function request($url, $data='') 
	{
		self::init($url);
		curl_setopt(self::$connection, CURLOPT_URL, $url);
		$strData = json_encode($data);
		curl_setopt(self::$connection, CURLOPT_POSTFIELDS, $strData);  
		
		curl_setopt(self::$connection, CURLOPT_HTTPHEADER, array(                                                                          
    	'Content-Type: application/json',                                                                                
    	'Content-Length: ' . strlen(json_encode($strData)))                                                                       
		);                                             
       $status = curl_exec($this->connection);
       curl_close(self::$connection);
	   
	   return $status;
	} 
	
	public static function register($data)
	{
		self::init();
		return self::request(self::$orchestrationParams['endpoint_ip'].'/'.self::$orchestrationParams['register'], $data);
	}
	
	public static function authenticate($data)
	{
		self::init();
		return self::request(self::$orchestrationParams['endpoint_ip'].'/'.self::$orchestrationParams['authenticate'], $data);
	}
	
	public static function run($data)
	{
		self::init();
		return self::request(self::$orchestrationParams['endpoint_ip'].'/'.self::$orchestrationParams['run'], $data);
	}
	
	public static function instance($data)
	{
		self::init();
		return self::request(self::$orchestrationParams['endpoint_ip'].'/'.self::$orchestrationParams['instance'], $data);
	}
	
	public static function getDeploymentStatus($data)
	{
		self::init();
		return self::request(self::$orchestrationParams['endpoint_ip'].'/'.self::$orchestrationParams['getDeploymentStatus'], $data);
	}
	
	public static function getLog($data)
	{
		self::init();
		return self::request(self::$orchestrationParams['endpoint_ip'].'/'.self::$orchestrationParams['getLog'], $data);
	}
	
	public static function uploadKey($data)
	{
		self::init();
		return self::request(self::$orchestrationParams['endpoint_ip'].'/'.self::$orchestrationParams['uploadKey'], $data);
	}
	
	public static function downloadKey($data)
	{
		self::init();
		return self::request(self::$orchestrationParams['endpoint_ip'].'/'.self::$orchestrationParams['downloadKey'], $data);
	}
}
