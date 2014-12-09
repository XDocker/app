<?php
/**
* Class and Function List:
* Function list:
* - author()
* Classes list:
* - CloudAccount extends \
*/
class EngineLog extends \Eloquent 
{
    protected $fillable = [];
	
	public static function logIt($arr)
	{
		$engineLog  = new EngineLog();
		$engineLog -> user_id = $arr['user_id'];
		$engineLog -> method = $arr['method'];
		$engineLog -> status_message = $arr['return'];
		if (!$engineLog->save()) {
         	Log::error('Engine Log Save ' . $engineLog->errors());
        }
	}
}
