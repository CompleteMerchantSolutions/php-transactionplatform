<?php
include "vendor/autoload.php";

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$params = array(
    'data' => array(
        'amount' => '1',
    ),
    'merchantId' => '513485010000008',
    'gateway' => array (
        'name' => 'usaepay'
    )
);
$data_string = json_encode($params);

$ch = curl_init('https://api.emviodev.com/pay/v3/token');
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
