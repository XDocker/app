@extends('site.layouts.default')

{{-- Content --}}
@section('content')

<div class="page-header">
	<div class="row">
		<div class="col-md-9">
			<h4>Your Accounts:</h4>
		</div>
	</div>
</div>

<div class="media-block">
	<ul class="list-group">
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
	</ul>
</div>
<div>
<a href="{{ URL::to('account/create') }}" class="btn btn-primary pull-right" role="button">Add New Cloud Account</a>
</div>

@stop
