<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8" />
		<title>
			@section('title')
			{{{ Lang::get('site.title') }}}
			@show
		</title>
		<meta name="keywords" content="{{{ Lang::get('site.keywords') }}}" />
		<meta name="author" content="{{{ Lang::get('site.author') }}}" />
		<meta name="description" content="{{{ Lang::get('site.description') }}}" />

		<!-- Mobile Specific Metas
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- CSS
		================================================== -->
        <link rel="stylesheet" href="{{asset('bower_components/bootswatch/paper/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
		<style>
		@section('styles')
		@show
		</style>

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Favicons
		================================================== -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" href="{{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">
		<link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.ico') }}}">
	</head>

	<body>
		<!-- Env: {{App::environment()}} -->

		<!-- To make sticky footer need to wrap in a div -->
		<div id="wrap">

			<!-- Navbar -->
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
				 <div class="container">
	                <div class="navbar-header">
	                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-target">
	                        <span class="sr-only">Toggle navigation</span>
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                    </button>
	                    <a class="navbar-brand" href="{{{ URL::to('/') }}}"><img class="img-responsive" src="{{{ asset('assets/img/logo.png') }}}"></a>  
	                </div>
	                <div class="collapse navbar-collapse navbar-ex1-collapse" id="navbar-collapse-target">
	                    <ul class="nav navbar-nav pull-right">
	                        @if (Auth::check())
		                        @if (Auth::user()->hasRole('admin'))
		                        	<li><a href="{{{ URL::to('admin') }}}">{{{ Lang::get('site.admin_panel') }}}</a></li>
		                        @endif
		                        <li class="dropdown">
		                        	<a class="dropdown-toggle" data-toggle="dropdown" href="#">
	    								<span class="glyphicon glyphicon-cog"></span> {{{ Lang::get('site.services') }}}	<span class="caret"></span>
	    							</a>
		                        	<ul class="dropdown-menu">
	    								<li><a href="{{{ URL::to('account') }}}"><span class="glyphicon glyphicon-wrench"></span> {{{ Lang::get('site.accounts') }}}</a></li>
	    								<li class="divider"></li>
	    								<li><a href="{{{ URL::to('deployment') }}}"><span class="glyphicon glyphicon-play-circle"></span> {{{ Lang::get('site.deployments') }}}</a></li>
	    								<li class="divider"></li>
	    								<li><a href="{{{ URL::to('enginelog') }}}"><span class="glyphicon glyphicon-inbox"></span> {{{ Lang::get('site.enginelog') }}}</a></li>
	    								<li class="divider"></li>
	    								<li><a href="{{{ URL::to('ServiceStatus') }}}"><span class="glyphicon glyphicon-signal"></span> {{{ Lang::get('site.webserivce_status') }}}</a></li>
	    								
	    							</ul>
		                        </li>
		                        <li class="dropdown">
		    							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
	    									<span class="glyphicon glyphicon-user"></span> {{{ Auth::user()->username }}}	<span class="caret"></span>
	    								</a>
	    							<ul class="dropdown-menu">
	    								<li><a href="{{{ URL::to('user') }}}"><span class="glyphicon glyphicon-edit"></span> {{{ Lang::get('site.edit_profile') }}}</a></li>
	    								<li class="divider"></li>
	    								<li><a href="{{{ URL::to('user/logout') }}}"><span class="glyphicon glyphicon-share"></span> {{{ Lang::get('site.log_out') }}}</a></li>
	    							
	    							</ul>
	    						</li>
	                        @else
	                        <li {{ (Request::is('user/login') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/login') }}}"><span class="glyphicon glyphicon-log-in"></span> {{{ Lang::get('site.login') }}}</a></li>
	                        <li {{ (Request::is('user/create') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/create') }}}"><span class="glyphicon glyphicon-log-out"></span> {{{ Lang::get('site.sign_up') }}}</a></li>
	                        @endif
	                    </ul>
	                    <!-- ./ nav-collapse -->
					</div>
				</div>
			</nav>
			<!-- ./ navbar -->

			<a class="banner-github {{ (Request::is('/') ? '' : 'hide') }}" href="https://github.com/XDocker/app" target="_blank">
		        <img src="{{{ asset('assets/img/forkme_right_red_aa0000.png') }}}" alt="{{{ Lang::get('site.forkme') }}}">
		    </a>

			<!-- Container -->
			<div class="container clear-both">
				
				<!-- Notifications -->
				@include('notifications')
				<!-- ./ notifications -->

				<!-- Content -->
				@yield('content')
				<!-- ./ content -->
			</div>
			<!-- ./ container -->

			<!-- the following div is needed to make a sticky footer -->
			<div id="push"></div>
			@include('site.footer')
		   
	    </div>
		<!-- ./wrap -->

		<!-- Javascripts
		================================================== -->
        <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

        @yield('scripts')

        {{-- Load SumoMe for the marketing stuff --}}
        <!--
        <script src="//load.sumome.com/" data-sumo-site-id="d9c34610bfb1f1b8f5c8cbfdce3a831f7e81aac9ef616668be06e0ffed04f25b" async></script>
		-->
	</body>
</html>
