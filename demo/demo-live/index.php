<?php

require_once('vendor/autoload.php');

$client = Symfony\Component\HttpClient\HttpClient::create();

$response = $client->request("GET", "http://127.0.0.1:8000/api/places");

print "<pre>";
print_r($response->toArray());


$client->request(
    "POST",
    "http://127.0.0.1:8000/api/places",[
    'json' => ['name' => 'value1', 'longitude' => 1234, 'latitude' => 76567]
    ]
);
