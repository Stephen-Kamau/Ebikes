
<?php
include 'top.php';
include 'server.php';
?>
<body>

<!-- main body.. -->
<div id="main-wrapper" class="section">
  <?php
  include 'header.php';
  ?>

  <!-- header start -->

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
                     <a href="details.php?id=<?php echo $id; ?>" class="img"><img style="height:300px;" src=<?php echo 'uploads/'.$image; ?> alt="Product"></a>

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


<!-- fooiter -->
<?php
include 'footer.php';
 ?>
</div>
<?php
include 'bottom.php';

?>
</body>

</html>
