<?php
require_once("../../Authorize.php");
require_once("../../config.php");

use Authorization\Authorize;

try {
    $authorize = new Authorize($username, $password, $apiurl.'user/v3/refresh');
    $access = $authorize->refreshJWT($refreshToken);
    $JWT = $access->idToken;

    //SAMPLE  PHP CODE REQUEST STARTS HERE
    $data = http_build_query(array(
        "endDate" => "2018-04-13",
        "startDate" => "2018-04-11"
    ));

    $ch = curl_init($apiurl.'transaction/v3/count?'.$data);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, null);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: $JWT",
        "Content-Type: application/json"));
    $result = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) {
        echo "CURL Error #: $error";
    } else {
        echo '<pre>';
        print_r(json_decode($result));
        echo '</pre>';
    }
    //SAMPLE  PHP CODE REQUEST ENDS HERE
} catch (Exception $e) {
    return $e->getMessage();
}


