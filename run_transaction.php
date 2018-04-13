<?php
require_once("Authorize.php");
require_once("config.php");

use Authorization\Authorize;

try {
    $authorize = new Authorize($username, $password, $apiurl.'user/v3/refresh');
    $access = $authorize->refreshJWT($refreshToken);
    $JWT = $access->idToken;

    $data = json_encode(array(
        'merchantId' => '100039',
        'tokenex' => array(
            'token' => '46800bb3-2f85-47b2-9950-cae79534200c',
        ),
        'data' => array(
            'amount' => '10.32',
        ),
        'gateway' => array (
            'name' => 'usaepay'
        ),
        'card' => array(
            'expirationMonth' => '3',
            'expirationYear' => '20'
        )
    ));

    //SAMPLE  PHP CODE REQUEST STARTS HERE
    $ch = curl_init($apiurl.'pay/v3/process');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: $JWT",
        "Content-Type: application/json",
        "Content-Length: " . strlen($data)));
    $result = curl_exec($ch);

    curl_close($ch);
    //SAMPLE  PHP CODE REQUEST ENDS HERE

    echo '<pre>';
    print_r(json_decode($result));
    echo '</pre>';
} catch (Exception $e) {
    return $e->getMessage();
}
