<?php

require_once("Payment.php");
extract($_REQUEST);
$oPayment= new Payment($conektaTokenId,$cart_id,$name,$email,$telephone,$card,$description,$total);

if($oPayment->pay()){
    echo "1";
}else{
    echo $oPayment->error;
}

?>
