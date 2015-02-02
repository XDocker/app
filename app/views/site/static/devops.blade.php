@extends('site.layouts.default')
{{-- Web site Title --}}
@section('title')
{{{ Lang::get('site.devops') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
@section('breadcrumbs', Breadcrumbs::render('DevOps'))
<h4>{{{ Lang::get('site.devops') }}}</h4>
<div class="row">
	<div class="col-md-12">
  		<h4>Support</h4>
  		<p>
		 The popular open source solutions listed and deployed on your favorite cloud provider can be supported by our team.
		 We offer flexible packages to support 99.9999 availability of your cloud foundation solutions.
		 We leverage <a href="https://www.xervmon.com">Xervmon Platform</a> to support and monitor the services, there by delivering
		 better quality of service at extremely affordable costs.
		</p>
		<p>
			Our team can also dockerize custom applications, implement custom CI/CD workflows, manage, audit and monitor them.
		</p>
		<p>Call us today on (800) 813-1315 or <a href="mailto:xDocksupport@xervmon.com">email us </a> with your questions in relation to our support packages. </p>
		
	</div>
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
		<p>Call us today on (800) 813-1315 or <a href="mailto:xDocksupport@xervmon.com">email us </a> with your questions in relation to our assessment packages and how a review can help your security and cost savings. </p>
		
	</div>
	
	<div class="col-md-12">
  		<h4>Docker® for DevOps, CI & CD</h4>
  		<strong>Is Docker® Right for your deeds?</strong>
		<p>
		Docker® is getting a lot of interest from enterprises and small businesses looking to improve their cloud service management. This container-based virtualization approach builds on Linux Container technology to facilitate enhanced application portability across platforms. 
		</p>
		<p>
			Docker® containers are also lightweight, which means that unlike virtual machines, they do not have to run on an underlying operating system.
			We specialize in implementing Docker® based solutions for companies of all shapes and sizes. 
			Our use of the Docker® for building <a href="https://www.xDock.io">this site</a> presents opportunities for companies to leverage our open source Docker® solution for Docker® deployment and management across hybrid Cloud footprint eco system.
		</p>
		<p>
			We can not only demonstrate, but also quote customer's use cases and the benefits in terms of developer workflows to improve testing in the local dev environment, reduce the time needed to maintain that environment, and ease tasks, such as re-creating and sharing that environment.
		</p>
		<p>	
			To find out more about how Docker® can support your development team, call us today on (800) 813-1315 or <a href="mailto:xDocksupport@xervmon.com">email us </a> with your questions in relation to our assessment packages and how a review can help your security and cost savings. 
		</p>
		
	</div>
	
	


</div>
<script type="text/javascript">
	$(function() {
		$('#howitworks').hide();
		$('#pricings').hide();
	});

</script>
@stop






