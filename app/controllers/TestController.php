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
		print xDockerEngine::register(   array(
                    'username' => 'sudhi', 
                    'password' => 'sudhi'
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
		
		
		print_r($status);
		//$engine ->server($orchestrationParams)
	}
}
