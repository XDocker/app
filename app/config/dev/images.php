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
						'ap-northeast-1' => array('ami-e7138ddd', 'ami-d54b60d4', 'ami-21072820'),
						'ap-southeast-1' =>  array('ami-a08fd9f2', 'ami-24e7c076', 'ami-20e1c572'),
						'ap-southeast-2' =>  array('ami-e7138ddd', 'ami-2111731b', 'ami-8b4724b1'),
						'eu-west-1' =>  array('ami-42718735', 'ami-00b11177', 'ami-aa8f28dd'),
						'sa-east-1' => array('ami-7d02a260', 'ami-79d26764', 'ami-9d6cc680'),
						'us-east-1' => array('ami-8997afe0', 'ami-8caa1ce4', 'ami-50842d38'),
						'us-west-1' => array('ami-b6bdde86', 'ami-696e652c', 'ami-c7a8a182'),
						'us-west-2' => array('ami-1a013c5f','ami-cd5311fd','ami-af86c69f')
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