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
	
	private function check($json = false)
	{
		if($json)
		{
			if(xDockerEngine::getDockerServiceStatus() == 'error')
			{
				Log::error(Lang::get('deployment/deployment.docker_service_down'));
				print json_encode(array('status' => 'error', 'message' => Lang::get('deployment/deployment.docker_service_down')));
				return;
			}
			if(xDockerEngine::getxDockerServiceStatus() == 'error')
			{
				Log::error(Lang::get('deployment/deployment.xdocker_service_down'));
				print json_encode(array('status' => 'error', 'message' => Lang::get('deployment/deployment.xdocker_service_down')));
				return;
			}
		}
		else 
		{
			
			if(xDockerEngine::getDockerServiceStatus() == 'error')
			{
				Log::error(Lang::get('deployment/deployment.docker_service_down'));
				return Redirect::to('ServiceStatus')->with('error', Lang::get('deployment/deployment.docker_service_down'));
			}
				
			if(xDockerEngine::getxDockerServiceStatus() == 'error')
			{
				Log::error(Lang::get('deployment/deployment.xdocker_service_down'));
				return Redirect::to('ServiceStatus')->with('error', Lang::get('deployment/deployment.xdocker_service_down'));
			}
		}
	}
    
    public function getIndex() {
        // Get all the user's deployment
        $deployments = DeploymentQueryHelper::getQuery( $this->deployments, 10 );
			
			$search_term = Input::get('q');
            if (empty($search_term)) {
                $search_term = 'xdocker';
            }
			
			$this->check();
           
            $response = xDockerEngine::dockerHubGet($search_term);
            
			
            $dockerInstances = !empty($response) ? $response->results : '';
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
    	$this->check();
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
    	$this->check();
        try {
            if (empty($deployment)) {
                $deployment = new Deployment;
            } else if ($deployment->user_id !== Auth::id()) {
                throw new Exception('general.access_denied');
            }
            $deployment->name = Input::get('name');
            $deployment->cloudAccountId = Input::get('cloudAccountId');
			//Check if account credentials are valid
			
			$account = CloudAccountHelper::findAndDecrypt($deployment->cloudAccountId);
			
			if(!CloudProvider::authenticate($account))
			{
				Log::error('Failed to authenticate before deployment! '. json_encode($account) );
				return Redirect::to('deployment/')->with('error', 'Failed to authenticate before deployment! '. $deployment->name);
			}
		
			$params = Input::get('parameters');
			//$params['instanceImage'] = Input::get('instanceImage');
			$arr = explode(':', Input::get('instanceAmi'));
			$params['instanceAmi'] = $arr[1];
			$params['OS'] = $arr[0];
			$deployment->parameters = json_encode($params);
            $deployment->docker_name = Input::get('docker_name');
            $deployment->user_id = Auth::id(); // logged in user id
            
            
            try {
                // Get and save status from external WS
                $user = Auth::user();
				$responseJson = xDockerEngine::authenticate(array('username' => $user->username, 'password' => md5($user->engine_key)));
				EngineLog::logIt(array('user_id' => Auth::id(), 'method' => 'authenticate', 'return' => $responseJson));
				$obj = json_decode($responseJson);
				
				if(!empty($obj) && $obj->status == 'OK')
				{
					$deployment -> token = $obj->token;
					$this->prepare($user, $account, $deployment);
					$responseJson = xDockerEngine::run(json_decode($deployment->wsParams));
					EngineLog::logIt(array('user_id' => Auth::id(), 'method' => 'run', 'return' => $responseJson));
					$obj1 = json_decode($responseJson);
					if(!empty($obj1) && $obj1->status == 'OK')
					{
						$deployment -> job_id = $obj1->job_id;
						$deployment -> status = Lang::get('deployment/deployment.status');
						unset($deployment -> token );
						$success = $deployment->save();
		            	if (!$success) {
		            		Log::error('Error while saving deployment : '.json_encode( $deployment->errors()));
							return Redirect::to('deployment')->with('error', 'Error saving deployment!' );
		                }
					}
					else if(!empty($obj1) && $obj1->status == 'error')
					{
						Log::error('Failed during deployment!'. $obj1->fail_message);
						Log::error('Log :' . implode(' ', $obj2->job_log));
            			return Redirect::to('deployment')->with('error', 'Failed during deployment!'. $obj1->fail_message);
					}
					
					UtilHelper::sendMail(Auth::user(), $account->name, $deployment, 'site/deployment/email', Lang::get('deployment/deployment.deployment_updated'));
					
					return Redirect::to('deployment')->with('success', Lang::get('deployment/deployment.deployment_updated'));
	            }
				else if(!empty($obj) && $obj->status == 'error')
				{
					Log::error('Failed to authenticate before deployment!'.$obj2->fail_code .':'. $obj->fail_message);
					Log::error('Log :' . implode(' ', $obj2->job_log));
            		return Redirect::to('deployment')->with('error', 'Failed to authenticate before deployment!'. $obj->fail_message);
				}
				else
				{
					Log::error('error', 'Unexpected error - Backend Engine API should be down!');
					return Redirect::to('ServiceStatus')->with('error', 'Backend API is down, please try again later!');		
				}
 
            }
            catch(Exception $err) {
                $status = 'Unexpected Error: ' . $err->getMessage();
				Log::error('Error while saving deployment : '. $status);
				
                throw new Exception($err->getMessage());
            }
            
        }
        catch(Exception $e) {
			Log::error('Error while saving deployment : '. $e->getMessage());
			return Redirect::back()->with('error', $e->getMessage());
        }
    }

	private function prepare($user, $account, & $deployment)
	{
		$credentials = json_decode($account->credentials);
		$parameters = json_decode($deployment->parameters);
		$dockerParams = xDockerEngine::getDockerParams($deployment -> docker_name);
		$rawApiKey = StringHelper::encrypt($credentials ->apiKey, md5(Auth::user()->username));
		$rawSecretKey = StringHelper::encrypt($credentials ->secretKey, md5(Auth::user()->username));
		
		if(xDockerEngine::billingBucket($deployment -> docker_name) && empty($credentials ->billingBucket))
		{
			Log::error('error', 'Billing bucket is mandatory for '. $deployment -> docker_name);
			return Redirect::to('account/'.$account->id.'/edit')->with('error', 'Billing bucket is mandatory for '. $deployment -> docker_name);			
		}
		
		$secPolicy = xDockerEngine::securityPolicy($deployment -> docker_name) ;
		if(!empty($secPolicy))
		{
			$keys = array_keys($secPolicy);
		}
		else {
			$keys[0] = 0;	
			$secPolicy[0] ='';
		}
		$keys = !empty($secPolicy) ? array_keys($secPolicy) : '';
		
		if(xDockerEngine::isAppCredEanbled($deployment -> docker_name))
		{
			if(empty($parameters->app_username) || empty($parameters->app_username))
			{
				Log::error('App Username/Password are required fields for ' . $deployment -> docker_name);
				return Redirect::back()->with('error', 'App Username/Password are required fields for ' . $deployment -> docker_name);
			}
		}
		
		$userArr = array( 'app_username' => $parameters->app_username, 'app_psw' => crypt($parameters->app_psw, base64_encode($parameters->app_psw)));
		
		$env= $dockerParams['env'];
		$dockerParams['env'] = array_merge($env, $userArr);
		
		$deployment->wsParams = json_encode(
                                    array (
                                        'token' => $deployment->token,
                                        'username' => $user->username,
                                        'cloudProvider' => $account ->cloudProvider,
                                        'apiKey' => $rawApiKey,
                                        'secretKey' => $rawSecretKey,
                                        'billingBucket' => !empty($credentials ->billingBucket) ? $credentials ->billingBucket : '' ,
                                        'instanceName' => $deployment->name,
                                        'instanceType' => $parameters->instanceType,
                                        'instanceRegion' => $parameters->instanceRegion,
                                        'instanceAmi' => $parameters->instanceAmi,
                                        'OS' => $parameters->OS,
                                        'packageName' => $deployment -> docker_name,
                                        'sgPorts' => $parameters->sgPorts,
                                        'dockerParams' => $dockerParams,
                                        'ipUI' => xDockerEngine::getIPAddress($deployment -> docker_name),
                                        $keys[0] => $secPolicy[$keys[0]]
                                       )
                                      );	
		  				
	}

	/**
     * Remove the specified Account .
     *
     * @param $deployment
     *
     */
    public function postDelete($id) 
    {
    	$this->check();
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

	public function postTerminate($id)
	{
		$this->check();
		$deployment = Deployment::where('user_id', Auth::id())->find($id);
		$account = CloudAccountHelper::findAndDecrypt($deployment->cloudAccountId);
				
		$instanceId =  Input::get('instanceID');
		Log::error('Terminating Instance :'. $instanceId);
		$response = $this->executeAction(Input::get('instanceAction'), $account, $deployment, $instanceId);
		if($response['status'] == 'OK') return Redirect::to('/')->with('success', 'Instance Terminated Successfully!');
		else return Redirect::to('/')->with('error', 'Error while terminating the instance!');;
			
	}
	
	public function checkStatus($id)
	{
		$this->check();
		$deployment = Deployment::where('user_id', Auth::id())-> whereNotIn('status', array('Completed'))->find($id);
		if(empty($deployment))
		{
			return Redirect::to('deployment')->with('info', 'Selected deployment do not need refresh!');
		}
		$user = Auth::user();
		$responseJson = xDockerEngine::authenticate(array('username' => $user->username, 'password' => md5($user->engine_key)));
		 EngineLog::logIt(array('user_id' => Auth::id(), 'method' => 'authenticate', 'return' => $responseJson));
		 $obj = json_decode($responseJson);
		
		 if(!empty($obj) && $obj->status == 'OK')
		 {
			$responseJson = xDockerEngine::getDeploymentStatus(array('token' => $obj->token, 'job_id' => $deployment->job_id));
			EngineLog::logIt(array('user_id' => Auth::id(), 'method' => 'getDeploymentStatus', 'return' => $responseJson));
		
			$obj2 = json_decode($responseJson);
			if(!empty($obj2) && $obj2->status == 'OK')
			{
				if(!isset($obj2 -> result))
				{
					Log::error('No Result in the checkStatus Request to be saved!');
					$obj2 -> result ='';
				} 
				$deployment->status = $obj2->job_status;
				$deployment -> wsResults = json_encode($obj2 -> result);
				$this->saveContainers($deployment);
				$success = $deployment->save();
		        if (!$success) {
		        	Log::error('Error while saving deployment : '.json_encode( $dep->errors()));
					return Redirect::to('deployment')->with('error', 'Error saving deployment!' );
		        }
				return Redirect::to('deployment')->with('success', $deployment->name .' is refreshed' );
			}
			else  if(!empty($obj2) && $obj2->status == 'error')
			 {
				 // There was a problem deleting the user
				 Log::error('Request to deploy failed :' . $obj2->fail_code . ':' . $obj2->fail_message);
				 Log::error('Log :' . implode(' ', $obj2->job_log));
	            return Redirect::to('deployment')->with('error', $obj2->fail_message );
			 }	
			else
			{
				  return Redirect::to('ServiceStatus')->with('error', 'Backend API is down, please try again later!');			
			}
			
		 }	
		 else if(!empty($obj) && $obj->status == 'error')
		 {
			 // There was a problem deleting the user
			Log::error('Request to deploy failed :' . $obj2->fail_code . ':' . $obj2->fail_message);
			Log::error('Log :' . implode(' ', $obj2->job_log));
            return Redirect::to('deployment')->with('error', $obj->fail_message );
		 }	
		 else
		 {
			return Redirect::to('ServiceStatus')->with('error', 'Backend API is down, please try again later!');			
		 }	
	}

	public function getLogs($id)
	{
		$this->check();
		$deployment = Deployment::where('user_id', Auth::id())->find($id);
		
		if(!empty($deployment) && isset($deployment->job_id))
		{
			$responseJson = xDockerEngine::authenticate(array('username' => Auth::user()->username, 'password' => md5(Auth::user()->engine_key)));
		 	EngineLog::logIt(array('user_id' => Auth::id(), 'method' => 'authenticate', 'return' => $responseJson));
		 	$obj = json_decode($responseJson);
			
			if(!empty($obj) && $obj->status == 'OK')
		 	{
				$response = xDockerEngine::getLog(array('token' => $obj->token, 'job_id' => $deployment->job_id, "line_num" => 10));
				return View::make('site/deployment/logs', array(
            	'response' => $response,
            	'deployment' => $deployment));
				
			}
			else if(!empty($obj) && $obj->status == 'error')
			{
				Log::error('Request to deploy failed :' . $obj2->fail_code . ':' . $obj2->fail_message);
				Log::error('Log :' . implode(' ', $obj2->job_log));
            	return Redirect::to('deployment')->with('error', $obj->fail_message );
			}
			else
				{
					return Redirect::to('ServiceStatus')->with('error', 'Backend API is down, please try again later!');
				}
		}
		else if(empty($deployment)) {
			 return Redirect::to('deployment')->with('info', 'No deployments found! ' );
		}
		else {
			 return Redirect::to('deployment')->with('info', 'No logs found! ' );
		}
		
	}
	
	public function postInstanceAction($id)
	{
		$this->check(true);
		$instanceAction = Input::get('instanceAction');
		$instanceID 	= Input::get('instanceID');
		$deployment 	= Deployment::where('user_id', Auth::id())->find($id);
		$account 		= CloudAccount::where('user_id', Auth::id())->findOrFail($deployment->cloudAccountId) ;
		$credentials 	= json_decode($account->credentials);
		
		$result			= json_decode($deployment->wsResults);
		$arr = $this->executeAction($instanceAction, $account, $deployment, $instanceID);
										
		if($arr['status'] == 'OK')
		{
			$deployment->status = (!in_array($instanceAction, array('describeInstances'))) ? $instanceAction : $deployment->status;
			$success = $deployment->save();
		    if (!$success) 
		    {
		    	Log::error('Error while saving deployment -  : '.$instanceAction.' '.json_encode( $arr['message']));
				print json_encode(array('status' => 'error', 'message' => $arr['message']));
		    }
					//return Redirect::to('deployment')->with('success', $deployment->name .' : '.$instanceAction.' submitted! ' );
			print json_encode(array('status' => 'OK', 'message' =>  $arr['message'] ));
		}
		else if($arr['status'] == 'error')
		{
			Log::error('Error occured - while submitting :'.$instanceAction);
			print json_encode(array('status' => 'error', 'message' => 'Error while submitting '.$instanceAction .' request ' ));
		}
		
	}

	private function executeAction($instanceAction, $account, $deployment , $instanceID)
	{
		$param 			= json_decode($deployment->parameters);
		$account -> instanceRegion =  $param->instanceRegion;
		return CloudProvider::executeAction($instanceAction, $account, $instanceID);
	}
	
	public function getDownloadKey($id)
	{
		$this->check(true);
		$instanceID 	= Input::get('instanceID');
		$deployment 	= Deployment::where('user_id', Auth::id())->find($id);
		$account 		= CloudAccount::where('user_id', Auth::id())->findOrFail($deployment->cloudAccountId) ;
		
		$arr = $this->executeAction('downloadKey', $account, $deployment, $instanceID);
		
		if($arr['status'] == 'OK')
		{
			$key = StringHelper::decrypt($arr['key'], md5(Auth::user()->username));
			header('Content-Description: File Transfer');
			header('Content-Type: ' . 'application/x-pem-file');
			header('Content-Disposition: attachment; filename=' . $arr['keyName'] . '.pem');
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . strlen($key));
			print $key;
		}
	}
	
	public function getImages()
	{
		$cloudProvider = Input::get('cloudProvider');
		$region = Input::get('region');
		$images = Config::get('images');
		foreach($images as $provider => $image)
		{
			if($provider == $cloudProvider)
			{
				foreach($image as $key => $val)
                {
                   if($key == $region)
                   {
                    	echo json_encode($val);
                   }                     
                }


			}
		}
	}

	public function getPrices()
	{
		$cloudProvider = Input::get('cloudProvider');
		$param = new stdClass();
		$param->region 		 = Input::get('region');
		$param->instanceType = Input::get('instanceType');
		
		$ondemand = EC2InstancePrices::OnDemand2($param);
		
		echo json_encode($ondemand);
		
		//echo json_encode(EC2InstancePrices::On)
	}

	private function saveContainers(& $deployment)
	{
		switch($deployment->status)
		{
			case 'Completed' : $result = json_decode($deployment->wsResults);
			 				   Log::info('Retrieving containers. '. $deployment->name);
							   $containers = RemoteAPI::getContainers($result->public_dns);
							   $deployment ->containers = json_encode($containers);
		}
		
	}

	

	
}
