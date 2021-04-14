<?php

require_once __DIR__ . '/config.php';
session_start();

function delete_meeting(){
    $client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

    $arr_token = $_SESSION['token'];
    $accessToken = $arr_token['access_token'];
  
    try {
        //borrar meeting, unico parametro en la url: meetingId
        $response = $client->request('DELETE', "/v2/meetings/$_GET[meet]/" ,  [
            "headers" => [
                "Authorization" => "Bearer " . getZoomAccessToken()
            ]
        ]);
        
        $data = json_decode($response->getBody(), true);
        foreach( $data['meetings'] as $meeting){
            print_r($meeting);
            echo " <a href='delete_meeting.php?$meeting[id]'> borrar reunion</a>";
            echo '<br>';
        }
        
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}
  
delete_meeting();
