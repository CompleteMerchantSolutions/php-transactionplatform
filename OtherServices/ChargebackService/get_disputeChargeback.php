<?php
require_once("../../Authorize.php");
require_once("../../config.php");

use Authorization\Authorize;

$data = json_encode(array(
    "userName" => 'rbuenaviaje@cmsonline.com',
    "chargebackId"  => '1',
    "description" => "test",
    "isPreview"  => "",
    "chargeback" => "1"
));

try {
    //SAMPLE  PHP CODE REQUEST STARTS HERE
    $ch = curl_init($apiurl.'user/v3/login');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
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
