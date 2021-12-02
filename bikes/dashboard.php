<?
session_start();


var_dump($_SESSION);
if(!isset($_SESSION['admin'])){
  header("location:index.php");
}

include 'top.php';
include 'header.php';
// include 'server.php';

$products = [];
$products_query = "SELECT * FROM Products";
$res = mysqli_query($conn, $products_query);

while($product = mysqli_fetch_array($res)){
  array_push($products, $product);
}

// statistics
$statistics_query = "SELECT
  (SELECT sum(unitPrice * quantity) FROM `OrdersDetails`) as total_sales,
  (SELECT count(*) FROM Products) as products";

$res = mysqli_query($conn, $statistics_query);
$stats = mysqli_fetch_array($res);

include "edit_product.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="stylecard.css">
  <title>Document</title>
</head>
<body>
    <div class="product-section section pt-110 pb-90 row">
      <!-- <p style="text-align:center;"><b>The E-cycle DashBoard</b></p> -->
      <div class="container col-6">
        <div class="main-container">
          <div class="heading">
            <h1><b>our statistics   <?php echo ""; ?></p></h1>
          </div>
          <?php

           ?>
          <div class="cards">
            <div class="card card-1">

              <h2 class="card__title">$ <?=$stats['total_sales']?></h2>
              <p class="card__apply">
                <p>Sales</p>
              </p>
            </div>
            <div class="card card-2">
              <h2 class="card__title"> <?=$stats['products']?></h2>
              <p class="card__apply">
                <p>Products</p>
              </p>
            </div>
          </div>
        </div>
      </div>


      <div class="container col-6">
        <!-- <div class="single-product-content col-lg-6 col-6 mb-30"?> -->
            <span class="product-price"></span>
            <!-- details -->
            <div class="order-details">

              <form  style="margin:25px;"class="" action="server.php" method="POST" enctype="multipart/form-data">
                <br>
                <br>
                <p><b>Add New Products</p></b>
                <br>
                <div class="form-group">
                  <label for="price">Price: </label>
                <input type="number" name="price" class="form-control" placeholder="" value="">
                </div>
                <div class="form-group">
                <label for="title">Title: </label>
                <input type="text" name="title" class="form-control" placeholder="" value="">
                 </div>
                 <div class="form-group">
                 <label for="description">description: </label>
                <input type="text" name="description" class="form-control" placeholder="" value="">
                </div>
                <div class="form-group">
                <label for="power">power: </label>
                <input type="number" name="power" class="form-control" placeholder="" value="">
                <div class="form-group">
                 </div>
                 <div class="form-group">
                 <label for="mileage">Mileage: </label>
                <input type="number" name="mileage" class="form-control" placeholder="" value="">
                </div>
                <div class="form-group">
                <label for="Image">Upload Image: </label>
                <input type="file" name="image" class="form-control" placeholder="" value="">
                 </div>

                <br>
                <button class="btn btn-success" name="additem" type="submit">Add Item</button>
              </form>

            </div>

        </div>
      <!-- </div> -->

      </div>


    </div>

    <div class="row container">
      <div class="contact-info col-lg-6 col-6" style="margin-top: 40px;">
         <div class="orders">
           <?php

           // Get all orders
           $all_orders_query = "SELECT Products.productId as productId, OrdersDetails.orderId as orderId,
               OrdersDetails.quantity, OrdersDetails.quantity, OrdersDetails.unitPrice, Products.*
               FROM OrdersDetails INNER JOIN Products ON Products.productId = OrdersDetails.product_id";


           $res = mysqli_query($conn , $all_orders_query);
           if(!$res){
             echo "An error  ".mysqli_error($conn);
           }
           $all_orders = [];

           while($row = mysqli_fetch_assoc($res)){
               array_push($all_orders, $row);
           }

            ?>
             <p><h3 class="title">All Orders</h3></p>
             <table class="table">
             <thead>
                 <tr>
                 <th scope="col">Order No</th>
                 <th scope="col">Product name</th>
                 <th scope="col">quantity</th>
                 <th scope="col">Unit Price</th>
                 <th scope="col">Total Price</th>
                 </tr>
             </thead>
             <tbody>
               <?php foreach ($all_orders as $order){ ?>
               <tr>
               <th scope="row"><?= $order['orderId'] ?></th>
               <td><?= $order['title'] ?></td>
               <td><?= $order['quantity'] ?></td>
               <td>$<?= $order['unitPrice'] ?></td>
               <td>$<?= ($order['unitPrice'] * $order['quantity']) ?></td>
               </tr>
               <?php } ?>
             </tbody>
             </table>

         </div>
      </div>

    <div class="contact-info col-lg-6 col-6" style="margin-top: 40px;">
       <div class="orders">
         <?php

         // Get all orders
         $all_orders_query = "SELECT Products.productId as productId, OrdersDetails.orderId as orderId,
             OrdersDetails.quantity, OrdersDetails.quantity, OrdersDetails.unitPrice, Products.*
             FROM OrdersDetails INNER JOIN Products ON Products.productId = OrdersDetails.product_id";


         $res = mysqli_query($conn , $all_orders_query);
         if(!$res){
           echo "An error  ".mysqli_error($conn);
         }
         $all_orders = [];

         while($row = mysqli_fetch_assoc($res)){
             array_push($all_orders, $row);
         }

          ?>
           <p><h3 class="title">Products</h3></p>
           <table class="table">
           <thead>
               <tr>
               <th scope="col">Image</th>
               <th scope="col">Product name</th>
               <th scope="col">Description</th>
               <th scope="col">Price</th>
               <th></th>
               </tr>
           </thead>
           <tbody>
             <?php foreach ($products as $product){ ?>
             <tr>
               <td><img width="100px" height="100px" src="uploads/<?= $product['image'] ?>"></td>
             <td><?= $product['title'] ?></td>
             <td><?= $product['description'] ?></td>
             <td>$<?= $order['price'] ?></td>
             <td>
               <a href="#" onclick="editProduct(this)" class="btn btn-small btn-primary" data-product='{
                 "title":"<?= $product['title'] ?>",
                 "id":"<?= $product['productId'] ?>",
                 "price":<?= $product['price'] ?>,
                 "image":"<?= $product['image'] ?>"
               }'>Edit</a>
             </td>
             </tr>
             <?php } ?>
           </tbody>
           </table>

       </div>
    </div>


    </div>
<?php
include 'footer.php';
include 'bottom.php';
?>

<div class="modal" id="edit">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">

        <form  style="margin:25px;" class="" action="" method="POST" enctype="multipart/form-data">
          <br>
          <br>
          <p><b>Edit Product</p></b>
          <br>
          <div class="form-group">
            <label for="price">Title: </label>
          <input type="text" name="title" id="edit_title" class="form-control" placeholder="" value="">
          </div>

          <div class="form-group">
            <label for="price">Price: </label>
          <input type="number" name="price" id="edit_price" class="form-control" placeholder="" value="">
          </div>

           <input type="hidden" name="id" id="edit_id" class="form-control" placeholder="" value="">

          <br>
          <button class="btn btn-success" name="edit_product" value="edit" type="submit">Update</button>
        </form>

      </div>
    </div>
  </div>
</div>

<script>
function editProduct(e){
  var product = e.dataset.product;
  product = JSON.parse(product);

  $('#edit_title').val(product.title);
  $('#edit_price').val(product.price);
  $('#edit_id').val(product.id);

  $('#edit').toggle();

  console.log(product);
}
</script>
