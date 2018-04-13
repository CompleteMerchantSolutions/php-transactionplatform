<?php

require_once("../../Authorize.php");
require_once("../../config.php");

use Authorization\Authorize;

try {
    $authorize = new Authorize($username, $password, $apiurl.'user/v3/refresh');
    $access = $authorize->refreshJWT($refreshToken);

    $ch = curl_init($apiurl.'merchant/v3/?merchantIds=100039');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
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
