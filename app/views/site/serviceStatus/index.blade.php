@extends('site.layouts.default')

{{-- Content --}}
@section('content')

<div class="page-header">
	<div class="row">
		<div class="col-md-9">
			<h5>{{{ Lang::get('site.webserivce_status') }}}</h5>
		</div>
	</div>
</div>

<div class="media-block">
	<ul class="list-group">

	  			<li class="list-group-item">
					<div class="media">
						<?php
							if($status == 'OK')
							{
						?>
						<span type="submit" class="btn btn-success pull-right" role="button">{{{ $status }}}</span>
						<?php
							}
							else if($status == 'error') {
						?>
						<span type="submit" class="btn btn-danger pull-right" role="button">{{{ $status }}}</span>
						<?php		
							}
						?>
						<div class="media-body">
							<h4 class="media-heading">{{{ Lang::get('site.webserivce') }}}
							</h4>
						</div>
					</div>
				</li>
	</ul>
</div>

<div>
</div>

@stop
