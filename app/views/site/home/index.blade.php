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


    <link href="{{asset('assets/css/stylish-portfolio.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/template.css')}}" rel="stylesheet">


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



    <section id="Howitworks" class="section section-center section-hilite section-features loaded" style="margin-top:0.5em;">
     
         <div class="container" style="padding-right: 40px;">
            <h2 class="section-title"><span>How it works?</span></h2>
            <div class="row">

              <div class="col-md-4 col-sm-6">
                <div class="icon-wrap"><img src="{{asset('assets/img/icon-easel-flat.png')}}" alt=""></div>
                <h4>Subheading</h4>
                <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>
              </div>

              <div class="col-md-4 col-sm-6">
                <div class="icon-wrap"><img src="{{asset('assets/img/icon-comments-flat.png')}}" alt=""></div>
                <h4>Subheading</h4>
                <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>
              </div>

              <div class="col-md-4 col-sm-6">
                <div class="icon-wrap"><img src="{{asset('assets/img/icon-book-flat.png')}}" alt=""></div>
                <h4>Subheading</h4>
                <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>
              </div>

              <div class="col-md-4 col-sm-6">
                <div class="icon-wrap"><img src="{{asset('assets/img/icon-bag-flat.png')}}" alt=""></div>
                <h4>Subheading</h4>
                <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>
              </div>

              <div class="col-md-4 col-sm-6">
                <div class="icon-wrap"><img src="{{asset('assets/img/icon-photo-flat.png')}}" alt=""></div>
                <h4>Subheading</h4>
                <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>
              </div>

              <div class="col-md-4 col-sm-6">
                <div class="icon-wrap"><img src="{{asset('assets/img/icon-calculator-flat.png')}}" alt=""></div>
                <h4>Subheading</h4>
                <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>
              </div>

            </div>
          </div>

    </section>



    <!-- Services -->
    <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
    <!-- <section id="services" class="services bg-section-primary">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-10 col-lg-offset-1">
                    <h2>Our Services</h2>
                    <hr class="small">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-cloud fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>Service Name</strong>
                                </h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                <a href="#" class="btn btn-light">Learn More</a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-compass fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>Service Name</strong>
                                </h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                <a href="#" class="btn btn-light">Learn More</a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-flask fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>Service Name</strong>
                                </h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                <a href="#" class="btn btn-light">Learn More</a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-shield fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>Service Name</strong>
                                </h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                <a href="#" class="btn btn-light">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
               <!--  </div>
                <!-- /.col-lg-10 -->
           <!--  </div>
            <!-- /.row -->
       <!--  </div>
        <!-- /.container -->
    <!-- </section>
 -->


    <section id="pricing" class="section section-center section-pricing loaded">
            <div class="container" style="padding-right: 50px;">
                <h2 class="section-title"><span>Pricing Table Made Easy</span></h2>
                <div class="pricing-table">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="paneltemplate paneltemplate-default">
                                <header class="paneltemplate-heading">
                                    <h1 style="font-size: 40px;">Bronze</h1>
                                    <div class="the-price">$5 <span class="subscript">/ month</span></div>
                                </header>
                                <div class="paneltemplate-body">
                                    <table class="table">
                                        <tbody>
                                            <tr><td>1 Account</td></tr>
                                            <tr class="active"><td>1 Project</td></tr>
                                            <tr><td>50K API Access</td></tr>
                                            <tr class="active"><td>50MB Storage</td></tr>
                                            <tr><td>Custom Cloud Services</td></tr>
                                            <tr class="active"><td>Weekly Reports</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                                <footer class="paneltemplate-footer"><a href="{{{ URL::to('user/create') }}}" class="btn btn-default">Sign up now</a></footer>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="paneltemplate paneltemplate-default">
                                <header class="paneltemplate-heading">
                                    <h1 style="font-size: 40px;">Silver</h1>
                                    <div class="the-price">$10 <span class="subscript">/ month</span></div>
                                </header>
                                <div class="paneltemplate-body">
                                    <table class="table">
                                        <tbody>
                                            <tr><td>1 Account</td></tr>
                                            <tr class="active"><td>3 Project</td></tr>
                                            <tr><td>100K API Access</td></tr>
                                            <tr class="active"><td>100MB Storage</td></tr>
                                            <tr><td>Custom Cloud Services</td></tr>
                                            <tr class="active"><td>Weekly Reports</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                                <footer class="paneltemplate-footer"><a href="{{{ URL::to('user/create') }}}" class="btn btn-default">Sign up now</a></footer>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="paneltemplate paneltemplate-primary">
                                <header class="paneltemplate-heading">
                                    <h1 style="font-size: 40px;">Gold</h1>
                                    <div class="the-price">$20 <span class="subscript">/ month</span></div>
                                </header>
                                <div class="paneltemplate-body">
                                    <table class="table">
                                        <tbody>
                                            <tr><td>2 Account</td></tr>
                                            <tr class="active"><td>5 Project</td></tr>
                                            <tr><td>100K API Access</td></tr>
                                            <tr class="active"><td>200MB Storage</td></tr>
                                            <tr><td>Custom Cloud Services</td></tr>
                                            <tr class="active"><td>Weekly Reports</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                                <footer class="paneltemplate-footer"><a href="{{{ URL::to('user/create') }}}" class="btn btn-primary">Sign up now</a></footer>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="paneltemplate paneltemplate-default">
                                <header class="paneltemplate-heading">
                                    <h1 style="font-size: 40px;">Diamond</h1>
                                    <div class="the-price">$35 <span class="subscript">/ month</span></div>
                                </header>
                                <div class="paneltemplate-body">
                                    
                                    <table class="table">
                                        <tbody>
                                            <tr><td>5 Account</td></tr>
                                            <tr class="active"><td>20 Project</td></tr>
                                            <tr><td>300K API Access</td></tr>
                                            <tr class="active"><td>500MB Storage</td></tr>
                                            <tr><td>Custom Cloud Services</td></tr>
                                            <tr class="active"><td>Weekly Reports</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                                <footer class="paneltemplate-footer"><a href="{{{ URL::to('user/create') }}}" class="btn btn-default">Sign up now</a></footer>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



       <!--  <section id="team" class="section section-center section-hilite section-team loaded">
            <div class="container" style="padding-right: 50px;">
                <h2 class="section-title"><span>Our Team</span></h2>
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <img src="http://placehold.it/165x165">
                        <h5>Rihanna</h5>
                    </div>
                    
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <img src="http://placehold.it/165x165">
                        <h5>Marry</h5>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <img src="http://placehold.it/165x165">
                        <h5>Ronaldo</h5>
                    </div>
                    
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <img src="http://placehold.it/165x165">
                        <h5>Jackie Lord</h5>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <img src="http://placehold.it/165x165">
                        <h5>David Beckham</h5>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <img src="http://placehold.it/165x165">
                        <h5>John Doe</h5>
                    </div>
                </div>
            </div>
        </section>
 -->



     <!-- blog -->
 <!--   <section id="blog" class="section section-blog loaded">
          <div class="container">
            <h2 class="section-title"><span>Our Latest Blog</span></h2>
            <div class="row">
              <div class="col-md-6">
                <article class="hentry post">
                  <div class="row">
                    <div class="entry-thumbnail col-lg-4 col-md-5 col-sm-4">
                      <a href="#" class="hover-effect">
                        <img src="http://placehold.it/165x165" alt="">
                        <span class="overlay"><i class="fa fa-plus"></i></span>
                      </a>
                    </div>
                    <div class="col-lg-8 col-md-7 col-sm-8">
                      <header class="entry-header">
                        <h2 class="entry-title"><a href="#">Sample blog title</a></h2>
                        <div class="entry-meta">By <a href="#">Jackie Lord</a> in <a href="#">Category</a></div>
                      </header>
                      <div class="entry-content">
                        <p>Pellentesque eleifend amet scelerisque convallis. Aenean eget metus non erat suscipit accumsan.</p>
                        <a href="#" class="more"><span class="btn btn-primary">Continue Reading</span></a>
                      </div>
                    </div>
                  </div>
                </article>
              </div>
              <div class="col-md-6">
                <article class="hentry post">
                  <div class="row">
                    <div class="entry-thumbnail col-lg-4 col-md-5 col-sm-4">
                      <a href="#" class="hover-effect">
                        <img src="http://placehold.it/165x165" alt="">
                        <span class="overlay"><i class="fa fa-plus"></i></span>
                      </a>
                    </div>
                    <div class="col-lg-8 col-md-7 col-sm-8">
                      <header class="entry-header">
                        <h2 class="entry-title"><a href="#">Sample blog title</a></h2>
                        <div class="entry-meta">By <a href="#">Jackie Lord</a> in <a href="#">Category</a></div>
                      </header>
                      <div class="entry-content">
                        <p>Pellentesque eleifend amet scelerisque convallis. Aenean eget metus non erat suscipit accumsan.</p>
                        <a href="#" class="more"><span class="btn btn-primary">Continue Reading</span></a>
                      </div>
                    </div>
                  </div>
                </article>
              </div>
            </div>
          </div>
        </section> -->



      <!--   <section id="clients" class="section section-hilite section-our-clients loaded">
          <div class="container" style="padding-right: 50px;">
            <h2 class="section-title"><span>What Others are Saying</span></h2>
            <div class="row">
              <div class="col-md-2 col-sm-4 col-xs-6">
                <a href="#"><img src="http://placehold.it/165x85" alt=""></a>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6">
                <a href="#"><img src="http://placehold.it/165x85" alt=""></a>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6">
                <a href="#"><img src="http://placehold.it/165x85" alt=""></a>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6">
                <a href="#"><img src="http://placehold.it/165x85" alt=""></a>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6">
                <a href="#"><img src="http://placehold.it/165x85" alt=""></a>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6">
                <a href="#"><img src="http://placehold.it/165x85" alt=""></a>
              </div>
            </div>
          </div>
        </section> -->



        <!-- <section id="contact" class="section section-center section-contact loaded">
          <div class="container">
            <h2 class="section-title"><span>Contact Us</span></h2>
            <p>Want to say hello? Want to know more about us? Give us a call or drop us an email and we will get back to you as soon as we can.</p>
            <div class="main-action">
              <form role="form">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="sr-only">Subject</label>
                      <input class="form-control" placeholder="Subject" type="text">
                    </div>
                    <div class="form-group">
                      <label class="sr-only">Name</label>
                      <input class="form-control" placeholder="Name" type="text">
                    </div>
                    <div class="form-group">
                      <label class="sr-only">Email</label>
                      <input class="form-control" placeholder="Email" type="email">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="sr-only">Message</label>
                      <textarea class="form-control" placeholder="Message" style="height: 100px" rows="6"></textarea>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-default">Send message</button>
              </form>
            </div>
          </div>
        </section> -->
       

   
    <script>
    // Closes the sidebar menu
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Scrolls to the selected menu item on the page
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
    </script>

@else
	@include('site.generic_view')
@endif
       
@stop
