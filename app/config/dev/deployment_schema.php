<?php
/**
 * Class and Function List:
 * Function list:
 * Classes list:
 */
// Schema for the Provider specific fields, will be converted into JSON and used on the front-end with https://github.com/joshfire/jsonform

return array(
    'Amazon AWS' => array(
        'parameters[securityGroupId]' => array(
            'type' => 'string',
            'title' => 'Security Group',
            'required' => true
        ) ,
        'parameters[keyPair]' => array(
            'type' => 'string',
            'title' => 'KeyPair',
            'required' => false
        )
    ) ,
    'Rackspace Cloud' => array(
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
    ) ,
);
