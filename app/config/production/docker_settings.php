<?php
/**
 * Class and Function List:
 * Function list:
 * Classes list:
 */
// Schema for the CloudAccount specific fields, will be converted into JSON and used on the front-end with https://github.com/joshfire/jsonform

return array(
   'xdocker/securitymonkey' => array('displayName' => 'SecurityMonkey', 
   									 'docker_url' => 'https://registry.hub.docker.com/u/xdocker/securitymonkey/',
   									 'logo' => 'securitymonkeyHead.png', 
   									 'dockerParams' => array('ports' => array(80, 443, 5000, 8080), 
   									 						 'tag' => 'v1',
   									 						'env' => array('host' => '{host}', 
   									 				  		'cmd' => '/home/ubuntu/securitymonkey.sh',),),
   									 				  		'ipUI' => '104.131.14.172',
   									 'protocol' 		=> 'https://',
   									 'securityPolicy'   => array('amazonIAM' 
   									 								=> array(
   									 										array(
									 											"ruleName" => "SecurityMonkeyInstanceProfile",
															            		"policyName" => "SecurityMonkeyLaunchPerms",
															            		"instanceProfile"=> "SecurityMonkey",
															            		"policy" => '{"Version": "2012-10-17", "Statement": [{"Action": ["ses:SendEmail"], "Resource": "*", "Effect": "Allow"}, {"Action": "sts:AssumeRole", "Resource": "*", "Effect": "Allow"}]}'
																				),
																			array(
																				  "ruleName"   => "SecurityMonkey",
                    															  "policyName" => "SecurityMonkeyReadOnly",
                    															  "[policy" => '{"Statement": [{"Action": ["cloudwatch:Describe*", "cloudwatch:Get*", "cloudwatch:List*", "ec2:Describe*", "elasticloadbalancing:Describe*", "iam:List*", "iam:Get*", "route53:Get*", "route53:List*", "rds:Describe*", "s3:Get*", "s3:List*", "sdb:GetAttributes", "sdb:List*", "sdb:Select*", "ses:Get*", "ses:List*", "sns:Get*", "sns:List*", "sqs:GetQueueAttributes", "sqs:ListQueues", "sqs:ReceiveMessage"], "Resource": "*", "Effect": "Allow"}]}
                    																[assumePolicy] => {"Version": "2008-10-17", "Statement": [{"Action": "sts:AssumeRole", "Principal": {"AWS": "{SecurityMonkeyInstanceProfile}"}, "Effect": "Allow", "Sid": ""}]}'
																				)	
																			)
									 
									 							),
   									 'append' => '',
   									 'billingBucket' => FALSE,
   									 'documentationUrl' => 'http://securitymonkey.readthedocs.org/en/latest/quickstart1.html#adding-an-account-in-the-web-ui',
									 'enabled' => TRUE),
   									 
									 //"dockerParams": {"ports": [443, 5000], "env": {}, "tag": "v1",
   'xdocker/netflix_ice' => array('displayName' => 'Netflix ICE',
   								  'docker_url' => 'https://registry.hub.docker.com/u/xdocker/netflix_ice/', 
   								  'sgPorts' => array(80, 443, 5000, 8080),
   								  'dockerParams' => array('ports' => array(80, 443, 5000, 8080),
   								  					    'tag' => 'v2',
   								  					    'env' => array('host' => '{host}',
   								  					    			   'AWS_ACCESS_KEY_ID'     => '{AWS_ACCESS_KEY_ID}',
												     				   'AWS_SECRET_ACCESS_KEY' => '{AWS_SECRET_ACCESS_KEY}',
												      				   'BILLING_BUCKET'        => '{BILLING_BUCKET}',
   								  					 				'cmd' => ''),),
   								  					 'ipUI' => '104.131.14.172',
   								  'logo' => 'ice.png', 'protocol' => 'http://',  
   								  'append' => ':8080/ice',
   								  'securityPolicy' =>  '',
   								  'documentationUrl' => 'https://github.com/Netflix/ice',
   								  'enabled' => TRUE,'billingBucket' => TRUE,),
   								  
    'xdocker/sketchy' => array('displayName' => 'Netflix Sketchy',
   								  'docker_url' => 'https://registry.hub.docker.com/u/xdocker/sketchy/', 
   								  'sgPorts' => array(80, 443, 5000, 8080),
   								  'dockerParams' => array('ports' => array(80, 443, 5000, 8080),
   								  					    'tag' => 'v1',
   								  					    'env' => array('host' => '{host}',
   								  					    			   
   								  					 				'cmd' => ''),),
   								  					 'ipUI' => '104.131.14.172',
   								  'logo' => 'sketchy.jpeg', 'protocol' => 'https://',  
   								  'append' => '/eager?url=https://www.xdocker.io&type=sketch',
   								  'securityPolicy' =>  '',
   								  'documentationUrl' => 'https://github.com/Netflix/sketchy/wiki',
   								  'enabled' => TRUE,'billingBucket' => FALSE,),
   								  
   	 'xdocker/asgard' => array('displayName' => 'Netflix Asgard',
   								  'docker_url' => 'https://registry.hub.docker.com/u/xdocker/asgard/', 
   								  'sgPorts' => array(80, 443, 5000, 8080),
   								  'dockerParams' => array('ports' => array(80, 443, 5000, 8080),
   								  					    'tag' => 'v1',
   								  					    'env' => array('host' => '{host}',
   								  					    			   'AWS_ACCESS_KEY_ID'     => '{AWS_ACCESS_KEY_ID}',
												     				   'AWS_SECRET_ACCESS_KEY' => '{AWS_SECRET_ACCESS_KEY}',
												      				   'AWS_ACCOUNT_ID'        => '{AWS_ACCOUNT_ID}',
   								  					 				'cmd' => ''),),
   								  					 'ipUI' => '104.131.14.172',
   								  'logo' => 'asgard_logo.png', 'protocol' => 'https://',  
   								  'append' => '',
   								  'securityPolicy' =>  '',
   								  'documentationUrl' => 'https://github.com/Netflix/asgard/wiki',
   								  'enabled' => TRUE,'billingBucket' => FALSE,),
   								  
   'stefobark/sphinxdocker' => array('displayName' => 'Sphinx', 
   									 'docker_url' => 'https://registry.hub.docker.com/u/xdocker/securitymonkey/',
   									 'dockerParams' => array('ports' => array(443, 5000, 8080),
   									 				  'env' => array('host' => '{host}',  'env_keys' => false,
   									 				  				 'tag' => ''),), 'ipUI' => '104.131.14.172',
   									  'logo' => 'placeholder.jpg', 'protocol' => '', 'enabled' => FALSE),
);