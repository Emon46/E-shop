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
<?php
        session_start();
        if(!isset($_SESSION['logged_in_username'])){
                header("Location: index.php?login=empty");
        }
?>

<?php
  if (isset($_POST['submit'])) {
     $keyboard_quantity_choose=$_POST['keyboard_quantity'];
    $mouse_quantity_choose=$_POST['mouse_quantity'];
     $pendrive_quantity_choose=$_POST['pendrive_quantity'];
    

  }
  else{
    $keyboard_quantity_choose=0;
    $mouse_quantity_choose=0;
    $pendrive_quantity_choose=0;
  }

  $keyboard_price=$keyboard_price_per_unit*$keyboard_quantity_choose;
  $pendrive_price=$pendrive_price_per_unit*$pendrive_quantity_choose;
  $mouse_price=$mouse_price_per_unit*$mouse_quantity_choose;
  $products_price=($keyboard_price+$mouse_price+$pendrive_price);
  if($products_price>0)$total_price=$products_price+100;
  else $total_price=0;

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
a {
    text-decoration: none;
}

body {
  background-color: #7EC855;
  font-family: Arial;
  font-size: 17px;
  margin: 0;
  padding: 0px;
}

.main-wrapper {
    margin:0px auto ;
    width:1000px;
}
header {
  background-color: black;
    padding: 8px,0px,6px,10px;
    margin-bottom: 0px;
}
header nav {
    width: 100%;
    height:60px;
    background-color: black;
}
header h1 {
  display: inline;
  font-family: 'Oswald', sans-serif;
  font-weight: 400;
  font-size: 32px;
  float: left;
  margin-top: 5px;
  margin-right: 12px;
  padding-left: 10px;
  color: red;
  text-shadow: 2px 2px 4px #ccc;
}

header nav ul {
  display: inline;
  padding-left: 15px;
  padding-right: 0px;
  padding-top: 0px;
  padding-bottom: 0px;
    float: left;
} 
header nav ul li {
  display: inline-block;
    float: left;
    list-style: none;
    padding-right: 8px;

}
header nav ul li a {
  font-size: 22px;
    float: left;
    list-style: none;
    padding-right: 10px;
  font-family: 'Montserrat', sans-serif;
  color: #ccc;
  font-weight: 500;

}  

header .nav-login {
    float: right;
}
header .nav-login  form {
    float: left;
    padding-top: 15px;
}
header .nav-login  form input {
    float: left;
    width: 140px;
    height: 30px;
    padding: 0px 10px;
    margin-right: 5px;
    border: none;
    background-color: #ccc;

}
header .nav-login  form  button {
    float: left;
    width: 60px;
    height: 25px;
    margin-right: 10px;
    margin-top: 2px;
    padding-top: 2px;
    border: none;
    background-color: #ccc;
    cursor: pointer;
  font-family: 'Raleway', sans-serif;
  font-weight: 600;

}
header .nav-login a {
    display: block;
    width: 60px;
    height: 60px;
    border: none;
    cursor: pointer;
    float: left;
    color: #111;
    padding-top: 3px;
    line-height: 50px;
    font-size: 16px;
    color: white;
  font-family: 'Raleway', sans-serif;
}


* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}
.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}
input[type=password] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}
 
.btn {
  background-color: #4CAF50;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
.quantity {
  padding-top: 0px;
  margin-right: 5px;
}
.quantity input {
  -webkit-appearance: none;
  border: none;
  text-align: center;
  width: 32px;
  height: 20px;
  font-size: 16px;
  color: #43484D;
  font-weight: 300;
}

button[class*=btn] {
  width: 25px;
  height: 25px;
  background-color: #E1E8EE;
  border-radius: 6px;
  border: none;
  cursor: pointer;
}
.minus-btn img {
  margin-bottom: 3px;
}
.plus-btn img {
  margin-top: 2px;
  margin-left: 2px;
}
button:focus,
input:focus {
  outline:0;
}


.footer {
  position: relative;
  margin-top: -100px;
  height: 200px;
  clear: both;
  padding-top: 10px;
  color: white;
  background-color: #383535;
  text-align: center;
}
.footer ul li{
  width: 33%;
  list-style: none;
  float: left;
  
}
.footlogo {
    width: 200px;
    height: 150px;
    background-image: url(images/logo.jpg); 
    
    background-repeat: no-repeat;
    background-position: center; 
}
}

