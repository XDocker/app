<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - getIndex()
 * - getCreate()
 * - postEdit()
 * - postDelete()
 * Classes list:
 * - AccountController extends BaseController
 */
class AccountController extends BaseController {
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
     * Returns all the Accounts for logged in user.
     *
     * @return View
     */
    public function getIndex() {
        // Get all the user's accounts
        //Auth::id() : gives the logged in userid
        $accounts = $this->accounts->where('user_id', Auth::id())->orderBy('created_at', 'DESC')->paginate(10);
        // var_dump($accounts, $this->accounts, $this->accounts->owner);
        // Show the page
        return View::make('site/account/index', array(
            'accounts' => $accounts
        ));
    }
    /**
     * Displays the form for cloud account creation
     *
     */
    public function getCreate($id = false) {
        $mode = $id !== false ? 'edit' : 'create';
		$account =  $id !== false ? CloudAccountHelper::findAndDecrypt($id) : null;
		$providers = Config::get('account_schema');
        return View::make('site/account/create_edit', compact('mode', 'account', 'providers'));
    }
    /**
     * Saves/Edits an account
     *
     */
    public function postEdit($id = false) {
    	if($id !== false)
    		$account = CloudAccount::where('user_id', Auth::id())->findOrFail($id);
        try {
            if (empty($account)) {
                $account = new CloudAccount;
            } else if ($account->user_id !== Auth::id()) {
                throw new Exception('general.access_denied');
            }
		    
            $account->name = Input::get('name');
            $account->cloudProvider = Input::get('cloudProvider');
            $account->credentials = json_encode(Input::get('credentials'));
            $account->user_id = Auth::id(); // logged in user id
            
            $conStatus = CloudProvider::authenticate($account);
            
            
            if ($conStatus == 1) {
            	Log::info('Credentials are encrypted before saving to DB.');
				CloudAccountHelper::save($account);
            	return Redirect::intended('account')->with('success', Lang::get('account/account.account_updated'));
            } else {
                return Redirect::to('account')->with('error', Lang::get('account/account.account_auth_failed'));
            }
        }
        catch(Exception $e) {
            Log::error($e);
            return Redirect::to('account')->with('error', $e->getMessage());
        }
    }
    /**
     * Remove the specified Account .
     *
     * @param $account
     *
     */
    public function postDelete($account) {
    		
    	if(empty($account->id)) $account = CloudAccount::where('user_id', Auth::id())->find($account);
		
		$deployment = Deployment::where('user_id', Auth::id())->where('cloudAccountId', $account->id)->get();
		if(!$deployment->isEmpty())
		{
			  return Redirect::to('account')->with('error', 'Deployment is linked with this account and hence cannot be deleted');
		}
		
		
        CloudAccount::where('id', $account->id)->where('user_id', Auth::id())->delete();
        
        $id = $account->id;
        $account->delete();
        // Was the comment post deleted?
        $account = CloudAccount::where('user_id', Auth::id())->find($id);
        if (empty($account)) {
            // TODO needs to delete all of that user's content
            return Redirect::to('account')->with('success', 'Removed Account Successfully');
        } else {
            // There was a problem deleting the user
            return Redirect::to('account/' . $account->id . '/edit')->with('error', 'Error while deleting');
        }
    }
	
}
