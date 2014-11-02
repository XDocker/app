@extends('site.layouts.default')
{{-- Web site Title --}}
@section('title')
{{{ Lang::get('site.devops') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
<h4>{{{ Lang::get('site.devops') }}}</h4>
<div class="row">
  	<div class="col-md-12">
  		<h4>Devops Readiness Package</h4>
  		<p>
		Our comprehensive assessment provides reviews of your infrastructure across six key areas to identify areas for improvement.
		<ul>
			<li>Performance</li>
			<li>Workflows</li>
			<li>Costs</li>
			<li>Robustness & Disaster Recovery</li>
			<li>Security scan and vulnerabilities</li>
			<li>Monitoring</li>
		</ul>
		</p>
	</div>
	
	


</div>
@stop






