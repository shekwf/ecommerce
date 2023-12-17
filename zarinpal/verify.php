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

require_once("zarinpal_function.php");

$MerchantID 	= "6ce23435-9d94-44b3-8de3-b0c9e6a3ed1d";
$Amount 		= $price;
$ZarinGate 		= false;
$SandBox 		= false;

$zp 	= new zarinpal();
$result = $zp->verify($MerchantID, $Amount, $SandBox, $ZarinGate);

if (isset($result["Status"]))//&& $result["Status"] == 100
{
	// Success
	echo "تراکنش با موفقیت انجام شد";
	echo "<br />مبلغ : ". $result["Amount"];
	echo "<br />کد پیگیری : ". $result["RefID"];
	echo "<br />Authority : ". $result["Authority"];
} else {
	// error
	echo "پرداخت ناموفق";
	echo "<br />کد خطا : ". $result["Status"];
	echo "<br />تفسیر و علت خطا : ". $result["Message"];
}
$name=implode(',', array_column($cart,'name'));
$status=$result["Status"];
$authority=$result["RefID"];
$query= mysqli_query($connection, "INSERT INTO orders(name ,price,authority,status) VALUES ('$name','$price','$authority','$status')");
//header('location: http://localhost/learn/ecommerce');