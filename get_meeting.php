<?php
require_once __DIR__ . '/config.php';
session_start();

function get_meetings(){
    $client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

    $arr_token = $_SESSION['token'];
    $accessToken = $arr_token['access_token'];
  
    try {
        //obtener informacion de un meeting, para metro en la url: meetingId
        $response = $client->request('GET', "/v2/meetings/$_GET[meet]",  [
            "headers" => [
                "Authorization" => "Bearer " . getZoomAccessToken()
            ]
        ]);
        
        $data = json_decode($response->getBody(), true);
        header("Location: $data[start_url]"); #esta url es para los host
        //header("Location: $data[join_url]"); #esta es url es para los invitados
        
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}
  
get_meetings();
