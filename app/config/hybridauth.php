<?php
/**
 * Class and Function List:
 * Function list:
 * Classes list:
 */
return array(
    /*
    |--------------------------------------------------------------------------
    | HybridAuth Social network essentials
    |--------------------------------------------------------------------------
    |
    |
    |
    |
    |
    */
    
    "base_url" => URL::to('user/social/auth') ,
    "providers" => array(
        "Google" => array(
            "enabled" => true,
            "keys" => array(
                "id" => "667508165338-u4f17rre6vhqdda4o3m0it31uk15lknm.apps.googleusercontent.com",
                "secret" => "2ucUzhWErni0PsrCD_HbAA_n"
            ) ,
        ) ,
        "Facebook" => array(
            "enabled" => true,
            "keys" => array(
                "id" => "602946523149734",
                "secret" => "09e7507d10ba50ce8c088bfcd806762a"
            ) ,
        ) ,
        "LinkedIn" => array(
            "enabled" => true,
            "keys" => array(
                "key" => "75xqpctq9drir4",
                "secret" => "M4T3DQcHiA6Vf178"
            ) ,
        ) ,
        "GitHub" => array(
            "enabled" => true,
            "keys" => array(
                "id" => "5a4a2307bfc112c6b713",
                "secret" => "c201ddebba40a0fb310022e53998a4056418dfc2"
            ) ,
            "wrapper" => array(
                'class' => 'Hybrid_Providers_GitHub',
                'path' => app_path() . '/../vendor/hybridauth/hybridauth/additional-providers/hybridauth-github/Providers/GitHub.php'
            )
        ) ,
        "DockerHub" => array(
            "enabled" => true,
            "keys" => array(
                "id" => "5a4a2307bfc112c6b713", // @TODO: Replace with valid client ID from DockerHub (see: https://docs.docker.com/v1.1/reference/api/docker_io_oauth_api/)
                "secret" => "5a4a2307bfc112c6b713", // @TODO: Replace with valid client_secret from DockerHub (see: https://docs.docker.com/v1.1/reference/api/docker_io_oauth_api/)
                "scope" => "profile_read email_read"
            ) ,
            "wrapper" => array(
                'class' => 'Hybrid_Providers_DockerHub',
                'path' => app_path() . '/../custom_vendor/hybridauth/hybridauth-dockerhub/DockerHub.php'
            )
        ) ,
    ) ,
);
