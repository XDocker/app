<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - getIndex()
 * Classes list:
 * - AdminAccountController extends BaseController
 */
class AdminAccountController extends AdminController {
    /**
     * CloudAccount Model
     * @var accounts
     */
    protected $accounts;
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
    public function __construct(CloudAccount $accounts, User $user) {
        parent::__construct();
        $this->accounts = $accounts;
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
        $title = Lang::get('admin/accounts/title.account_management');

        // Grab all the blog posts
        $accounts = $this->accounts;

        // Show the page
        return View::make('admin/accounts/index', compact('accounts', 'title'));
    }
   
   /**
     * Show a list of all the blog posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
    	$tickets = CloudAccount::select(array('cloudAccounts.id', 'cloudAccounts.name', 'cloudAccounts.cloudProvider', 'tickets.created_at'));

        return Datatables::of($tickets)

		 ->remove_column('id')

        ->make();
    }
	
}
