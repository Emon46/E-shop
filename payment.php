
<?php
	session_start();
	if(!isset($_SESSION['logged_in_username'])){
		header("Location: index.php?login=empty");
	}
?>
<?php

if (isset($_POST['order'])) {
	include_once 'includes/dbh.inc.php';
	$pendrive_quantity=mysqli_real_escape_string($connct,$_POST['pendrive_quantity']);

	$mouse_quantity=mysqli_real_escape_string($connct,$_POST['mouse_quantity']);

	$keyboard_quantity=mysqli_real_escape_string($connct,$_POST['keyboard_quantity']);

	$usercardnumber=mysqli_real_escape_string($connct,$_POST['cardnumeber']);

	$todelivername=mysqli_real_escape_string($connct,$_POST['name']);

	$deliveryadress=mysqli_real_escape_string($connct,$_POST['adress']);

	$cardpass=mysqli_real_escape_string($connct,$_POST['cardpassword']);

	$delivertonumber=mysqli_real_escape_string($connct,$_POST['phone']);

	$totalamount=mysqli_real_escape_string($connct,$_POST['totalamountfinal']);


	//Error handlers
	$supplierCardNumber="67890";
	$ecommerceCardNumber="123456789";
	// $cardpass="12345";
	// $usercardnumber="12345";
	$userbalance=-1;
	$username="";
	$casedelivery=$totalamount;
	print_r($_POST);

	$url = "http://localhost/e-shop/api/bank.api.php";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HTTPGET, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response_json = curl_exec($ch);
	curl_close($ch);
	$response=json_decode($response_json,true);

	$response=$response['result'];
	foreach ($response as $row ) {
		if($row['cardnumber']==$usercardnumber && $cardpass==$row['cardpassword']){	
			$username=$row['name'];
			$userbalance=$row['balance'];
		}
		else{
		}
	}
	if($userbalance==-1){
		echo 'wrong id';
	}
	else{
		if($casedelivery<=$userbalance){

			dopayment($usercardnumber,$cardpass,$supplierCardNumber,($casedelivery-100));
			
			dopayment($usercardnumber,$cardpass,$ecommerceCardNumber,100);
			doorder($todelivername,$deliveryadress,$delivertonumber,$pendrive_quantity,$mouse_quantity,$keyboard_quantity,0);
			echo "Your order have been received by the supplier.";
		}
		else {
			echo "not sufficient balance. ";
		}
	}
	header("Location: orderreceived.php?login");
}


	function dopayment($sendercardnumber,$senderpass,$receiverCardNUmber,$sendMoney){
 		$postdata = array(
        'sender' => $sendercardnumber,
        'password' => $senderpass,
        'receiver' => $receiverCardNUmber,
        'transfermoney' => $sendMoney

	    );

	    $url = "http://localhost/e-shop/api/bank.api.php";

	    $curl = curl_init($url);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_POST, true);
	    $postdata=json_encode($postdata);
	    curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);

	    $json_response = curl_exec($curl);
	    curl_close($curl);
		}
		

	function doorder($deliverytoname,$adress,$phone,$pendrive,$mouse,$keyboard,$delivered){
 		$postdata = array(
        'name' => $deliverytoname,
        'adress' => $adress,
        'phone' => $phone,
        'pendrive' => $pendrive,
        'mouse' => $mouse,
        'keyboard' => $keyboard,
        'delivered' => $delivered

	    );

	    $url = "http://localhost/e-shop/api/order.api.php";

	    $curl = curl_init($url);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_POST, true);
	    $postdata=json_encode($postdata);
	    curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);

	    $json_response = curl_exec($curl);
	    curl_close($curl);
		}		



?>