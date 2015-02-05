<?php


class FeedbackController extends BaseController  {


	public function getFeedback(){

    $feedbackmessage = Input::get('feedbackmessage');
    $feedbackemail   = Input::get('feedbackemail');
    $feedbackdescription = Input::get('feedbackdescription');
    
    $adminEmail = Config::get('mail');
    
    $data = array(
	'messages'	=> $feedbackmessage,
	'description'=>$feedbackdescription,
	'user_email'=>$feedbackemail
     );

    Mail::send('site/feedbackmail', $data, function($message) use ($adminEmail)
    {
      $message->to($adminEmail['from']['address'])->subject('New Feedback');
    });

    echo 'Feedback Sent Successfully';

    }

    
}


?>