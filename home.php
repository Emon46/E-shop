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
					}
					else if($row['product_name']=="mouse")
						{
							$mouse_price_per_unit=$row['price_per_unit'];
						}
					else if($row['product_name']=="keyboard"){
						$keyboard_price_per_unit=$row['price_per_unit'];
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
<body >
	<header>
        <nav>

			<h1>demo shop</h1>
			<div class="main-wrapper">
				<ul>
					<li><a href="home.php">Home </a></li>
					<li><a href="cart.php">cart</a></li>
					

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
		
        <h1 style="text-align:center;padding-top:50px; padding-left:0px; color:#664B23"> See your products kiddo!!!! </h1>

         	

    <form action="cart.php" method="POST">
    <div class="shopping-cart" style="height : 564px;">
          <!-- Title -->
          <div class="title">
            Shopping Bag
          </div>

          <!-- Product #1 -->
          <div class="item">
              <div class="buttons">
                <span class="delete-btn"></span>
                <span class="like-btn"></span>
              </div>

              <div class="image">
                <img src="images/item-1.png" style="width:110px; height:90px" alt="" />
              </div>

              <div class="description">
                <span>Pendrive</span>
                <span>Brand : Samsung</span>
                <span><b><?php echo $pendrive_price_per_unit; ?></b> (per-unit)</span>
              </div>

              <div class="quantity">
                <button class="plus-btn" type="button" name="button">
                  <img src="images/plus.svg" alt="" />
                </button>
                <input type="text" name="pendrive_quantity" value="0">
                <button class="minus-btn" type="button" name="button">
                  <img src="images/minus.svg" alt="" />
                </button>
              </div>

              <div class="total-price" type="number">0</div>
          </div>


          <!-- Product #2 -->
          <div class="item">
              <div class="buttons">
                <span class="delete-btn"></span>
                <span class="like-btn"></span>
              </div>

              <div class="image">
                <img src="images/item-2.jpg" style="width:110px; height:90px" alt=""/>
              </div>

              <div class="description">
                <span>Mouse</span>
                <span>Brand : A4tech</span>
                <span><b><?php echo $mouse_price_per_unit;?></b> (per-unit)</span>
              </div>

              <div class="quantity">
                <button class="plus-btn" type="button" name="button">
                  <img src="images/plus.svg" alt="" />
                </button>
                <input type="text" name="mouse_quantity" value="0">
                <button class="minus-btn" type="button" name="button">
                  <img src="images/minus.svg" alt="" />
                </button>
              </div>

              <div class="total-price">0</div>
          </div>


          <!-- Product #3 -->
          <div class="item" >
              <div class="buttons">
                <span class="delete-btn"></span>
                <span class="like-btn"></span>
              </div>

              <div class="image">
                <img src="images/item-3.jpg" style="width:110px; height:90px" alt="" />
              </div>

              <div class="description">
                <span>Keyboard</span>
                <span>Brand : A4tech</span>
                <span><b><?php echo $keyboard_price_per_unit;?></b> (per-unit)</span>
              </div>

              <div class="quantity">
                <button class="plus-btn" type="button" name="button">
                  <img src="images/plus.svg" alt="" />
                </button>
                <input type="text" name="keyboard_quantity" value="0">
                <button class="minus-btn" type="button" name="button">
                  <img src="images/minus.svg" alt="" />
                </button>
              </div>

              <div class="total-price" >0</div>
          </div>

          
          <!-- //total #1 -->
          <div class="item" style:"border-top:  2px solid #E1E8EE;">
               <div class="description" >
                <span> products prize</span>
                <div name='productsprize' align="center" style="width: 83px ,text-align: center;">0</div>
              </div>
              
               <div class="description">
                <span>delivery Cost</span>
                <div name="deliverycost" style="width: 83px ;text-align: center;">100</div>
              </div>

              <div class="description">
                <span></span>
              </div>
              <div class="description">
                <span>Total amount </span>
                <div name="totalprize" style="width: 83px ;text-align: center;">0</div>
              </div>
          </div>
          <button type="submit" name="submit" value="submit" class="_btn checkout-btn entypo-forward" style="width:100px; margin-left:340px;">Checkout</button>
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

        //perunit prize access
        var priceunitper=parseInt($this.parent().prev().find("b").text());

        var $priceofproduct=$this.parent().next();
        var priceint=parseInt($priceofproduct.text());
        priceint=priceunitper*value;
        $this.parent().next().text(priceint);

        var previousproductsprize=parseInt($("div[name='productsprize']").text());
        if(flag==1)var newproductsprize=previousproductsprize-priceunitper;
        else var newproductsprize=previousproductsprize;
        $("div[name='productsprize']").text(newproductsprize);

        var previoustotalamount=parseInt($("div[name='totalprize']").text());
        newtotalamount=newproductsprize+100;
        if(newproductsprize==0)newtotalamount=0;
        $("div[name='totalprize']").text(newtotalamount);


    	});

    	$('.plus-btn').on('click', function(e) {
    		e.preventDefault();
    		var $this = $(this);
    		var $input = $this.closest('div').find('input');
    		var value = parseInt($input.val());

    		if (value < 100) {
      		value = value + 1;
    		} else {
    			value =100;
    		}

    		$input.val(value);


         //perunit prize access
        var priceunitper=parseInt($this.parent().prev().find("b").text());

        var $priceofproduct=$this.parent().next();
        var priceint=parseInt($priceofproduct.text());
        priceint=priceunitper*value;
        $this.parent().next().text(priceint);

        var previousproductsprize=parseInt($("div[name='productsprize']").text());
        var newproductsprize=previousproductsprize+priceunitper;
        $("div[name='productsprize']").text(newproductsprize);

        var previoustotalamunt=parseInt($("div[name='totalprize']").text());
        var newtotalamunt=newproductsprize+100;
        if(newproductsprize==0)newtotalamunt=0;
        $("div[name='totalprize']").text(newtotalamunt);



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