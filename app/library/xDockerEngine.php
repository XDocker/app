<?php
/**
 * Class and Function List:
 * Function list:
 * - init()
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
    private static function init() {
        self::$connection = curl_init();
        curl_setopt(self::$connection, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt(self::$connection, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt(self::$connection, CURLOPT_SSL_VERIFYPEER, FALSE);
        
        self::$orchestrationParams = Config::get('orchestration');
    }
    
    public static function request($url, $data ) {
        self::init();
		curl_setopt(self::$connection, CURLOPT_URL, $url);
        $strData = json_encode($data);
        curl_setopt(self::$connection, CURLOPT_POSTFIELDS, $strData);
        
        curl_setopt(self::$connection, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($strData)
        ));
        $status = curl_exec(self::$connection);
		 curl_close(self::$connection);
        
        return $status;
    }
    
    public static function register($data) {
    	self::init();
        return self::request(self::$orchestrationParams['endpoint_ip'] . '/' . self::$orchestrationParams['register'], $data);
    }
    
    public static function authenticate($data) {
        return self::request(self::$orchestrationParams['endpoint_ip'] . '/' . self::$orchestrationParams['authenticate'], $data);
    }
    
    public static function run($data) {
        return self::request(self::$orchestrationParams['endpoint_ip'] . '/' . self::$orchestrationParams['run'], $data);
    }
    
    public static function instance($data) {
        return self::request(self::$orchestrationParams['endpoint_ip'] . '/' . self::$orchestrationParams['instance'], $data);
    }
    
    public static function getDeploymentStatus($data) {
        return self::request(self::$orchestrationParams['endpoint_ip'] . '/' . self::$orchestrationParams['getDeploymentStatus'], $data);
    }
    
    public static function getLog($data) {
      return self::request(self::$orchestrationParams['endpoint_ip'] . '/' . self::$orchestrationParams['getLog'], $data);
    }
    
    public static function uploadKey($data) {
        return self::request(self::$orchestrationParams['endpoint_ip'] . '/' . self::$orchestrationParams['uploadKey'], $data);
    }
    
    public static function downloadKey($data) {
        return self::request(self::$orchestrationParams['endpoint_ip'] . '/' . self::$orchestrationParams['downloadKey'], $data);
    }
}
