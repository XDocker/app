<?php

class AdminTicketsController extends AdminController {


    /**
     * Post Model
     * @var Post
     */
    private $ticket;
	
	protected $user;

    /**
     * Inject the models.
     * @param Post $post
     */
    public function __construct(Ticket $ticket, User $user)
    {
        parent::__construct();
        $this->ticket = $ticket;
		$this->user = $user;
    }

    /**
     * Show a list of all the blog posts.
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/tickets/title.ticket_management');

        // Grab all the blog posts
        $tickets = $this->ticket;

        // Show the page
        return View::make('admin/tickets/index', compact('tickets', 'title'));
    }

	  /**
     * Display the specified resource.
     *
     * @param $post
     * @return Response
     */
	public function getShow($ticket)
	{
        // redirect to the frontend
	}
	
	/**
     * Show the form for editing the specified resource.
     *
     * @param $post
     * @return Response
     */
	public function getEdit($id)
	{
        // Title
        $title = Lang::get('admin/tickets/title.ticket_update');
		$priorities =array('urgent', 'high', 'medium', 'low');
		
		$ticket = $id !== false ? Ticket::findOrFail($id) : null;
		

        // Show the page
        return View::make('admin/tickets/create_edit', compact('ticket', 'priorities', 'title'));
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
        $title = Lang::get('admin/tickets/title.ticket_delete');

        // Show the page
        return View::make('admin/tickets/delete', compact('ticket', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function postDelete($ticket)
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
            $id = $ticket->id;
            $ticket->delete();

            // Was the blog post deleted?
            $ticket = Ticket::find($id);
            if(empty($ticket))
            {
                // Redirect to the blog posts management page
                return Redirect::to('admin/tickets')->with('success', Lang::get('admin/tickets/messages.delete.success'));
            }
        }
        // There was a problem deleting the blog post
        return Redirect::to('admin/tickets')->with('error', Lang::get('admin/tickets/messages.delete.error'));
    }

    /**
     * Show a list of all the blog posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
    	$tickets = Ticket::select(array('tickets.id', 'tickets.title', 'tickets.priority',  'tickets.active', 'tickets.created_at'));

        return Datatables::of($tickets)

		 ->add_column('actions', '<a href="{{{ URL::to(\'admin/tickets/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/tickets/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')
       
        ->remove_column('id')

        ->make();
    }

}