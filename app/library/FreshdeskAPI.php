<?php
/**
 * Class and Function List:
 * Function list:
 * - init()
 
 * Classes list:
 * - FreshdeskAPI
 */
class FreshdeskAPI 
{
    private static $credentials;
	private static $endpointUrl;	
    
    private static function init() 
    {
        self::$credentials = Config::get('thirdparty_integration.Freshdesk');
		
    }
	
	public static function getTickets()
	{
		self::init();
		$process = curl_init( self::$credentials['endpointUrl'] . 'tickets.json');
        Log::info((Auth::check() ? Auth::user()->username : '__Guest__') . ' URL : ' . self::$credentials['endpointUrl'] . 'tickets.json');
        curl_setopt($process, CURLOPT_USERPWD, self::$credentials['apiKey'] . ":X");
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
        $response = curl_exec($process);
        curl_close($process);
        return json_decode($response);
	}
	
	public static function addTicket()
	{
		
	}
	
	
	
}
    