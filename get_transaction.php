<?php
include "vendor/autoload.php";
require_once('TokenizationClass.php');

use Tokenization\TokenizationClass;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$ch = curl_init('https://api.emviodev.com/transaction/v3/134278614');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
//curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: ".getenv('JWT'),
    "Content-Type: application/json"));
$result = curl_exec($ch);

curl_close($ch);

echo '<pre>';
print_r(json_decode($result));
echo '</pre>';
