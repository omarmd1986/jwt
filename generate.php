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
        'isAdmin'=>false,
        'username'=>'admin',
        'email'=>'admin@ataama.com',
        'password'=> password_hash('password', PASSWORD_DEFAULT)
    ]
];

$token = JWT::encode($payload, $privateKey, 'RS256');

print_r($token);
print PHP_EOL;