<?php
require_once("Authorize.php");
require_once("config.php");

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.transactionplatformdev.com/pay/v3/transactions/authonly",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "merchantId=10003d9&amount=2.22&gateway=usaepay&card_expr_month=1&card_expr_year=20&paymethod=4794e919-069d-4070-930d-a65a419f874f",
  CURLOPT_HTTPHEADER => array(
    "Authorization: {$JWT}",
    "Content-Type: application/x-www-form-urlencoded",
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}