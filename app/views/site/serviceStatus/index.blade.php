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
						 <?php foreach($vars as $name => $val) {
                            if($val == 'OK')  { ?>
								<span type="submit" class="btn btn-success pull-right" role="button"><?=$val?></span>
							<?php } else { ?>
								<span type="submit" class="btn btn-danger pull-right" role="button"><?=$val?></span>
							<?php } ?>
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
