<?php

class RemoteAPI
{
	
	 public static function request($url, $method, $params) {
        Log::info((Auth::check() ? Auth::user()->username : json_encode($params)) . ' URL : ' . $url);
        $process = curl_init();
        curl_setopt($process, CURLOPT_URL, $url);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
        //url-ify the data for the POST
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, $method);
		if(!empty($params))
		{
        	curl_setopt($process, CURLOPT_POSTFIELDS, json_encode($data));
		}	
        curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($process, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen(json_encode($params))
        ));
        $status = curl_exec($process);
        curl_close($process);
        
        return $status;
    }
	
	 public static function Containers($url, $port = '4243')
     {
     	$client = new Docker\Http\DockerClient(array(), $url . ':'.$port.'/containers/json');
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
	 }
	 
	 public static function getContainers($url, $port = '4243')
	 {
	 	$client = new Docker\Http\DockerClient(array(), $url . ':'.$port.'/containers/json');
        $docker = new Docker\Docker($client);
		try
		{
			$containers = $docker->getContainerManager()->findAll();
			$contents = [];
			
			foreach($containers as $container)
			{
				$getid['id'] = $container -> getId();
				$obj = $docker->getContainerManager()->find($container->getId());
				$contents[] = array_merge($getid, $obj -> getRuntimeInformations());
			}
			return $contents;
		}
		catch(Exception $ex)
		{
			Log::error('Error file getting all containers');
			return array();
		}
		
	}

     public static function stopContainer($id, $url, $port = '4243')
	 {
	 	$client = new Docker\Http\DockerClient(array(), $url . ':'.$port.'/containers/json');
        $docker = new Docker\Docker($client);
		$container = $docker->getContainerManager()->find($id);
		$ret = $docker->getContainerManager()->stop($container);
		return $ret;
	 }
	 
	 public static function startContainer($id, $url, $port = '4243')
	 {
	 	$client = new Docker\Http\DockerClient(array(), $url . ':'.$port.'/containers/json');
        $docker = new Docker\Docker($client);
		$container = $docker->getContainerManager()->find($id);
		$ret = $docker->getContainerManager()->start($container);
		return $ret;
	 }
	 
	 public static function top($id, $url, $port = '4243')
	 {
	 	$client = new Docker\Http\DockerClient(array(), $url . ':'.$port.'/containers/json');
        $docker = new Docker\Docker($client);
		try
		{
			$container = $docker->getContainerManager()->find($id);
			$ret = $docker->getContainerManager()->top($container);
			return $ret;
		}
		catch(Exception $ex)
		{
			Log::error("Error while getting list of process from container ". $id);
			return array();	
		}
		
	 }
	 
	  public static function logs($id, $url, $port = '4243')
	 {
	 	$client = new Docker\Http\DockerClient(array(), $url . ':'.$port.'/containers/json');
        $docker = new Docker\Docker($client);
		try
		{
			$container = $docker->getContainerManager()->find($id);
			$ret = $docker->getContainerManager()->logs($container);
			return $ret;
		}
		catch(Exception $ex)
		{
			Log::error("Error while getting list of logs from container ". $id);
			return array();	
		}
		
	 }
	 
	 public static function export($id, $url, $port = '4243')
	 {
	 	$client = new Docker\Http\DockerClient(array(), $url . ':'.$port.'/containers/json');
        $docker = new Docker\Docker($client);
		try
		{
			$container = $docker->getContainerManager()->find($id);
			$ret = $docker->getContainerManager()->export($container);
			return $ret;
		}
		catch(Exception $ex)
		{
			Log::error("Error while exporting from container ". $id);
			return array();	
		}
		
	 }
	
}
	