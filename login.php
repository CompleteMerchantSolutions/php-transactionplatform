<?php
include "vendor/autoload.php";
require_once("Authorize.php");

use Authorization\Authorize;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$params = array(
    "username" => getenv('USER'),
    "password"  => getenv('PASS'),
);

$data_string = json_encode($params);

$ch = curl_init(getenv('APIURL').'user/v3/login');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: ".getenv('JWT'),
    "Content-Type: application/json",
    "Content-Length: " . strlen($data_string)));
$result = curl_exec($ch);

curl_close($ch);

echo '<pre>';
print_r(json_decode($result));
echo '</pre>';

//$authorize = new Authorize(getenv('USER'), getenv('PASS'), 'https://api.transactionplatformdev.com/user/v3/login');
//$access = $authorize->login();

//echo '<pre>';
//print_r($access);
//echo '</pre>';
