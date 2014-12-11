<?php

// Amazon credentials for login

return array(
	'client_id' => 'amzn1.application-oa2-client.740a3b2e3e624294abeb47614e33f22e',
	'client_secret' => 'd8c82ffaa446fc0cc7ad0fda50246375292e27137ba7a7c4742f2936c8c1f255',
	'return_route' => 'user/amazon',
	'login_js' => 'https://api-cdn.amazon.com/sdk/login1.js',
	'amazon_sdk' => 'amazon-login-sdk',
	'amazon_oauth_api' => 'https://api.amazon.com/auth/o2/tokeninfo?access_token=',
	'amazon_api_profile' => 'https://api.amazon.com/user/profile',
);
