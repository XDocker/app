@extends('site.layouts.default')

{{-- Content --}}
@section('content')

	<div class="page-header">
		<div class="row">
			<div class="col-md-9">
				<h4>{{isset($ticket->id)?'Edit':'Create'}} Ticket:</h4>
			</div>
		</div>
	</div>

	{{-- Create/Edit cloud ticket Form --}}
	<form id="cloudProviderCredntialsForm" class="form-horizontal" method="post" action="@if (isset($ticket->id)){{ URL::to('ticket/' . $ticket->id . '/edit') }}@endif" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		
		
		<!-- name -->
		<div class="form-group {{{ $errors->has('username') ? 'error' : '' }}}">
			<label class="col-md-2 control-label" for="name">Title <font color="red">*</font></label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="title" id="title" value="{{{ Input::old('title', isset($ticket->name) ? $ticket->name : null) }}}" required />
			</div>
		</div>
		
		<div class="form-group {{{ $errors->has('description') ? 'has-error' : '' }}}">
			<div class="col-md-12">
            	<label class="control-label" for="content">Description <font color="red">*</font></label>
					<textarea class="form-control full-width wysihtml5" name="description" value="description" rows="5" required>{{{ Input::old('description', isset($post) ? $post->description : null) }}}</textarea>
					{{{ $errors->first('description', '<span class="help-block">:message</span>') }}}
			</div>
		</div>
		
		<div class="form-group {{{ $errors->has('email') ? 'error' : '' }}}">
			<label class="col-md-2 control-label" for="email">Priority </label>
			<div class="col-md-6">
				<select class="form-control" name="priority" id="priority" required>
					@foreach ($priorities as $key )
						<option value="{{$key}}" {{{ Input::old('priority', isset($ticket->priority) && ($ticket->priority == $key) ? 'selected="selected"' : '') }}}>{{{ $key }}}</option>
					@endforeach
				</select>
			</div>
		</div>

		<!-- Form Actions -->
		<div class="form-group">
			<div class="col-md-offset-2 col-md-10">
				<a href="{{ URL::to('ticket') }}" class="btn btn-default">Back</a>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
		</div>
		<!-- ./ form actions -->
	</form>
@stop

@section('scripts')
@stop
