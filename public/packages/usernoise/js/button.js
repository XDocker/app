jQuery(function($){
	window.usernoise = {};
  if ($.browser && $.browser.msie && ($.browser.version == '6.0' || $.browser.version == '7.0'))
	return;
	  function UsernoiseButton(){
			var self = this;
			self.show = function(){
				var $button = $('<a href="#" id="un-button" />').appendTo($('body'));
				var property;
				$button.text(usernoiseButton.text);
				$button.addClass(usernoiseButton['class']);
				$button.attr('style', usernoiseButton.style);
				$button.click(function(event){
					self.showWindow();
					event.preventDefault();
					return false;
				});
				if ($.browser && $.browser.msie && $.browser.version == '7.0'){
					if ($button.is('.un-left') || $button.is('.un-right'))
						$button.css('margin-top', '-' + $button.width() / 2  + "px");
					$button.addClass('ie7');
				} else if ($.browser && $.browser.msie && $.browser.version == '8.0'){
					if ($button.is('.un-right')){
						$button.css('right', "-" + $button.outerWidth() + "px");
					}
					if ($button.is('.un-left') || $button.is('.un-right'))
						$button.css('margin-top', '-' + $button.width() / 2 + "px");
					$button.addClass('ie8');
				} else {
					$button.addClass('css3');
				}

				if ($button.is('.un-bottom') || $button.is('.un-top'))
					$button.css('margin-left', "-" + ($('#un-button').width() / 2) + "px");
				if ($button.is('.un-left'))
					property = 'left';
				else if ($button.is('.un-right'))
					property = 'right';
				else if ($button.is('.un-bottom'))
					property = 'bottom';
				else
					property = 'top';

				if ($button.is('.un-left.css3'))
					$button.css('margin-top', ($button.width() / 2) + "px");
				if ($button.is('.un-right.css3')){
					$button.css('margin-top', "-" + ($button.width() / 2) + "px");
				}
				var propOnStart = {};
				var propOnIn = {opacity: 1};
				var propOnOut = {opacity: 0.96};
				propOnStart[property] = '+=40px';
				propOnIn[property] = '+=3px';
				propOnOut[property] = '-=3px';
				$button.animate(propOnStart).hover(
					function(){$button.animate(propOnIn, 100)},
					function(){$button.animate(propOnOut, 100)});
			}

			self.showWindow = function(){
			  var $overlay = $('<div id="un-overlay" />').appendTo($('body'));
			  $overlay.fadeIn('fast');
			  var $loading = $('<div id="un-loading" />').appendTo($('body'));
				var $iframe = $('<iframe id="un-iframe" marginheight="0" marginwidth="0" frameborder="0" allowtransparency="true" />').appendTo($('body'));
				$iframe.css('opacity', 0);
				$iframe.load(function(){
					$loading.fadeOut('fast', function(){
						$loading.remove();
					});
					$iframe.css('opacity', 0);
					$iframe.animate({'opacity': 1}, 'fast');
				});
				$iframe.attr('src', usernoiseButton.windowUrl);
			}
			self.hideWindow = function(){
			  $('#un-overlay').fadeOut(function(){
					$('#un-overlay').remove();
				});
				$('#un-loading').remove();
				$('#un-iframe').fadeOut('fast', function(){
					$('#un-iframe').remove();
				});
			};
		};

	usernoise.UsernoiseButton = UsernoiseButton;
  usernoiseButton.button = new usernoise.UsernoiseButton();
  usernoise.window = {
  	show: usernoiseButton.button.showWindow
  };
  $('.un-feedback-form').each(function(){
    new usernoise.FeedbackForm($(this));
  });
  if (usernoiseButton.showButton){
  	usernoiseButton.button.show();
	}
	$(document).bind('sent#feedbackform#window.un', function(){
	  var $overlay = $('<div id="un-overlay" />').appendTo($('body'));
	  function closeOverlay(){
	    $('#un-thankyou').find('a').unbind('click');
	    $('#un-thankyou').fadeOut('fast', function(){
	      $('#un-overlay').fadeOut('fast', function(){
          $('#un-thankyou').remove();
          $('#un-overlay').remove();
        });  
	    });
	    
	  }
	  $('#un-overlay').click(closeOverlay).fadeIn('fast', function(){
	    $('#un-thankyou').fadeIn('fast', function(){
	      setTimeout(closeOverlay, 5000);
	    }).find('#un-feedback-close').click(closeOverlay);
	  });
	});
	try{
    $('#' + usernoiseButton.custom_button_id).click(function(){usernoise.window.show(); return false;})
  } catch (err){
    alert('It looks like you entere wrong HTML ID value for custom Usernoise feedback button.');
  }
  $('a[rel=usernoise]').click(function(){usernoise.window.show(); return false;})
});