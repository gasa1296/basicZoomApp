<?php
require_once __DIR__ . '/config.php';
session_start();

function get_meetings(){
    $client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

    $arr_token = $_SESSION['token'];
    $accessToken = $arr_token['access_token'];
  
    try {
        //obtener todos las reuniones de tu cuenta
        $response = $client->request('GET', '/v2/users/me/meetings',  [
            "headers" => [
                "Authorization" => "Bearer " . getZoomAccessToken()
            ]
        ]);
        
        $data = json_decode($response->getBody(), true);
        foreach( $data['meetings'] as $meeting){
            print_r($meeting);
            echo " <a href='delete_meeting.php?meet=$meeting[id]'> borrar reunion</a>";
            echo " <a href='get_meeting.php?meet=$meeting[id]'> ir a reunion</a>";
            echo '<br>';
        }
        
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}
  
get_meetings();
