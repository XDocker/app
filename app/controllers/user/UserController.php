<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - getIndex()
 * - postIndex()
 * - postEdit()
 * - getCreate()
 * - getLogin()
 * - postLogin()
 * - socialLogin()
 * - getConfirm()
 * - getForgot()
 * - postForgot()
 * - getReset()
 * - postReset()
 * - getLogout()
 * - getProfile()
 * - getSettings()
 * - processRedirect()
 * Classes list:
 * - UserController extends BaseController
 */
class UserController extends BaseController {
    /**
     * User Model
     * @var User
     */
    protected $user;
    /**
     * Inject the models.
     * @param User $user
     */
    public function __construct(User $user) {
        parent::__construct();
        $this->user = $user;
    }
    /**
     * Users settings page
     *
     * @return View
     */
    public function getIndex() {
        list($user, $redirect) = $this->user->checkAuthAndRedirect('user');
        if ($redirect) {
            return $redirect;
        }
        // Show the page
        return View::make('site/user/index', compact('user'));
    }
    /**
     * Stores new user
     *
     */
    public function postIndex() {
        $this->user->username = Input::get('username');
        $this->user->email = Input::get('email');
        
        $password = Input::get('password');
        $passwordConfirmation = Input::get('password_confirmation');
        
        if (!empty($password)) {
            if ($password === $passwordConfirmation) {
                $this->user->password = $password;
                // The password confirmation will be removed from model
                // before saving. This field will be used in Ardent's
                // auto validation.
                $this->user->password_confirmation = $passwordConfirmation;
            } else {
                // Redirect to the new user page
                return Redirect::to('user/create')->withInput(Input::except('password', 'password_confirmation'))->with('error', Lang::get('admin/users/messages.password_does_not_match'));
            }
        } else {
            unset($this->user->password);
            unset($this->user->password_confirmation);
        }
        // Save if valid. Password field will be hashed before save
        $this->user->save();
        
        if ($this->user->id) {
            // Redirect with success message, You may replace "Lang::get(..." for your custom message.
            return Redirect::to('user/login')->with('success', Lang::get('user/user.user_account_created'));
        } else {
            // Get validation errors (see Ardent package)
            $error = $this->user->errors()->all();
            
            return Redirect::to('user/create')->withInput(Input::except('password'))->with('error', $error);
        }
    }
    /**
     * Edits a user
     *
     */
    public function postEdit($user) {
        // Validate the inputs
        $validator = Validator::make(Input::all() , $user->getUpdateRules());
        
        if ($validator->passes()) {
            $oldUser = clone $user;
            $user->username = Input::get('username');
            $user->email = Input::get('email');
            
            $password = Input::get('password');
            $passwordConfirmation = Input::get('password_confirmation');
            
            if (!empty($password)) {
                if ($password === $passwordConfirmation) {
                    $user->password = $password;
                    // The password confirmation will be removed from model
                    // before saving. This field will be used in Ardent's
                    // auto validation.
                    $user->password_confirmation = $passwordConfirmation;
                } else {
                    // Redirect to the new user page
                    return Redirect::to('users')->with('error', Lang::get('admin/users/messages.password_does_not_match'));
                }
            } else {
                unset($user->password);
                unset($user->password_confirmation);
            }
            
            $user->prepareRules($oldUser, $user);
            // Save if valid. Password field will be hashed before save
            $user->amend();
        }
        // Get validation errors (see Ardent package)
        $error = $user->errors()->all();
        
        if (empty($error)) {
            return Redirect::to('user')->with('success', Lang::get('user/user.user_account_updated'));
        } else {
            return Redirect::to('user')->withInput(Input::except('password', 'password_confirmation'))->with('error', $error);
        }
    }
    /**
     * Displays the form for user creation
     *
     */
    public function getCreate() {
        return View::make('site/user/create');
    }
    /**
     * Displays the login form
     *
     */
    public function getLogin() {
        $user = Auth::user();
        if (!empty($user->id)) {
            return Redirect::to('/');
        }
        
        return View::make('site/user/login');
    }
    /**
     * Attempt to do login
     *
     */
    public function postLogin() {
        $input = array(
            'email' => Input::get('email') , // May be the username too
            'username' => Input::get('email') , // May be the username too
            'password' => Input::get('password') ,
            'remember' => Input::get('remember') ,
        );
		
		
        // If you wish to only allow login from confirmed users, call logAttempt
        // with the second parameter as true.
        // logAttempt will check if the 'email' perhaps is the username.
        // Check that the user is confirmed.
        if (Confide::logAttempt($input, true)) {
        	return Redirect::intended('/');
        } else {
            // Check if there was too many login attempts
            if (Confide::isThrottled($input)) {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            } elseif ($this->user->checkUserExists($input) && !$this->user->isConfirmed($input)) {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            } else {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }
            
            return Redirect::to('user/login')->withInput(Input::except('password'))->with('error', $err_msg);
        }
    }
    
