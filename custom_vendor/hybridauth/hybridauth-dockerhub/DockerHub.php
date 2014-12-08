<?php
/**
 * 
 * The DockerHub OAuth provider for HybridAuth
 * Author: Sathvik (sathvik@doersguild.com)
 * 
 * Class and Function List:
 * Function list:
 * - initialize()
 * - getUserProfile()
 * - loginFinish()
 * Classes list:
 * - Hybrid_Providers_DockerHub extends Hybrid_Provider_Model_OAuth2
 */
class Hybrid_Providers_DockerHub extends Hybrid_Provider_Model_OAuth2 {
    /**
     * IDp wrappers initializer
     */
    function initialize() {
        parent::initialize();
        // Provider api end-points
        $this->api->api_base_url = "https://www.docker.io/api/v1.1/";
        $this->api->authorize_url = "https://www.docker.io/api/v1.1/o/authorize/";
        $this->api->token_url = "https://www.docker.io/api/v1.1/o/token/";
    }
    /**
     * load the user profile from the IDp api client
     */
    function getUserProfile() {
        $data = $this->api->api("users/" . !empty($this->user->profile->username) ? $this->user->profile->username : "");
        if (!isset($data->id)) {
            throw new Exception("User profile request failed! {$this->providerId} returned an invalid response.", 6);
        }
        $this->user->profile->identifier = @$data->id;
        $this->user->profile->displayName = @$data->full_name;
        $this->user->profile->description = @$data->company;
        $this->user->profile->photoURL = @$data->gravatar_url;
        $this->user->profile->profileURL = @$data->url;
        $this->user->profile->email = @$data->email;
        $this->user->profile->webSiteURL = @$data->profile_url;
        $this->user->profile->region = @$data->location;
        if (empty($this->user->profile->displayName)) {
            $this->user->profile->displayName = @$data->username;
        }
        return $this->user->profile;
    }
    /**
     * finish login step - store username from token response (Based on Hybrid_Provider_Model_OAuth2->loginFinish)
     */
    function loginFinish() {
        $error = (array_key_exists('error', $_REQUEST)) ? $_REQUEST['error'] : "";
        // check for errors
        if ($error) {
            throw new Exception("Authentication failed! {$this->providerId} returned an error: $error", 5);
        }
        // try to authenticate user
        $code = (array_key_exists('code', $_REQUEST)) ? $_REQUEST['code'] : "";
        
        $tokenResponse = null;
        try {
            $tokenResponse = $this->api->authenticate($code);
            $this->user->profile->identifier = @$tokenResponse->id;
            $this->user->profile->username = @$tokenResponse->username;
            $this->user->profile->scope = @$tokenResponse->scope;
        }
        catch(Exception $e) {
            throw new Exception("User profile request failed! {$this->providerId} returned an error: $e", 6);
        }
        // check if authenticated
        if (!$this->api->access_token) {
            throw new Exception("Authentication failed! {$this->providerId} returned an invalid access token.", 5);
        }
        // store tokens
        $this->token("access_token", $this->api->access_token);
        $this->token("refresh_token", $this->api->refresh_token);
        $this->token("expires_in", $this->api->access_token_expires_in);
        $this->token("expires_at", $this->api->access_token_expires_at);
        // set user connected locally
        $this->setUserConnected();
    }
}
