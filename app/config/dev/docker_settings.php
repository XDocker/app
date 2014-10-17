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
   									 'dockerParams' => array('ports' => array(443, 5000, 8080), 
   									 						'tag' => 'v1',
   									 						'env_keys' => false,
															'env' => array('host' => '{host}', 
   									 				  				'cmd' => '/home/ubuntu/securitymonkey.sh',),),
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
									 'enabled' => TRUE),
   									 
									 //"dockerParams": {"ports": [443, 5000], "env": {}, "tag": "v1",
   'xdocker/netflix_ice' => array('displayName' => 'Netflix ICE',
   								  'docker_url' => 'https://registry.hub.docker.com/u/xdocker/netflix_ice/', 
   								  'dockerParams' => array('ports' => array(443, 5000, 8080), 
   								  					    'tag' => 'v2',
   								  					    'env_keys' => true,
   								  					 	'env' => array('host' => '{host}',
   								  					 				'cmd' => ''),),
   								  'logo' => 'placeholder.jpg', 'protocol' => 'http://',  
   								  'append' => ':8080/ice',
   								  'securityPolicy' =>  '',
   								  'enabled' => TRUE),
   								  
   'stefobark/sphinxdocker' => array('displayName' => 'Sphinx', 
   									 'docker_url' => 'https://registry.hub.docker.com/u/xdocker/securitymonkey/',
   									 'dockerParams' => array('ports' => array(443, 5000, 8080), 
   									 				  'env' => array('host' => '{host}',  'env_keys' => false,
   									 				  				 'tag' => ''),), 
   									  'logo' => 'placeholder.jpg', 'protocol' => '', 'enabled' => FALSE),
);