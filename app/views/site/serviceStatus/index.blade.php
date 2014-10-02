@extends('site.layouts.default')

{{-- Content --}}
@section('content')

<div class="page-header">
	<div class="row">
		<div class="col-md-9">
			<h4>{{{ Lang::get('site.webserivce_status') }}}</h4>
		</div>
	</div>
</div>

<div class="media-block">
	<ul class="list-group">

	  			<li class="list-group-item">
					<div class="media">
						<button type="submit" class="btn btn-danger pull-right" role="button">{{{ $status }}}</button>
						<div class="media-body">
							<div class="alert alert-success" role="alert">
 								 <a href="#" class="alert-link"><h4 class="media-heading">xDocker Webservice Engine</h4></a>
							</div>
						</div>
					</div>
				</li>
	</ul>
</div>

<div>
</div>

@stop
