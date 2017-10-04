<?php

require_once './vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

$publicKey = file_get_contents('keys/jwt.example.pem');

$token = $_GET['token'];
try {
    $data = (array) @JWT::decode($token, $publicKey, ['RS256']);
    print_r($data);
} catch (ExpiredException $exc) {
    die($exc->getMessage());
} catch (Exception $exc) {
    die(sprintf('We can not validate the token. %s', $exc->getMessage()));
}
