@extends('site.layouts.default')

{{-- Content --}}
@section('content')

<div class="page-header">
	<div class="row">
		<div class="col-md-9">
			<h5>{{{ Lang::get('enginelog/enginelog.your_logs') }}}</h5>
		</div>
	</div>
</div>

<div class="media-block">
	<ul class="list-group">
		@if(!empty($enginelog)) 
			@foreach ($enginelog as $log)
	  			<li class="list-group-item">
					<div class="media">
						<div class="media-body">
							<h4 class="media-heading">{{{ Lang::get('enginelog/enginelog.method') }}} : {{ String::title($log->method) }}</h4>
							<p>
								<span class="glyphicon glyphicon-asterisk"></span> <!--Sept 16th, 2012-->{{{ $log->status_message }}}
							</p>
							<p>
								<span class="glyphicon glyphicon-calendar"></span> <!--Sept 16th, 2012-->{{{ $log->created_at }}}
							</p>
						</div>
					</div>
				</li>
			@endforeach
		@endif
	</ul>
	@if(empty($enginelog) || count($enginelog) === 0) 
		<div class="alert alert-info"> {{{ Lang::get('account/account.empty_accounts') }}}</div>
	@endif
</div>
<div>
</div>

@stop
