@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('home/home.settings') }}} ::
@parent
@stop

{{-- New Laravel 4 Feature in use --}}
@section('styles')
@parent
@stop

{{-- Content --}}
@section('content')
@if (Auth::check())
	<div class="media-block">
		<h6 class="page-header">Your Deployments:</h6>
		<ul class="list-group list-group-custom">
				@if(!empty($deployments)) 
					@foreach($deployments as $deployment)
			  		<li class="list-group-item">
						<div class="media">
							<form class="pull-right" method="post" action="{{ URL::to('deployment/' . $deployment->id . '/delete') }}">
								<!-- CSRF Token -->
								<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
								<!-- ./ csrf token -->
								<button type="submit" class="btn btn-danger pull-right" role="button">Delete</button>
							</form>				
							<div class="media-body">
								<h4 class="media-heading">{{{!empty($deployment -> name)?$deployment -> name:'Untitled'}}} - {{{!empty($deployment -> docker_name)?$deployment -> docker_name:'Untitled'}}}</h4>
							    <p>
							    	{{{!empty($deployment -> status)?$deployment -> status:''}}}
								</p>
							</div>
						</div>
					</li>
					@endforeach
				@else 
					{{{ Lang::get('home/home.empty_deployments') }}}
				@endif
		</ul>
	</div>
@endif
<div class="page-header">
	<div class="row">
		<div class="col-md-9">
			<h6>Public Docker Images:</h6>
		</div>
		<div class="col-md-3">
			<form class="navbar-right" action="#" role="search" method="get">
                <div class="form-group home-search">
                  <div class="input-group">
                    <input class="form-control" name="q" type="search" placeholder="Search" value="{{$search_term}}">
                    <span class="input-group-btn">
                      <button type="submit" class="btn" title="Search"><span class="fui-search"></span></button>
                    </span>
                  </div>
                </div>
            </form>
		</div>
	</div>
</div>
<p>
</p>
<div class="media-block">
	<ul class="list-group list-group-custom">
		@foreach($dockerInstances as $instance)
  		<li class="list-group-item">
			<div class="media">
				<a href="{{ URL::to('deployment/create/') }}?name={{urlencode($instance -> name)}}" class="btn btn-inverse pull-right" role="button">Deploy</a>
				<div class="media-body">
					<h4 class="media-heading">{{{!empty($instance -> name)?$instance -> name:''}}}</h4>
				    <p>
				    	{{{!empty($instance -> description)?$instance -> description:''}}}
					</p>
				</div>
			</div>
		</li>
		@endforeach
	</ul>
	<!-- <div class="text-center">
		<div class="pagination">
			<ul>
	        	<li class="previous"><a href="#fakelink" class="fui-arrow-left"></a></li>
	            <li class="active"><a href="#fakelink">1</a></li>
	            <li><a href="#fakelink">2</a></li>
	            <li><a href="#fakelink">3</a></li>
	            <li><a href="#fakelink">4</a></li>
	            <li><a href="#fakelink">5</a></li>
	            <li><a href="#fakelink">6</a></li>
	            <li><a href="#fakelink">7</a></li>
	            <li><a href="#fakelink">8</a></li>
	            <li class="next"><a href="#fakelink" class="fui-arrow-right"></a></li>
			</ul>
		</div>
	</div> -->
</div>
@stop
