<?php
require_once("../Authorize.php");
require_once("../config.php");

use Authorization\Authorize;

try {
    $authorize = new Authorize($username, $password, $apiurl.'user/v3/refresh');
    $access = $authorize->refreshJWT($refreshToken);
    $JWT = $access->idToken;

    //SAMPLE  PHP CODE REQUEST STARTS HERE
    $hash = base64_encode($username.":".$password);

    $data = http_build_query(array(
        'merchantId' => '100039',
        'amount' => '10.32',
        'gateway' => 'usaepay',
    ));

    $ch = curl_init($apiurl.'pay/v3/transactions/134409025/void');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, "");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: $JWT",
        "X-Authorization: $hash",
        "Content-Type: application/x-www-form-urlencoded"
    ));
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
