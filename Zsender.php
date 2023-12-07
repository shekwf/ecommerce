<?php
require_once 'inc/confing.php';
$session = $_SESSION;
$cart = [];
foreach($session as $keySession => $value){
    if(substr($keySession, 0, 5) == 'cart_'){
        $cart[$keySession] = $value;
    }
}
$price= array_column($cart,'price');
$price= array_sum($price);
$desc= array_column($cart,'name');

$data = array("merchant_id" => "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
    "amount" => $price,
    "callback_url" => "http://www.yoursite.com/verify.php",
    "description" => implode(',',$desc),
    "metadata" => [ "email" => "info@email.com","mobile"=>"09121234567"],
);
$jsonData = json_encode($data);
$ch = curl_init('https://sandbox.zarinpal.com/pg/v4/payment/request.json');
curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData)
));

$result = curl_exec($ch);
$err = curl_error($ch);
$result = json_decode($result, true, JSON_PRETTY_PRINT);
curl_close($ch);




if ($err) {
    echo "cURL Error #:" . $err;
} else {
    if (empty($result['errors'])) {
        if ($result['data']['code'] == 100) {
            header('Location: https://sandbox.zarinpal.com/pg/StartPay/' . $result['data']["authority"]);
        }
    } else {
        echo'Error Code: ' . $result['errors']['code'];
        echo'message: ' .  $result['errors']['message'];

    }
}

?>
