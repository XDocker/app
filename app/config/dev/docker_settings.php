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
   									 				  'env' => array('host' => '{host}', 
   									 				  				'AWS_ACCESS_KEY_ID' => '{AWS_ACCESS_KEY_ID}',
																	'AWS_SECRET_ACCESS_KEY' => '{AWS_SECRET_ACCESS_KEY}',
																	'BILLING_BUCKET' =>'{BILLING_BUCKET}'), 
   									 				  				'tag' => 'v1',
																	'cmd' => '/home/ubuntu/securitymonkey.sh',
   									 				  ),
   									 'protocol' => 'https://',
									 'enabled' => TRUE),
   									 
									 //"dockerParams": {"ports": [443, 5000], "env": {}, "tag": "v1",
   'xdocker/netflix_ice' => array('displayName' => 'Netflix ICE',
   								  'docker_url' => 'https://registry.hub.docker.com/u/xdocker/netflix_ice/', 
   								  'dockerParams' => array('ports' => array(443, 5000, 8080), 
   								  					 'env' => array('host' => '{host}', 
   									 				  				 'tag' => 'v2',
																	 'cmd' => ''),),
   								  'logo' => 'placeholder.jpg', 'protocol' => 'http://',  'enabled' => TRUE),
   								  
   'stefobark/sphinxdocker' => array('displayName' => 'Sphinx', 
   									 'docker_url' => 'https://registry.hub.docker.com/u/xdocker/securitymonkey/',
   									 'dockerParams' => array('ports' => array(443, 5000, 8080), 
   									 				  'env' => array('host' => '{host}', 
   									 				  				 'tag' => ''),), 
   									  'logo' => 'placeholder.jpg', 'protocol' => '',  'enabled' => FALSE),
);