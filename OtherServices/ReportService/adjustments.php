<?php

require_once("../../Authorize.php");
require_once("../../config.php");

use Authorization\Authorize;

$authorize = new Authorize($username, $password, $apiurl.'user/v3/refresh');
$access = $authorize->refreshJWT($refreshToken);

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => $apiurl."report/v3/adjustments/?limit=5&offset=0&endDate=2018-01-01&startDate=2017-01-01",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
    "Authorization: $JWT",
    "Content-Type: application/json"
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
