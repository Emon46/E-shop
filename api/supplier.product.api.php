<?php
  session_start();
  if(!isset($_SESSION['logged_in_username'])){
    header("Location: ../index.php?login=empty");
  }
?>
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
    $sql = "SELECT * FROM products";
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

    $pendrive_quantity = $data['pendrive_quantity'];
    $mouse_quantity = $data['mouse_quantity'];
    $keyboard_quantity = $data['keyboard_quantity'];
    $pendrive_price = $data['pendrive_price'];
    $mouse_price = $data['mouse_price'];
    $keyboard_price=$data['keyboard_price'];

    $sql="UPDATE products SET price_per_unit=$pendrive_price, quantity_available=$pendrive_quantity  WHERE product_name='pendrive';";
      if (mysqli_query($apiconnct, $sql)) {
          echo '{"result": "Success"}';
      } else {
          echo '{"result": "Sql error"}';
          
      }


    //$sql = "INSERT INTO products(name, phone,  datetime) VALUES('$name', '$phone', NOW())";
    $sql="UPDATE products SET price_per_unit=$mouse_price, quantity_available=$mouse_quantity  WHERE product_name='mouse';";

    if (mysqli_query($apiconnct, $sql)) {
        echo '{"result": "Success"}';
    } else {
        echo '{"result": "Sql error"}';
        echo $data;
    }
    $sql="UPDATE products SET price_per_unit=$keyboard_price, quantity_available=$keyboard_quantity  WHERE product_name='keyboard';";

    if (mysqli_query($apiconnct, $sql)) {
        echo '{"result": "Success"}';
    } else {
        echo '{"result": "Sql error"}';
        echo $data;
    }
  }
?>