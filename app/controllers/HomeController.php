<?php

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
    public function __construct(Post $post, User $user)
    {
        parent::__construct();

        $this->user = $user;
    }
    
	/**
	 * Returns all the blog posts.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		 $providers = Config::get('thirdparty_integration');
		 
		 
		// Show the page
		return View::make('site/home/index');
	}
}
