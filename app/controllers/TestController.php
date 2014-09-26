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
     * Test Model
     * @var tests
     */
    protected $tests;
   
    /**
     * Inject the models.
     * @param Post $post
     * @param User $user
     */
    public function __construct(Test $test) 
    {
        parent::__construct();
		$this->tests = $test;
    }
	
	
	public function getIndex()
	{
		echo 'Index test';
		$tests = $this->tests->orderBy('created_at', 'DESC')->paginate(10);
        // var_dump($accounts, $this->accounts, $this->accounts->owner);
        // Show the page
        return View::make('site/tests/index', array(
            'tests' => $tests
        ));
	}
	
	public function getCreate()
	{
		echo 'Create';
	}
	
	public function postEdit()
	{
		echo 'postEdit';
	}
	
	public function postDelete()
	{
		echo 'postDelete';
	}
	
	 /**
     * Returns all the blog posts.
     *
     * @return View
     */
    public function getIndex2() {
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
