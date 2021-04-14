<?php
require_once __DIR__ . '/config.php';
session_start();

function get_groups(){
    $client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

    $arr_token = $_SESSION['token'];
    $accessToken = $arr_token['access_token'];
  
    try {
        //obtener todos los grupos de tu cuenta
        $response = $client->request('GET', '/v2/groups',  [
            "headers" => [
                "Authorization" => "Bearer " . getZoomAccessToken()
            ]
        ]);
        
        $data = json_decode($response->getBody(), true);
        foreach( $data['groups'] as $groups){
            print_r($meeting);
            echo " <a href='add_members.php?meet=$groups[id]'> borrar reunion</a>";
            echo '<br>';
        }
        
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}
  
get_groups();