    public function socialLogin($action = "") {
        // check URL segment
        if ($action == "auth") {
            // process authentication
            try {
                Hybrid_Endpoint::process();
            }
            catch(Exception $e) {
                Log::error($e);
                // redirect back to http://URL/social/
                return Redirect::route('hybridauth')->with('error', $e->getMessage());
            }
            return;
        }
        try {
            // create a HybridAuth object
            $socialAuth = new Hybrid_Auth(app_path() . '/config/hybridauth.php');
            // authenticate with Facebook
            $provider = $socialAuth->authenticate(strtolower(Input::get('provider')));
            // fetch user profile
            $userProfile = $provider->getUserProfile();
            // Log the user in
            $providerName = Input::get('provider');
            $email = isset($userProfile->emailVerified) ? $userProfile->emailVerified : $userProfile->email;
            // @FIXME Generating a dummy email for github/linkedin as they aren't passing along the email ID
            if (empty($email)) {
                $email = preg_replace('/[\s\W]+/', '_', $userProfile->displayName) . '@' . $providerName . '.com';
            }
            
            $user = User::where('email', $email)->first();
            if (empty($user)) {
                // Register
                $user = new User;
                $user->email = $email;
                // Generate a username from the email for compatibility with Confide's schema
                $user->username = preg_replace('/[\s\W]+/', '_', $email);
                // Assign a random password for compatibility with Confide's Auth
                $randomPass = Hash::make(uniqid(mt_rand() , true));
                $user->password = $randomPass;
                $user->password_confirmation = $randomPass;
                $user->confirmation_code = md5(uniqid(mt_rand() , true));
                // Set as confirmed by default since we have social proof
                $user->confirmed = 1;
                // var_dump('created', $user->save() , $user->errors());
                if (!$user->save()) {
                    throw new Exception($user->errors());
                }
            }
            Auth::loginUsingId($user->id);
            // Confide::logAttempt((array) $user);
            return Redirect::intended('/');
        }
        catch(Exception $e) {
            // exception codes can be found on HybBridAuth's web site
            var_dump('$e', $e);
            Log::error($e);
            try {
                // Logout older providers - clear expired connections
                $socialAuth = new Hybrid_Auth(app_path() . '/config/hybridauth.php');
                $socialAuth->logoutAllProviders();
                return Redirect::to('user/login')->with('error', $e->getMessage() . '<br/>Please try again later!');
            }
            catch(Exception $err) {
                Log::error($err);
                return Redirect::to('user/login')->with('notice', $e->getMessage() . '<hr/>' . $err->getMessage());
            }
        }
    }
    /**
     * Attempt to confirm account with code
     *
     * @param  string  $code
     */
    public function getConfirm($code) {
        if (Confide::confirm($code)) {
            return Redirect::to('user/login')->with('notice', Lang::get('confide::confide.alerts.confirmation'));
        } else {
            return Redirect::to('user/login')->with('error', Lang::get('confide::confide.alerts.wrong_confirmation'));
        }
    }
    /**
     * Displays the forgot password form
     *
     */
    public function getForgot() {
        return View::make('site/user/forgot');
    }
    /**
     * Attempt to reset password with given email
     *
     */
    public function postForgot() {
        if (Confide::forgotPassword(Input::get('email'))) {
            return Redirect::to('user/login')->with('notice', Lang::get('confide::confide.alerts.password_forgot'));
        } else {
            return Redirect::to('user/forgot')->withInput()->with('error', Lang::get('confide::confide.alerts.wrong_password_forgot'));
        }
    }
    /**
     * Shows the change password form with the given token
     *
     */
    public function getReset($token) {
        
        return View::make('site/user/reset')->with('token', $token);
    }
    /**
     * Attempt change password of the user
     *
     */
    public function postReset() {
        $input = array(
            'token' => Input::get('token') ,
            'password' => Input::get('password') ,
            'password_confirmation' => Input::get('password_confirmation') ,
        );
        // By passing an array with the token, password and confirmation
        if (Confide::resetPassword($input)) {
            return Redirect::to('user/login')->with('notice', Lang::get('confide::confide.alerts.password_reset'));
        } else {
            return Redirect::to('user/reset/' . $input['token'])->withInput()->with('error', Lang::get('confide::confide.alerts.wrong_password_reset'));
        }
    }
    /**
     * Log the user out of the application.
     *
     */
    public function getLogout() {
        Confide::logout();
        
        try {
            // Logout all providers
            $socialAuth = new Hybrid_Auth(app_path() . '/config/hybridauth.php');
            $socialAuth->logoutAllProviders();
        }
        catch(Exception $err) {
            Log::error($err);
            return Redirect::to('/')->with('notice', $err->getMessage());
        }
        
        return Redirect::to('/');
    }
    /**
     * Get user's profile
     * @param $username
     * @return mixed
     */
    public function getProfile($username) {
        $userModel = new User;
        $user = $userModel->getUserByUsername($username);
        // Check if the user exists
        if (is_null($user)) {
            return App::abort(404);
        }
        
        return View::make('site/user/profile', compact('user'));
    }
    
    public function getSettings() {
        list($user, $redirect) = User::checkAuthAndRedirect('user/settings');
        if ($redirect) {
            return $redirect;
        }
        
        return View::make('site/user/profile', compact('user'));
    }
    /**
     * Process a dumb redirect.
     * @param $url1
     * @param $url2
     * @param $url3
     * @return string
     */
    public function processRedirect($url1, $url2, $url3) {
        $redirect = '';
        if (!empty($url1)) {
            $redirect = $url1;
            $redirect.= (empty($url2) ? '' : '/' . $url2);
            $redirect.= (empty($url3) ? '' : '/' . $url3);
        }
        return $redirect;
    }
}
