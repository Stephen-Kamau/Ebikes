<?php
include 'top.php';
include 'header.php';

// query data if that id
if(isset($_GET['id'])){

  // get database
  $id = $_GET['id'];
  $sql_query = "SELECT * FROM Products WHERE productId='$id' LIMIT 1";

  $res = mysqli_query($conn , $sql_query);

  $data = mysqli_fetch_array($res);
  $id = $data['productId'];
  $price = $data['price'];
  $image =$data['image'];
  $epower = $data['Epower'];
  $mileage = $data['mileage'];
  $title = $data['title'];
  $desc = $data['description'];
?>
<!-- details start -->
    <div class="product-section section pt-110 pb-90">
        <div class="container">
          <div></div>
            <div class="row">
                <div class="col-lg-7 col-12 mb-30">

                    <!-- img -->
                    <div class="single-product-image product-image-slider fix">
                        <div class="single-image"><img src=<?php echo 'uploads/'.$image; ?> alt=""></div>
                    </div>


                </div>
                <div class="single-product-content col-lg-5 col-12 mb-30">
                  <br>
                  <br>
                  <br>
                    <h1 class="title">EBike</h1>
                    <span class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </span>

                    <span class="product-price">Price  : € <?php echo $price; ?></span>
                    <!-- details -->
                    <div class="order-details">
                      <ul>
                        <li><p>Title </p><p><?php echo $title; ?></p></li>
                        <li><p>Power </p><p><?php echo $epower; ?></p></li>
                        <li><p>speed </p><p><?php echo $mileage; ?>km/min</p></li>
                        <li><p>Milage</p><p><?php echo $mileage; ?>km/h</p></li>
                      </ul>
                    </div>
                    <div class="description">
                        <p class="text text-success">
                          <?php echo $desc; ?>
                        </p>
                    </div>

                    <!-- Qty selection -->
                    <div class="product-quantity-cart fix">
                        <div class="product-quantity">
                            <input type="text" disabled=true value="1" name="qty">
                        </div>
                        <button class="addToCart" onclick="addCartItem(
                            '<?php echo $id; ?>',
                            '<?php echo $title; ?>',
                            1,
                            <?php echo $price; ?>,
                            '<?php echo $image; ?>'
                        )">add to cart</button>

                        <!-- <button class="add-to-cart">add to cart</button> -->
                    </div>
                </div>
            </div>

        </div>
    </div><!-- Product Section End-->

<?php

}
else{
  echo "No Item Found";
}


?>



<?php
include 'footer.php';
include 'bottom.php';

?>
