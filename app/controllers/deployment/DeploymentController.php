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
     * Returns all the Accounts for logged in user.
     *
     * @return View
     */
    public function getIndex() {
        // Get all the user's deployments
        $deployments = $this->deployments->orderBy('created_at', 'DESC')->paginate(10);
        // var_dump($deployments, $this->deployments, $this->deployments->owner);
        // Show the page
        return View::make('site/deployment/index', compact('deployments'));
    }
    /**
     * Displays the form for cloud deployment creation
     *
     */
    public function getCreate($id = false) {
        $mode = $id !== false ? 'edit' : 'create';
        $deployment = $id !== false ? Deployment::findOrFail($id) : null;
        $providers = Config::get('deployment_schema');
        return View::make('site/deployment/create_edit', compact('mode', 'deployment', 'providers'));
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
            $deployment->cloudProvider = Input::get('cloudProvider');
            $deployment->credentials = json_encode(Input::get('credentials'));
            $deployment->user_id = Auth::id(); // logged in user id
            //@TODO  based on the json template for provider to populate, load the field and values.
            // Save it in credentials field of table as json.
            // $deployment->prepareRules($oldAccount, $deployment);
            // Save if valid.
            $success = $deployment->save();
            // return var_dump($deployment);
            
            //$error = $deployment->errors()->all();
            return Redirect::to('deployment')->with('success', Lang::get('deployment/deployment.deployment_deployment_updated'));
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
