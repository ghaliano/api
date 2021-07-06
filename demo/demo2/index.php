
<?php

require_once('vendor/autoload.php');

use Symfony\Component\HttpClient\HttpClient;

$httpClient = HttpClient::create();

$response = $httpClient->request(
    'GET',
    'http://127.0.0.1:8000/api/places'
);

$places = $response->toArray();

?>

<?php foreach ($places["hydra:member"] as $place){?>

<?php } ?>
