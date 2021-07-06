<?php

require_once("vendor/autoload.php");

$token = "1eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2MjU1NzQ3MTIsImV4cCI6MTYyNTU3ODMxMiwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoic3VwcG9ydEB0ZXN0LmNvbSJ9.WGT-um25ddDSDfmVHvZSVEprt-uG9xH00tsFM9s2YvPeEvVm3d20hzdwRtmNpV2Y3NecJC8LmcGSsq3Qd1sFVCdlvyDWojNk4QN79ToyI6fpvSRx6tO8Ylr4IwUUcblS_-tzU5tzNCjl1UCp-Ko9F62gmyP-ffu_kt4Vp7NFYZm6XGwrFz1Aj2P2kFOpaeyKIuZV8xcWvR4Brlt-5wt7ycOPpzacCgfqNpRiWkBmdSOwV9XebcxyAt3rdktMPpL6vWvrSEmy05i9aEJNl3FkiaIaNtFmfi6AKoxgNYIjexp7dIUWQ7Tt9JSqlcCyUWBn7Gsp0mfSmBAwyNGv9me6GQ";
try{
    $client = \Symfony\Component\HttpClient\HttpClient::create();
    $response = $client->request("GET", "http://127.0.0.1:8000/api/topic", ["auth_bearer" => $token]);

    echo $response->getContent();
}catch(\Exception $e){
    echo $e->getMessage();
}



