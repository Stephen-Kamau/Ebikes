<?php
// session_start();
include ('connect.php');

if(isset($_POST['cart'])){
    // Get the user
    $username = $_SESSION['username'];
    $getUser = "SELECT * from Users where username = '$username'";
    $q = mysqli_query($conn , $getUser);
    $user = mysqli_fetch_array($q);

    $user_id = $user['id'];

    $cart_items = $_POST['cart'];

    // Cart is json encoded
    $cart_items = json_decode($cart_items, true);


    // create an order first
    $orderID = uniqid('orders');
    $myorder = "INSERT INTO Orders(orderId , user_id) VALUES('$orderID' , '$user_id')";



    foreach($cart_items as $item){
        $detailsId = uniqid('details');
        $product_id = $item['productId'];
        $quantity = $item['quantity'];
        $unit_price = $item['unitPrice'];

        $sql = "INSERT INTO OrdersDetails(detailsId ,orderId, user_id,quantity, unitPrice , product_id) VALUES('$detailsId' ,'$orderID', '$user_id', '$quantity', '$unit_price','$product_id')";

        if(!mysqli_query($conn, $sql)){
          echo "Error    ".mysqli_error($conn);
            echo false;
            return;
        }
    }
    mysqli_query($conn , $myorder);
    echo true;
    return;

}

echo 'GET method not allowed';

?>
