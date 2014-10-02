<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - getIndex()
 * Classes list:
 * - WebserviceController extends BaseController
 */
class WebserviceController extends BaseController {
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
    public function __construct(User $user) {
        parent::__construct();
        $this->user = $user;
    }
    /**
     * Returns all the blog posts.
     *
     * @return View
     */
    public function getIndex() {
        if (Auth::check()) {
          	$responseJson = xDockerEngine::authenticate(array('username' => Auth::user()->username, 'password' => md5(Auth::user()->engine_key)));
			EngineLog::logIt(array('user_id' => Auth::id(), 'method' => 'Status Page : authenticate', 'return' => $responseJson));
       } else {
            $responseJson = '';
        }
       
	   	$status = 'error';
        // Show the page
        if(!empty($responseJson))
		{
			$obj = json_decode($responseJson);
			if($obj->status == 'OK')
			{
				$status = 'OK';
			}
		}
        return View::make('site/serviceStatus/index', array(
            'status' => $status
        ));
    }
}
