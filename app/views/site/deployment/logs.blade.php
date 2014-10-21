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
//print_r($data);
echo '<pre>';
if($data['status'] == 'OK') implode('<br/>', $data['log']);
else echo 'No log data available';

echo '</pre>';
?>
<div>
</div>

@stop
