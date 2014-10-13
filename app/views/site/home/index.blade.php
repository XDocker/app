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
	@include('site.generic_view')
       
@stop
