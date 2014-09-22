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
		
		 $engine = new xDockerEngine();
		 $orchestrationParams = Config::get('orchestration');
		 echo '<pre>';
		 print_r($orchestrationParams);
		 //$engine ->server($orchestrationParams)
	}
}