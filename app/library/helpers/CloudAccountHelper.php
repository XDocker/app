<?php

/**
 * Class and Function List:
 * Function list:
 * - findAndDecrypt()
 *  Function list:
 * - save()
 * Classes list:
 * - CloudAccountHelper
 */
class CloudAccountHelper
{
	public static function findAndDecrypt($id)
	{
		$account = CloudAccount::where('user_id', Auth::id())->findOrFail($id) ;
		$account->credentials = StringHelper::decrypt($account->credentials, md5(Auth::user()->username));
		return $account;
	}
	
	public static function save($account)
	{
		$account->credentials = StringHelper::encrypt($account->credentials, md5(Auth::user()->username));
        return $account->save();
	}
	
}
	