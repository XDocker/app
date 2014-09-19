<?php
/**
* Class and Function List:
* Function list:
* - AWSAuth()
* - authenticate()
* Classes list:
* - CloudProvider
*/

class CloudProvider {
    private static $aws;
    private static function AWSAuth($account) {
        $credentials = json_decode($account->credentials);
        $config['key'] = $credentials->apiKey;
        $config['secret'] = $credentials->secretKey;
        $config['region'] = 'us-east-1';
		$conStatus = FALSE;
        try 
        {
            $ec2Client = \Aws\Ec2\Ec2Client::factory($config);

			$result = $ec2Client->DescribeInstances(array(
		        'Filters' => array(
		                array('Name' => 'instance-type', 'Values' => array('m1.small')),
		        )
			));
		
			$reservations = $result->toArray();
			if(isset($reservations['requestId'])) $conStatus = TRUE; else $conStatus = FALSE;
        }
        catch(Exception $ex) {
            $conStatus = FALSE;
            Log::error($ex);
       }
        return $conStatus;
    }
    
    public static function authenticate($account) {
        switch ($account->cloudProvider) {
            case 'Amazon AWS':
                return self::AWSAuth($account);
            break;
        }
    }
}
