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
 * - DeploymentController extends BaseController
 */
class DeploymentController extends BaseController {
    /**
     * Deployment Model
     * @var deployments
     */
    protected $deployments;
    /**
     * User Model
     * @var User
     */
    protected $user;
    /**
     * Inject the models.
     * @param Deployment $deployments
     * @param User $user
     */
    public function __construct(Deployment $deployments, User $user) {
        parent::__construct();
        $this->deployments = $deployments->where('deployments.user_id', Auth::id());
        $this->user = $user;
    }
    
    public function getIndex() {
        // Get all the user's deployment
        $deployments = $this->deployments
            ->select('cloud_accounts.name as accountName', 'cloud_accounts.cloudProvider', 'deployments.name', 'deployments.cloud_account_id', 'deployments.created_at')
            ->leftJoin('cloud_accounts', 'deployments.cloud_account_id', '=', 'cloud_accounts.id')
            ->where('deployments.user_id', Auth::id())
            ->orderBy('deployments.created_at', 'DESC')
            ->paginate(10);
			
			$search_term = Input::get('q');
            if (empty($search_term)) {
                $search_term = 'xdocker';
            }
           
            $response = xDockerEngine::dockerHubGet($search_term);
            
            $dockerInstances = $response->results;
        // var_dump($accounts, $this->accounts, $this->accounts->owner);
        // Show the page
        return View::make('site/deployment/index', array(
            'deployments' => $deployments,
            'search_term' => $search_term,
            'dockerInstances' => $dockerInstances,
        ));
    }
    /**
     * Displays the form for cloud deployment creation
     *
     */
    public function getCreate($id = false) {
        $mode = $id !== false ? 'edit' : 'create';
        $deployment = $id !== false ? Deployment::where('user_id', Auth::id())->findOrFail($id) : null;
        $cloud_account_ids = CloudAccount::where('user_id', Auth::id())->get();
        if (empty($cloud_account_ids) || $cloud_account_ids->isEmpty()) {
            return Redirect::to('account/create')->with('error', Lang::get('deployment/deployment.account_required'));
        }
		$providers = Config::get('deployment_schema');
		return View::make('site/deployment/create', array(
            'mode' => $mode,
            'deployment' => $deployment,
            'providers' => $providers,
            'cloud_account_ids' => $cloud_account_ids,
            'docker_name' => Input::get('name')
        ));
    }
    /**
     * Saves/Edits an deployment
     *
     */
    public function postEdit($deployment = false) {
        try {
            if (empty($deployment)) {
                $deployment = new Deployment;
            } else if ($deployment->user_id !== Auth::id()) {
                throw new Exception('general.access_denied');
            }
            $deployment->name = Input::get('name');
            $deployment->cloud_account_id = Input::get('cloud_account_id');
            $deployment->parameters = json_encode(Input::get('parameters'));
            $deployment->docker_name = Input::get('docker_name');
            $deployment->user_id = Auth::id(); // logged in user id
            try {
                // Get and save status from external WS
                $user = Auth::user();
				$responseJson = xDockerEngine::authenticate(array('username' => $user->username, 'password' => md5($user->engine_key)));
				EngineLog::logIt(array('user_id' => Auth::id(), 'method' => 'authenticate', 'return' => $responseJson));
				$obj = json_decode($responseJson);
				print_r($obj);
				if($obj->status == 'OK')
				{
					echo ' Ready for deployment:'. $obj->token;
				}
				
                /*$process = curl_init(Config::get('deployment_api.url'));
                curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
                $fields = array(
                    'parameters' => $deployment->parameters,
                    'cloud_account' => CloudAccount::findOrFail($deployment->cloud_account_id) ,
                    'docker_name' => $deployment->docker_name
                );
                //url-ify the data for the POST
                $fields_string = '';
                foreach ($fields as $key => $value) {
                    $fields_string.= $key . '=' . $value . '&';
                }
                $status = curl_exec($process);
                curl_setopt($process, CURLOPT_POST, count($fields));
                curl_setopt($process, CURLOPT_POSTFIELDS, $fields_string);
                curl_close($process);
				 * */
            }
            catch(Exception $err) {
                $status = 'Unexpected Error: ' . $err->getMessage();
                throw new Exception($err->getMessage());
            }
            $deployment->status = $status;
            $success = $deployment->save();
            if (!$success) {
                throw new Exception($deployment->errors());
            }
            // return var_dump($deployment);
            
            //$error = $deployment->errors()->all();
            return Redirect::to('/')->with('success', Lang::get('deployment/deployment.deployment_updated'));
        }
        catch(Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }
    /**
     * Remove the specified Account .
     *
     * @param $deployment
     *
     */
    public function postDelete($id) {
        Deployment::where('id', $id)->where('user_id', Auth::id())->delete();
        // Was the comment post deleted?
        $deployment = Deployment::where('user_id', Auth::id())->find($id);
        if (empty($deployment)) {
            // TODO needs to delete all of that user's content
            return Redirect::to('/')->with('success', 'Removed Deployment Successfully');
        } else {
            // There was a problem deleting the user
            return Redirect::to('/')->with('error', 'Error while deleting');
        }
    }
}
