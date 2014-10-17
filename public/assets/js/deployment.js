;
function start(url, instanceID, token)
{
	$.ajax({
	 type: "POST",
	 url: url,
	 data: { "instanceAction": "start", "instanceID": instanceID, "_token" : token}
	 }).done(function(response) 
	 {
		    showMessage(response);
	});
};

function stop(url, instanceID, token)
{
	$.ajax({
	 type: "POST",
	 url: url,
	 data: { "instanceAction": "stop", "instanceID": instanceID, "_token" : token}
	 }).done(function(response) 
	 {
		    showMessage(response);
	});
};

function restart(url, instanceID, token)
{
	$.ajax({
	 type: "POST",
	 url: url,
	 data: { "instanceAction": "restart", "instanceID": instanceID, "_token" : token}
	 }).done(function(response) 
	 {
		    showMessage(response);
	});
};

function terminate(url, instanceID, token)
{
	$.ajax({
	 type: "POST",
	 url: url,
	 data: { "instanceAction": "terminate", "instanceID": instanceID, "_token" : token}
	 }).done(function(response) 
	 {
		    showMessage(response);
	});
};

function downloadKey(id)
{
	alert(id);
	/*$.ajax({
	 type: "POST",
	 url: url,
	 data: { "instanceAction": "download", "deploymentId": deploymentId, "_token" : token}
	 }).done(function(response) 
	 {
	 	console.log(response);
		    //showMessage(response);
	});
	*/
};

function refresh(url, instanceId, token)
{
	alert(instanceId);
	$.ajax({
	 type: "POST",
	 url: url,
	 data: { "instanceAction": "describeInstances", "instanceID": instanceId, "_token" : token}
	 }).done(function(response) 
	 {
	 	console.log(response);
		    //showMessage(response);
	});
	
};

showMessage = function (response)
{
	if(response.status == 'OK')
	{
		return '<div class="alert alert-success alert-block"> ' +
				' <button type="button" class="close" data-dismiss="alert">&times;</button> '+
					'<h4> Success </h4> ' + response.message +
   			  '</div>';
   	}
   	else if(response.status == 'error')
   	{
   		return '<div class="alert alert-danger alert-block"> ' +
				' <button type="button" class="close" data-dismiss="alert">&times;</button> '+
					'<h4> Error </h4> ' + response.message +
   			  '</div>';
    }
}