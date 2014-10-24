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
    	$response ='';
        if (!Auth::check()) {
          	return Redirect::to('/')->with('error', Lang::get('genera.must_login'));
		}
        return View::make('site/serviceStatus/index', array(
            'vars' => array( Lang::get('site.docker_service') => xDockerEngine::getDockerServiceStatus(), 
            				Lang::get('site.webservice') => xDockerEngine::getxDockerServiceStatus(), )
        ));
    }
}
