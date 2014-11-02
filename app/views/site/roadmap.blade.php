@extends('site.layouts.default')
{{-- Web site Title --}}
@section('title')
{{{ Lang::get('site.roadmap') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
<h4>{{{ Lang::get('site.roadmap') }}}</h4>
<div class="row">
  	<div class="col-md-12">
  		<h4>What to expect?</h4>
  		<p>
		Our comprehensive assessment provides reviews of your infrastructure across six key areas to identify areas for improvement.
		<ul>
			<li>MultiCloud Deployment & Management</li>
			<li>Multi Container Deployment & Management</li>
			<li>More coming soon!</li>
			
		</ul>
		</p>
		<p>Call us today on (800) 813-1315 or <a href="mailto:roapmap-xdocker@xervmon.com">email us </a> with your feature request in relation to our xDocker service. </p>
		
	</div>
</div>
@stop






