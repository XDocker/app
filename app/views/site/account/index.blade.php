@extends('site.layouts.default')

{{-- Content --}}
@section('content')

<div class="media-block">
	<ul class="list-group">
		@if(!empty($accounts)) 
			@foreach ($accounts as $account)
	  			<li class="list-group-item">
					<div class="media">
						<span class="pull-left" href="#">
						    <img class="media-object img-responsive" src="{{ asset('/assets/img/providers/'.Config::get('provider_meta.'.$account->cloudProvider.'.logo')) }}" alt="{{ $account->cloudProvider }}" />
						</span>
						<form class="pull-right" method="post" action="{{ URL::to('account/' . $account->id . '/delete') }}">
							<!-- CSRF Token -->
							<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
							<!-- ./ csrf token -->
							<button type="submit" class="btn btn-warning pull-right" role="button">Delete</button>
						</form>
						<a href="{{ URL::to('account/' . $account->id . '/edit') }}" class="btn btn-success pull-right" role="button">Edit</a>
						<div class="media-body">
							<h4 class="media-heading">{{ String::title($account->name) }}</h4>
							<p>
								<span class="glyphicon glyphicon-calendar"></span> <!--Sept 16th, 2012-->{{{ $account->created_at }}}
							</p>
						</div>
					</div>
				</li>
			@endforeach
		@endif
	</ul>
	@if(empty($accounts) || count($accounts) === 0) 
		<div class="alert alert-info"> {{{ Lang::get('account/account.empty_accounts') }}}</div>
	@endif
</div>
<div>
<a href="{{ URL::to('account/create') }}" class="btn btn-primary pull-right" role="button">Add New Cloud Account</a>
</div>

@stop
