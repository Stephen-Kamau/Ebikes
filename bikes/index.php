
<?php
include 'top.php';
include 'server.php';
?>
<body>

<!-- main body.. -->
<div id="main-wrapper" class="section">

  <!-- header start -->
  <?php
  include 'header.php';
   ?>
    <!-- header end -->
    <div class="hero-slider section fix">
        <div class="hero-item" style="background-image: url(img/product/7.jpg)">
            <div class="hero-content text-center m-auto">
                <h2>Save 15%</h2>
                <h1>Flash Sale</h1>
                <p>There are many variations of electric bikes, get the chance to enjoy bike riding like never before, get ready for time of your life.</p>
                <!-- check against session if someone is logined -->
                <?php
                if (!isset($_SESSION['username'])) {
                  echo '<a href="login.php" style="margin-right:20px">SignIn</a>';
                }
                ?>
                <a class="btn-full" href="#">Shop</a>
            </div>
        </div>
    </div>
    <div class="product-section section pt-70 pb-60">
        <div class="container">
            <div class="row">
                <div class="section-title text-center col mb-60">
                    <h1>Products</h1>
                </div>
            </div>
            <div class="row">

                <?php
                while ($row = mysqli_fetch_array($res_query))
                {
                  $image =  $row["image"];
                  $id = $row['productId'];
                  $desc = $row["description"];
                  $price = $row['price'];
                  $title = $row['title'];
                  $mileage = $row['mileage'];
                  $epower = $row['Epower'];


                  ?>
                     <div class="col-lg-4 col-md-6 col-12 mb-60">
                     <div class="product">
                     <div class="image">
                     <a href="details.php?id=<?php echo $id; ?>" class="img">
                       <img style="height:300px;" src=<?php echo 'uploads/'.$image; ?>  alt="Product"></a>

                     </div>
                     <div class="content">
                     <div class="head fix">
                     <div class="title-category float-left">
                     <h5 class="title"><a href="details.php?id=<?php echo $id; ?>"><?php echo $title; ?></a></h5>
                     </div>
                     <div class="price float-right">
                     <span class="new">$<?php echo $price; ?></span>
                     </div>
                     </div>
                     <div class="action-button fix">
                        <button class="addToCart" onclick="addCartItem('<?php echo $id; ?>',
                            '<?php echo $title; ?>',
                            1,
                            <?php echo $price; ?>,
                            '<?php echo $image; ?>'
                        )">add to cart</button>
                     </div>
                     </div>
                     </div>
                     </div>
                <?php
                }
                ?>

            </div>
        </div>
    </div>


    <!-- testimonials -->
    <div class="testimonial-section section bg-gray pt-100 pb-65" >
        <div class="container">
            <div class="row">
                <div class="section-title text-center col mb-60">
                    <h1>Customer Reviews</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-10 col-12 ml-auto mr-auto">
                    <div class="testimonial-slider text-center">
                        <div class="single-testimonial">
                            <img src="img/testimonial/1.jpg" alt="customer">
                            <p>Quality bikes, I have been using mine for about an year and haven't noticed any decline in the motors performance .</p>
                            <h5>Betty Moore</h5>
                        </div>
                        <div class="single-testimonial">
                            <img src="img/testimonial/1.jpg" alt="customer">
                            <p>Exceptional delivery time and product quality.</p>
                            <h5>John Doe</h5>
                        </div>
                        <div class="single-testimonial">
                            <img src="img/testimonial/1.jpg" alt="customer">
                            <p>Nice user interface and a very responsive shopping page.</p>
                            <h5>Forest Gump</h5>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end of testimonies -->

<!-- fooiter -->
<?php
include 'footer.php';
 ?>
    <!-- footer end -->

</div>
<!-- main boody div  end -->
<?php
include 'bottom.php';

?>
</body>

</html>
