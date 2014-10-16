<?php

class AdminSubscribersController extends AdminController {


    /**
     * Post Model
     * @var Post
     */
    protected $subscriber;

    /**
     * Inject the models.
     * @param Post $post
     */
    public function __construct(Subscriber $signup)
    {
        parent::__construct();
        $this->subscriber = $signup;
    }

    /**
     * Show a list of all the blog posts.
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/subscribers/title.subscriber_management');

        // Grab all the blog posts
        $subscibers = $this->subsciber;

        // Show the page
        return View::make('admin/subscribers/index', compact('subscibers', 'title'));
    }

	  /**
     * Display the specified resource.
     *
     * @param $post
     * @return Response
     */
	public function getShow($post)
	{
        // redirect to the frontend
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function getDelete($subscriber)
    {
        // Title
        $title = Lang::get('admin/subscribers/title.subscriber_delete');

        // Show the page
        return View::make('admin/subscribers/delete', compact('subscriber', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function postDelete($subscriber)
    {
        // Declare the rules for the form validation
        $rules = array(
            'id' => 'required|integer'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $id = $subscriber->id;
            $subscriber->delete();

            // Was the blog post deleted?
            $subscriber = Signup::find($id);
            if(empty($subscriber))
            {
                // Redirect to the blog posts management page
                return Redirect::to('admin/subscribers')->with('success', Lang::get('admin/subscribers/messages.delete.success'));
            }
        }
        // There was a problem deleting the blog post
        return Redirect::to('admin/subscribers')->with('error', Lang::get('admin/subscribers/messages.delete.error'));
    }

    /**
     * Show a list of all the blog posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $subscribers = Signup::select(array('fbf_newsletter_signups.id', 'fbf_newsletter_signups.email', 'fbf_newsletter_signups.created_at'));

        return Datatables::of($subscribers)

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/subscribers/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/subscribers/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }

}