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
            'enum' => array(
                'us-east-1',
                'us-west-1',
                'us-west-2',
                'ap-northeast-1',
                'ap-southeast-1',
                'ap-southeast-2',
                'eu-west-1',
                'sa-east-1'
            ),
            'event' => 'onchange="loadImages"'
        ) ,
        'parameters[instanceType]' => array(
            'type' => 'string',
            'title' => 'Instance Type',
            'required' => false,
            'enum' => array(
                'm3.medium',
                'm3.large',
                'm3.xlarge',
                'm3.2xlarge'
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
