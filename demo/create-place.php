<?php
require_once('vendor/autoload.php');
require_once('config.php');
$client = \Symfony\Component\HttpClient\HttpClient::create();
try {
    $response = $client->request("POST", SERVER_API_URL . "/places", [
        "auth_bearer" => JWT_TOKEN,
        "json" => [
            "name" => "test33",
            "description" => "test2",
            "longitude" => 1,
            "latitude" => 2
        ]
    ]);

    echo "<pre>";
    print_r(json_decode($response->getContent(), true));
} catch (\Exception $e) {
    echo $e->getMessage();
}
