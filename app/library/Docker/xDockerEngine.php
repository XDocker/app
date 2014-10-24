<?php
/**
 * Class and Function List:
 * Function list:
 * - init()
 * - dockerHubGet()
 * - request()
 * - register()
 * - authenticate()
 * - run()
 * - instance()
 * - getDeploymentStatus()
 * - getLog()
 * - uploadKey()
 * - downloadKey()
 * Classes list:
 * - xDockerEngine
 */
class xDockerEngine {
    private static $connection;
    private static $orchestrationParams;
    private static $dockerHubCredentials;
	
    private static function init() 
    {
        self::$orchestrationParams = Config::get('orchestration');
        self::$dockerHubCredentials = Config::get('thirdparty_integration.Docker_Hub');
    }
    
    public static function dockerHubGet($search_term) {
        // Get the list of docker instances for the given term
        self::init();
        $process = curl_init(self::$dockerHubCredentials['search_url'] . $search_term);
        Log::info((Auth::check() ? Auth::user()->username : '__Guest__') . ' URL : ' . self::$dockerHubCredentials['search_url'] . $search_term);
        curl_setopt($process, CURLOPT_USERPWD, self::$dockerHubCredentials['username'] . ":" . self::$dockerHubCredentials['password']);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
        $response = curl_exec($process);
        curl_close($process);
        return json_decode($response);
    }
    
    public static function request($url, $data) {
        Log::info((Auth::check() ? Auth::user()->username : json_encode($data)) . ' URL : ' . $url);
        $process = curl_init();
        curl_setopt($process, CURLOPT_URL, $url);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
        //url-ify the data for the POST
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($process, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen(json_encode($data))
        ));
        $status = curl_exec($process);
        curl_close($process);
        
        return $status;
    }
    
    public static function register($data) {
        self::init();
        return self::request(self::$orchestrationParams['endpoint_ip'] . self::$orchestrationParams['register'], $data);
    }
    
    public static function authenticate($data) {
        self::init();
        return self::request(self::$orchestrationParams['endpoint_ip'] . self::$orchestrationParams['authenticate'], $data);
    }
    
    public static function run($data) {
        self::init();
        return self::request(self::$orchestrationParams['endpoint_ip'] . self::$orchestrationParams['run'], $data);
    }
    
    public static function instance($data) {
        self::init();
        return self::request(self::$orchestrationParams['endpoint_ip'] . self::$orchestrationParams['instance'], $data);
    }
    
    public static function getDeploymentStatus($data) {
        self::init();
        return self::request(self::$orchestrationParams['endpoint_ip'] . self::$orchestrationParams['getDeploymentStatus'] . '/' . $data['job_id'], $data);
    }
    
    public static function getLog($data) {
        self::init();
		Log::info('Debug' . json_encode($data));
        return self::request(self::$orchestrationParams['endpoint_ip'] . self::$orchestrationParams['getLog'] . '/' . $data['job_id'], $data);
    }
    
    public static function uploadKey($data) {
        self::init();
        return self::request(self::$orchestrationParams['endpoint_ip'] . self::$orchestrationParams['uploadKey'], $data);
    }
    
    public static function downloadKey($data) {
        self::init();
		Log::info('Debug :' . json_encode($data));
        return self::request(self::$orchestrationParams['endpoint_ip'] . self::$orchestrationParams['downloadKey'], $data);
    }
	
	public static function removeUsername($data) {
        self::init();
		Log::info('Debug :' . json_encode($data));
        return self::request(self::$orchestrationParams['endpoint_ip'] . self::$orchestrationParams['removeUsername'], $data);
    }
	
	///Following methods are helper for accessing the config variables
	public static function getTag($dockerName)
	{
		$settings = Config::get('docker_settings');
		return isset($settings[$dockerName]) ? $settings[$dockerName]['tags'] : '';
	}
	public static function getLogo($dockerName)
	{
		$settings = Config::get('docker_settings');
		return isset($settings[$dockerName]) ? $settings[$dockerName]['logo'] : '';
	}
	
	public static function getProtocol($dockerName)
	{
		$settings = Config::get('docker_settings');
		return isset($settings[$dockerName]) ? $settings[$dockerName]['protocol'] : '';
	}
	public static function getDisplayName($dockerName)
	{
		$settings = Config::get('docker_settings');
		$img = '<img width="25px" height="25px" src="' . asset('/assets/img/providers/'.$settings[$dockerName]['logo']).'" />';
		return isset($settings[$dockerName]) ? $img.$settings[$dockerName]['displayName'] : '';
	}
	
	public static function getDockerUrl($dockerName)
	{
		$settings = Config::get('docker_settings');
		$img = '<img width="25px" height="25px" src="' . asset('/assets/img/providers/docker.jpg').'" />';
		$url = isset($settings[$dockerName]) ? $settings[$dockerName]['docker_url'] : '';
		return '<a target="_blank" href="'.$url.'">' .$img.'</a>';
		
	}
	
	public static function getDockerParams($dockerName)
	{
		$settings = Config::get('docker_settings');
		return isset($settings[$dockerName]) ? $settings[$dockerName]['dockerParams'] : '';
	}
	
	public static function enabled($dockerName)
	{
		$settings = Config::get('docker_settings');
		return isset($settings[$dockerName]) ? $settings[$dockerName]['enabled'] : FALSE;
	}
	
	public static function urlAppend($dockerName)
	{
		$settings = Config::get('docker_settings');
		return isset($settings[$dockerName]) ? $settings[$dockerName]['append'] : '';
	}
	public static function securityPolicy($dockerName)
	{
		$settings = Config::get('docker_settings');
		$secPolicy = isset($settings[$dockerName]) ? $settings[$dockerName]['securityPolicy'] : '';
		return $secPolicy;
	}

	public static function documentationUrl($dockerName)
	{
		$settings = Config::get('docker_settings');
		$url = isset($settings[$dockerName]) ? $settings[$dockerName]['documentationUrl'] : '';
		return '<a title="Documentation" alt="Documentation" target="_blank" href="'.$url.'"><span class="glyphicon glyphicon-list-alt"> </span></a>';
	}
	
	public static function getIPAddress($dockerName)
	{
		$settings = Config::get('docker_settings');
		$url = isset($settings[$dockerName]) ? $settings[$dockerName]['ipUI'] : ''; 
		return $url;
	}
	
	public static function billingBucket($dockerName)
	{
		$settings = Config::get('docker_settings');
		return isset($settings[$dockerName]) ? $settings[$dockerName]['billingBucket'] : FALSE;
	}
	
	public static function getDockerServiceStatus($query = 'xdocker')
	{
		$response = self::dockerHubGet($query);
		$dockerServiceStatus = 'error';
		if($response->num_results > 0 && !empty($response->results) )
		{
			$dockerServiceStatus = 'OK';
		}
		 return $dockerServiceStatus;
	}
	
	public static function getxDockerServiceStatus()
	{
		$responseJson = xDockerEngine::authenticate(array('username' => Auth::user()->username, 'password' => md5(Auth::user()->engine_key)));
		EngineLog::logIt(array('user_id' => Auth::id(), 'method' => 'getxDockerServiceStatus : authenticate', 'return' => $responseJson));
		$status = 'error';
		if(StringHelper::isJson($responseJson))
		{
			$obj = json_decode($responseJson);
			if(!empty($obj) && $obj->status == 'OK')
			{
				$status = 'OK';
			}
		}	
		return $status;
	}
	
}
