<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - getIndex()
 * - getCreate()
 * - postEdit()
 * - getFields()
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
        $accounts = $this->accounts->orderBy('created_at', 'DESC')->paginate(10);
        // var_dump($accounts, $this->accounts, $this->accounts->owner);
        // Show the page
        return View::make('site/account/index', compact('accounts'));
    }
    /**
     * Displays the form for cloud account creation
     *
     */
    public function getCreate($id = false) {
        $mode = $id !== false ? 'edit' : 'create';
        $account = $id !== false ? $this->accounts->findOrfail($id) : null;
        $title = '';
        $providers = Config::get('cloud_account_schema');
        return View::make('site/account/create_edit', compact('mode', 'account', 'title', 'providers'));
    }
    /**
     * Saves/Edits an account
     *
     */
    public function postEdit($account = false) {
        try {
            if (empty($account)) {
                $account = new CloudAccount;
            }
            $account->name = Input::get('name');
            $account->cloudProvider = Input::get('cloudProvider');
            $account->credentials = json_encode(Input::get('credentials'));
            $account->user_id = Auth::id(); // logged in user id
            //@TODO  based on the json template for provider to populate, load the field and values.
            // Save it in credentials field of table as json.
            // $account->prepareRules($oldAccount, $account);
            // Save if valid.
            $success = $account->save();
            // return var_dump($account);
            
            //$error = $account->errors()->all();
            return Redirect::to('account')->with('success', Lang::get('account/account.account_account_updated'));
        }
        catch(Exception $e) {
            return Redirect::to('account')->with('error', $error);
        }
    }
    
    public function getFields() {
        $ret = '';
        
        $provider = Input::get('provider');
        $accountId = Input::get('accountId');
        if (!empty($accountId)) {
            $acctModel = new CloudAccount($accountId);
        }
        
        switch ($provider) {
            case 'Amazon AWS':
                $apiAccessKey = isset($acctModel->content->apiAccessKey) ? $acctModel->content->apiAccessKey : '';
                $secretAccessKey = isset($acctModel->content->secretAccessKey) ? $acctModel->content->secretAccessKey : '';
                $ret = array(
                    array(
                        'id' => 'apiAccessKey',
                        'name' => 'apiAccessKey',
                        'type' => 'text',
                        'value' => $apiAccessKey
                    ) ,
                    array(
                        'id' => 'secretAccessKey',
                        'name' => 'secretAccessKey',
                        'type' => 'text',
                        'value' => $secretAccessKey
                    ) ,
                );
        }
        print json_encode($ret);
    }
}
