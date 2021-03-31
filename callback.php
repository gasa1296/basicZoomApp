<?php
require_once __DIR__ . '/config.php';
session_start();

try {
    $client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
    $response = $client->request('POST', '/oauth/token', [
        "headers" => [
            "Authorization" => "Basic " . base64_encode(CLIENT_ID.':'.CLIENT_SECRET)
        ], 
        'form_params' => [
            "grant_type" => "authorization_code",
            "code" => $_GET['code'],
            "redirect_uri" => REDIRECT_URI
        ], 
    ]);
  
    $token = json_decode($response->getBody()->getContents(),  true);

    $_SESSION['token'] = $token;
    echo "Access token inserted successfully.";
  
} 
catch(Exception $e) {
    echo $e->getMessage();
}
