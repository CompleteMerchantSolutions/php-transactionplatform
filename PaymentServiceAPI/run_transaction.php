<?php
require_once("../Authorize.php");
require_once("../config.php");

use Authorization\Authorize;

try {
    $authorize = new Authorize($username, $password, $apiurl.'user/v3/refresh');
    $access = $authorize->refreshJWT($refreshToken);
    $JWT = $access->idToken;

    //SAMPLE  PHP CODE REQUEST STARTS HERE
    $data = http_build_query(array(
        'merchantId' => '100039',
        'amount' => '10.32',
        'gateway' => 'usaepay',
        'card_expr_month' => 02,
        'card_expr_year' => 21,
        'paymethod' => 'e21e9021-c98c-40bd-bf6c-cd23d9cbaaf3'
    ));

    $hash = base64_encode($username.":".$password);

    $ch = curl_init($apiurl.'pay/v3/transactions/run');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: $JWT",
        //"X-Authorization: $hash",
        "Content-Type: application/x-www-form-urlencoded",
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
