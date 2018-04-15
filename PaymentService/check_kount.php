<?php

require_once("../Authorize.php");
require_once("../config.php");

$curl = curl_init();

// $data = json_encode([
//     "merchantId" => "717000",
//     "card" => [
//         "cardHolderName" => "card name",
//         "lastFour" => "2227"
//     ],
//     "tokenex" => [
//         "token" => "ff02aa35-b6f1-46b0-89fe-0915c1bce85a"
//     ],
//     "data" => [
//         "amount" => 10.00
//     ]
// ]);

curl_setopt_array($curl, array(
  CURLOPT_URL => $apiurl."pay/v3/kount",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "merchantId=100039&data[amount]=21.22&tokenex[token]=4794e919-069d-4070-930d-a65a419f874f&card[cardHolderName]=Wilson Empleo&card[lastFour]=2226",
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