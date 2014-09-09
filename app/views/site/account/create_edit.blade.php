@extends('site.layouts.default')

{{-- Content --}}
@section('content')

	{{-- Create User Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($user)){{ URL::to('accounts/' . $account->id . '/edit') }}@endif" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		
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

		<!-- ./ username -->
		<div id="additionalCloudProviderFields">
			
		</div>				

		<!-- Form Actions -->
		<div class="form-group">
			<div class="col-md-offset-2 col-md-10">
				<element class="btn btn-cancel close_popup">Cancel</element>
				<button type="reset" class="btn btn-default">Reset</button>
				<button type="submit" class="btn btn-success">OK</button>
			</div>
		</div>
		<!-- ./ form actions -->
	</form>
@stop

@section('scripts')
<script src="{{asset('assets/bower_components/jsonform/deps/underscore.js')}}"></script>
<script src="{{asset('assets/bower_components/jsonform/lib/jsonform.js')}}"></script>
<script type="text/javascript">
	(function($){
		'use strict';
		var PROVIDERS = {{ json_encode($providers) }};
		$(function(){
			var $additionalCloudProviderFields = $('#additionalCloudProviderFields');
			var $cloudProvider = $('#cloudProvider');
			$cloudProvider.on('change', function(){
				$additionalCloudProviderFields.empty().jsonForm({
			        schema: PROVIDERS[$cloudProvider.val()] || {},
			        onSubmit: function () {
			        	console.log('form submitted', arguments, this);
			        }
		      	});
			}).trigger('change');
		});
	})(jQuery);
</script>
@stop
