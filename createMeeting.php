<?php
require_once __DIR__ . '/config.php';
session_start();

function create_meeting() {
    $client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

    $arr_token = $_SESSION['token'];
    $accessToken = $arr_token['access_token'];
  
    try {
        $response = $client->request('POST', '/v2/users/me/meetings',  [
            "headers" => [
                "Authorization" => "Bearer $accessToken"
            ], 
            'json' => [
                "topic" => "Let's learn Laravel", 
                "type" => 2, 
                "start_time" => "2021-03-05T20:30:00", 
                "duration" => "30",  // 30 mins
                "password" => "123456"
            ], 
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
            create_meeting();
        } else {
            echo $e->getMessage();
        }
    }
}
  
create_meeting();

