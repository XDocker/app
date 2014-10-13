@extends('site.layouts.default')

{{-- Content --}}
@section('content')

<div class="page-header">
	<div class="row">
		<div class="col-md-9">
			<h4>{{{ Lang::get('ticket/ticket.your_tickets') }}}</h4>
		</div>
	</div>
</div>

<div class="media-block">
	<ul class="list-group">
		@if(!empty($tickets)) 
			@foreach ($tickets as $ticket)
	  			<li class="list-group-item">
					<div class="media">
						
						<form class="pull-right" method="post" action="{{ URL::to('ticket/' . $ticket->id . '/ticket') }}">
							<!-- CSRF Token -->
							<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
							<!-- ./ csrf token -->
							<button type="submit" class="btn btn-warning pull-right" role="button"><span class="glyphicon glyphicon-trash"></span></button>
						</form>
						<a href="{{ URL::to('ticket/' . $ticket->id . '/edit') }}" class="btn btn-success pull-right" role="button"><span class="glyphicon glyphicon-edit"></span></a>
						<div class="media-body">
							<h4 class="media-heading">{{ String::title($ticket->title) }}</h4>
							<p>
								<span class="glyphicon glyphicon-calendar"></span> <!--Sept 16th, 2012-->{{{ $ticket->created_at }}}
							</p>
						</div>
					</div>
				</li>
			@endforeach
		@endif
	</ul>
	@if(empty($tickets) || count($tickets) === 0) 
		<div class="alert alert-info"> {{{ Lang::get('ticket/ticket.empty_tickets') }}}</div>
	@endif
</div>
<div>
<a href="{{ URL::to('ticket/create') }}" class="btn btn-primary pull-right" role="button">{{{ Lang::get('ticket/ticket.add_ticket') }}}</a>
</div>

@stop
