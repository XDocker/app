<?php

/**
 * Class and Function List:
 * Function list:
 * - findAndDecrypt()
 *  Function list:
 * - save()
 * Classes list:
 * - RedirectHelper
 */
class UtilHelper
{
	public static function check($json = false)
	{
			
		if(AWSBillingEngine::getServiceStatus() == 'error')
		{
			Log::error(Lang::get('account/account.awsbilling_service_down'));
			if($json)
			{
				print json_encode(array('status' => 'error', 'message' => Lang::get('account/account.awsbilling_service_down')));
				return;	
			}
			else {
				Redirect::intended('/ServiceStatus')->with('error', Lang::get('account/account.awsbilling_service_down')); 
			}
		}
	}
	
	public static function sendMail($user, $accountName, $deploymentName, $template, $subject)
	{
		$data['deploymentName'] = $deploymentName;
		$data['accountName'] = $accountName;
		$adminEmail = Config::get('mail');
		Mail::send($template, $data, function($message) use ($user, $subject, $adminEmail)
		{
		  $message->to($user->email, $user->username)->to($adminEmail['supportEmail'])
		          ->subject($subject);
		});
	}
}