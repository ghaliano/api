<?php

require_once("vendor/autoload.php");
require ("config.php");

//JWT Token déjà récupéré via ./getToken.php

    $client = \Symfony\Component\HttpClient\HttpClient::create();
    $response = $client->request("POST", SERVER_API_URL."/places", [
        "auth_bearer" => JWT_TOKEN,
        "json" => [
            "name" => "Test place user",
            "longitude" => 1,
            "latitude" => 1
        ]
    ]);

    echo "<pre>";
    print_r(json_decode($response->getContent(), true));
    try{}catch(\Exception $e){
    echo $e->getMessage();
}



