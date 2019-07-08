<?php
	session_start();
?>
<?php

	include_once 'api/db.php';

if(isset($_POST['submit'])){

	$image =$_FILES['product_image'];
	print_r($image);


	$imageName=$_FILES['product_image']['name'];
	$imageTmpName=$_FILES['product_image']['tmp_name'];
	$imageError=$_FILES['product_image']['error'];
	$imageType=$_FILES['product_image']['type'];

	$imageExt=explode('.', $imageName);
	$imageActualExt=strtolower(end($imageExt));

	$allowed = array( 'jpg' , 'jpeg' , 'png' , 'pdf');

	if(in_array($imageActualExt, $allowed)){

		$dbImage= addslashes(file_get_contents($imageTmpName)) ;
		if($imageError == 0){

			 $postdata = array(
        		'product_name' => 'Arfan',

        		'product_price' => 5,
        		'image' => '@'.$imageTmpName,
        		//'image'=> curl_file_create($imageTmpName, $imageType, $imageName),
        		'quantity_available' => 5,
        		'brand_name' => 'eastasy',
        		'supplier' => 'kaka'
        	     );

			     $url = "http://localhost/e-shop/api/products.api.php";

			    $curl = curl_init($url);
			    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			    curl_setopt($curl, CURLOPT_POST, true);
			    $postdata=json_encode($postdata);
			    curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);

			    $json_response = curl_exec($curl);
			    print_r($json_response);
			    curl_close($curl);

		}
		else {
			echo 'error in upload';
		}
	}
	else {
		echo "not supported";

	}
}
?>