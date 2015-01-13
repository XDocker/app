<div id="footer" class="navbar-fixed-bottom">
	<div class="container">

		<div class="row clearfix">
		<div class="col-md-8 column pull-left" style="margin-top: 3%;">
				<p class="muted credit text-center pull-left">
					<img src="{{{ asset('assets/ico/favicon.ico') }}}" alt="Powered By Xervmon">
					<a href="https://www.xervmon.com">Copyright <i class="fa fa-copyright"></i> 2014-2015 | Powered By Xervmon</a>
					<!--
					<img src="{{{ asset('assets/ico/favicon.ico') }}}" alt="{{{ Lang::get('site.footertitle') }}}"/>
					
					<a href="https://www.xervmon.com"> Lang::get('site.footertitle') </a>
					-->
				</p>
			</div>
		<div class="col-md-4 column footer-social">
				<p> <strong>{{{ Lang::get('site.follow_us') }}}</strong></p>
				<p class=" footer-social-icons">
					<a href="https://hub.docker.com/u/xdocker/"><img width="32px" height="32px" src="{{{ asset('assets/img/providers/docker.jpg') }}}" alt="{{{ Lang::get('site.footertitle') }}}"/></a>
					<a href="https://github.com/XDock"><img width="32px" height="32px" src="{{{ asset('assets/img/providers/GitHub-Mark-32px.png') }}}" alt="{{{ Lang::get('site.footertitle') }}}"/></a>
					<a href="https://www.linkedin.com/groups/Xdock-Users-6789160?gid=6789160"><img width="32px" height="32px" src="{{{ asset('assets/img/providers/LinkedIn.png') }}}" alt="{{{ Lang::get('site.footertitle') }}}"/></a>
					<a href="https://www.facebook.com/pages/XDock/687711791303636"><img width="32px" height="32px" src="{{{ asset('assets/img/providers/facebook.png') }}}" alt="{{{ Lang::get('site.footertitle') }}}"/></a>
					<a href="https://www.twitter.com/xdock"><img width="32px" height="32px" src="{{{ asset('assets/img/providers/Twitter_logo.png') }}}" alt="{{{ Lang::get('site.footertitle') }}}"/></a>
				</p>
			</div>
		</div>
	</div>
		
		<!-- <p class="text-center">
			<iframe src="http://ghbtns.com/github-btn.html?user=xdocker&repo=app&type=watch&count=true" allowtransparency="true" frameborder="0" scrolling="0" width="170" height="30"></iframe>
		</p> -->
	</div>
</div>

<?php $settings =  Config::get('app');
	if($settings['app_environment'] == 'production'):

 ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54777003-1', 'auto');
  ga('send', 'pageview');

</script>
<?php  endif; ?>