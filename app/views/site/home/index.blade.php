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
<div class="page-header">
	<div class="row">
		<div class="col-md-9">
			<h6>Home Page</h6>
		</div>
		<div class="col-md-3">
			<form class="navbar-right" action="#" role="search">
                <div class="form-group home-search">
                  <div class="input-group">
                    <input class="form-control" id="navbarInput-01" type="search" placeholder="Search">
                    <span class="input-group-btn">
                      <button type="submit" class="btn"><span class="fui-search"></span></button>
                    </span>
                  </div>
                </div>
              </form>
		</div>
	</div>
</div>
<p>
	Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, 
	tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem 
	malesuada magna mollis euismod. Donec sed odio dui.
</p>
<div class="media-block">
	<ul class="list-group list-group-custom">
  		<li class="list-group-item">
			<div class="media">
				<a class="pull-left" href="#">
				    <img class="media-object img-circle" src="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}" alt="">
				</a>
				<a href="#" class="btn btn-inverse pull-right" role="button">Deploy</a>
				<div class="media-body">
					<h6 class="media-heading">Media heading </h6>
				    <p>
				    	Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.
					</p>
				</div>
			</div>
		</li>
		<li class="list-group-item">
			<div class="media">
				<a class="pull-left" href="#">
				    <img class="media-object img-circle" src="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}" alt="">
				</a>
				<a href="#" class="btn btn-inverse pull-right" role="button">Deploy</a>
				<div class="media-body">
					<h6 class="media-heading">Media heading2 </h6>
				    <p>
				    	Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.
					</p>
				</div>
			</div>
		</li>
		<li class="list-group-item">
			<div class="media">
				<a class="pull-left" href="#">
				    <img class="media-object img-circle" src="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}" alt="">
				</a>
				<a href="#" class="btn btn-inverse pull-right" role="button">Deploy</a>
				<div class="media-body">
					<h6 class="media-heading">Media heading3 </h6>
				    <p>
				    	Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.
					</p>
				</div>
			</div>
		</li>
		<li class="list-group-item">
			<div class="media">
				<a class="pull-left" href="#">
				    <img class="media-object img-circle" src="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}" alt="">
				</a>
				<a href="#" class="btn btn-inverse pull-right" role="button">Deploy</a>
				<div class="media-body">
					<h6 class="media-heading">Media heading4 </h6>
				    <p>
				    	Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.
					</p>
				</div>
			</div>
		</li>
		<li class="list-group-item">
			<div class="media">
				<a class="pull-left" href="#">
				    <img class="media-object img-circle" src="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}" alt="">
				</a>
				<a href="#" class="btn btn-inverse pull-right" role="button">Deploy</a>
				<div class="media-body">
					<h6 class="media-heading">Media heading5 </h6>
				    <p>
				    	Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.
					</p>
				</div>
			</div>
		</li>
		<li class="list-group-item">
			<div class="media">
				<a class="pull-left" href="#">
				    <img class="media-object img-circle" src="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}" alt="">
				</a>
				<a href="#" class="btn btn-inverse pull-right" role="button">Deploy</a>
				<div class="media-body">
					<h6 class="media-heading">Media heading6 </h6>
				    <p>
				    	Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.
					</p>
				</div>
			</div>
		</li>
		<li class="list-group-item">
			<div class="media">
				<a class="pull-left" href="#">
				    <img class="media-object img-circle" src="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}" alt="">
				</a>
				<a href="#" class="btn btn-inverse pull-right" role="button">Deploy</a>
				<div class="media-body">
					<h6 class="media-heading">Media heading7 </h6>
				    <p>
				    	Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.
					</p>
				</div>
			</div>
		</li>
		<li class="list-group-item">
			<div class="media">
				<a class="pull-left" href="#">
				    <img class="media-object img-circle" src="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}" alt="">
				</a>
				<a href="#" class="btn btn-inverse pull-right" role="button">Deploy</a>
				<div class="media-body">
					<h6 class="media-heading">Media heading8 </h6>
				    <p>
				    	Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.
					</p>
				</div>
			</div>
		</li>
		<li class="list-group-item">
			<div class="media">
				<a class="pull-left" href="#">
				    <img class="media-object img-circle" src="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}" alt="">
				</a>
				<a href="#" class="btn btn-inverse pull-right" role="button">Deploy</a>
				<div class="media-body">
					<h6 class="media-heading">Media heading9 </h6>
				    <p>
				    	Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.
					</p>
				</div>
			</div>
		</li>
		<li class="list-group-item">
			<div class="media">
				<a class="pull-left" href="#">
				    <img class="media-object img-circle" src="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}" alt="">
				</a>
				<a href="#" class="btn btn-inverse pull-right" role="button">Deploy</a>
				<div class="media-body">
					<h6 class="media-heading">Media heading10 </h6>
				    <p>
				    	Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.
					</p>
				</div>
			</div>
		</li>
	</ul>
	<div class="text-center">
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
	</div>
</div>
@stop
