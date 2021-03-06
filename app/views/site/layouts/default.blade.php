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
        <link rel="stylesheet" href="{{asset('assets/css/feedback.css')}}">
		<style>
		@section('styles')
		@show
		</style>

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery-plugins/jquery.crypt.js')}}"></script>
        <script src="{{asset('assets/js/jqueryblockui.js')}}"></script>

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
	                	<ul class="nav navbar-nav">
	                		<li{{ (Request::is('data-security') ? ' class="active"' : '') }}><a href="{{{ URL::to('data-security') }}}"><span class="glyphicon glyphicon-lock"></span> {{{ Lang::get('site.data_security') }}}</a></li>
    						<li{{ (Request::is('roadmap') ? ' class="active"' : '') }}><a href="{{{ URL::to('roadmap') }}}"><span class="glyphicon glyphicon-list-alt"></span> {{{ Lang::get('site.roadmap') }}}</a></li>
	                		<li{{ (Request::is('devops') ? ' class="active"' : '') }}><a href="{{{ URL::to('devops') }}}"><span class="glyphicon glyphicon-plane"></span> {{{ Lang::get('site.devops') }}}</a></li>
							<li{{ (Request::is('videos') ? ' class="active"' : '') }}><a href="{{{ URL::to('videos') }}}"><span class="glyphicon glyphicon-hd-video"></span> {{{ Lang::get('site.videos') }}}</a></li>
					        @if (!Auth::check())						
								@if(Request::url()==URL::to('/'))
		                          	<li id="howitworks"><a href="#Customers"><i class="fa fa-users"></i> Customers </a></li>
		                         @else
		                         	<li id="howitworks"></li>
		                         	<li id="howitworks"><a href="{{{ URL::to('/').'#Customers' }}}"><i class="fa fa-users"></i> Customers </a></li>
		                         @endif	
	                         @endif
	                	</ul>	
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
	    								<li><a href="{{{ URL::to('ServiceStatus') }}}"><span class="glyphicon glyphicon-signal"></span> {{{ Lang::get('site.webservice_status') }}}</a></li>
	    								
	    							</ul>
		                        </li>
		                        <li class="dropdown">
		                        	<a class="dropdown-toggle" data-toggle="dropdown" href="#">
	    								<span class="glyphicon glyphicon-hand-up"></span> {{{ Lang::get('site.support') }}}	<span class="caret"></span>
	    							</a>
	    							<ul class="dropdown-menu">
	    								<li><a href="{{{ URL::to('ticket') }}}"><span class="glyphicon glyphicon-question-sign"></span> {{{ Lang::get('site.tickets') }}}</a></li>
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
	                        <!--  <li id="howitworks"><a href="#Howitworks">How it works</a></li>
	                        <li id="pricings"><a href="#pricing">Pricing</a></li> 
                       <li><a href="#services">Services</a></li>
                            <li><a href="#blog">Blog</a></li>-->
	                        <li {{ (Request::is('user/login') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/login') }}}"><span class="glyphicon glyphicon-log-in"></span> {{{ Lang::get('site.login') }}}</a></li>
	                        <li {{ (Request::is('user/create') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/create') }}}"><span class="glyphicon glyphicon-log-out"></span> {{{ Lang::get('site.sign_up') }}}</a></li>
	                        @endif
	                    </ul>
	                    <!-- ./ nav-collapse -->
					</div>
				</div>
			</nav>
			
			<!-- ./ navbar -->
			<!--
			<a class="banner-github {{ (Request::is('/') ? '' : 'hide') }}" href="https://github.com/XDocker/app" target="_blank">
		        <img src="{{{ asset('assets/img/forkme_right_red_aa0000.png') }}}" alt="{{{ Lang::get('site.forkme') }}}">
		    </a>
			-->
			<!-- Container -->
			<div class="container clear-both" style="margin-top: 4em;">
				@yield('breadcrumbs')
				
				<!-- Notifications -->
				@include('notifications')
				<!-- ./ notifications -->

			<button style="margin-top: 50px; opacity: 0.96;" class="un-button un-right un-has-border css3"  data-toggle="modal" data-target="#feedbackmodal">Feedback</button>

				<!-- Content -->
				@yield('content')
				<!-- ./ content -->
				@include('feedbackmodal')
			</div>
			<!-- ./ container -->

			<!-- the following div is needed to make a sticky footer -->
			<div id="push"></div>
			@include('site.footer')
	    </div>
		<!-- ./wrap -->

		<!-- Javascripts
		================================================== -->
        
        <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery-plugins/jquery.fileDownload.js')}}"></script>
        <script src="{{asset('assets/js/jquery-plugins/prettify.js')}}"></script>
        @if(!Auth::check())
        @if(Request::url()==URL::to('/'))
	        <script src="{{asset('assets/js/jquery-plugins/jssor.slider.mini.js')}}"></script>
        @include('site.home.jsPartial')
        @endif
        @endif
        <script>
        $(function () { 

        var url = "{{ URL::to('FeedbackController') }}";

           $('#feedbackmodal').on('hidden.bs.modal', function (e) {
            $(this).find("input,textarea").val('').end()
                   .find("#feedback_response").text('').end();
            })

           $('#feedbackconfirm').click(function(e){

           	var feedbackmessage = $('#feedbackmessage').val();
           	var feedbackemail = $('#feedbackemail').val();
           	var feedbackdescription = $('textarea#feedbackdescription').val();
           	if ($.trim(feedbackemail).length == 0 || $("#feedbackmessage").val()=="" || $("textarea#feedbackdescription").val()=="") {
           	$('#feedback_response').html('<h5 style="color:red;">All fields are mandatory</h5>');
            e.preventDefault();
             }
             if(feedbackmessage && feedbackemail && feedbackdescription){
             if (validateEmail(feedbackemail)) {
             	$('#feedbackmodal').modal('hide');
             $.blockUI({ message: "<h6>Sending Feedback.....</h6>" });    
             $.ajax({
             url:url,
             data:{feedbackmessage:feedbackmessage,feedbackemail:feedbackemail,feedbackdescription:feedbackdescription},
             cache: false
             }).done(function(response) {
            
             if(response){
             	$.unblockUI();
             	$.blockUI({ message: "<h6>"+response+"</h6>" }); 
             	setTimeout($.unblockUI, 2000); 
             }
             });
             }else {
             $('#feedback_response').html('<h5 style="color:red;">Invalid Email Address</h5>');
             e.preventDefault();
             }
           	}
                        
          });
       
        

        function validateEmail(email) {
          var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
          if (filter.test(email)) {
          return true;
          }else {
          return false;
          }
        }

         });

        </script>


        @yield('scripts')
	</body>
</html>
