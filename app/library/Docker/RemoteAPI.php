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
		$ret  = shell_exec('curl -X GET http://'.$url.':4243/containers/json');
		$ret = StringHelper::isJson($ret) ? json_decode($ret) :  '';
		return $ret;
	}
		
}
	