.footdiv {
    padding-top: 5px;
}
</style>
<script src="https://code.jquery.com/jquery-2.2.4.js" charset="utf-8"></script>
</head>
<body>
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

    <h2 style="padding:8px;" align='center'>Order Now kiddo!!!!</h2>
    <div class="row" style="padding:8px;">
      <div class="col-75">
        <div class="container">
          <form action="payment.php" method="POST">
          
            <div class="row">
              <div class="col-50">
                <h3>Billing Address</h3>
                <label for="fname"><i class="fa fa-user"></i> Full Name</label>

                <input type="text" id="fname" name="name" placeholder="emon shoumik">

                <label for="email"><i class="fa fa-envelope"></i> Email</label>

                <input type="text" id="email" name="phone" placeholder="sust@example.com">

                <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>

                <input type="text" id="adr" name="adress" placeholder="Akhalia,Sylhet">

               
              </div>

              <div class="col-50">
                <h3>Payment</h3>
                <label for="fname">Accepted Cards</label>
                <div class="icon-container">
                  <i class="fa fa-cc-visa" style="color:navy;"></i>
                  <i class="fa fa-cc-amex" style="color:blue;"></i>
                  <i class="fa fa-cc-mastercard" style="color:red;"></i>
                  <i class="fa fa-cc-discover" style="color:orange;"></i>
                </div>
                <label for="ccnum">Credit card number</label>

                <input type="text" id="ccnum" name="cardnumeber" placeholder="1111-2222-3333-4444">

                <label for="ccnum">Credit card password</label>

                <input id="ccnum" name="cardpassword" type="password" placeholder="********">
                
                
              </div>
              
            </div>

            <label>
              <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
            </label>

            <input type="submit" value="Place Your Order" name="order" class="btn">


        </div>

      </div>

      <div class="col-25">
        <div class="container">
          <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b>4</b></span></h4>
          
          <div class="quantity">
            <p>
              <a href="#" style="margin-right:5px;">Pendrive</a> 
                  <b class="priceperunit" style="margin-top:3px; "><?php echo $pendrive_price_per_unit;?></b>
                  <button class="plus-btn" type="button" name="button">
                      <img src="images/plus.svg" alt="" />
                  </button>
                  <input type="text"  name="pendrive_quantity" value=<?php echo $pendrive_quantity_choose;?> >
                  <button class="minus-btn" type="button" name="button">
                      <img src="images/minus.svg" alt="" />
                  </button>
                  <span class="price" style="margin-top:3px;"><?php echo $pendrive_price; ?> </span>
                </p>
          </div>

          <div class="quantity">
            <p>
              <a href="#" style="margin-right : 25px;">Mouse</a> 
                  <b class="priceperunit" style="margin-top:3px; "><?php echo $mouse_price_per_unit;?></b>
                  <button class="plus-btn" type="button" name="button">
                      <img src="images/plus.svg" alt="" />
                  </button>
                  <input type="text" name="mouse_quantity" value=<?php echo $mouse_quantity_choose;?>>
                  <button class="minus-btn" type="button" name="button">
                      <img src="images/minus.svg" alt="" />
                  </button>
                  <span class="price" style="margin-top:3px;"><?php echo $mouse_price; ?> </span>
                </p>
          </div>

          <div class="quantity">
            <p>
                  <a href="#" style="margin-right:5px;">Keyboard</a> 
                  <b class="priceperunit" style="margin-top:3px; text-size:16px"><?php echo $keyboard_price_per_unit;?></b>
                  <button class="plus-btn" type="button" name="button">
                      <img src="images/plus.svg" alt="" />
                  </button>
                  <input type="text" name="keyboard_quantity" value=<?php echo $keyboard_quantity_choose;?>>
                  <button class="minus-btn" type="button" name="button">
                      <img src="images/minus.svg" alt="" />
                  </button>
                  <span class="price" style="margin-top:3px;"><?php echo $keyboard_price; ?> </span>
            </p>
          </div>
          <hr>
          <div class="quantity" style="margin-top=5px;">
            <p>
                  <a href="#" style="margin-right:5px;">Products cost </a> 
                  
                  <span name='productsprize' class="price" style="margin-top:3px;"><?php echo $products_price; ?> </span>
            </p>
          </div>
          <div class="quantity" style="margin-top=5px;">
            <p>
                  <a href="#" style="margin-right:5px;">delivery cost </a> 
                  
                  <span name='deliverycost' class="price" style="margin-top:3px;">100</span>
            </p>
          </div>

          <hr>
          <p>Total <span class="price" style="color:black"><b name="totalamount" id='total-prize'><?php echo $total_price; ?> </b></span></p>
          <input type='number' name='totalamountfinal' value=<?php echo $total_price; ?>  style="visibility: collapse;"/> 

        </div>
      </div>
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

        
        var $priceperunit = $this.closest('div').find('b').text();
        var priceperunitint=parseInt($priceperunit);

         var $price = $this.closest('div').find('span');
        var priceint=parseInt($price.text());
        priceint=priceperunitint*value;
        $price.text(priceint);

        //$("#total-prize").text("sdjkh");
        var previousproductsprize=parseInt($("span[name='productsprize']").text());
        if(flag==1)var newproductsprize=previousproductsprize-priceperunitint;
        else var newproductsprize=previousproductsprize;
        if(newproductsprize>=100)newproductsprize=newproductsprize;
        $("span[name='productsprize']").text(newproductsprize);
        //euiwfdu
        var previoustotalamount=parseInt($("b[name='totalamount']").text(""));
        newtotalamount=newproductsprize+100;
        if(newproductsprize==0)newtotalamount=0;
        $("b[name='totalamount']").text(newtotalamount);

        $("input[name='totalamountfinal']").val(newtotalamount);

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

        var $priceperunit = $this.closest('div').find('b').text();
        var priceperunitint=parseInt($priceperunit);

        
        var $price = $this.closest('div').find('span');
        var priceint=parseInt($price.text());
        priceint=priceperunitint*value;
        $price.text(priceint);

        //$("#total-prize").text("sdjkh");
        var previousproductsprize=parseInt($("span[name='productsprize']").text());
        var newproductsprize=previousproductsprize+priceperunitint;
        $("span[name='productsprize']").text(newproductsprize);

        //euiwfdu
        var previoustotalamount=parseInt($("b[name='totalamount']").text(""));
        newtotalamount=newproductsprize+100;
        if(newproductsprize==0)newtotalamount=0;
        $("b[name='totalamount']").text(newtotalamount);

        $("input[name='totalamountfinal']").val(newtotalamount);

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