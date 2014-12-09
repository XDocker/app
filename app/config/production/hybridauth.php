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
                "id" => "e15e70b482f360485fd3",
                "secret" => "51398208d5c8d539586a54b894c03a0a565ba065"
            ),
            "wrapper" => array(
                    'class'=>'Hybrid_Providers_GitHub',
                    'path' => app_path() . '/../vendor/hybridauth/hybridauth/additional-providers/hybridauth-github/Providers/GitHub.php'
                )
        ),
    ) ,
);
