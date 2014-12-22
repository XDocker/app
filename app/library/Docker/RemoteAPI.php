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
	
	 public static function Containers($url)
     {
     	$client = new Docker\Http\DockerClient(array(), $url . ':4243/containers/json');
        $docker = new Docker\Docker($client);
		$containers = $docker->getContainerManager()->findAll();
		$arr = [];
		foreach($containers as $container)
		{
			$obj = $docker->getContainerManager()->find($container->getId());
			$arr[] = $obj;
		}

		return $arr;
     }
	 
	 public static function getContainers($url)
	 {
	 	$client = new Docker\Http\DockerClient(array(), $url . ':4243/containers/json');
        $docker = new Docker\Docker($client);
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

     public static function stopContainer($id, $url)
	 {
	 	$client = new Docker\Http\DockerClient(array(), $url . ':4243/containers/json');
        $docker = new Docker\Docker($client);
		$container = $docker->getContainerManager()->find($id);
		$ret = $docker->getContainerManager()->stop($container);
		$data = $ret->find($id);
		return $data;
	 }
	 
	 public static function startContainer($id, $url)
	 {
	 	$client = new Docker\Http\DockerClient(array(), $url . ':4243/containers/json');
        $docker = new Docker\Docker($client);
		$container = $docker->getContainerManager()->find($id);
		$ret = $docker->getContainerManager()->start($container);
		$data = $ret->find($id);
		return $data;
	 }
	
	public static function Containers2($url)
	{
		$process = curl_init();
        curl_setopt($process, CURLOPT_URL, $url);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($process, CURLOPT_CUSTOMREQUEST, "GET");
		$status = curl_exec($process);
        curl_close($process);
        
        return $status;
	}
		
}
	