@extends('site.layouts.default')

{{-- Content --}}
@section('content')

<div class="page-header">
	<div class="row">
		<div class="col-md-9">
			<h5>{{{ Lang::get('ticket/ticket.your_tickets') }}}</h5>
		</div>
	</div>
</div>
<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
	<li class="active"><a href="#Open" data-toggle="tab"><i title="Open"></i>Open</a></li>
	<li><a href="#Closed" data-toggle="tab"><i title="Closed"></i>Closed</a></li>
</ul>
<div id="my-tab-content" class="tab-content">
	<div class="tab-pane active" id="Open">
		<div class="media-block">
			<ul class="list-group">
				@if(!empty($open_tickets)) 
					@foreach ($open_tickets as $ticket)
						<li class="list-group-item">
							<div class="media">
								
								<form class="pull-right" method="post" action="{{ URL::to('ticket/' . $ticket->id . '/close') }}">
									<!-- CSRF Token -->
									<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
									<!-- ./ csrf token -->
									<button type="submit" class="btn btn-warning pull-right" role="button"><span class="glyphicon glyphicon-eye-close"></span></button>
								</form>
								<a href="{{ URL::to('ticket/' . $ticket->id . '/reply') }}" class="btn btn-success pull-right" role="button">
										<span class="glyphicon glyphicon-comment"></span></a>
								<div class="media-body">
									<h4 class="media-heading">{{ String::title($ticket->title) }}</h4>
									<p>
										{{{ $ticket->description }}}
									</p>
									<p>{{{ $ticket->priority }}} | {{{ $ticket->active }}} </p>
									<p>
										<span class="glyphicon glyphicon-calendar"></span> <!--Sept 16th, 2012-->{{{ $ticket->created_at }}}
									</p>
								</div>
							</div>
						</li>
					@endforeach
				@endif
			</ul>
			@if(empty($open_tickets) || count($open_tickets) === 0) 
				<div class="alert alert-info"> {{{ Lang::get('ticket/ticket.empty_tickets') }}}</div>
			@endif
		</div>
	</div>
	<div class="tab-pane" id="Closed">
		<div class="media-block">
			<ul class="list-group">
				@if(!empty($closed_tickets)) 
					@foreach ($closed_tickets as $ticket)
						<li class="list-group-item">
							<div class="media">
								
								<form class="pull-right" method="post" action="{{ URL::to('ticket/' . $ticket->id . '/close') }}">
									<!-- CSRF Token -->
									<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
									<!-- ./ csrf token -->
									<button type="submit" class="btn btn-warning pull-right" role="button"><span class="glyphicon glyphicon-eye-close"></span></button>
								</form>
								<a href="{{ URL::to('ticket/' . $ticket->id . '/reply') }}" class="btn btn-success pull-right" role="button">
										<span class="glyphicon glyphicon-comment"></span></a>
								<div class="media-body">
									<h4 class="media-heading">{{ String::title($ticket->title) }}</h4>
									<p>
										{{{ $ticket->description }}}
									</p>
									<p>{{{ $ticket->priority }}} | {{{ $ticket->active }}} </p>
									<p>
										<span class="glyphicon glyphicon-calendar"></span> <!--Sept 16th, 2012-->{{{ $ticket->created_at }}}
									</p>
								</div>
							</div>
						</li>
					@endforeach
				@endif
			</ul>
			@if(empty($closed_tickets) || count($closed_tickets) === 0) 
				<div class="alert alert-info"> {{{ Lang::get('ticket/ticket.empty_tickets') }}}</div>
			@endif
		</div>
	</div>
</div>
<div>
<a href="{{ URL::to('ticket/create') }}" class="btn btn-primary pull-right" role="button">{{{ Lang::get('ticket/ticket.add_ticket') }}}</a>
</div>

@stop
