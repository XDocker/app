<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - server()
* Classes list:
* - xDockerEngine
*/
class xDockerEngine 
{
    private $connection;
	private $curl;
	
	function __construct($url) 
	{
		$this->connection = curl_init();
		curl_setopt($this->connection, CURLOPT_CUSTOMREQUEST, "POST"); 
		curl_setopt($this->connection, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($this->connection, CURLOPT_SSL_VERIFYPEER, FALSE);
	}
	
	public function request($url, $data='') 
	{
		curl_setopt($this->connection, CURLOPT_URL, $url);
		$strData = json_encode($data);
		curl_setopt($this->connection, CURLOPT_POSTFIELDS, $strData);  
		
		curl_setopt($this->connection, CURLOPT_HTTPHEADER, array(                                                                          
    	'Content-Type: application/json',                                                                                
    	'Content-Length: ' . strlen(json_encode($strData)))                                                                       
		);                                             
       $status = curl_exec($this->connection);
       curl_close($this->connection);
	   
	   return $status;
		
	} 
	
}
