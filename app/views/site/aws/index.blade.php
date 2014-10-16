@extends('site.layouts.default')

{{-- Content --}}
@section('content')

<div class="page-header">
	<div class="row">
		<div class="col-md-9">
			<h5>{{{ Lang::get('aws/aws.your_aws_pricing') }}}</h5>
		</div>
	</div>
</div>


<?php echo '<pre>' ;print_r(ec2Data); ?>
@stop
