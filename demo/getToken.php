<?php

require_once("vendor/autoload.php");

$client = \Symfony\Component\HttpClient\HttpClient::create();
$response = $client->request("POST", "http://127.0.0.1:8000/api/login_check", ['body'=>[
    '_username' => 'support@test.com',
    '_password' => 'test'
]]);

echo $response->getContent();


