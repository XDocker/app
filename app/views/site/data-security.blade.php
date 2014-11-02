@extends('site.layouts.default')
{{-- Web site Title --}}
@section('title')
{{{ Lang::get('site.contact_us') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')

<div class="row">
  <div class="col-md-8"><p>
	At xDocker we make it a priority to keep the client data safe through a defined system of vigorous security practices.  Below are some of the reasons why we can confidently assure you that your data will be secure with Xervmon:
	</div>
  <div class="col-md-4">.col-md-4</div>
</div>
@stop
