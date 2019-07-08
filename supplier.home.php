<?php
	include_once 'includes/dbh.inc.php';
	

?>


<?php
	session_start();
?>

<?php
        		
				$url = "http://localhost/e-shop/api/products.api.php";
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_HTTPGET, true);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$response_json = curl_exec($ch);
				curl_close($ch);
				$response=json_decode($response_json,true);

				$response=$response['result'];
				

				foreach ($response as $row ) {
					if($row['product_name']=="pendrive"){
						$pendrive_price_per_unit=$row['price_per_unit'];
            $pendrive_quantity=$row['quantity_available'];
					}
					else if($row['product_name']=="mouse")
						{
							$mouse_price_per_unit=$row['price_per_unit'];
              $mouse_quantity=$row['quantity_available'];
						}
					else if($row['product_name']=="keyboard"){
						$keyboard_price_per_unit=$row['price_per_unit'];
            $keyboard_quantity=$row['quantity_available'];
					}

				}

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
	//session_start();
	if(!isset($_SESSION['logged_in_username'])){
		header("Location: index.php?login=empty");
	}
?>	 
<div class="divider"> </div>
		
        <h1 style="text-align:center;padding-top:50px; padding-left:0px; color:#664B23"> Update your products kiddo!!!! </h1>

         	

    <form action="supplier_update_product.php" method="POST">
    <div class="shopping-cart" style="height : 500px;">
      <div class="item" >
               <!-- Title -->
              <div class="quantity" style="margin-left:70px;">
                <span>product image</span>
              </div>
              <div class="quantity">
                <span>product description</span>
              </div>

              <div class="quantity">
                quantity
              </div>

              <div class="quantity"  style="margin-left:20px;margin-right:20px;">
                price(unit)
              </div>
          </div>
         

          <!-- Product #1 -->
          <div class="item">
              <div class="buttons">
              </div>

              <div class="image">
                <img src="images/item-1.png" style="width:130px; height:90px" alt="" />
              </div>

              <div class="description">
                <span>Pendrive</span>
                <span>Brand : Samsung</span>
              </div>

              <div class="quantity">
                <button class="plus-btn" type="button" name="button">
                  <img src="images/plus.svg" alt="" />
                </button>
                <input type="text" style="width:50px;" name="pendrive_quantity" value=<?php echo 
                $pendrive_quantity;?>>
                <button class="minus-btn" type="button" name="button">
                  <img src="images/minus.svg" alt="" />
                </button>
              </div>

              <div class="total-price" type="number">
                <input name="pendrive_price_per_unit" value=<?php echo $pendrive_price_per_unit; ?> type="text">
              </div>
          </div>


          <!-- Product #2 -->
          <div class="item">
              <div class="buttons">
              </div>

              <div class="image">
                <img src="images/item-2.jpg" style="width:130px; height:90px" alt="" />
              </div>

              <div class="description">
                <span>Mouse</span>
                <span>Brand : A4tech</span>
              </div>

              <div class="quantity">
                <button class="plus-btn" type="button" name="button">
                  <img src="images/plus.svg" alt="" />
                </button>
                <input type="text" style="width:50px;"  name="mouse_quantity" value=<?php echo 
                $mouse_quantity;?>>
                <button class="minus-btn" type="button" name="button">
                  <img src="images/minus.svg" alt="" />
                </button>
              </div>

              <div class="total-price">
                <input name="mouse_price_per_unit" value=<?php echo $mouse_price_per_unit; ?> type="text">
              </div>
          </div>


          <!-- Product #3 -->
          <div class="item" >
              <div class="buttons">
              </div>

              <div class="image">
                <img src="images/item-3.jpg" style="width:130px; height:90px" alt="" />
              </div>

              <div class="description">
                <span>Keyboard</span>
                <span>Brand : A4tech</span>
              </div>

              <div class="quantity">
                <button class="plus-btn" type="button" name="button">
                  <img src="images/plus.svg" alt="" />
                </button>
                <input type="text" style="width:50px;" name="keyboard_quantity" value=<?php echo 
                $keyboard_quantity;?> >
                <button class="minus-btn" type="button" name="button">
                  <img src="images/minus.svg" alt="" />
                </button>
              </div>

            <div class="total-price">
              <input name="keyboard_price_per_unit"value=<?php echo $keyboard_price_per_unit; ?> type="text">
            </div>
          </div>

          
         
          <button name="update" type="submit"  class="_btn checkout-btn entypo-forward" style="width:100px; margin-left:340px;">Update
          </button>
    </div>

  </form>

    <script type="text/javascript">
      $('.minus-btn').on('click', function(e) {
    		e.preventDefault();
    		var $this = $(this);
    		var $input = $this.closest('div').find('input');
    		var value = parseInt($input.val());
        var flag=1;

    		if (value >= 1) {
    			value = value - 1;
    		} else {
          flag=0;
    			value = 0;
    		}

        $input.val(value);

        


    	});

    	$('.plus-btn').on('click', function(e) {
    		e.preventDefault();
    		var $this = $(this);
    		var $input = $this.closest('div').find('input');
    		var value = parseInt($input.val());

    		if (value < 10000) {
      		value = value + 1;
    		} else {
    			value =10000;
    		}

    		$input.val(value);





    	});

      $('.like-btn').on('click', function() {
        $(this).toggleClass('is-active');
      });
    </script>
    <div style="margin-top:150px;">
		</div>



<?php
	include_once 'footer.php';
?>