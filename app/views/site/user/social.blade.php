<!--
<p class="text-center">
	<a title="Facebook" href="{{URL::to('user/social')}}?provider=Facebook" class="social-facebook "><i class="fa fa-facebook-square fa-4x social-login-icons"></i></a>
	<a title="Google" href="{{URL::to('user/social')}}?provider=Google" class="social-google "><i class="fa fa-google-plus-square fa-4x"></i></a>
</p> 
-->
<p class="text-center">
	<a title="Github" href="{{URL::to('user/social')}}?provider=GitHub" class="social-git"><i class="fa fa-github-square fa-4x"></i></a>
<!--	<a title="LinkedIn" href="{{URL::to('user/social')}}?provider=LinkedIn" class="social-linkedin "><i class="fa fa-linkedin-square fa-4x"></i></a>
	<a title="Amazon" href="#" id="LoginWithAmazon" class="social-amazon "><i class="fa fa-adn fa-4x"></i></a>-->
</p>


<!-- Amazon login -->
<div id="amazon-root"></div>
<script type="text/javascript">

  window.onAmazonLoginReady = function() {
    amazon.Login.setClientId('{{ Config::get('amazon.client_id') }}');
  };
  (function(d) {
    var a = d.createElement('script'); a.type = 'text/javascript';
    a.async = true; a.id = '{{Config::get('amazon.amazon_sdk')}}';
    a.src = '{{ Config::get('amazon.login_js') }}';
    d.getElementById('amazon-root').appendChild(a);
  })(document);

  // Enable the login button
  document.getElementById('LoginWithAmazon').onclick = function() {
    options = { scope : 'profile' };
    amazon.Login.authorize(options, '{{ URL::to(Config::get('amazon.return_route')) }}');
    return false;
  };

</script>
