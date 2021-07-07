<?php

require_once ('vendor/autoload.php');
require_once ('config.php');
$client = \Symfony\Component\HttpClient\HttpClient::create();

$response = $client->request("POST",SERVER_URL."/api/login_check", [
    "body" => [
        "_username" => AUTH_USERNAME,
        "_password" =>AUTH_PASSWORD
    ]
]);

print_r( $response->toArray());
