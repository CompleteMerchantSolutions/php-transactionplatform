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
   /* $params = json_encode(array(
    	'endDate' => '2018-04-12',
        'startDate' => '2018-04-12'
        
    ));*/

    $ch = curl_init(getenv('APIURL').'transaction/v3/dailyTransactionsSummary?date=2018-04-12');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
   // curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: ".$jwt,
        "Content-Type: application/json"));
    $result = curl_exec($ch);

    curl_close($ch);
    //SAMPLE  PHP CODE REQUEST ENDS HERE

    echo '<pre>';
    print_r(json_decode($result));
    echo '</pre>';
} catch (Exception $e) {
    return $e->getMessage();
}
