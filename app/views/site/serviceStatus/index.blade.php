@extends('site.layouts.default')

{{-- Content --}}
@section('content')

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
						 <?php foreach($vars as $name => $val) { ?>
                            <p class="pull right">{{ UIHelper::getStatus($val) }}</p>
							<div class="media-body">
								<h5 class="media-heading"><?=$name?></h5>
							
							</div>
						<?php } ?>
					</div>
				</li>
	</ul>
</div>

<div>
</div>

@stop
