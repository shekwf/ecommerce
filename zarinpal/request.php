<?php
/*
 * ZarinPal Advanced Class
 *
 * version 	: 1.0
 * link 	: https://vrl.ir/zpc
 *
 * author 	: milad maldar
 * e-mail 	: miladworkshop@gmail.com
 * website 	: https://miladworkshop.ir
*/
require_once '../inc/confing.php';
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

require_once("zarinpal_function.php");

$MerchantID 	= "6ce23435-9d94-44b3-8de3-b0c9e6a3ed1d";
$Amount 		= $price;
$Description 	= "تراکنش زرین پال";
$Email 			= "";
$Mobile 		= "";
$CallbackURL 	= "http://localhost/learn/ecommerce/zarinpal/verify.php";
$ZarinGate 		= false;
$SandBox 		= false;

$zp 	= new zarinpal();
$result = $zp->request($MerchantID, $Amount, $Description, $Email, $Mobile, $CallbackURL, $SandBox, $ZarinGate);

if (isset($result["Status"]) && $result["Status"] == 100)
{
	// Success and redirect to pay
	$zp->redirect($result["StartPay"]);
} else {
	// error
	echo "خطا در ایجاد تراکنش";
	echo "<br />کد خطا : ". $result["Status"];
	echo "<br />تفسیر و علت خطا : ". $result["Message"];
}