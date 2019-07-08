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
    $sql = "SELECT * FROM bankrecords";
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
    $receiver = $data['receiver'];
    $transfermoney = $data['amount'];

   
    $sql="INSERT INTO bankrecords(receiver, sender, amount) VALUES ('$receiver','$sender','$transfermoney')";

    if (mysqli_query($apiconnct, $sql)) {
        echo '{"result": "Success"}';
    } else {
        echo '{"result": "Sql error"}';
    }

    
  }
?>