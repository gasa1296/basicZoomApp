<?php
require_once __DIR__ . '/config.php';
session_start();


function create_meeting() {
    $client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
    try {
        //types:
        //1: reunion instantanea
        //2: reunion programada
        //3: reunion recurrente sin momentos fijado
        //8: reunion recurrenter con tiempos fijados
        //
        //duration: duracion de la reunion solo para reuniones de tipo 2
        //recurrence: solo para reuniones de tipo 8(obligatiorio para tipo 8):
        //type:
        //1 diario
        //2 semanal
        //3 mensual
        //repeat_interval: para recurrecia tipo 1: max 90, 2: max 12, 3: max 3
        //weekly_days: requerido para recurrencia tipo 2
        //end_times: numero de repeticiones 

        $data = array();
        $data['topic'] = "$_POST[topic]";
        $data['type'] = $_POST['type'];
        $data['start_time'] = "$_POST[start_time]:00";
        $data['password'] = $_POST['password'];
        if( !empty($data['duration']) ){
            $data['duration'] = $_POST['duration'];
        }
        if( $_POST['type'] == 8 ){
            $data['recurrence'] = array('type' => $_POST['recurrence_type'], 'repeat_interval' => $_POST['repeat_interval'], $_POST['end_times']);

            if( $_POST['recurrence_type'] == 2 ){
                $data['recurrence']['weekly_days'] = $_POST['weekly_days'];
            }

        }

        $response = $client->request('POST', '/v2/users/me/meetings',  [
            "headers" => [
                "Authorization" => "Bearer " . getZoomAccessToken()
            ], 
            'json' => $data 
        ]);
        
        $data = json_decode($response->getBody(), true);
        print_r($data);
        
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}
  
create_meeting();

