<?php

require_once('vendor/autoload.php');

use Symfony\Component\HttpClient\HttpClient;

$httpClient = HttpClient::create();

$response = $httpClient->request(
    'POST',
    'http://127.0.0.1:8000/api/places',
    ['headers' => [
        'content-type' => 'application/json',
    ],'json' => [

        'name' => 'New place',
        'description' => 'New place description',
        'longitude' => 1,
        'latitude' => 1

    ]]
);

$place = $response->toArray();

print "<pre>";
print_r($place);
?>
