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
class EnginelogController extends BaseController {
    /**
     * CloudAccount Model
     * @var accounts
     */
    protected $enginelog;
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
    public function __construct(EngineLog $enginelog, User $user) {
        parent::__construct();
        $this->enginelog = $enginelog;
        $this->user = $user;
    }
    /**
     * Returns all the Accounts for logged in user.
     *
     * @return View
     */
    public function getIndex() {
        // Get all the user's accounts
        $enginelog = $this->enginelog->where('user_id', Auth::id())->orderBy('created_at', 'DESC')->paginate(10);
        return View::make('site/enginelog/index', array(
            'enginelog' => $enginelog
        ));
    }
    
}
