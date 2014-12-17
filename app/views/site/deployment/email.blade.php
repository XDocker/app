<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Deployment Details: {{ $deploymentName}}</h2>

		<div>{{ $dockerImage }} was deployed using {{ $accountName }} at {{ $timestamp }}</div>
		
		For support, contact </br>
		<a href="http://support.xervmon.com"> Support</a> or <a href="mailto:xdocker@xervmon.com">xDocker Team</a>
	</body>
</html>