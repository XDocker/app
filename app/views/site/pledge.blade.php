@extends('site.layouts.default')
{{-- Web site Title --}}
@section('title')
{{{ Lang::get('site.pledge') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
<h4>{{{ Lang::get('site.pledge') }}}</h4>
<div class="row">
  	<div class="col-md-12">
  		<p>
		At xDocker, we value our customers and their loyalty to us and will make sure our product and service is running forever.  We do understand the concerns, that being a startup,there is always a questions about life-expectancy.startups get acquired or die.
		We want to pledge that our product and service is running and continuity plans are well thought out. So in any situation, customers can export data in a non-proprietary format, which can be moved to any new platform.
		Our parent Xervmon Inc, a Delaware corporation is thriving well and we anticipate double digit growth in 3-5 years. In case of an un-warranted situaton, we have made all of our code base open-source and we will go the extra mile to help our customers for business continuity and customers business is not impacted in any way.
		</p>
	</div>
	
	


</div>
@stop






