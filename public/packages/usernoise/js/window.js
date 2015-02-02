jQuery(function($){
	usernoise.window = new usernoise.Window();
	usernoise.feedbackForm = new usernoise.FeedbackForm($('.un-feedback-form'));
	usernoise.thankYouScreen  = new usernoise.ThankYouScreen();
	$('#window').resize(function(){
		$('#window').css({
			'margin-top': '-' + $('#window').height() / 2 + "px",
			'margin-left': '-'  + $('#window').width() / 2 + "px"});
	});
	$('#window-close').click(function(){
		usernoise.window.hide();
		return false;
	});
	$(document).bind('sent#feedbackform#window.un', function(){
	  $('#un-feedback-form-wrapper').fadeOut('fast', function(){
		  usernoise.thankYouScreen.show();
		});
	});
	$(document).click(function(event){
		if (event.target.parentNode == document)
			usernoise.window.hide();
	});
});