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
						'ap-northeast-1' => array('Ubuntu 14.04:ami-e7138ddd', 'CentOs 6.5:ami-d54b60d4', 'Amazon Linux:ami-21072820'),
						'ap-southeast-1' =>  array('Ubuntu 14.04:ami-a08fd9f2', 'CentOs 6.5:ami-24e7c076', 'Amazon Linux:ami-20e1c572'),
						'ap-southeast-2' =>  array('Ubuntu 14.04:ami-e7138ddd', 'CentOs 6.5:ami-2111731b', 'Amazon Linux:ami-8b4724b1'),
						'eu-west-1' =>  array('Ubuntu 14.04:ami-42718735', 'CentOs 6.5:ami-00b11177', 'Amazon Linux:ami-aa8f28dd'),
						'sa-east-1' => array('Ubuntu 14.04:ami-7d02a260', 'CentOs 6.5:ami-79d26764', 'Amazon Linux:ami-9d6cc680'),
						'us-east-1' => array('Ubuntu 14.04:ami-8997afe0', 'CentOs 6.5:ami-8caa1ce4', 'Amazon Linux:ami-50842d38'),
						'us-west-1' => array('Ubuntu 14.04:ami-b6bdde86', 'CentOs 6.5:ami-696e652c', 'Amazon Linux:ami-c7a8a182'),
						'us-west-2' => array('Ubuntu 14.04:ami-1a013c5f','CentOs 6.5:ami-cd5311fd','Amazon Linux:ami-af86c69f')
				)
				);

/*
US East (Virginia)	       					ami-8997afe0
US West (Oregon)	       							ami-b6bdde86
US West (Northern California) 	ami-1a013c5f
EU West (Ireland)	        					ami-42718735
Asia Pacific (Singapore)						ami-a08fd9f2
Asia Pacific (Sydney)						ami-e7138ddd
Asia Pacific (Tokyo)	        					ami-81294380
South America (Sao Paulo)			ami-7d02a260

ap-northeast-1 		ami-d54b60d4
ap-southeast-1 		ami-24e7c076
eu-west-1 			ami-00b11177
sa-east-1 			ami-79d26764
us-east-1 			, 'ami-8caa1ce4
us-west-1 			ami-696e652c
ap-southeast-2 		ami-2111731b
us-west-2 			ami-cd5311fd

ap-northeast-1 		, 'ami-21072820
ap-southeast-1 		, 'ami-20e1c572
eu-west-1 			ami-aa8f28dd
sa-east-1 			ami-9d6cc680
us-east-1 			, 
us-west-1 			ami-c7a8a182
ap-southeast-2 		ami-8b4724b1
us-west-2 			ami-af86c69f
 * 
 */