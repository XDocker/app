<?php
/**
 * Class and Function List:
 * Function list:
 * Classes list:
 */
// Schema for the CloudAccount specific fields, will be converted into JSON and used on the front-end with https://github.com/joshfire/jsonform

return array(
    'Amazon AWS' => array(
        'credentials[accountId]' => array(
            'type' => 'string',
            'title' => 'Account ID',
            'required' => true
        ) ,
        'credentials[apiKey]' => array(
            'type' => 'string',
            'title' => 'API Key',
            'required' => true
        ) ,
        'credentials[secretKey]' => array(
            'type' => 'string',
            'title' => 'Secret Key',
            'required' => true
        ) ,
    ) ,
    'Rackspace Cloud' => array(
        'credentials[accountId]' => array(
            'type' => 'string',
            'title' => 'Account ID',
            'required' => true
        ) ,
        'credentials[username]' => array(
            'type' => 'string',
            'title' => 'API Key',
            'required' => true
        ) ,
        'credentials[apiKey]' => array(
            'type' => 'string',
            'title' => 'Api Key',
            'required' => true
        ) ,
    ) ,
);
