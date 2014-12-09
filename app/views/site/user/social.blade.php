<!--
<p class="text-center">
	<a title="Facebook" href="{{URL::to('user/social')}}?provider=Facebook" class="social-facebook "><i class="fa fa-facebook-square fa-4x social-login-icons"></i></a>
	<a title="Google" href="{{URL::to('user/social')}}?provider=Google" class="social-google "><i class="fa fa-google-plus-square fa-4x"></i></a>
</p> 
-->
<p class="text-center">
	<a title="Github" href="{{URL::to('user/social')}}?provider=GitHub" class="social-git"><i class="fa fa-github-square fa-4x"></i></a>
	<a title="LinkedIn" href="{{URL::to('user/social')}}?provider=LinkedIn" class="social-linkedin "><i class="fa fa-linkedin-square fa-4x"></i></a>
	<a title="DockerHub" href="{{URL::to('user/social')}}?provider=DockerHub" class="social-linkedin "><i class="fa fa-4x"><img width="50px" height="46px" style="margin-bottom: 10px; border-radius: 10px;" src="{{{ asset('assets/img/providers/docker.jpg') }}}" alt="{{{ Lang::get('site.footertitle') }}}"/></i></a>
</p>
