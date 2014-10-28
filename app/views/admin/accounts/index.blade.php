@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

@section('keywords')Account administration @stop
@section('author')Laravel 4 Bootstrap Starter SIte @stop
@section('description')Account administration index @stop

{{-- Content --}}
@section('content')
	<div class="page-header">
		<h3>
			{{{ $title }}}

		</h3>
	</div>

	<table id="accounts" class="table table-striped table-hover">
		<thead>
			<tr>
				<th class="col-md-4">{{{ Lang::get('admin/accounts/table.name') }}}</th>
				<th class="col-md-4">{{{ Lang::get('admin/accounts/table.cloudProvider') }}}</th>
				<th class="col-md-4">{{{ Lang::get('admin/accounts/table.created_by_username') }}}</th>
				<th class="col-md-4">{{{ Lang::get('admin/accounts/table.created_by_email') }}}</th>
				<th class="col-md-2">{{{ Lang::get('admin/accounts/table.created_at') }}}</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
@stop

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript">
		var oTable;
		$(document).ready(function() {
			oTable = $('#accounts').dataTable( {
				"sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
				"sPaginationType": "bootstrap",
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{ URL::to('admin/accounts/data') }}",
		        "fnDrawCallback": function ( oSettings ) {
	           		$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
	     		}
			});
		});
	</script>
@stop