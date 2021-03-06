<?php
require_once __DIR__ . '/config.php';
session_start();


function add_members() {
    $client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

    $arr_token = $_SESSION['token'];
    $accessToken = $arr_token['access_token'];
  
    try {
        //agregar mienbros a grupo, parametros de GET groupId
        //parametros POST: members array
        $response = $client->request('POST', "/v2/groups/$_GET[group]/members",  [
            "headers" => [
                "Authorization" => "Bearer " . getZoomAccessToken()
            ], 
            'json' => [
                'members' => $_POST['members']
            ]
        ]);
        
        $data = json_decode($response->getBody(), true);
        print_r($data);
        
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}
  
add_members();

