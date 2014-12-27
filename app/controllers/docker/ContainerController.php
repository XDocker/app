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
	
	
	public function getContainers($id)
	{
		$deployment 	= Deployment::where('user_id', Auth::id())->find($id);
		$deployment     = json_decode($deployment->toJson());

		Log::info('Stopping Deployment '. $deployment->name);	
		$result = json_decode($deployment->wsResults);
		Log::info('Starting Container '. $result->public_dns);
		$containers = RemoteAPI::getContainers($result->public_dns);
		
		return View::make('site/docker/containers/container', array(
            'containers' => $containers,
            'deployment' => $deployment
        ));
	}

	public function startContainer()
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
	
	public function stopContainer()
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
}
	