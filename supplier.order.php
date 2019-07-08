<?php
	include_once 'includes/dbh.inc.php';
	

?>


<?php
	session_start();
?>

<?php
        		
        $url = "http://localhost/e-shop/api/order.api.php";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json,true);

        $response=$response['result'];

?>
<!DOCTYPE html>

<html lang="en">
<html>
<head>


<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <link rel="stylesheet" href="cartstyle.css" type="text/css" media="screen" title="no title" charset="utf-8">
    <script src="https://code.jquery.com/jquery-2.2.4.js" charset="utf-8"></script>
    <meta name="robots" content="noindex,follow" />


	<title>E-shop</title>


</head>
<body style="background-color: #b29df2;">
	<header>
        <nav>

			<h1>demo shop</h1>
			<div class="main-wrapper">
				<ul>
					<li><a href="supplier.home.php">Home </a></li>
          <li><a href="supplier.order.php">orders</a></li>
          <li><a href="supplier.transactions.php">transactions</a></li>
					

				</ul
			</div>
			<div class="nav-login">		
				<?php
					if(isset($_SESSION['logged_in_username'])){
						echo '<a href="profile.php" style="font-size:14px;padding-right:10px; padding-left:0px;text-align:left;">'. $_SESSION['logged_in_username'] .' </a>';
						echo '<form action="includes/logout.inc.php" method="POST">';

						echo '<button type="submit" name="submit">Logout</button>
						</form>';
					}
					else {
						echo '<form action="includes/login.inc.php" method="POST">
							<input type="text" name="username" placeholder="username">
							<input type="password" name="pwd" placeholder="password">
							<button type="submit" name="submit">login</button>
						</form>';
					}
				?>
			</div>
		</nav>
	</header>
<?php
	if(!isset($_SESSION['logged_in_username'])){
		header("Location: index.php?login=empty");
	}
?>	 
<div class="divider"> </div>
		
        <h1 style="text-align:center;padding-top:50px; padding-left:0px; color:#664B23">Received orders list </h1>

    <div class="shopping-cart" style="height : 100%;">
      <div class="item" >
               <!-- Title -->
              <div class="quantity" >
                <span>Name</span>
              </div>
              <div class="quantity">
                <span>Quantity</span>
              </div>

              <div class="quantity">
                <span>Address</span>
              </div>

              <div class="quantity"  >
                <span>Contact no.</span>
              </div>
              <div class="quantity"  >
                <span>OrderId</span>
              </div>
              <div class="quantity"  >
                <span>Delivered!</span>
              </div>
          </div>
<?php
//print_r($response);        
foreach ($response as $row ) {
  ?>
          <div class="item" >
              <div class="description">
                <span><?php echo $row['todelivername']?></span>
              </div>

              <div class="description" style="width:280px;">
                <span>pendrive :<?php echo $row['pendrive_quantity']; ?></span>
                <span>mouse : <?php echo $row['mouse_quantity']?></span>      
                <span>Keyboard : <?php echo $row['keyboard_quantity']?></span>
              </div>

              <div class="description">
                <span><?php echo $row['deliveryadress']?> </span>
              </div>

              <div class="description">
                <span><?php echo $row['delivertonumber']?></span>
              </div>

            <div class="description">
                <span><?php echo $row['orderid']?></span>
              </div>
              <div class="description">
                <?php if($row['delivered']==1){
                  echo '<span>done!!</span>';
                }
                else {
                  ?>
                  <button id=<?php echo $row['orderid']?> class="btn" style="width:60px;">do now</button>
                <?php }
                  ?>
                 
              </div>
          </div>
          <?php } ?>

    </div>


    <script type="text/javascript">
       $(function() {
          $(document).on("click", ".btn", function() {
            var $btn=$(this);
            var orderid=parseInt($(this).attr("id"));

            
            
            window.location = "delivery_update.php?orderid=" + orderid;


          });

        });
    </script>
    <div style="margin-top:150px;">
		</div>



<?php
	include_once 'footer.php';
?>