<?php
require_once __DIR__ . '/config.php';
session_start();


function create_group() {
    $client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

    $arr_token = $_SESSION['token'];
    $accessToken = $arr_token['access_token'];
  
    try {
        //crear un grupo, unico parametro: nombre
        $response = $client->request('POST', '/v2/groups',  [
            "headers" => [
                "Authorization" => "Bearer " . getZoomAccessToken()
            ], 
            'json' => [
                'name' => $_POST['group_name']
            ]
        ]);
        
        $data = json_decode($response->getBody(), true);
        print_r($data);
        
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}
  
create_group();

