<?php
// include 'connect.php';

// credential..
$host = 'localhost';
$user ='steve';
$database='CAT2';
$pass="steve";
$conn  =mysqli_connect($host , $user , $pass);
mysqli_select_db($conn , $database);


// query all items from the product table

$query_res =[];
$sql_query = "SELECT * FROM Products";
$res_query = mysqli_query($conn , $sql_query);



if (isset($_POST['additem'])){
  $title = mysqli_real_escape_string($conn,$_POST['title']);
  $price = mysqli_real_escape_string($conn,$_POST['price']);
  $description = mysqli_real_escape_string($conn,$_POST['description']);
  $power = mysqli_real_escape_string($conn,$_POST['power']);
  $mileage = mysqli_real_escape_string($conn,$_POST['mileage']);
  $image = $_FILES['image']['name'];
  $image_tmp = $_FILES['image']['tmp_name'];
  // val img extensions
  $extensions = array("jpg","jpeg","png","gif");

  // select file extensions
  $imageExtension = strtolower(pathinfo($image,PATHINFO_EXTENSION));

  if(in_array($imageExtension,$extensions)){

    // move image to a Directory
    if(move_uploaded_file($image_tmp,'uploads/'.$image)){

      $pro_id = uniqid('product');
      // insert the details
      $insertDetails = "INSERT into Products(productId ,title , price ,description , Epower , mileage ,image) values('$pro_id','$title','$price','$description' ,'$power' ,'$mileage' , '$image')";
      if(mysqli_query($conn , $insertDetails)){
        // echo "product added successfully!";
        $_SESSION['done'] = "Added product well";
        array_push($_SESSION['success'] , "Added product well");
        header("location:dashboard.php");
      }
      else{
        $_SESSION['undone'] = "Unable to add product";
        array_push($_SESSION['errors'] , "unable to add items");
        header("location:dashboard.php");
      }

    }
    else{
      $_SESSION['undone'] = "Unable to save the image";
      array_push($_SESSION['errors'] , "Unable to save image in local setber");
    }
  }
  else{
    $_SESSION['undone'] = "Error while uploading file";
    array_push($_SESSION['errors'] , "Error in uploading file");
  }

}
 ?>
