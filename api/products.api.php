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

    $product_name = $data['product_name'];
    $product_price = $data['product_price'];
    //$product_image = $data['image'];
    $product_quantity = $data['quantity_available'];
    $brand_name = $data['brand_name'];
    $product_supplier = $data['supplier'];


    //$sql = "INSERT INTO products(name, phone,  datetime) VALUES('$name', '$phone', NOW())";
    $sql="INSERT INTO products(product_name  , price_per_unit , quantity_available, brand_name,    supplier) VALUES 
                             ('$product_name','$product_price'  ,'$product_quantity', '$brand_name', '$product_supplier')";

    if (mysqli_query($apiconnct, $sql)) {
        echo '{"result": "Success"}';
    } else {
        echo '{"result": "Sql error"}';
        echo $data;
    }
  }
?>