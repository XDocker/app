@extends('site.layouts.default')

{{-- Content --}}
@section('content')

<div class="page-header">
	<div class="row">
		<div class="col-md-9">
			<h4>{{{ Lang::get('enginelog/enginelog.your_logs') }}}</h4>
		</div>
	</div>
</div>

<?php

$data = json_decode($response);
if($data->status == 'OK')
{
	echo '<pre>';
	echo $data->log;
	echo '<pre>';
}
?>
<div>
</div>

@stop
