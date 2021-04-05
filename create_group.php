<?php
require_once __DIR__ . '/config.php';
session_start();


function create_group() {
    $client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

    $arr_token = $_SESSION['token'];
    $accessToken = $arr_token['access_token'];
  
    try {
        $response = $client->request('POST', '/v2/groups',  [
            "headers" => [
                "Authorization" => "Bearer $accessToken"
            ], 
            'json' => [
                'name' => $_POST['group_name']
            ]
        ]);
        
        $data = json_decode($response->getBody(), true);
        print_r($data);
        
    } catch(Exception $e) {
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
            create_group();
        } else {
            echo $e->getMessage();
        }
    }
}
  
create_group();

