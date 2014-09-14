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
    
    "base_url" => URL::to('user/social/auth'),
    "providers" => array(
        "Google" => array(
            "enabled" => true,
            "keys" => array(
                "id" => "1031333276894-29163rbahnkl7mq210ujnj64g2viraoh.apps.googleusercontent.com",
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
                "key" => "75e87jrvaewyzk",
                "secret" => "ug1qoqjc3BvdV2q6"
            ) ,
        )
    ) ,
);
