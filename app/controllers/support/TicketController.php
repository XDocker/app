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
class TicketController extends BaseController {
    /**
     * CloudAccount Model
     * @var accounts
     */
    protected $ticket;
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
    public function __construct(Ticket $ticket, User $user) {
        parent::__construct();
        $this->user = $user;
		$this->ticket = $ticket;
    }
    /**
     * Returns all the Accounts for logged in user.
     *
     * @return View
     */
    public function getIndex() {
        // Get all the user's accounts
        //Auth::id() : gives the logged in userid
        $open_tickets = $this->ticket->where('user_id', Auth::id())->where('active', TRUE)->orderBy('created_at', 'DESC')->paginate(10);
		$closed_tickets = $this->ticket->where('user_id', Auth::id())->where('active', FALSE)->orderBy('created_at', 'DESC')->paginate(10);
		if(!Auth::check())
		{
			Log::error("Not authorized access");
			return Redirect::to('ticket')->with('error', Lang::get('ticket/ticket.ticket_auth_failed'));
		}
        // var_dump($accounts, $this->accounts, $this->accounts->owner);
        // Show the page
        return View::make('site/ticket/index', array(
            'tickets' => $tickets,
			'open_tickets' => $open_tickets,
			'closed_tickets' => $closed_tickets
        ));
    }
    /**
     * Displays the form for cloud account creation
     *
     */
    public function getCreate($ticket = false) {
        $mode = $ticket !== false ? 'edit' : 'create';
        $ticket = $ticket !== false ? Ticket::where('user_id', Auth::id())->findOrFail($ticket->id) : null;
		$priorities =array('urgent', 'high', 'medium', 'low');
        return View::make('site/ticket/create_edit', compact('mode', 'ticket', 'priorities'));
    }
    /**
     * Saves/Edits an account
     *
     */
    public function postEdit($ticket = false) {
        try {
            if (empty($ticket)) {
                $ticket = new Ticket;
            } else if ($ticket->user_id !== Auth::id()) {
                throw new Exception('general.access_denied');
            }

            $ticket->title = Input::get('title');
            $ticket->description = Input::get('description');
            $ticket->active = 1;
			$ticket->priority = Input::get('priority');
            $ticket->user_id = Auth::id(); // logged in user id
            
             $success = $ticket->save();
            
            if ($success) {
                return Redirect::intended('ticket')->with('success', Lang::get('ticket/ticket.ticket_updated'));
            } else {
                return Redirect::to('ticket')->with('error', Lang::get('ticket/ticket.ticket_auth_failed'));
            }
        }
        catch(Exception $e) {
            Log::error($e);
            return Redirect::to('ticket')->with('error', $e->getMessage());
        }
    }
	
	public function getReply($id = false)
	{
		$ticket = $id !== false ? Ticket::where('user_id', Auth::id())->findOrFail($id) : null;
		
		$userList = $id !== false ? DB::table('users')->select('username', 'email')->where('id', Auth::id())->get() : null;
		
		$ticketComments = $id !== false ? Ticket::leftJoin('ticket_comments', 'tickets.id', '=', 'ticket_comments.ticket_id')->where('tickets.user_id', Auth::id())->orderBy('ticket_comments.created_at', 'DESC')->get() : null;
		$priorities =array('urgent', 'high', 'medium', 'low');
        return View::make('site/ticket/reply', compact('mode', 'ticket', 'priorities', 'ticketComments', 'userList'));
	}
	
	 public function postReply($id = false) {
	 	$ticket = $id !== false ? Ticket::where('user_id', Auth::id())->findOrFail($id) : null;
        try {
            if (empty($ticket)) {
                return Redirect::to('ticket')->with('error', 'You need a ticket to comment');
            } 

            $ticketComment = new TicketComments;
            $ticketComment->user_id = Auth::id(); // logged in user id
            
            $ticketComment->ticket_id = $id;
            $ticketComment->comments = Input::get('comments');
			$success = $ticketComment->save();
			
			 
            if ($success) {
                return Redirect::intended('ticket')->with('success', Lang::get('ticket/ticket.ticket_comments_updated'));
            } else {
                return Redirect::to('ticket')->with('error', Lang::get('ticket/ticket.ticket_comment_update_failed'));
            }
        }
        catch(Exception $e) {
            Log::error($e);
            return Redirect::to('ticket')->with('error', $e->getMessage());
        }
    }
	
	public function closeTicket($id = false)
	{
		$ticket = $id !== false ? Ticket::where('user_id', Auth::id())->findOrFail($id) : null;
		$ticket->active = FALSE;
		$success = $ticket->save();
		if ($success) {
                return Redirect::intended('ticket')->with('success', Lang::get('ticket/ticket.ticket_updated'));
        } else {
                return Redirect::to('ticket')->with('error', Lang::get('ticket/ticket.ticket_auth_failed'));
        }
	}
	
	
    /**
     * Remove the specified Ticket .
     *
     * @param $ticket
     *
     */
    public function postDelete($ticket) {
    	//Only admin to delete the ticket
    	
        Ticket::where('id', $ticket->id)->where('user_id', Auth::id())->delete();
        
        $id = $ticket->id;
        $ticket->delete();
        // Was the comment post deleted?
        $ticket = Ticket::where('user_id', Auth::id())->find($id);
        if (empty($ticket)) {
            // TODO needs to delete all of that user's content
            return Redirect::to('ticket')->with('success', 'Removed Ticket Successfully');
        } else {
            // There was a problem deleting the user
            return Redirect::to('ticket/' . $ticket->id . '/edit')->with('error', 'Error while deleting ticket');
        }
    }
}
