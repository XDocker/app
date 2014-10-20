; 
function saveComment(id, url){
	var token =  $('[name="_token"]').val();
	var comments =  $('[name="comments"]').val();
	$.ajax({
		type: "POST",
		url: url,
		data: { "id": id, "comments" : comments, "_token" : token}
	}).done(function(response){
		showMessage(response, url);
	});
};

showMessage = function (response, url)
{
	data = JSON.parse(response);
	if(data.status == 'OK')
	{
		setInterval(function() {
			$.ajax({
				type: "GET",
				url: url,
				data: {}
			}).done(function(response){
				$('#wrap').hide().replaceWith(response).fadeIn('fast');
			});
		});
   	}
   	else if(data.status == 'error')
   	{
   		return '<div class="alert alert-danger alert-block"> ' +
				' <button type="button" class="close" data-dismiss="alert">&times;</button> '+
					'<h4> Error </h4> ' + data.message +
   			  '</div>';
    }
};