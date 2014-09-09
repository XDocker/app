@extends('site.layouts.default')

{{-- Content --}}
@section('content')
	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
		</ul>
	<!-- ./ tabs -->

	{{-- Create User Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($user)){{ URL::to('accounts/' . $account->id . '/edit') }}@endif" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs Content -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">
				
				<!-- cloudProvider -->
				<div class="form-group {{{ $errors->has('email') ? 'error' : '' }}}">
					<label class="col-md-2 control-label" for="email">Cloud Provider</label>
					<!--
					<div class="col-md-10">
						<input class="form-control" type="text" name="cloudProvider" id="email" value="{{{ Input::old('cloudProvider', !empty($account) ? $account->cloudProvider : null) }}}" />
						{{ $errors->first('cloudProvider', '<span class="help-inline">:message</span>') }}
					</div>
					-->
					<div class="col-md-6">
						@if ($mode == 'create')
							<select class="form-control" name="cloudProvider" id="cloudProvider">
								<option value="">Select </option>
								@foreach ($providers as $key => $value)
									<option value="{{$key}}" {{{ Input::old('cloudProvider', isset($account->cloudProvider) && ($account->cloudProvider == $key) ? 'selected="selected"' : '') }}}>{{{ $key }}}</option>
								@endforeach
							</select>
						@endif
						{{ $errors->first('cloudProvider', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
				<!-- ./ cloudProvider -->
				
				<!-- name -->
				<div class="form-group {{{ $errors->has('username') ? 'error' : '' }}}">
					<label class="col-md-2 control-label" for="name">Name</label>
					<div class="col-md-10">
						<input class="form-control" type="text" name="name" id="name" value="{{{ Input::old('name', isset($account->name) ? $account->name : null) }}}" />
						{{ $errors->first('name', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
				<!-- ./ username -->
				<div class="populateFields">
					
				</div>
				
				<!-- Activation Status -->
				<div class="form-group {{{ $errors->has('active') || $errors->has('active') ? 'error' : '' }}}">
					<label class="col-md-2 control-label" for="confirm">Account Active?</label>
					<div class="col-md-6">
						@if ($mode == 'create')
							<select class="form-control" name="active" id="active">
								<option value="1"{{{ (Input::old('active', 0) === 1 ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.yes') }}}</option>
								<option value="0"{{{ (Input::old('active', 0) === 0 ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.no') }}}</option>
							</select>
						@else
							<select class="form-control" name="active" id="active">
								<option value="1"{{{ ($account->active ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.yes') }}}</option>
								<option value="0"{{{ ( ! $account->active ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.no') }}}</option>
							</select>
						@endif
						{{ $errors->first('confirm', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
				<!-- ./ activation status -->
				

				

			</div>
			<!-- ./ general tab -->

		</div>
		<!-- ./ tabs content -->

		<!-- Form Actions -->
		<div class="form-group">
			<div class="col-md-offset-2 col-md-10">
				<element class="btn-cancel close_popup">Cancel</element>
				<button type="reset" class="btn btn-default">Reset</button>
				<button type="submit" class="btn btn-success">OK</button>
			</div>
		</div>
		<!-- ./ form actions -->
	</form>
@stop
