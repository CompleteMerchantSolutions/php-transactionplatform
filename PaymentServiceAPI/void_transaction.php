<?php

require_once("../Authorize.php");
require_once("../config.php");

use Authorization\Authorize;

$authorize = new Authorize($username, $password, $apiurl.'user/v3/refresh');
$access = $authorize->refreshJWT($refreshToken);
$curl = curl_init();

$hash = base64_encode($username.":".$password);
//var_dump($hash);

curl_setopt_array($curl, array(
  CURLOPT_URL => $apiurl."/pay/v3/transactions/134306163/void",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => array(
    "Authorization: $JWT",
    "X-Authorization: $hash",
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
