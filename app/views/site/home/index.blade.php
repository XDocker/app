@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('home/home.settings') }}} ::
@parent
@stop

{{-- New Laravel 4 Feature in use --}}
@section('styles')
@parent
body {
	background: #f2f2f2;
}
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h4>Home Page</h4>
</div>
<p>
	Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, 
	tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem 
	malesuada magna mollis euismod. Donec sed odio dui.
</p>

<p>
	Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, 
	tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
</p>
@stop
