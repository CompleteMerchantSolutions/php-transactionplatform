<?php
include "vendor/autoload.php";
require_once('TokenizationClass.php');

use Tokenization\TokenizationClass;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$params = array(
    'merchantId' => '100039',
    'data' => array(
        'amount' => '10.32',
    ),
    'gateway' => array (
        'name' => 'usaepay',
        'refNumber' => '134278311'
    )
);

$data_string = json_encode($params);

$ch = curl_init('https://api.emviodev.com/pay/v3/void');
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
