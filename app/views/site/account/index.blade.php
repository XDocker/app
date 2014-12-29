@extends('site.layouts.default')

{{-- Content --}}
@section('content')
 @section('breadcrumbs', Breadcrumbs::render('account'))

<div class="page-header">
	<div class="row">
		<div class="col-md-9">
			<h5>{{{ Lang::get('account/account.your_accounts') }}}</h5>
		</div>
	</div>
</div>

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
					<button type="button" class="btn btn-warning pull-right" role="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete Account" data-message="{{ Lang::get('account/account.account_delete') }}">
						<span class="glyphicon glyphicon-trash"></span>
					</button>

				</form>
						<a href="{{ URL::to('account/' . $account->id . '/edit') }}" class="btn btn-success pull-right" role="button"><span class="glyphicon glyphicon-edit"></span></a>
						<div class="media-body">
							<h4 class="media-heading">{{ String::title($account->name) }}</h4>
							<p>
								<span class="glyphicon glyphicon-calendar"></span> <!--Sept 16th, 2012-->{{{ $account->created_at }}} 
								
								@if($account->cloudProvider == 'Docker')
								| <a href="{{ URL::to('account/docker/' . $account->id . '/Containers') }}"><span class="fa fa-info"></span></a>
								@endif
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
{{$accounts->links()}}
<div>
<a id="acc_add_btn" href="{{ URL::to('account/create') }}" class="btn btn-primary pull-right" role="button">{{{ Lang::get('account/account.add_account') }}}</a>
</div>
@include('deletemodal')



@stop
