@extends('site.layouts.default')
{{-- Web site Title --}}
@section('title')
{{{ Lang::get('site.videos') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
@section('breadcrumbs', Breadcrumbs::render('Videos'))
<h4>{{{ Lang::get('site.videos') }}}</h4>
<div class="row">
  	<div class="col-md-12">
  		<h4>Quick walk through</h4>
  		<p>
		<iframe src="//www.youtube.com/embed/JVRZrhHBHFU" width="700" height="480" frameborder="0"></iframe>

		</p>
		<p>Call us today on (800) 813-1315 or <a href="mailto:roapmap-xdocker@xervmon.com">email us </a> with your feature request in relation to our xDocker service. </p>
		
	</div>
</div>
<script type="text/javascript">
	$(function() {
		$('#howitworks').hide();
		$('#pricings').hide();
	});

</script>
@stop






