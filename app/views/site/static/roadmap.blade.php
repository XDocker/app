@extends('site.layouts.default')
{{-- Web site Title --}}
@section('title')
{{{ Lang::get('site.roadmap') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
@section('breadcrumbs', Breadcrumbs::render('Roadmap'))
<h4>{{{ Lang::get('site.roadmap') }}}</h4>
<div class="row">
  	<div class="col-md-12">
  		<h4>What to expect?</h4>
  		<p>
		While our roadmap items will be defined by our xDock service users, the following are a gist of items that we would cover in next few releses.
		<ul>
			<li>Collaborate and Integrate with <a href="https://www.docker.io">Docker®</a> eco system</li>
			<li>Multi Cloud Deployment & Management</li>
			<li>Multi Container Deployment & Management</li>
			<li>Application Container (logs, process etc.,) monitoring</li>
			<li>Custom application dockerization, workflows & Automation</li>
			<li>More coming soon!</li>
			
		</ul>
		</p>
		<p>Call us today on (800) 813-1315 or <a href="mailto:roapmap-xdock@xervmon.com">email us </a> with your feature request in relation to our xDock service. </p>
		
	</div>
</div>

<script type="text/javascript">
	$(function() {
		$('#howitworks').hide();
		$('#pricings').hide();
	});

</script>
@stop






