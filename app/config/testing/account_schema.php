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
            'required' => true,
            'description' => 'Your AWS Account Id is required field. Set up <b>ReadOnly</b> policy for credentials'
        ) ,
        'credentials[apiKey]' => array(
            'type' => 'string',
            'title' => 'API Key',
            'required' => true,
            'description' => 'API Key that you create within AWS IAM UI. <a target="_blank" href="https://console.aws.amazon.com/iam/home?region=us-east-1#home"> Identity and Access Management</a>'
   
        ) ,
        'credentials[secretKey]' => array(
            'type' => 'string',
            'title' => 'Secret Key',
            'required' => true,
            'description' => 'Secret Key that you create within AWS IAM UI. <a target="_blank" href="https://console.aws.amazon.com/iam/home?region=us-east-1#home"> Identity and Access Management</a>'
			
        ) ,
        'credentials[billingBucket]' => array(
            'type' => 'string',
            'title' => 'Billing Bucket',
            'required' => false,
            'description' => 'The bucket configured to host aws usage data. Required* for Netflix Ice <a target="_blank" href="https://console.aws.amazon.com/billing/home?#/preferences">Billing Preferences</a>'
			
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
            'title' => 'Username',
            'required' => true
        ) ,
        'credentials[apiKey]' => array(
            'type' => 'string',
            'title' => 'Api Key',
            'required' => true
        ) ,
    ) ,
);
