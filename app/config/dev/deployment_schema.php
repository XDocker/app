<?php
/**
 * Class and Function List:
 * Function list:
 * Classes list:
 */
// Schema for the Provider specific fields, will be converted into JSON and used on the front-end with https://github.com/joshfire/jsonform

return array(
    'Amazon AWS' => array(
     'parameters[instanceRegion]' => array(
            'type' => 'string',
            'title' => 'Region',
            'required' => true,
            'enum' => array('',
                'us-east-1',
                'us-west-1',
                'us-west-2',
                'eu-west-1',
                'sa-east-1',
                'ap-northeast-1',
                'ap-southeast-1',
                'ap-southeast-2',
                'cn-north-1'
                
            ),
            'event' => 'onchange="loadImages(this)"'
        ) ,
        'parameters[instanceType]' => array(
            'type' => 'string',
            'title' => 'Instance Type',
            'required' => false,
            'enum' => array(
                "m1.small",
	            "m1.medium",
	            "m1.large",
	            "m1.xlarge",
	            "m2.xlarge",
	            "m2.2xlarge",
	            "m3.xlarge",
	            "m3.2xlarge",
	            "m2.4xlarge",
	            "c1.medium",
	            "c1.xlarge",
	            "cc1.4xlarge",
	            "cc2.8xlarge",
	            "cg1.4xlarge"
            ),
            'event' => 'onchange="loadPrice(this)"'
        ),
		 'parameters[ports]' => array(
            'type' => 'string',
            'title' => 'Ports',
            'required' => false,
            'multiple' => true,
            'default' => array('443','5000'),
            'enum' => array(
                '443',
                '5000',
                '8080'
            )
        )
    ) ,
    
	
    /*'Rackspace Cloud' => array(
        'parameters[securityGroupId]' => array(
            'type' => 'string',
            'title' => 'Security Group',
            'required' => true
        ) ,
        'parameters[keyPair]' => array(
            'type' => 'string',
            'title' => 'KeyPair',
            'required' => false
        ) ,
        'parameters[vpcId]' => array(
            'type' => 'string',
            'title' => 'VPC',
            'required' => false
        ) ,
        'parameters[subnet]' => array(
            'type' => 'string',
            'title' => 'Subnet',
            'required' => false
        ) ,
    ) ,*/
);
