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
    header('Location: index.php');
  
} 
catch(Exception $e) {
    echo $e->getMessage();
}

/*
if( 401 == $e->getCode() ) {
    $refresh_token = $_SESSION['refresh_token'];
    $client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
    $response = $client->request('POST',  '/oauth/token',  [
        "headers" => [
            "Authorization" => "Basic ". base64_encode(CLIENT_ID.':'.CLIENT_SECRET)
        ],
        'form_params' => [
            "grant_type" => "refresh_token",
            "refresh_token" => $refresh_token
        ], 
    ]);
    $token = $response->getBody();
    echo $token;
    $_SESSION['token'] = json_decode($token, true);
    create_meeting();
} else {
    echo $e->getMessage();
}
*/