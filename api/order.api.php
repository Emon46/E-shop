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
    $sql = "SELECT * FROM orders ORDER BY orders.delivered ASC";
    $result = mysqli_query($apiconnct, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
      $rows = array();
       while($r = mysqli_fetch_assoc($result)) {
          $rows["result"][] = $r; // with result object
        //  $rows[] = $r; // only array
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

    print_r($data);

    $name = $data['name'];
    $adress = $data['adress'];
    $phone = $data['phone'];
    $pendrive = $data['pendrive'];
    $mouse = $data['mouse'];
    $keyboard = $data['keyboard'];
    $delivered = $data['delivered'];


    //$sql = "INSERT INTO products(name, phone,  datetime) VALUES('$name', '$phone', NOW())";

    $sql="INSERT INTO orders(todelivername, deliveryadress, delivertonumber, pendrive_quantity, mouse_quantity, keyboard_quantity, delivered) VALUES ('$name','$adress'  ,'$phone', '$pendrive', '$mouse','$keyboard','$delivered')";

    if (mysqli_query($apiconnct, $sql)) {
        echo '{"result": "Success"}';
    } else {
        echo '{"result": "Sql error"}';
        
    }
    if($pendrive>0){

      $sql="UPDATE products SET quantity_available=quantity_available - $pendrive WHERE product_name='pendrive';";
      if (mysqli_query($apiconnct, $sql)) {
          echo '{"result": "Success"}';
      } else {
          echo '{"result": "Sql error"}';
          
      }

    }
    if ($mouse>0) {
      $sql="UPDATE products SET quantity_available=quantity_available - $mouse WHERE product_name='mouse';";

      if (mysqli_query($apiconnct, $sql)) {
          echo '{"result": "Success"}';
      } else {
          echo '{"result": "Sql error"}';
          
      }

    }
    if($keyboard>0){
        $sql="UPDATE products SET quantity_available=quantity_available - $keyboard WHERE product_name='keyboard';";

        if (mysqli_query($apiconnct, $sql)) {
            echo '{"result": "Success"}';
        } else {
            echo '{"result": "Sql error"}';
            
        }

    }
  }
?>