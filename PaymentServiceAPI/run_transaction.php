<?php

require_once("../Authorize.php");
require_once("../config.php");

use Authorization\Authorize;

$authorize = new Authorize($username, $password, $apiurl.'user/v3/refresh');
$access = $authorize->refreshJWT($refreshToken);
$curl = curl_init();

$hash = base64_encode($username.":".$password);

// $data = "merchantId=100039&amount=20&gateway=usaepay&card_expr_month=02&card_expr_year=21&paymethod=e21e9021-c98c-40bd-bf6c-cd23d9cbaaf3&customer=Unique%20Customer%20ID&checkData%5Baccount%5D=Bank%20Account%20Number&checkData%5Brouting%5D=Bank%20Routing%20Number&billing%5Bfirstname%5D=First%20name&billing%5Blastname%5D=Last%20name&custom_field%5Bone%5D=First%20custom%20field&custom_field%5Btwo%5D=Second%20custom%20field&lineitem1%5Bsku%5D=Line%20item%3A%20sku&lineitem1%5Bproductname%5D=Line%20item%3A%20product%20name&lineitem1%5Bdescription%5D=Line%20item%3A%20description&lineitem1%5Bunitprice%5D=Line%20item%3A%20unit%20price&lineitem1%5Bqty%5D=Line%20item%3A%20quantity&lineitem1%5Btaxable%5D=Line%20item%3A%20taxable";

$data = "merchantId=100039&amount=20&gateway=usaepay&card_expr_month=02&card_expr_year=21&paymethod=e21e9021-c98c-40bd-bf6c-cd23d9cbaaf3";

curl_setopt_array($curl, array(
    CURLOPT_URL => $apiurl."/pay/v3/transactions/run",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_HTTPHEADER => array(
    "Authorization: $JWT",
    "X-Authorization: $hash"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}
