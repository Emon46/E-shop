<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopping Cart</title>

    <link rel="stylesheet" href="cartstyle.css" type="text/css" media="screen" title="no title" charset="utf-8">
    <script src="https://code.jquery.com/jquery-2.2.4.js" charset="utf-8"></script>
    <meta name="robots" content="noindex,follow" />
  </head>
  <body>
    <div class="shopping-cart">
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
                <img src="item-1.png" alt="" />
              </div>

              <div class="description">
                <span>Pendrive</span>
                <span>Brand : Samsung</span>
                <span>549 (per-unit)</span>
              </div>

              <div class="quantity">
                <button class="plus-btn" type="button" name="button">
                  <img src="plus.svg" alt="" />
                </button>
                <input type="text" name="name" value="0">
                <button class="minus-btn" type="button" name="button">
                  <img src="minus.svg" alt="" />
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
                <img src="item-2.png" alt=""/>
              </div>

              <div class="description">
                <span>Maison Margiela</span>
                <span>Future Sneakers</span>
                <span>549 (per-unit)</span>
              </div>

              <div class="quantity">
                <button class="plus-btn" type="button" name="button">
                  <img src="plus.svg" alt="" />
                </button>
                <input type="text" name="name" value="0">
                <button class="minus-btn" type="button" name="button">
                  <img src="minus.svg" alt="" />
                </button>
              </div>

              <div class="total-price">0</div>
          </div>


          <!-- Product #3 -->
          <div class="item">
              <div class="buttons">
                <span class="delete-btn"></span>
                <span class="like-btn"></span>
              </div>

              <div class="image">
                <img src="item-3.png" alt="" />
              </div>

              <div class="description">
                <span>Our Legacy</span>
                <span>Brushed Scarf</span>
                <span>549 (per-unit)</span>
              </div>

              <div class="quantity">
                <button class="plus-btn" type="button" name="button">
                  <img src="plus.svg" alt="" />
                </button>
                <input type="text" name="name" value="0">
                <button class="minus-btn" type="button" name="button">
                  <img src="minus.svg" alt="" />
                </button>
              </div>

              <div class="total-price">0</div>
          </div>

          
          <!-- //total #1 -->
          <div class="item">
               <div class="description">
                <span> products prize</span>
                <div style="width: 83px ,text-align: center;;">0</div>
              </div>
              <div class="description">
                <span></span>
              </div>
               <div class="description">
                <span>delivery Cost</span>
                <div style="width: 83px ;text-align: center;;">100</div>
              </div>

              <div class="description">
                <span></span>
              </div>
              <div class="description">
                <span>Total amount </span>
                <div style="width: 83px ;text-align: center;">0</div>
              </div>
          </div>
          <button  class="_btn checkout-btn entypo-forward" style="width:100px; margin-left:340px;">Checkout</button>
    </div>

    <script type="text/javascript">
      $('.minus-btn').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var $input = $this.closest('div').find('input');
        var value = parseInt($input.val());

        if (value > 1) {
          value = value - 1;
        } else {
          value = 0;
        }

        $input.val(value);

        var $price=$this.parent().next();
        var priceint=parseInt($price.text());
        priceint=priceint*value;
        $this.parent().next().text(priceint);


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

        var $price=$this.parent().next();
        var priceint=parseInt($price.text());
        priceint=priceint*value;
        $this.parent().next().text(priceint);
      });

      $('.like-btn').on('click', function() {
        $(this).toggleClass('is-active');
      });
    </script>
  </body>
</html>
