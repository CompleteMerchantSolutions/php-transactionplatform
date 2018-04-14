<?php

require_once("../../Authorize.php");
require_once("../../config.php");

use Authorization\Authorize;

$authorize = new Authorize($username, $password, $apiurl.'user/v3/refresh');
$access = $authorize->refreshJWT($refreshToken);

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => $apiurl."user/v3/account/whoAmI",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
    "Authorization: eyJraWQiOiI3V2JrOFdSVVliMVljR2p3Mlhwd2swR3lIRWt6THcwVDRqckVhNVVVTjBnPSIsImFsZyI6IlJTMjU2In0.eyJzdWIiOiJmOTJmMTRlNi1jZTdmLTRjOTMtYmM5Yi0yNWY1NWRiNmYxNzIiLCJlbWFpbF92ZXJpZmllZCI6dHJ1ZSwiaXNzIjoiaHR0cHM6XC9cL2NvZ25pdG8taWRwLnVzLWVhc3QtMS5hbWF6b25hd3MuY29tXC91cy1lYXN0LTFfVlVEN21MeWNqIiwiY3VzdG9tOmFjY291bnRJZCI6ImIzNmU5Y2NmLTE1MDQtNGRjOS1hYTc1LTIxM2RlMmZhYTRmNyIsImNvZ25pdG86dXNlcm5hbWUiOiJycGFtaWxhckBjbXNvbmxpbmUuY29tIiwiYXVkIjoiNDBtZWQ2YnNybDZ1aWpnMmpmZzQwcmJzOGkiLCJldmVudF9pZCI6ImI2NmJiMWI1LTNmNzMtMTFlOC05YTBjLWU3N2E2NzA5NmNhMiIsInRva2VuX3VzZSI6ImlkIiwiYXV0aF90aW1lIjoxNTIzNjYyNjg1LCJleHAiOjE1MjM2ODAyMTMsImN1c3RvbTphY2Nlc3NSaWdodHMiOiJ7XCJtZXJjaGFudElkc1wiOntcIjEwMDAzOVwiOlwiQVwifSxcInJvbGVcIjpcIkFcIn0iLCJpYXQiOjE1MjM2NzY2MTMsImVtYWlsIjoicnBhbWlsYXJAY21zb25saW5lLmNvbSJ9.iZfdNZiIIP7Vd-4kPrND7qzMev_3pZZhR7ol3VeBPOioL94qCC5M0d2y69r8UiDODW0lFFZCgQI2j6-_5aLWrNEkLWH2MED_bQEInxPDNBB5oPW8nHpEvubYz4FYdoz3kveu9fsY5hJEiWPrnQdhGSULjVWNl9dPR852QUdJcZv9AoKKAIyLNdffKeadfrLrzfY7mwh9yazPscq7redO7CEhMaOV8FLHDOtMEvNHDjwBLCK2GOvi1Ba-mKVsV0wZGPTJJSMI6-c3R4F0JLSvkXg8Y940U9_6PEv3GSVnVHmp4zGIOXjQNYgsXuYhfIJZQRualSe4QdzI0kSAlRpm3g",
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
