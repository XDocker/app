@extends('site.layouts.default')

{{-- Content --}}
@section('content')
@section('breadcrumbs', Breadcrumbs::render('ServiceStatus'))

<div class="page-header">
	<div class="row">
		<div class="col-md-9">
			<h5>{{{ Lang::get('site.webservice_status') }}}</h5>
		</div>
	</div>
</div>

<div class="media-block">
	<ul class="list-group">

	  			<li class="list-group-item">
					<div class="media">
						<div class="media-body">
							
						 <?php foreach($vars as $name => $val) { ?>
						 	<h4 class="media-heading">{{{$name}}}</h4>
                            <p><span class="glyphicon glyphicon-asterisk"></span> {{ UIHelper::getLabel($val) }}</p>
							
						<?php } ?>
						
						</div>
					</div>
				</li>
	</ul>
</div>

<div>
</div>

@stop
