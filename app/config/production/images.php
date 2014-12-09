<?php
/**
 * Class and Function List:
 * Function list:
 * Classes list:
 */
// Schema for the Provider specific fields, will be converted into JSON and used on the front-end with https://github.com/joshfire/jsonform

return array(
    'Amazon AWS' =>
				array(
						'us-east-1' => 		array('Ubuntu 14.04:ami-8caa1ce4'),
						'us-west-1' => 		array('Ubuntu 14.04:ami-696e652c'),
						'us-west-2' => 		array('Ubuntu 14.04:ami-cd5311fd'),
						'eu-west-1' =>  	array('Ubuntu 14.04:ami-00b11177'),
						'sa-east-1' => 		array('Ubuntu 14.04:ami-79d26764'),
						'ap-northeast-1' => array('Ubuntu 14.04:ami-d54b60d4'),
						'ap-southeast-1' => array('Ubuntu 14.04:ami-24e7c076'),
						'ap-southeast-2' => array('Ubuntu 14.04:ami-2111731b'),
						'cn-north-1' =>  	array('Ubuntu 14.04:ami-9e42d0a7'),
						)
				);
				
/*
array(
						'us-east-1' => array('Ubuntu 14.04:ami-8caa1ce4', 'CentOS 6.5:ami-8997afe0', 'Amazon Linux:ami-50842d38'),
						'us-west-1' => array('Ubuntu 14.04:ami-696e652c', 'CentOS 6.5:ami-b6bdde86', 'Amazon Linux:ami-c7a8a182'),
						'us-west-2' => array('Ubuntu 14.04:ami-cd5311fd','CentOS 6.5:ami-1a013c5f','Amazon Linux:ami-af86c69f'),
						'eu-west-1' =>  array('Ubuntu 14.04:ami-00b11177', 'CentOS 6.5:ami-42718735', 'Amazon Linux:ami-aa8f28dd'),
						'sa-east-1' => array('Ubuntu 14.04:ami-79d26764', 'CentOS 6.5:ami-7d02a260', 'Amazon Linux:ami-9d6cc680'),
						'ap-northeast-1' => array('Ubuntu 14.04:ami-d54b60d4', 'CentOS 6.5:ami-e7138ddd', 'Amazon Linux:ami-21072820'),
						'ap-southeast-1' =>  array('Ubuntu 14.04:ami-24e7c076', 'CentOS 6.5:ami-a08fd9f2', 'Amazon Linux:ami-20e1c572'),
						'ap-southeast-2' =>  array('Ubuntu 14.04:ami-2111731b', 'CentOS 6.5:ami-81294380', 'Amazon Linux:ami-8b4724b1'),
						'cn-north-1' =>  array('Ubuntu 14.04:ami-9e42d0a7','Amazon Linux:ami-a857c591'),
						)
*/