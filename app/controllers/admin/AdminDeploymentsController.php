<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - getIndex()
 * Classes list:
 * - AdminDeploymentsController extends BaseController
 */
class AdminDeploymentsController extends AdminController {
    /**
     * CloudAccount Model
     * @var accounts
     */
    protected $deployment;
    /**
     * User Model
     * @var User
     */
    protected $user;
    /**
     * Inject the models.
     * @param Account $account
     * @param User $user
     */
    public function __construct(Deployment $deployment, User $user) {
        parent::__construct();
        $this->deployment = $deployment;
        $this->user = $user;
    }
	
    /**
     * Show a list of all the blog posts.
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/deployments/title.deployment_management');

        // Grab all the blog posts
        $deployments = $this->deployment;

        // Show the page
        return View::make('admin/deployments/index', compact('deployments', 'title'));
    }
   
   /**
     * Show a list of all the blog posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
    	$deployments = Deployment::select(array('deployments.id', 'deployments.name', 'cloudAccounts.name as AcctName', 'cloudAccounts.cloudProvider', 'users.username', 'users.email', 'cloudAccounts.created_at'))
					->join('users', 'users.id', '=', 'deployments.user_id')
					->join('cloudAccounts', 'cloudAccounts.id', '=', 'deployments.cloudAccountId');

        return Datatables::of($deployments)

		->remove_column('id')

        ->make();
    }
	
}
