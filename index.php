<?php
include_once('./vendor/autoload.php');

use \Firebase\JWT\JWT;

$key = "zz!@!#!@#!@#!@#@!#z";
$token = array(
    "iss" => "http://example.org",
	"aud" => "httample.com",
    "iat" => 1356999524,
    "nbf" => 1357000000
	);

$jwt = JWT::encode($token, $key);
echo $jwt;
$decoded = JWT::decode($jwt, $key, array('HS256'));

print_r($decoded);






 phpinfo(); ?>
