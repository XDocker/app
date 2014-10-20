<?php defined('BASEPATH') OR exit('No direct script access allowed');

class StringHelper
{
	public $phpmongoClient;
	
	public static function startsWith($haystack, $needle)
	{
    	 return strpos($haystack, $needle) === 0;
	}

	public static function endsWith($haystack, $needle)
	{
	   return substr($haystack, -strlen($needle)) == $needle;
	}
	
	public static function getUniqueId($prefix = 'XERVMON',$entropy){
		return uniqid($prefix, $entropy);
	}
	
	public static function gen_uuid() 
	{
    	return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    	);
	}
	
	public static function getProviderIcon($cloudProvider)
	{
		$icon= '';
		switch($cloudProvider) 
		{
        	case 'Rackspace Cloud' :
            $icon = base_url() . '/addons/shared_addons/themes/xervmon/img/rackspace-big.jpg';
            break;
	        case 'Amazon AWS' :
	            $icon = base_url() . '/addons/shared_addons/themes/xervmon/img/aws-big.jpg';
	            break;
	        case 'HP Cloud' :
	            $icon = base_url() . '/addons/shared_addons/themes/xervmon/img/providers/hpcloud_logo.png';
	            break;
	        case 'OpenStack' :
	            $icon = base_url() . '/addons/shared_addons/themes/xervmon/img/providers/openstack-small.png';
	        break;

	        case 'DigitalOcean' :
	        $icon = base_url() . '/addons/shared_addons/themes/xervmon/img/providers/digitalocean.png';
	        break;
	        default:
	        	$icon = base_url() . '/addons/shared_addons/themes/xervmon/img/xervmon-logo.png';
	        	break;
   		 }
    	return $icon;
	}

	public static function decrypt($base64encoded_ciphertext, $customerIdentifier) 
	{
		$key = $customerIdentifier;
		$iv = ci() -> config -> item('iv');

		$plaintext = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, base64_decode($base64encoded_ciphertext), MCRYPT_MODE_CBC, $iv);
		$plaintext = trim($plaintext);

		//Sostituisco tutti i caratteri fasulli
		for($i=0; $i<32; $i++) $plaintext = str_replace(chr($i), "", $plaintext);

		return $plaintext;
	}

	public static function encrypt($dvalue,$customerIdentifier)
	{
		if (!empty($dvalue))
		{
			$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
			$iv = ci() -> config -> item('iv');
			$key = $customerIdentifier;
			$crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $dvalue, MCRYPT_MODE_CBC, $iv);
			return base64_encode($crypttext);
		} else
			return $dvalue;
	}

    public static function auditTrailLog($post)
    {
		ci()-> phpmongoClient = new XervmonMongoQB();
        ci()->  phpmongoClient = ci()->  phpmongoClient -> getMongoQB();
        $post['generation'] = '';
        $post['created_on'] = microtime(true);
        $post['updated_on'] = microtime(true);
        $post['created_by'] = ci()-> current_user -> id;
        $post['updated_by'] = ci()-> current_user -> id;
        $post['type'] = 'auditTrailLog';
        $config =  ci()-> config->item('mongoqb');
        $post['customerIdentifer'] =$config['customer_identifier'];

        $post['cloudProvider'] = CloudType::AWS_CLOUD;
        $post['initiatedBy'] =ci()-> current_user -> display_name;

        ci()-> phpmongoClient -> insert('auditTrailLogMessage', $post);

        $post['sender_ip'] = ci()->  input -> ip_address();
        $post['sender_agent'] = ci()->  agent -> browser() . ' ' .  ci()->  agent -> version();
        $post['sender_os'] =  ci()->  agent -> platform();
		ci()-> phpmongoClient -> insert('iaasCloudAudit', $post);
    }	
	
    public static function auditLog($post)
    {
    	ci()-> phpmongoClient = new XervmonMongoQB();
        ci()->  phpmongoClient = ci()->  phpmongoClient -> getMongoQB();
        $post['generation'] = '';
        $post['created_on'] = microtime(true);
        $post['updated_on'] = microtime(true);
        $post['created_by'] =  ci()-> current_user -> id;
        $post['updated_by'] =  ci()-> current_user -> id;
	$post['type'] = 'auditTrailLog';
        $config =  ci()->config->item('mongoqb');
        $post['customerIdentifer'] =$config['customer_identifier'];

        $post['cloudProvider'] = CloudType::AWS_CLOUD;
        $post['initiatedBy'] =   ci()-> current_user -> display_name;

        ci()-> phpmongoClient -> insert('auditLogMessage', $post);

        $post['sender_ip'] =  ci()->input -> ip_address();
        $post['sender_agent'] =  ci()-> agent -> browser() . ' ' . ci()-> agent -> version();
        $post['sender_os'] =  ci()-> agent -> platform();
        ci()-> phpmongoClient -> insert('iaasCloudAudit', $post);
    }
		
	public static function getImage($image){
		$image = strtolower($image);
		$imagePath = '';
		if(strpos($image,'fedora') !== false)
		{
			$imagePath = self::getImageURL('fedora');
		}
		else if (strpos($image,'redhat') !== false || strpos($image,'red hat') !== false){
			$imagePath = self::getImageURL('redhat');
		}
		else if (strpos($image,'centos') !== false)
		{
			$imagePath = self::getImageURL('centos');
		}
		else if (strpos($image,'debian') !== false)
		{
			$imagePath = self::getImageURL('debian');
		}
		else if (strpos($image,'ubuntu') !== false)
		{
			$imagePath = self::getImageURL('ubuntu');
		}
		else 
		{
			$imagePath = self::getImageURL('linux');
		}
		return $imagePath;
	}
	
	private static function getImageURL($image){
		return 'addons/shared_addons/themes/xervmon/img/'.$image.'.png';
	}
	
	public static function urlFileExists($file)
	{
		$exists = false;
		$file_headers = @get_headers($file);
		if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
		    $exists = false;
		}
		else if($file_headers[0] == 'HTTP/1.1 401 Authorization Required') {
			$exists = false;
		}
		else {
		    $exists = true;
		}
		return $exists;
	}
	
	

	public static function isJson($string) 
	{
		if(!empty($string))
		{
 			json_decode($string);
 			return (json_last_error() == JSON_ERROR_NONE);
		}
		else
		{
			return false;
		}
	}

	public static function timeAgo($time)
	{
		$time = (!is_int($time)) ? strtotime($time) : $time;
		
		$now = time();
		
		$remainder = $now - $time;
		
		if($remainder < 60) 
		{
			return $remainder . ' seconds ago';
		} else if($remainder < 3600) 
		{
			$number = ceil($remainder / 60);
			$suffix = ($number > 1) ? 's' : '';
			return $number . ' minute' . $suffix . ' ago';
		} else if($remainder < 86400) 
		{
			$number = floor($remainder / 3600);
			$suffix = ($number > 1) ? 's' : '';
			return $number . ' hour' . $suffix . ' ago';
		} else 
		{
			$number = floor($remainder / 86400);
			$suffix = ($number > 1) ? 's' : '';
			return $number . ' day' . $suffix . ' ago';
		}
	}
	
	public static function getOperationStatus($status)
	{
		$ret = '';
		switch($status)
		{
			case 'Pending Installation' : $ret = '<span class="label label-warning" data-original-title="'.$status.'">B</span>';break;
			case 'Alerts disabled' : $ret = '<span class="label label-default" data-original-title="'.$status.'">D</span>';break;
			case 'No reports' : $ret = '<span class="label label-default" data-original-title="'.$status.'">N</span>';break;
			case 'Out of sync' : $ret = '<span class="label label-warning" data-original-title="'.$status.'">S</span>';break;
			case 'Error' : $ret = '<span class="label label-danger" data-original-title="'.$status.'">E</span>';break;
			case 'Active' : $ret = '<span class="label label-info" data-original-title="'.$status.'">A</span>';break;
			case 'Pending' : $ret = '<span class="label label-warning" data-original-title="'.$status.'">P</span>';break;
			default:	$ret = '<span class="label label-success" data-original-title="OK">O</span>';break;
			
		}
		return $ret;
	}
	
	public static function IsVirtual($value)
	{
		if($value->is_virtual == "true")
			return '<span class="badge badge-warning">VM</span>';
		else
			return '<span class="badge badge-info">D</span>';
	}
	
	public static function getProvider($value)
	{
		if(empty($value->blockdevices))
		{
			return '<img src="'.StringHelper::getProviderIcon('Xervmon').'" title="Default" />';
		}
		$blockDevice = explode(',',$value->blockdevices);
    	if(in_array ( $blockDevice[0] , array('sr0','vda')))
    	{
    		return '<img src="'.StringHelper::getProviderIcon('DigitalOcean').'" title="DigitalOcean" />';
    	}
    	else if(in_array ( $blockDevice[0] , array('xvda1','xvdb','xvdf')))
    	{
    		return '<img src="'.StringHelper::getProviderIcon('Amazon AWS').'" title="Amazon AWS" />';
    	}
    	else if(in_array ( $blockDevice[0] , array('sda')))
    	{
    		return '<img src="'.StringHelper::getProviderIcon('Xervmon').'" title="Default" />';
    		
    	}
	}
	
	public static function removeSpaces($str)
	{
		return $cleanAccountName = str_ireplace(" ", "_", $str);
	}
}
