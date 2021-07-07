<?php
require_once('vendor/autoload.php');
require_once('config.php');
$client = \Symfony\Component\HttpClient\HttpClient::create();
try {
    $response = $client->request("GET", SERVER_API_URL."/places/24", [
        "headers" => [
            "Content-Type" => "application/json"
        ],
        "auth_bearer" => JWT_TOKEN
    ]);
    //var_dump(SERVER_API_URL);
    echo "<pre>";
    print_r(json_decode($response->getContent(), true));
} catch (\Exception $e) {
    echo $e->getMessage();
}
