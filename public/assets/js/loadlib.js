;loadImages = function(val)
{
	var cloudProvider = $('#cloud_account_id').find('option:selected').data('cloud-provider');
	var region = val.value;
	var request = $.ajax({
				  url: "{{ URL::to('deployment/images') }}",
				  type: "GET",
				  data: { "cloudProvider" : cloudProvider, "region" : val.value },
				  dataType: "json"
				});
	request.done(function( msg ) {
  		var option = '';
  		for(var i = 0; i < msg.length; i++) {
    		option += '<option data-instance-region="' + msg[i] +'" value="' + msg[i] + '">' + msg[i] + '</option>';
		}
  		var str = '<div class="form-group {{{ $errors->has('username') ? 'error' : '' }}}"> ' +
				  ' <label class="col-md-2 control-label" for="name">Instance Image</label> '+
				  '<div class="col-md-6"> '+
				  '<select class="form-control" name="instanceAmi" id="jsonform-0-elt-instanceAmi" >' +
				  option +
				  '</select>' +
				  '</div> ' +
				 '</div> ';
 			$( "#instanceImage" ).html( str );
  			
		});
 		request.fail(function( jqXHR, textStatus ) {
		  alert( "Request failed: " + textStatus );
		});
};

loadPrices = function(val)
{
	var instanceRegion = $('.jsonform-0-elt-parameters[instanceRegion]').find('option:selected').data('instance-region');
	alert(val);
	alert(instanceRegion);
	
}
