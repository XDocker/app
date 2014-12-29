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
 * - ContainerController extends BaseController
 */
class ContainerController extends BaseController 
{
	/**
     * Deployment Model
     * @var deployment
     */
    protected $deployment;
    /**
     * User Model
     * @var User
     */
    protected $user;
    /**
     * Inject the models.
     * @param Deployment $deployment
     * @param User $user
     */
	public function __construct(Deployment $deployment, User $user) 
	{
        parent::__construct();
        $this->deployment = $deployment->where('deployments.user_id', Auth::id());
        $this->user = $user;
    }
	
	public function getContainersByDeployment($id)
	{
		$deployment 	= Deployment::where('user_id', Auth::id())->find($id);
		$deployment     = json_decode($deployment->toJson());

		Log::info('Stopping Deployment '. $deployment->name);	
		$result = json_decode($deployment->wsResults);
		Log::info('Starting Container '. $result->public_dns);
		$containers = RemoteAPI::getContainers($result->public_dns);
		
		return View::make('site/docker/containers/container_deployment', array(
            'containers' => $containers,
            'deployment' => $deployment
        ));
	}
	
	public function startContainerByDeployment()
	{
		$id = Input::get('id');
		
		$deploymentId = Input::get('deploymentId');
		$deployment 	= Deployment::where('user_id', Auth::id())->find($deploymentId);
		Log::info('Starting Deployment '. $deployment->name);
		$result = json_decode($deployment->wsResults);
		Log::info('Starting Container '. $result->public_dns);
		RemoteAPI::startContainer($id, $result->public_dns);
		Log::info('Started Container ');
		//$this->getContainers($deploymentId);
		return Redirect::to('docker/'.$deploymentId.'/Containers')->with('success', $deployment->docker_name . ' started ' ); 
		
	}
	
	public function stopContainerByDeployment()
	{
		$id = Input::get('id');
		
		$deploymentId = Input::get('deploymentId');
		$deployment 	= Deployment::where('user_id', Auth::id())->find($deploymentId);
		Log::info('Stopping Deployment '. $deployment->name);
		
		$result = json_decode($deployment->wsResults);
		RemoteAPI::stopContainer($id, $result->public_dns);
		Log::info('Stopped Container ');
		
		return Redirect::to('docker/'.$deploymentId.'/Containers')->with('success', $deployment->docker_name . ' stopped ' ); 
	}
	
	public function topByDeployment()
	{
		$id = Input::get('id');
		
		$deploymentId = Input::get('deploymentId');
		$deployment 	= Deployment::where('user_id', Auth::id())->find($deploymentId);
		Log::info('Top for '. $deployment->name);
		$result = json_decode($deployment->wsResults);
		$ret = RemoteAPI::top($id, $result->public_dns);
		Log::info('Top for Container ');
		echo '<pre>';
		print_r($ret);
		
	}
	
	public function logsByDeployment()
	{
		$id = Input::get('id');
		
		$deploymentId = Input::get('deploymentId');
		$deployment 	= Deployment::where('user_id', Auth::id())->find($deploymentId);
		Log::info('Logs for '. $deployment->name);
		$result = json_decode($deployment->wsResults);
		$ret = RemoteAPI::logs($id, $result->public_dns);
		Log::info('Logs for Container ');
		echo '<pre>';
		print_r($ret);
		
	}
	
	public function exportByDeployment()
	{
		$id = Input::get('id');
		
		$deploymentId = Input::get('deploymentId');
		$deployment 	= Deployment::where('user_id', Auth::id())->find($deploymentId);
		Log::info('Logs for '. $deployment->name);
		$result = json_decode($deployment->wsResults);
		$ret = RemoteAPI::export($id, $result->public_dns);
		Log::info('Logs for Container ');
		echo '<pre>';
		print_r($ret);
		
	}
	
	public function getContainersByAccount($id)
	{
		$account 	= CloudAccount::where('user_id', Auth::id())->find($id);
		$cred = json_decode($account->credentials);
		$containers = RemoteAPI::getContainers($cred->host, $cred->port);
		return View::make('site/docker/containers/container_account', array(
            'containers' => $containers,
            'deployment' => $account->name
        ));
	}
	
	public function startContainerByAccount()
	{
		$id = Input::get('id');
		
		$accountId = Input::get('accountId');
		$account 	= CloudAccount::where('user_id', Auth::id())->find($deploymentId);
		Log::info('Starting Account '. $account->name);
		$result = json_decode($account->credentials);
		Log::info('Starting Container '. $result->host);
		RemoteAPI::startContainer($id, $result->host, $result->port);
		Log::info('Started Container ');
		//$this->getContainers($deploymentId);
		return Redirect::to('account/docker/'.$accountId.'/Containers')->with('success', $account->name . ' started ' ); 
		
	}
	
	public function stopContainerByAccount()
	{
		$id = Input::get('id');
		
		$accountId = Input::get('accountId');
		$account 	= CloudAccount::where('user_id', Auth::id())->find($deploymentId);
		Log::info('Starting Account '. $account->name);
		$result = json_decode($account->credentials);
		Log::info('Starting Container '. $result->host);
		RemoteAPI::stopContainer($id, $result->host, $result->port);
		Log::info('Stopped Container ');
		
		return Redirect::to('account/docker/'.$accountId.'/Containers')->with('success', $account->name . ' stopped ' ); 
	}
	
	public function topByAccount()
	{
		$id = Input::get('id');
		
		$accountId = Input::get('accountId');
		$account 	= CloudAccount::where('user_id', Auth::id())->find($deploymentId);
		Log::info('Starting Account '. $account->name);
		$result = json_decode($account->credentials);
		Log::info('Top for '. $result->host);
		$ret = RemoteAPI::top($id, $result->host, $result->port);
		Log::info('Top for Container ');
		echo '<pre>';
		print_r($ret);
		
	}
	
	public function logsByAccount()
	{
		$id = Input::get('id');
		
		$accountId = Input::get('accountId');
		$account 	= CloudAccount::where('user_id', Auth::id())->find($deploymentId);
		
		Log::info('Logs for '. $account->name);
		$result = json_decode($account->credentials);
		$ret = RemoteAPI::logs($id, $result->host, $result->port);
		Log::info('Logs for Container ');
		echo '<pre>';
		print_r($ret);
		
	}
	
	public function exportByAccount()
	{
		$id = Input::get('id');
		
		$accountId = Input::get('accountId');
		$account 	= CloudAccount::where('user_id', Auth::id())->find($deploymentId);
		
		Log::info('Logs for '. $account->name);
		
		$result = json_decode($account->credentials);
		$ret = RemoteAPI::export($id, $result->host, $result->port);
		Log::info('Logs for Container ');
		echo '<pre>';
		print_r($ret);
		
	}

	
}
	