<?php
require_once("Authorize.php");
require_once("config.php");

use Authorization\Authorize;

$data = json_encode(array(
    "username" => $username,
    "password"  => $password,
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
        $result = json_decode($result);

        // we save the tokens to the config file
        $content = file_get_contents('config.php');

        $newcontent = preg_replace(
            '/\$JWT = \'(.*?)\';/',
            '$JWT = \''.$result->idToken.'\';',
            $content
        );
        
        $newcontent = preg_replace(
            '/\$refreshToken = \'(.*?)\';/',
            '$refreshToken = \''.$result->refreshToken.'\';',
            $newcontent
        );

        file_put_contents('config.php', $newcontent);

        echo '<pre>';
        print_r($result);
        echo '</pre>';
    }
    //SAMPLE  PHP CODE REQUEST ENDS HERE
} catch (Exception $e) {
    return $e->getMessage();
}
