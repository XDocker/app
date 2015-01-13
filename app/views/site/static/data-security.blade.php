@extends('site.layouts.default')
{{-- Web site Title --}}
@section('title')
{{{ Lang::get('site.data_security') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
@section('breadcrumbs', Breadcrumbs::render('DataSecurity'))
<h4>{{{ Lang::get('site.data_security') }}}</h4>
<div class="row">
  	<div class="col-md-12">
  		<p>
		At xDock we make it a priority to keep the client data safe through a defined system of vigorous security practices.  Below are some of the reasons why we can confidently assure you that your data will be secure with xDock.
		</p>
	</div>
	<div class="col-md-12">
  		<p>
		<strong>Secure Data Centers</strong><br/>
		At xDock we store our data with some of the most reputable data centers on the market today, such as Amazon AWS. These data centers are both certified with ISO/IEC 27001:2005, SAS70 Type II compliance as well as the PCI DSS Level 1 compliance.
		If you want to find out more about the security practices at these data centers <a href="http://aws.amazon.com/security/">read here</a> for AWS.
		</p>
	</div>
	
	<div class="col-md-12">
  		<p>
		<strong>Encrypted Data</strong><br/>
		To maximize secure data handling and storage, we encrypt all data processed through xDock. Our encryption techniques are highly-developed to ensure that our data is processed in the most secure manner and protected from all threats.
		</p>
	</div>
	<div class="col-md-12">
  		<p>
		<strong>Strict Access Controls</strong><br/>
		To further ensure that your date is securely stored and processed, we employ a wide range of strict access controls. One of the access controls includes provisioning, which results in our employees being granted the lowest level of system access relevant to their job function.
		<br/> <br/>A further access control we are using is that our employees are unable to decrypt your encrypted account data.
		</p>
	</div>
	<div class="col-md-12">
  		<p>
		<strong>Strict Access Controls</strong><br/>
		To always ensure that our data security measures are successfully, we employ an active vulnerability reporting program. Through this program we ensure to actively seek any possible vulnerability in the system, and report them. To find out more about our vulnerability reporting procedures read here.
		At xDock, we want you to be confident in our trustworthiness, and for this reason we have strong partnerships with one of the most reliable names on the market Amazon AWS. 
		<br/>
		Xervmon, parent organization of xDock holds the official positions of a AWS APN Technology Partnership.
		</p>
	</div>
	<div class="col-md-12">
  		<p>
		<strong>HIPAA Sensitive Environments</strong><br/>
		Your data is secure with xDock as our product is designed to work under HIPAA sensitive environments requirements. Although HIPAA does not provide an official certification for any SaaS solution, we have carefully designed out tool to ensure that it fulfills the requirements of the HIPAA. Alternatively, you could subscribe for on-premise version of Xervmon
		This means that there will be no type of access to your actual data, and no one at Xervmon will be able to access any data you store in the cloud.
		Although the HIPAA /HiTECH structure, recently released by Omnibus, would not define Xervmon as a ‘business associate’ or organization that met the HIPAA security standards, we have ensured that our product is developed to be able to work under the HIPAA sensitive environment requirements.
		To find out more about HIPAA Data security you read the official website or email us at at security@xervmon.com
		</p>
	</div>
	<div class="col-md-12">
  		<p>
		<strong>Dedicated To Meet Your Data Security Needs</strong><br/>
		 At xDock, we take full responsibility for your data security, and we are always proactive to improve and develop our systems and procedures.
		If you want more information on our security measures, you are welcome to read our Data Security Statement or email us at security@xervmon.com. We thrive on our transparency, and we can provide you with further information and insight into our policies and procedures.
		</p>
	</div>
	
	<div class="col-md-12">
  		<p>
		<strong>{{{ Lang::get('site.pledge') }}}</strong><br/>
		At xDock, we value our customers and their loyalty to us and will make sure our product and service is running forever.  We do understand the concerns, that being a startup, there is always a questions about life-expectancy.startups get acquired or die.
		We want to pledge that our product and service is running and continuity plans are well thought out. So in any situation, customers can export data in a non-proprietary format, which can be moved to any new platform.
		Our parent Xervmon Inc, a Delaware corporation is thriving well and we anticipate double digit growth in 3-5 years. In case of an un-warranted situaton, we have made all of our code base open-source and we will go the extra mile to help our customers for business continuity and customers business is not impacted in any way.
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






