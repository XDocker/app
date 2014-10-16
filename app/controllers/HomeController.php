<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - getIndex()
 * Classes list:
 * - HomeController extends BaseController
 */
class HomeController extends BaseController {
    /**
     * Post Model
     * @var Post
     */
     protected $deployments;
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
    public function __construct(Deployment $deployment, User $user) {
        parent::__construct();
        $this->deployments = $deployment;
        $this->user = $user;
    }
    /**
     * Returns all the blog posts.
     *
     * @return View
     */
    public function getIndex() {
        if (Auth::check()) {
            //$deployments = Deployment::where('user_id', Auth::id())->get();
			$deployments = DeploymentQueryHelper::getQuery( $this->deployments, 10 );
		
        } else {
            $deployments = array();
        }
        try {
            $search_term = Input::get('q');
            if (empty($search_term)) {
                $search_term = 'xdocker';
            }
            
            $response = xDockerEngine::dockerHubGet($search_term);
            $dockerInstances = !empty($response) ? $response->results : '';
        }
        catch(Exception $e) {
            Log::error('Exception while loading docker images!');
            $dockerInstances = array();
        }
        // Show the page
        return View::make('site/home/index', array(
            'deployments' => $deployments,
            'search_term' => $search_term,
            'dockerInstances' => $dockerInstances
        ));
    }
}

