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
                    <h3 class="section-heading">{{{ Lang::get('site.name') }}}</h3>
                    <h5 class="section-subheading text-muted">{{{ Lang::get('site.tagline') }}}</h5>
                   
                		
		</div>
            </div>
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
        <div class="alert alert-info text-center">
        	<h4>{{{ Lang::get('home.xervmon_intro') }}}</h4>
        	<a target="_blank" href="https://www.xervmon.com/product" class="btn btn-primary">{{{ Lang::get('home.xervmon_call_to_action') }}}</a>
        </div>
       <div class="text-center">
       	 <!-- You can move inline styles to css file or css block. -->
       	 <p><h4><font color="3399FF">Ready to be deployed now on Amazon AWS</font></h4></p>
	    <div id="slider1_container" style="position: relative; top: 0px; center: 0px; width: 980px; height: 100px; overflow: hidden; ">
	
	        <!-- Loading Screen -->
	        <div u="loading" style="position: absolute; top: 0px; center: 0px;">
	            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
	                background-color: #000; top: 0px; left: 0px;width: 100%;height:100%;">
	            </div>
	            <div style="position: absolute; display: block; background: url({{{ asset('assets/img/loading.gif') }}}) no-repeat center center;
	                top: 0px; left: 0px;width: 100%;height:100%;">
	            </div>
	        </div>
	
	        <!-- Slides Container -->
	        <div u="slides" style="cursor: move; position: absolute; center: 0px; top: 0px; width: 980px; height: 100px; overflow: hidden;">
	            @foreach($dockerInstances as $instance)
					@if(xDockerEngine::enabled($instance->name))
						<div><img u="image" title="{{ $instance -> name }} : {{ $instance -> description }}" alt="{{ $instance -> name }} : {{ $instance -> description }}" src="{{ asset('/assets/img/providers/'.xDockerEngine::getLogo($instance -> name)) }}" /></div>
	            	@endif
	            @endforeach
	           
	        </div>
     	</div>
       </div>
    </section>
@else
	@include('site.generic_view')
@endif
       
@stop
