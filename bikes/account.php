<?php
// session_start();
// include 'connect.php';
include 'top.php';
include 'header.php';


// query all user orders
// Get the user first
$username = $_SESSION['username'];
$getUser = "SELECT * from Users where username = '$username'";
$q = mysqli_query($conn , $getUser);
$user = mysqli_fetch_array($q);

$user_id = $user['id'];


// Get the orders
$orders_query = "SELECT Products.productId as productId, OrdersDetails.orderId as orderId,
    OrdersDetails.quantity, OrdersDetails.quantity, OrdersDetails.unitPrice, Products.*
    FROM OrdersDetails INNER JOIN Products ON Products.productId = OrdersDetails.product_id
    WHERE OrdersDetails.user_id = $user_id";


$res = mysqli_query($conn , $orders_query);
$orders = [];

while($row = mysqli_fetch_assoc($res)){
    array_push($orders, $row);
}


// update information
if(isset($_POST['update'])){
  $address = mysqli_real_escape_string($conn,$_POST['address']);
  $phone = mysqli_real_escape_string($conn,$_POST['phone']);
  $password = mysqli_real_escape_string($conn,$_POST['password']);

  // hash password
  if($password == ""){
      $update_q = "UPDATE Users set address ='$address' , phone ='$phone' ,  WHERE id = '$user_id'";
  }
  $password = password_hash($password , PASSWORD_DEFAULT);
  $update_q = "UPDATE Users set address ='$address' , phone ='$phone' , password ='$password'  WHERE id = '$user_id'";
  if(mysqli_query($conn , $update_q)){
    $_SESSION['done'] = "Updated successfully";
    echo "Updated successfully";
  }
  else{
    $_SESSION['undone'] = "Unable to update the results";
    echo "Unable to update the results".mysqli_error($conn);
    echo "<alert>mysqli_error($conn)</alert>";
  }
}



?>

<style>

  .edit-info{
    display:block;
  }
  .title{
    color: crimson;
  }
  h6{
    color: #777;
    text-transform: uppercase;
    font-size: 15px;
    letter-spacing: 1px;

  }
  .input{
    border: 0;
    border-bottom: 1px solid #3fb6a8;
    width: 80%;
    font-family: 'monserat';
    font-size: .9rem;
    padding: 7px 0;
    color: #070707;
    outline: none;

  }

  .btn{
    text-transform: uppercase;
    font-size: 15px;
    border: 0;
    color: #fff;
    background: #7ed386;
    padding: 7px 15px;
    cursor: pointer;
    margin-top: 15px;
  }
  .title{
    margin-top: 15px;
  }

</style>
<body>


<div class="contact-section section bg-white pt-120">
    <div class="container">
        <div class="row">
        <div class="col-xl-10 col-12 ml-auto mr-auto">
            <div class="contact-wrapper">
                <div class="row">
                    <div class="contact-info col-lg-5 col-12">
                        <h4 class="title">Personal information</h4>

                        <p><h6>Username</h6></p><input type="text" disabled class="input" name="" id="" value="<?echo $user['username']?>">
                        <p><h6>Email</h6></p><input type="email" disabled class="input" name="" id="" value="<?php echo $user['email']?>">

                        <p><h6>Phone</h6></p><input type="text" disabled class="input" name="" id="" value="<?echo $user['phone']?>">

                        <p><h6>Address</h6></p><input value="<?echo $user['address']?>" type="text" disabled class="input" name="" id="" placeholder="">

                        <!-- <a href="#" onclick="editInfo()" class="btn">Update</a> -->

                    </div>


                <div class="contact-form col-lg-7 col-12 ">
                    <div class="edit-info">
                        <h4 class="title">Update information</h4>
                        <form id="contact-form" action="" method="post">
                            <input type="text" name="address" placeholder="New address">
                            <input type="number" name="phone" placeholder="New phone number" >
                            <input type="password" name="password" placeholder="New password">

                            <input type="submit" value="Submit" name="update"  id="submit">

                        </form>
                    </div>


                 </div>
                 <div class="contact-info col-lg-12 col-12" style="margin-top: 40px;">
                    <div class="orders">
                        <p><h3 class="title">My orders</h3></p>
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
                            <?php foreach ($orders as $order){ ?>
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
                </div>
            </div>

        </div>


        </div>
    </div>
</div>


</div>
<!-- main boody div  end -->
<?php
include 'bottom.php';

?>
</body>

</html>
