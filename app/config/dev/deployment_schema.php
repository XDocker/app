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
            'type' => 'selectfieldset',
            'title' => 'Region',
            'required' => true,
                  "items"=> array(
                  		array(
			          "key"=> "us-east-1",
			          "legend"=> "us-east-1"
			        ),
			        array(
			          "key"=> "us-west-1",
			          "legend"=> "us-west-1"
			        ),
			         array(
			          "key"=> "us-west-2",
			          "legend"=> "us-west-2"
			        ),
			        array(
			          "key"=> "ap-northeast-1",
			          "legend"=> "ap-northeast-1"
			        ),
			         array(
			          "key"=> "ap-southeast-1",
			          "legend"=> "ap-southeast-1"
			        ),
			         array(
			          "key"=> "ap-southeast-2",
			          "legend"=> "ap-southeast-2"
			        ),
			         array(
			          "key"=> "eu-west-1",
			          "legend"=> "eu-west-1"
			        ),
			         array(
			          "key"=> "sa-east-1",
			          "legend"=> "sa-east-1"
			        )
					
      			)
        ) ,
        'parameters[instanceType]' => array(
            'type' => 'string',
            'title' => 'Instance Type',
            'required' => false
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
