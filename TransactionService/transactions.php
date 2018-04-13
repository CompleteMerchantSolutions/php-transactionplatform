<?php
require_once("../Authorize.php");
require_once("../config.php");

use Authorization\Authorize;

try {
    $authorize = new Authorize($username, $password, $apiurl.'user/v3/refresh');
    $access = $authorize->refreshJWT($refreshToken);
    $JWT = $access->idToken;

    $data = http_build_query([
        'limit' => 20,
        'offset' => 0,
        'endDate' => '2018-04-10',
        'startDate' => '2018-03-10'
    ]);

    //SAMPLE  PHP CODE REQUEST STARTS HERE
    $ch = curl_init($apiurl.'transaction/v3?'.$data);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: ".$JWT,
        "Content-Type: application/json"
         ));
    $result = curl_exec($ch);

    curl_close($ch);
    //SAMPLE  PHP CODE REQUEST ENDS HERE

    echo '<pre>';
    print_r(json_decode($result));
    echo '</pre>';
} catch (Exception $e) {
    return $e->getMessage();
}
