@extends('site.layouts.default')

{{-- Content --}}
@section('content')

<div class="page-header">
	<div class="row">
		<div class="col-md-9">
			<h4>Your Deployments:</h4>
		</div>
	</div>
</div>

<div class="media-block">
	<ul class="list-group">
		@if(!empty($deployments)) 
			@foreach ($deployments as $deployment)
			{{var_dump($deployment)}}
	  			<li class="list-group-item">
					<div class="media">
						<form class="pull-right" method="post" action="{{ URL::to('deployment/' . $deployment->id . '/delete') }}">
							<!-- CSRF Token -->
							<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
							<!-- ./ csrf token -->
							<button type="submit" class="btn btn-warning pull-right" role="button">Delete</button>
						</form>
						<div class="media-body">
							
							<h4 class="media-heading">{{ String::title($deployment->name) }}</h4>
							<p>
								<span class="glyphicon glyphicon-calendar"></span> <!--Sept 16th, 2012-->{{{ $deployment->created_at }}}
							</p>
						</div>
					</div>
				</li>
			@endforeach
		@endif
	</ul>
	@if(empty($deployments) || count($deployments) === 0) 
		<div class="alert alert-info"> {{{ Lang::get('deployment/deployment.empty_deployments') }}}</div>
	@endif
</div>
<div>
<a href="{{ URL::to('deployment/create') }}" class="btn btn-primary pull-right" role="button">Add New Deployment</a>
</div>

@stop
