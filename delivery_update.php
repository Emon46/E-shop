<?php
if ( ! empty( $_GET['orderid'] ) ) {
	$orderid= $_GET['orderid'];
	$postdata = array(

	    'orderid' => $orderid 

	);

     $url = "http://localhost/e-shop/api/delivery.api.php";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    $postdata=json_encode($postdata);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);

    $json_response = curl_exec($curl);
    curl_close($curl); 
    header("Location: supplier.order.php");


} 

?>