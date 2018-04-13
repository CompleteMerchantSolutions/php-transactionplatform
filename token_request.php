<?php
include "vendor/autoload.php";
require_once("Authorize.php");

use Authorization\Authorize;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

try {
    $authorize = new Authorize(getenv('USER'), getenv('PASS'), getenv('APIURL').'user/v3/login');
    $access = $authorize->login();
    $jwt = $access->idToken;

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

    $ch = curl_init(getenv('APIURL').'pay/v3/token');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: ".$jwt,
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
