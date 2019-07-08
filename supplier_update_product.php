<?php
	session_start();
	if(!isset($_SESSION['logged_in_username'])){
		header("Location: index.php?login=empty");
	}
?>
<?php

	include_once 'api/db.php';

if(isset($_POST['update'])){

	
	include_once 'includes/dbh.inc.php';
	$pendrive_quantity=mysqli_real_escape_string($connct,$_POST['pendrive_quantity']);

	$mouse_quantity=mysqli_real_escape_string($connct,$_POST['mouse_quantity']);

	$keyboard_quantity=mysqli_real_escape_string($connct,$_POST['keyboard_quantity']);

	$pendrive_price=mysqli_real_escape_string($connct,$_POST['pendrive_price_per_unit']);

	$mouse_price=mysqli_real_escape_string($connct,$_POST['mouse_price_per_unit']);

	$keyboard_price=mysqli_real_escape_string($connct,$_POST['keyboard_price_per_unit']);


		$postdata = array(

        		'pendrive_quantity' => $pendrive_quantity ,
        		'mouse_quantity' => $mouse_quantity,
        		'keyboard_quantity' => $keyboard_quantity,
        		'pendrive_price' => $pendrive_price,
        		'mouse_price' => $mouse_price,
        		'keyboard_price' => $keyboard_price

        	     );

			     $url = "http://localhost/e-shop/api/supplier.product.api.php";

			    $curl = curl_init($url);
			    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			    curl_setopt($curl, CURLOPT_POST, true);
			    $postdata=json_encode($postdata);
			    curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);

			    $json_response = curl_exec($curl);
			    print_r($json_response);
			    curl_close($curl);

	header("Location: supplier.home.php");
}
?>