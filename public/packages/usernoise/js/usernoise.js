usernoise = {};
jQuery(function($){
	function FeedbackForm($form){
		var self = this;
		self.form = $form;
		$form.find('.text').unAutoPlaceholder();
		$form.find('.un-types-wrapper a').click(selectTypeHandler);
		$form.submit(submitHandler);
		
		function selectTypeHandler(){
			var $selector = $(this).parent();
			$selector.find('a').removeClass('selected');
			$(this).addClass('selected');
			var type = $(this).attr('class').replace(/\s*selected\s*/, '').replace('un-type-', '');
			$selector.find('input[type=hidden]').val(type);
			$(document).trigger('typeselected#feedbackform#window.un', type);
			return false;
		}
		
		function submitHandler(){
			var data  = $form.unSerializeObject();
			data.referer = window.parent.document.location.href;
			$(document).trigger('submitting#feedbackform#window.un', data);
			self.lock();
			$form.find('.loader').show();
			self.errors.hide();
			$.post($form.attr('action'), data , function(response){
				$form.find('.loader').hide();
				self.unlock();
				response = usernoise.helpers.parseJSON(response);
				if (response.success){
				  $(document).trigger('sent#feedbackform#window.un');
				} else {
					self.errors.show(response.errors);
				}
			});
			return false;
		}
		
		$.extend(self, {
			unlock: function(){
				$(document).trigger('unlocking#feedbackform#window.un');
				$form.find('input, select, textarea').removeAttr('disabled');
				$form.find('.un-types-wrapper a').click(selectTypeHandler);
			}, 
			lock: function(){
				$form.find('*').unbind('click');
				$(document).trigger('locking#feedbackform#window.un');
				$form.find('input, select, textarea').attr('disabled', 'disabled');
			},
			errors: new Errors($form.find('.un-feedback-errors-wrapper')),
			selectedType: function(){
				var type = $('#types-wrapper a.selected').attr('id');
				return type ? type.replace('un-type-', '') : null;
			}
		});
		$(document).trigger('created#feedbackform#window.un', self);
	}
	
	usernoise.FeedbackForm = FeedbackForm;
	
	function Errors($errorsWrapper){
		var self = this;
		var $errors = $errorsWrapper.find('.un-errors');
		$.extend(self, {
			show: function(errors){
				$('#window').addClass('transitionEnabled');
				$(errors).each(function(index, error){
					$errors.append($("<p />").text(error));
				});
				$errorsWrapper.fadeIn('fast');
			}, 
			hide: function(errors){
				$errors.html(''); 
				$errorsWrapper.fadeOut('fast', function(){
					$errorsWrapper.hide();
				});
			}
		});
	}
	usernoise.Errors = Errors;
	
	function ThankYouScreen(){
		var self = this;
		var $screen = $screen;
		$.extend(self, {
			show: function(){
					$('#un-thankyou').show();
					$('#un-feedback-close').click(function(){
						usernoise.window.hide();
						return false;
					});
			}
		});
	}
	usernoise.ThankYouScreen = ThankYouScreen;
	
	function UsernoiseWindow(windowSelector){
		var self = this;
		var $window = $('#window');
		
		
		function detectBrowser(){
			if (!$('#wrapper').hasClass('un')) return;
			$('#wrapper').addClass('un');
			if ($.browser.msie && $.browser.version == '7.0')
				$('#wrapper').addClass('un-ie7');
			if ($.browser.msie && $.browser.version == '8.0')
				$('#wrapper').addClass('un-ie8');
		}
		
		function showThankYouHandler(event, html){
			self.thankYouScreen = new ThankYouScreen($window.find('.thank-you-screen'));
			self.thankYouScreen.show(html);
		}
		detectBrowser();
		$.extend(self, {
			hide: function(){
				window.parent.usernoiseButton.button.hideWindow();
			},
			adjustSize: function(){
				$window.css({
									'margin-top': '-' + $window.height() / 2 + "px",
									'margin-left': '-'  + $window.width() / 2 + "px"});
			}
		});
		self.adjustSize();
	}
	
	$.fn.unAutoPlaceholder = function(){
		$(this).each(function(){
			$(this).attr('data-default', $(this).val());
			$(this).focus(function(){
				if ($(this).val() == $(this).attr('data-default')){
					$(this).val('');
					$(this).addClass('text-normal');
					$(this).removeClass('text-empty');
				}
			});
			$(this).blur(function(){
				if ($(this).val() == ''){
					$(this).val($(this).attr('data-default'));
					$(this).removeClass('text-normal');
					$(this).addClass('text-empty');
					
				}
			});
		});
	};
	
	$.fn.unSerializeObject = function(){
		var o = {};
		var a = this.serializeArray();
		$.each(a, function() {
			if (o[this.name]) {
				if (!o[this.name].push) {
					o[this.name] = [o[this.name]];
				}
				o[this.name].push(this.value || '');
			} else {
				o[this.name] = this.value || '';
			}
		});
		return o;
	};
	
	usernoise.helpers = {
		parseJSON: function(json){
			return $.parseJSON ? $.parseJSON(json) : eval("(" + json + ")");
		}
	};
	
	usernoise.Window = UsernoiseWindow;
});