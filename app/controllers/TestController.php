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
		$process = curl_init(Config::get('orchestration.endpoint_ip') . Config::get('orchestration.register'));
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
        $fields = array(
                    'username' => 'sudhi',
                    'password' => 'sudhi'
        );
                //url-ify the data for the POST
                $fields_string = '';
                foreach ($fields as $key => $value) {
                    $fields_string.= $key . '=' . $value . '&';
                }
        $status = curl_exec($process);
        curl_setopt($process, CURLOPT_POST, count($fields));
        curl_setopt($process, CURLOPT_POSTFIELDS, $fields_string);
        curl_close($process);
		
		print_r($status);
		//$engine ->server($orchestrationParams)
	}
}