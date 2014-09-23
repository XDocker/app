<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - getIndex()
 * Classes list:
 * - HomeController extends BaseController
 */
class TestController extends BaseController {
    /**
     * Post Model
     * @var Post
     */
    /**
     * User Model
     * @var User
     */
    protected $user;
    /**
     * Inject the models.
     * @param Post $post
     * @param User $user
     */
    public function __construct() 
    {
        parent::__construct();
            
       
    }
	
	 /**
     * Returns all the blog posts.
     *
     * @return View
     */
    public function getIndex() {
    	echo 'Test Controller';
		
		$orchestrationParams = Config::get('orchestration');
		echo '<pre>';
		print_r($orchestrationParams);
		$process = curl_init();
		curl_setopt($process, CURLOPT_URL, 'http://104.131.38.159:5000' . '/register');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
        $fields = array(
                    'username' => 'sudhi', 
                    'password' => 'sudhi'
        );
                //url-ify the data for the POST
	curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($process, CURLOPT_POSTFIELDS, json_encode($fields));                                                                  
curl_setopt($process, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($process, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen(json_encode($fields)))                                                                       
);                                             
       $status = curl_exec($process);
       curl_close($process);
		
		print_r($status);
		//$engine ->server($orchestrationParams)
	}
}
