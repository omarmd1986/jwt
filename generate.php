<?php

require_once './vendor/autoload.php';

use Firebase\JWT\JWT;

$privateKey = file_get_contents('keys/jwt.example');
$now = (time());

$payload = [
    'iss'=>'example.com',
    'aud'=>'example.com',
    'iat'=>$now,
    'nbf'=>$now,
    'exp'=>($now + 3600),
    'data'=>[
        'name'=>'Test User',
        'email'=>'admin@ataama.com',
        'phone'=>'7028866912',
        'timezone'=>'America/Los_Angeles',
        'password'=> password_hash('password', PASSWORD_DEFAULT)
    ]
    
];

$token = JWT::encode($payload, $privateKey, 'RS256');

print_r($token);
print PHP_EOL;