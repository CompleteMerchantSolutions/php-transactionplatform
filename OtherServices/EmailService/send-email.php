<?php
require_once("../../Authorize.php");
require_once("../../config.php");

use Authorization\Authorize;

try {
    $authorize = new Authorize($username, $password, $apiurl.'user/v3/refresh');
    $access = $authorize->refreshJWT($refreshToken);
    $JWT = $access->idToken;

    $data = json_encode([
        "from" => "wempleo@cmsonline.com",
        "subject" => "Send email testing",
        "text" => "Email body here!",
        "to" => "wempleo@cmsonline.com"
    ]);

    //SAMPLE  PHP CODE REQUEST STARTS HERE
    $ch = curl_init($apiurl.'email/v3');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
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
