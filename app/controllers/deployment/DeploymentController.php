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
        $this->deployments = $deployments;
        $this->user = $user;
    }
    /**
     * Displays the form for cloud deployment creation
     *
     */
    public function getCreate($id = false) {
        $mode = $id !== false ? 'edit' : 'create';
        $deployment = $id !== false ? Deployment::findOrFail($id) : null;
        $providers = Config::get('local/deployment_schema');
        return View::make('site/deployment/create', compact('mode', 'deployment', 'providers'));
    }
    /**
     * Saves/Edits an deployment
     *
     */
    public function postEdit($deployment = false) {
        try {
            if (empty($deployment)) {
                $deployment = new Deployment;
            }
            $deployment->name = Input::get('name');
            $deployment->cloud_account_id = Input::get('cloud_account_id');
            $deployment->parameters = json_encode(Input::get('parameters'));
            $deployment->user_id = Auth::id(); // logged in user id
            //@TODO get and save status from external WS
            $deployment->status = 'Unknown';
            $success = $deployment->save();
            // return var_dump($deployment);
            
            //$error = $deployment->errors()->all();
            return Redirect::to('/')->with('success', Lang::get('deployment/deployment.deployment_deployment_updated'));
        }
        catch(Exception $e) {
            return Redirect::to('deployment')->with('error', $error);
        }
    }
    /**
     * Remove the specified Account .
     *
     * @param $deployment
     *
     */
    public function postDelete($deployment) {
        Deployment::where('id', $deployment->id)->delete();
        
        $id = $deployment->id;
        $deployment->delete();
        // Was the comment post deleted?
        $deployment = Deployment::find($id);
        if (empty($deployment)) {
            // TODO needs to delete all of that user's content
            return Redirect::to('deployment')->with('success', 'Removed Account Successfully');
        } else {
            // There was a problem deleting the user
            return Redirect::to('deployment/' . $deployment->id . '/edit')->with('error', 'Error while deleting');
        }
    }
}
