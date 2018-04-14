<?php
require_once("../Authorize.php");
require_once("../config.php");

use Authorization\Authorize;

try {
    $authorize = new Authorize($username, $password, $apiurl.'user/v3/refresh');
    $access = $authorize->refreshJWT($refreshToken);
    $JWT = $access->idToken;

    //SAMPLE  PHP CODE REQUEST STARTS HERE
    $data = json_encode(array(
        'merchantId' => '100039',
        'data' => array(
            'currency' => 'CAD',
            'amount' => '13',
            'partialAmount' => '1',
        ),
        'gateway' => array (
            'name' => 'moneris',
            'refNumber' => '2319-1_11'
        )
    ));

    $ch = curl_init($apiurl.'pay/v3/refund');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: $JWT",
        "Content-Type: application/json",
        "Content-Length: " . strlen($data)));
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
