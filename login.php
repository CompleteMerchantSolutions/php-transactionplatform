<?php
require_once("Authorize.php");
require_once("config.php");

use Authorization\Authorize;

$data = json_encode(array(
    "username" => $username,
    "password"  => $password,
));

try {
    $ch = curl_init($apiurl.'user/v3/login');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "Content-Length: " . strlen($data)));
    $result = curl_exec($ch);

    curl_close($ch);

    echo '<pre>';
    print_r(json_decode($result));
    echo '</pre>';
} catch (Exception $e) {
    return $e->getMessage();
}
