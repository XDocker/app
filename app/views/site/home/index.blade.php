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
	Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, 
	tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem 
	malesuada magna mollis euismod. Donec sed odio dui.
</p>
<div class="media-block">
	<ul class="list-group list-group-custom">
		@foreach($data as $instance)
  		<li class="list-group-item">
			<div class="media">
				<a href="#" class="btn btn-inverse pull-right" role="button">Deploy</a>
				<div class="media-body">
					<h4 class="media-heading">{{!empty($instance -> name)?$instance -> name:''}}</h4>
				    <p>
				    	{{!empty($instance -> description)?$instance -> description:''}}
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
