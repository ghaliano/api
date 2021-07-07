<?php
require_once('vendor/autoload.php');
require_once('config.php');
$client = \Symfony\Component\HttpClient\HttpClient::create();

use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;

$data = [
    "name" => "Name l'ors 'un upload de fichier",
    "file" => DataPart::fromPath("/Users/mac/Documents/dev/sofrecom/api/demo/lanetscouade.png")
];

$formData = new FormDataPart($data);

try {
    $response = $client->request("POST", SERVER_API_URL."/places/24/pictures", [
        "headers" => $formData->getPreparedHeaders()->toArray(),
        "body" => $formData->bodyToIterable(),
        "auth_bearer" => JWT_TOKEN
    ]);

    echo "<pre>";
    print_r(json_decode($response->getContent(), true));
} catch (\Exception $e) {
    echo $e->getMessage();
}


