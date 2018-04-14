<?php

require_once("../../Authorize.php");
require_once("../../config.php");

use Authorization\Authorize;

$authorize = new Authorize($username, $password, $apiurl.'user/v3/refresh');
$access = $authorize->refreshJWT($refreshToken);

$curl = curl_init();

$curl_data = json_encode(array(
    "refreshToken" => "eyJjdHkiOiJKV1QiLCJlbmMiOiJBMjU2R0NNIiwiYWxnIjoiUlNBLU9BRVAifQ.W3lQvY7RE5Xw3WUqn1IrqS9E5ObROcWlxMFmwYuqbZAqQnmz0yHlYe8N_zbVVz8Bs_nYJ20Mri89-20WdJWP2ly5PPQnr1Yc7b8kyjv0eyek0TWJzuCVUbz4LaHcdbOwP7OMHJD0sKSTPQqfl8H4fsPgDKYXI_lK-cJTbF7FXafaH2cxIdK7PBIBCmOy7MS1m9nFlqWof0GnChqi_d7yuyf-8tI73sYzcZB62c0TtZ6GdEC0cG72iNkeTsxJMI-TUIKYHsYXxAu2pcBiQri-cp-2iz1UB_Q87e-bDOcohM_T986z-buqkjR2fL_TLkWKcyAxUgeTr4SBq2n-0XkULg.mycFLSUPbYblCRkJ.2-AELarWBq235ruZopahyQp1RylFIXvJwK6AggCclsJFtt4-3rNab7bnB_Lin5bmfX9ynCHpXUA7ywfQZYfrEYytBJOPmyjyr6_Yp5MZO4YwryhNeJRRTzn7M5w2H9ctk6s9SKbmbuVF3u5LktxEr13f3lsE5yDnHUrDHDwmexAOEAD_6Bl1HrQu0V651jBTeayBkgRy2NiejpTXl6MpHQ1JUMUKjoWlFXyvi7Z-ICZxcxw9zCnw57wLAWgNaS5MTA3ZFVEzBr-hwlTsBnWZFbHt_P1WTjdT4GW9N_n_T-b2ZjePsI7jw-Zz-7yWzqhmzhKI__i1zflObGyZxmDO9xCtZ1aqZOie-W7svVt-SKD9A8HhZjRgFRn9AtVs340BcpSsGTSLf8_8ku54yrMcl5WsJtM9ItaBamx_gTGpvmBxbmaajY7GH0RPUPtz4awej6ZAMxF96hNMj4Vga2FFPuvKDl7tRX893q_Ygn1hSq_wF1PVv8lDlnXY4vJlMjkemUv2e1qgtqIsffKHZdvXgk2i1WJpO-DmPV9D8i9V3gQy-ZaOnYyBmygN1IbqvzSXxb8eVQS-D7tSB-OW-RHUYpXFUrSHiYraOwoFJQV7QGnVQh6eYTnXM02UjwZ_HVxsOYXM0GWFe4k7TMbq8XvDFbZzlx2ac34BmwcWrbDzo9iP6ctTVFtlpRb2ERRVEkeH7Tl8z9YqQb13NjhRN-fpVyw4CxqYSeTfjo1T7QKFg15-mlISQhw2TuKrp_Hr0mZIhh7DgA9xF4QpwVSjSTOP1GToBMpCbp__r-LuwvbVL-t7KIHdd71F57ZwjKmuf0S_-yIPN3TTbs1J7_38XdzVkAqsJ_8LRNGeyKRlJRBVh5rXjO4xJKGENwQ5o15-70MHxK84PaxWbqXySBnG-b_jWoy5BxsGSxvJgFV4w-L6veltZOJOhzJD7FeTEg2lC4sMqx99eHjlWP6GupsXvXJHA93f5XLG9o8AC9VGbALidqhgRuN6eNwWSf6fjkg5HlLfNwcZHySy99zKf0XbyMawTn0Yeg9MrJC1T5xJ1BlRQrvemcEBBtazzro-pb5lr7ZsFXksXh3tBoDfqIDpcilB0azRYtwM41Ps3vCDk5PY6IBWLD6pndWRKVw5puHPoeTJUfTIW8tZI9IlZqVcq5aXABAa5JSu1jWstWOh-R_rUWCVxiHkcIChqONZfIoCclQc227UyhLcNG6KzR-M4eMuIEjNAxNc9IhpkmioOCP7MGfTSUjZpchtFZAuRGIFaGm2gyEMRXEUDWeaIyNs2hU_MUJvdYp0yqMzVA.NsgTyx8lKOzvi91Q2l6Ptw"
));

curl_setopt_array($curl, array(
    CURLOPT_URL => $apiurl."user/v3/refresh",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $curl_data,
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json"
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
