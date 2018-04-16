<?php
require_once("../Authorize.php");
require_once("../config.php");

use Authorization\Authorize;

$authorize = new Authorize($username, $password, $apiurl.'user/v3/refresh');
$access = $authorize->refreshJWT($refreshToken);
$curl = curl_init();

$hash = base64_encode($username.":".$password);
//var_dump($hash);

//SAMPLE  PHP CODE REQUEST STARTS HERE
$data = http_build_query(array(
    "limit" => 10,
    "offset" => 0,
    "endDate" => "2018-04-13",
    "startDate" => "2018-04-11"
));

curl_setopt_array($curl, array(
  CURLOPT_URL => $apiurl."transaction/v3/search",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
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
    echo "<pre>";
    print_r(json_decode($response));
    echo "</pre>";
}
