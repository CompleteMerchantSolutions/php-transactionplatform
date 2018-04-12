<?php
include "vendor/autoload.php";
require_once('TokenizationClass.php');

use Tokenization\TokenizationClass;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$params = array(
    'merchantId' => '100039',
    'tokenex' => array(
        'token' => '46800bb3-2f85-47b2-9950-cae79534200c',
    ),
    'data' => array(
        'amount' => '10.32',
    ),
    'gateway' => array (
        'name' => 'usaepay'
    ),
    'card' => array(
        'expirationMonth' => '3',
        'expirationYear' => '20'
    )
);

$data_string = json_encode($params);

$ch = curl_init('https://api.emviodev.com/pay/v3/process');
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
