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

function downloadKey(url,instanceID, token)
{
	/*$.ajax({
	 type: "POST",
	 url: url,
	 data: { "instanceAction": "downloadKey", "instanceID": instanceID, "_token" : token}
	 }).done(function(response) 
	 {
	 	console.log(response);
	 	return response;
		    //showMessage(response);
	});
	*/
	$.fileDownload(url, { httpMethod : "POST", data: { 
									"instanceID" : instanceID,
									"_token" : token,
								}
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
