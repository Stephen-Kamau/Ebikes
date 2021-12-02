<?php

if(isset($_POST['edit_product'])){
  // Edit
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $price = mysqli_real_escape_string($conn, $_POST['price']);
  // $description = mysqli_real_escape_string($conn, $_POST['description']);
  $id = mysqli_real_escape_string($conn, $_POST['id']);

  $sql = "UPDATE Products SET title='$title', price=$price WHERE productId='$id'";

  if(mysqli_query($conn, $sql)){
    // Edited
    $_SESSION['done'] = "Edited the data well";
    array_push($_SESSION['success'] , "Edited successfully");
    // echo "<script>alert('Edited successfully');</script>";
  }else{
    $_SESSION['undone'] = "failed to edit";
    array_push($_SESSION['success'] , "Failed to edit");
    // echo "<script>alert('Failed to edit');</script>";
  }
}

?>
