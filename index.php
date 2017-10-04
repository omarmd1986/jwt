<?php

require_once './vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;

$privateKey = file_get_contents('keys/jwt.example');
$publicKey = file_get_contents('keys/jwt.example.pem');

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

try {
    $data = (array) @JWT::decode($token, $publicKey, ['RS256']);
    print_r($data);
} catch (ExpiredException $exc) {
    die($exc->getMessage());
} catch (Exception $exc) {
    die(sprintf('We can not validate the token. %s', $exc->getMessage()));
}
