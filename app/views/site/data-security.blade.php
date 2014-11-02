@extends('site.layouts.default')
{{-- Web site Title --}}
@section('title')
{{{ Lang::get('site.data_security') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
<h4>{{{ Lang::get('site.data_security') }}}</h4>
<div class="row">
  	<div class="col-md-12">
  		<p>
		At xDocker we make it a priority to keep the client data safe through a defined system of vigorous security practices.  Below are some of the reasons why we can confidently assure you that your data will be secure with xDocker.
		</p>
	</div>
	<div class="col-md-12">
  		<p>
		<strong>Secure Data Centers</strong><br/>
		At xDocker we store our data with some of the most reputable data centers on the market today, such as Amazon AWS. These data centers are both certified with ISO/IEC 27001:2005, SAS70 Type II compliance as well as the PCI DSS Level 1 compliance.
		If you want to find out more about the security practices at these data centers read, <a href="http://aws.amazon.com/security/">read here</a> for AWS.
		</p>
	</div>
</div>
@stop
