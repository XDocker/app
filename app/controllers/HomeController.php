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
    public function __construct(Post $post, User $user) {
        parent::__construct();
        
        $this->user = $user;
    }
    /**
     * Returns all the blog posts.
     *
     * @return View
     */
    public function getIndex() {
        
        $deployments = Deployment::where('user_id', Auth::id())->get();
        
        try {
            $dockerHubCredentials = Config::get('local/thirdparty_integration.Docker_Hub');
            $search_term = Input::get('q');
            if (empty($search_term)) {
                $search_term = 'xdocker';
            }
            $process = curl_init($dockerHubCredentials['search_url'] . $search_term);
            curl_setopt($process, CURLOPT_USERPWD, $dockerHubCredentials['username'] . ":" . $dockerHubCredentials['password']);
            curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
            $response = curl_exec($process);
            curl_close($process);
            
            $response = json_decode($response);
            
            $dockerInstances = $response->results;
            // var_dump($dockerHubCredentials, $dockerInstances, json_decode($dockerInstances));
            
            
        }
        catch(Exception $e) {
            $dockerInstances = array();
        }
        // Show the page
        return View::make('site/home/index', array(
            'dockerInstances' => $dockerInstances,
            'search_term' => $search_term,
            'deployments' => $deployments
        ));
    }
}
