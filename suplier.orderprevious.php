<?php
	include_once 'includes/dbh.inc.php';
	

?>


<?php
	include_once 'supplier.header.php';
?>
<?php
	//session_start();
	if(!isset($_SESSION['logged_in_username'])){
		header("Location:  index.php?login=empty");
	}
?>
		 <div class="divider"> </div>
		
        <h1 style="text-align:center;padding-top:50px; padding-left:0px; color:#664B23"> Choose your products kiddo!!!! </h1>

        

         	<?php
        		
				$url = "http://localhost/e-shop/api/order.api.php";
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_HTTPGET, true);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$response_json = curl_exec($ch);
				curl_close($ch);
				$response=json_decode($response_json,true);

				$response=$response['result'];

				foreach ($response as $row ) {

					echo '<div align="center" style=" margin-top:100px; height:400px;margin-left:50px; margin-right:10px; border: 2px solid black; ">';
					echo '<ul';
					echo '<li style="margin:20px;">';
					echo '<h2>order id : '.$row['orderid'].'</h2>';
					echo '</li>';

					echo '<li style="margin:20px;">';
					echo '<h2>receiver name : '.$row['todelivername'].'</h2>';
					echo '</li>';

					echo '<li style="margin:20px;">';
					echo '<h2>delivery address : '.$row['deliveryadress'].'</h2>';
					echo '</li>';

					echo '<li style="margin:20px;">';
					echo '<h2>pendrive quantity : '.$row['pendrive_quantity'].'</h2>';
					echo '</li>';

					echo '<li style="margin:20px;">';
					echo '<h2>mouse quantity : '.$row['mouse_quantity'].'</h2>';
					echo '</li>';

					echo '<li style="margin:20px;">';
					echo '<h2>keyboard quantity : '.$row['keyboard_quantity'].'</h2>';
					echo '</li>';

					echo '<li style="margin:20px;">';
					if($row['delivered']==0)
					echo '<h2>delivery details : not delivered</h2>';
					else {

						echo '<h2>delivery details : delivered</h2>';
					}
					echo '</li>';
					echo ' 	</ul>
				        	
				        </div>';

					echo '</form>';

				}

        	?>

        <div style="margin-top:295px;">
		</div> 

		<script> 
			function up(max) {
		    document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) + 1;
		    if (document.getElementById("myNumber").value >= parseInt(max)) {
		        document.getElementById("myNumber").value = max;
		    	}
			}
			function down(min) {
			    document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) - 1;
			   
			}

		</script>


<?php
	include_once 'footer.php';
?>