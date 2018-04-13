<?php
require_once("Authorize.php");
require_once("config.php");

use Authorization\Authorize;

try {
    $authorize = new Authorize($username, $password, $apiurl.'user/v3/refresh');
    $access = $authorize->refreshJWT($refreshToken);
    $JWT = $access->idToken;

    //SAMPLE  PHP CODE REQUEST STARTS HERE
    $params = json_encode(array(
        'data' => array(
            'amount' => '1',
        ),
        'merchantId' => '100039',
        'gateway' => array (
            'name' => 'usaepay'
        )
    ));

    $ch = curl_init($apiurl.'pay/v3/token');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: $JWT",
        "Content-Type: application/json",
        "Content-Length: " . strlen($params)));
    $result = curl_exec($ch);

    curl_close($ch);
    //SAMPLE  PHP CODE REQUEST ENDS HERE

    echo '<pre>';
    print_r(json_decode($result));
    echo '</pre>';
} catch (Exception $e) {
    return $e->getMessage();
}
