@extends('site.layouts.default')

{{-- Content --}}
@section('content')

	<div class="page-header">
		<div class="row">
			<div class="col-md-9">
				<h5>{{isset($ticket->id)?'Edit':'Create'}} Ticket:</h5>
			</div>
		</div>
	</div>

	{{-- REplu ticket Form --}}
	<form id="cloudProviderCredntialsForm" class="form-horizontal" method="post" action="@if (isset($ticket->id)){{ URL::to('ticket/' . $ticket->id . '/reply') }}@endif" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		
		
		<!-- name -->
		<div class="form-group {{{ $errors->has('username') ? 'error' : '' }}}">
			<label class="col-md-2 control-label" for="name">Title </label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="title" id="title" value="{{{ Input::old('title', isset($ticket->title) ? $ticket->title : null) }}}" readonly />
			</div>
		</div>
		
		<div class="form-group {{{ $errors->has('description') ? 'has-error' : '' }}}">
			<label class="col-md-2 control-label" for="email">Description </label>
			<div class="col-md-6">
            		<textarea class="form-control full-width wysihtml5" name="description" value="description" rows="3" readonly>{{{ Input::old('description', isset($ticket) ? $ticket->description : null) }}}</textarea>
					{{{ $errors->first('description', '<span class="help-block">:message</span>') }}}
			</div>
		</div>
		
		<div class="form-group {{{ $errors->has('email') ? 'error' : '' }}}">
			<label class="col-md-2 control-label" for="email">Priority </label>
			<div class="col-md-6">
				<select class="form-control" name="priority" id="priority" readonly>
					@foreach ($priorities as $key )
						<option value="{{$key}}" {{{ Input::old('priority', isset($ticket->priority) && ($ticket->priority == $key) ? 'selected="selected"' : '') }}}>{{{ $key }}}</option>
					@endforeach
				</select>
			</div>
		</div>
		
		<div class="form-group {{{ $errors->has('description') ? 'has-error' : '' }}}">
			<label class="col-md-2 control-label" for="email">Comment <font color="red">*</font></label>
			<div class="col-md-6">
            		<textarea class="form-control full-width wysihtml5" name="comments" value="comments" rows="5" required></textarea>
					{{{ $errors->first('comments', '<span class="help-block">:message</span>') }}}
			</div>
		</div>

		<!-- Form Actions -->
		<div class="form-group">
			<div class="col-md-offset-2 col-md-10">
				<a href="{{ URL::to('ticket') }}" class="btn btn-default">Back</a>
				<button type="submit" class="btn btn-primary">Comment</button>
			</div>
		</div>
		<!--
		@foreach($ticketComments as $comment)
		<div class="form-group {{{ $errors->has('comment') ? 'has-error' : '' }}}">
			<div class="col-md-6">
            		<textarea class="form-control full-width wysihtml5" name="pastComment" value="pastComment" rows="3" readonly>{{{$comment}}}</textarea>
			</div>
		</div>
		@endforeach
		-->
		<!-- ./ form actions -->
	</form>
@stop

@section('scripts')
@stop
