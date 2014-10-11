@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('site.title') }}} ::
@parent
@stop

{{-- New Laravel 4 Feature in use --}}
@section('styles')
@parent
@stop

{{-- Content --}}
@section('content')
@if (!Auth::check())
	{{-- Home page welcome content for new users --}}
	<section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">{{{ Lang::get('site.name') }}}</h2>
                    <h5 class="section-subheading text-muted">{{{ Lang::get('site.tagline') }}}</h5>
                    <h7 class="section-subheading text-muted btn btn-success">{{{ Lang::get('site.launch') }}}</h7>
                    
                    <br/><br/>
        	 			@include('laravel-newsletter-signup::signup')
                		
				</div>
            </div>
            <br/>
            <br/>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-play fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">{{{ Lang::get('home.steps.select.title') }}}</h4>
                    <p class="text-muted">{{{ Lang::get('home.steps.select.description') }}}</p>
                	<i class="hidden-xs hidden-sm fa fa-2x fa-arrow-right process-next-arrow-horizontal"></i>
                	<i class="hidden-md hidden-lg fa fa-2x fa-arrow-down process-next-arrow-vertical"></i>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-cog fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">{{{ Lang::get('home.steps.configure.title') }}}</h4>
                    <p class="text-muted">{{{ Lang::get('home.steps.configure.description') }}}</p>
                	<i class="hidden-xs hidden-sm fa fa-2x fa-arrow-right process-next-arrow-horizontal"></i>
                	<i class="hidden-md hidden-lg fa fa-2x fa-arrow-down process-next-arrow-vertical"></i>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-dashboard fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">{{{ Lang::get('home.steps.manage.title') }}}</h4>
                    <p class="text-muted">{{{ Lang::get('home.steps.manage.description') }}}</p>
                </div>
            </div>
        </div>
        <br/>
        <div class="alert alert-info text-center">
        	<h4>{{{ Lang::get('home.xervmon_intro') }}}</h4>
        	<a target="_blank" href="https://www.xervmon.com/product" class="btn btn-primary">{{{ Lang::get('home.xervmon_call_to_action') }}}</a>
        	
        </div>
       
    </section>
@else
	<div class="media-block">
		<h4 class="page-header">Your Deployments:</h4>
		<ul class="list-group list-group-custom">
				@if(!empty($deployments)) 
					@foreach($deployments as $deployment)
			  		<li class="list-group-item">
						<div class="media">
							<a href="{{ URL::to('account/'.$deployment->cloud_account_id.'/edit') }}" class="pull-left" href="#">
						   	 <img class="media-object img-responsive" src="{{ asset('/assets/img/providers/'.Config::get('provider_meta.'.$deployment->cloudProvider.'.logo')) }}" alt="{{ $deployment->cloudProvider }}" />
						    	<p class="text-center">{{{$deployment->accountName}}}</p>
							</a>
							<form class="pull-right" method="post" action="{{ URL::to('deployment/' . $deployment->id . '/refresh') }}">
								<!-- CSRF Token -->
								<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
								<!-- ./ csrf token -->
								<button type="submit" class="btn btn-success pull-right" role="button"><span class="glyphicon glyphicon-refresh"</a></button>
							</form>		
							<form class="pull-right" method="post" action="{{ URL::to('deployment/' . $deployment->id . '/delete') }}">
								<!-- CSRF Token -->
								<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
								<!-- ./ csrf token -->
								<button type="submit" class="btn btn-danger pull-right" role="button"><span class="glyphicon glyphicon-trash"</a></button>
							</form>					
							<div class="media-body">
								<h4 class="media-heading">{{{!empty($deployment -> name)?$deployment -> name:'Untitled'}}} - {{{!empty($deployment -> docker_name)?$deployment -> docker_name:'Untitled'}}}</h4>
							    <p>
								<?php
									if($deployment->status == 'Completed') 
									{
										$result = json_decode($deployment->wsResults);
										echo $result->instance_id . ' | ' . $result->public_dns . '<br/>';
										echo '<a href="#" onclick="restart('.$deployment->id.')">Restart</a> |'  .
											'<a href="#" onclick="terminate('.$deployment->id.')">Terminate</a>|' .
											'<a href="'. URL::to('deployment/' . $deployment->id . '/log').'">View Log</a>' ;
								?>
								
				
								<?php
									}
								?>
								
							</p>
								<p>
									<span title="Created At"><span class="glyphicon glyphicon-calendar"></span> <!--Sept 16th, 2012-->{{{ $deployment->created_at }}}</span>
								</p>
								<p>
									<span title="Status"><span class="glyphicon glyphicon-asterisk"></span> <!--Sept 16th, 2012-->{{{ $deployment->status }}}</span>
								</p>
							</div>
						</div>
					</li>
					@endforeach
				@endif
		</ul>
		@if(empty($deployments) || count($deployments) === 0) 
			<div class="alert alert-info"> {{{ Lang::get('home/home.empty_deployments') }}}</div>
		@endif
	</div>
@endif
<div class="page-header">
	<div class="row">
		<div class="col-md-9">
			<h4>Public Docker Images:</h4>
		</div>
		<div class="col-md-3">
			<form class="navbar-right" action="#" role="search" method="get">
                <div class="form-group home-search">
                  <div class="input-group">
                    <input class="form-control" name="q" type="search" placeholder="Search" value="{{$search_term}}">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-inverse" title="Search"><span class="fa fa-search"></span></button>
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
		@forelse($dockerInstances as $instance)
			<li class="list-group-item">
				<div class="media">
					<a href="{{ URL::to('deployment/create/') }}?name={{urlencode($instance -> name)}}" class="btn btn-primary pull-right" role="button"><span class="glyphicon glyphicon-play"</a></a>
					<div class="media-body">
						<h4 class="media-heading">{{{!empty($instance -> name)?$instance -> name:''}}}</h4>
					    <p>
					    	{{{!empty($instance -> description)?$instance -> description:''}}}
						</p>
					</div>
				</div>
			</li>
		@empty
			<li class="list-group-item alert alert-info">No matching docker images found for '{{ $search_term }}'</li>	
		@endforelse
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
