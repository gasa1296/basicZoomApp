<?php
require_once __DIR__ . '/vendor/autoload.php';

use \Firebase\JWT\JWT;
use GuzzleHttp\Client;

define('ZOOM_API_KEY',  '');
define('ZOOM_SECRET_KEY',  '');

function getZoomAccessToken() {
    $key = ZOOM_SECRET_KEY;
    $payload = array(
        "iss" => ZOOM_API_KEY,
        'exp' => time() + 3600,
    );
    return JWT::encode($payload, $key);    
}