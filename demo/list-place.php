<?php

require_once("vendor/autoload.php");
require ("config.php");

//JWT Token déjà récupéré via ./getToken.php
try{
    $client = \Symfony\Component\HttpClient\HttpClient::create();
    $response = $client->request("GET", SERVER_API_URL."/places", ["auth_bearer" => JWT_TOKEN]);

    echo "<pre>";
    print_r(json_decode($response->getContent(), true));
}catch(\Exception $e){
    echo $e->getMessage();
}



