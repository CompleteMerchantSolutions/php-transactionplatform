<?php
include "vendor/autoload.php";
require_once("Authorize.php");

use Authorization\Authorize;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$data = json_encode(array(
    "username" => getenv('USER'),
    "password"  => getenv('PASS'),
));

$ch = curl_init(getenv('APIURL').'user/v3/login');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: ".getenv('JWT'),
    "Content-Type: application/json",
    "Content-Length: " . strlen($data)));
$result = curl_exec($ch);

curl_close($ch);

echo '<pre>';
print_r(json_decode($result));
echo '</pre>';
