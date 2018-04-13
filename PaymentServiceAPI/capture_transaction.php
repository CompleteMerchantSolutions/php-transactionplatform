<?php
require_once("../Authorize.php");
require_once("../config.php");

use Authorization\Authorize;


$authorize = new Authorize($username, $password, $apiurl.'user/v3/refresh');
$access = $authorize->refreshJWT($refreshToken);  
//$JWT = $access->idToken;     

$transactionReferenceNumber = '134305590';

$data = http_build_query([
    'merchantId' => '100039',
    'amount' => '2.22',
    'gateway' => 'usaepay'
]);    
//$ch = curl_init('https://api.emviodev.com/pay/v3/transactions/{transactionReferenceNumber}/capture?merchantId={id}&gateway={gatewayName}&amount={amt}');

$ch = curl_init($apiurl.'pay/v3/transactions/'.$transactionReferenceNumber.'/capture?'.$data);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_ENCODING, '');
curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: ".$JWT,
    "Content-Type: application/json"));
$result = curl_exec($ch);

curl_close($ch);    
echo '<pre>';
print_r(json_decode($result));
echo '</pre>';
