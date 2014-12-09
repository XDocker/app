@extends('site.layouts.default')

{{-- Content --}}
@section('content')

<div class="page-header">
	<div class="row">
		<div class="col-md-9">
			<h4>{{{ Lang::get('account/account.your_accounts') }}}</h4>
		</div>
	</div>
</div>

<div class="media-block">
	<ul class="list-group">
		@if(!empty($tests)) 
			@foreach ($tests as $test)
	  			<li class="list-group-item">
					<div class="media">
						<span class="pull-left" href="#">
						    <img class="media-object img-responsive" src="{{ asset('/assets/img/providers/'.Config::get('provider_meta.'.$account->cloudProvider.'.logo')) }}" alt="{{ $account->cloudProvider }}" />
						</span>
						<form class="pull-right" method="post" action="{{ URL::to('test/' . $test->id . '/delete') }}">
							<!-- CSRF Token -->
							<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
							<!-- ./ csrf token -->
							<button type="submit" class="btn btn-warning pull-right" role="button">{{{ Lang::get('general.delete') }}}</button>
						</form>
						<a href="{{ URL::to('test/' . $test->id . '/edit') }}" class="btn btn-success pull-right" role="button">{{{ Lang::get('general.edit') }}}</a>
						<div class="media-body">
							<h4 class="media-heading">{{ String::title($test->name) }}</h4>
							<p>
								<span class="glyphicon glyphicon-calendar"></span> <!--Sept 16th, 2012-->{{{ $test->created_at }}}
							</p>
						</div>
					</div>
				</li>
			@endforeach
		@endif
	</ul>
	@if(empty($tests) || count($tests) === 0) 
		<div class="alert alert-info"> {{{ Lang::get('test/test.empty_test') }}}</div>
	@endif
</div>
<div>
<a href="{{ URL::to('account/create') }}" class="btn btn-primary pull-right" role="button">{{{ Lang::get('account/account.add_account') }}}</a>
</div>

@stop
