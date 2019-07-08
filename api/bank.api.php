<?php
	header('Content-Type: application/json');
	$method = $_SERVER['REQUEST_METHOD'];

	switch ($method) {

 		case 'POST': // create data
     		$data = json_decode(file_get_contents('php://input'), true);  // true means you can convert data to array
     		 //print_r($data);
    			
      		postOperation($data);
      		break;

 		case 'GET': // read data
		  	getOperation();
    		break;


  		case 'PUT': // update data
      		$data = json_decode(file_get_contents('php://input'), true);  // true means you can convert data to array
      		putOperation($data);
      		break;

  		case 'DELETE': // delete data
      		$data = json_decode(file_get_contents('php://input'), true);  // true means you can convert data to array
		  	deleteOperation($data);
    		break;

  		default:
    		print('{"result": "Requested http method not supported here."}');

}



function getOperation(){

    include "db.php"; 
    $sql = "SELECT * FROM bank";
    $result = mysqli_query($apiconnct, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
      $rows = array();
       while($r = mysqli_fetch_assoc($result)) {
          $rows["result"][] = $r; 

       }
      echo json_encode($rows);
    } else {
    echo "string";
        echo '{"result": "No data found"}';
    }
  }

  function postOperation($data){
   // print_r($data);
 
    include "db.php";

    

    $sender = $data['sender'];
    $password = $data['password'];
    $receiver = $data['receiver'];
    $transfermoney = $data['transfermoney'];

    //$sql="Update INTO products(product_name  , price_per_unit , quantity_available, brand_name,    supplier) VALUES 
                            // ('$product_name','$product_price'  ,'$product_quantity', '$brand_name', '$product_supplier')";
    $sql="UPDATE bank SET balance=balance-$transfermoney WHERE cardnumber=$sender ";

    if (mysqli_query($apiconnct, $sql)) {
        echo '{"result": "Success"}';
    } else {
        echo '{"result": "Sql error"}';
    }

    $sql="UPDATE bank SET balance=balance+$transfermoney WHERE cardnumber=$receiver ";

    if (mysqli_query($apiconnct, $sql)) {
        echo '{"result": "Success"}';
        takerecords($sender,$receiver,$transfermoney);

    } else {
        echo '{"result": "Sql error"}';
    }
  }
  function takerecords($sendercardnumber,$receiverCardNUmber,$sendMoney){
    $postdata = array(
        'sender' => $sendercardnumber,
        'receiver' => $receiverCardNUmber,
        'amount' => $sendMoney

      );

      $url = "http://localhost/e-shop/api/bankrecords.api.php";

      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POST, true);
      $postdata=json_encode($postdata);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);

      $json_response = curl_exec($curl);
      curl_close($curl);
    }
?>