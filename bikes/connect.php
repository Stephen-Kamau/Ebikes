<?php
session_start();

// credential..
$host = 'localhost';
$user ='steve';
$database='CAT2';
$pass="steve";


$_SESSION['errors'] = [];
$_SESSION['succ'] = [];




// $errors
$errors =[];
$success =[];


// create a connection variable
$conn  =mysqli_connect($host , $user , $pass);
// check if connection was successfully
if(!$conn){
  echo "Cannot connect to db ".mysqli_connect_error();
}
else{

  // create database
  $cat1 = "CREATE DATABASE  IF NOT EXISTS CAT2";

  if (!mysqli_query($conn , $cat1)){
    echo "Unable to create db <br>";
  }
  else{
    // select database
    mysqli_select_db($conn , $database);

    // create table
    $tbl1 = "CREATE TABLE IF NOT EXISTS Users(id int auto_increment,phone varchar(100),lastOnline TIMESTAMP ,dob TIMESTAMP , username varchar(200) UNIQUE, address varchar(250) not null ,email varchar(100) UNIQUE,country varchar(100) not null ,gender varchar(25) not null , password varchar(255) not null,created TIMESTAMP DEFAULT CURRENT_TIMESTAMP , isAdmin int DEFAULT 0 ,primary key(id))";

    // execute
    if (!mysqli_query($conn , $tbl1)){
      echo "Unable to create table <br>".mysqli_error($conn);
      die("Unable to create thge database");
    }




    // create product table
    $tbl2 = "CREATE TABLE IF NOT EXISTS Products(productId varchar(500), title varchar(1000) not null ,description varchar(1000) ,price varchar(100) not null ,mileage varchar(25) not null , Epower varchar(100) not null,created TIMESTAMP DEFAULT CURRENT_TIMESTAMP , image  BLOB  ,primary key(productId))";

    // execute
    if (!mysqli_query($conn , $tbl2)){
      echo "Unable to create product table <br>".mysqli_error($conn);
      die("Unable to create thge database");
    }

    // create orders table
    $tbl3 = "CREATE TABLE IF NOT EXISTS Orders(orderId varchar(500), user_id int not null ,orderedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,primary key(orderId))";

    // execute
    if (!mysqli_query($conn , $tbl3)){
      echo "Unable to create orders table <br>".mysqli_error($conn);
      die("Unable to create thge database");
    }


    // create ordersDetails table
    $tbl4 = "CREATE TABLE IF NOT EXISTS OrdersDetails(detailsId varchar(500), orderId varchar(500), product_id varchar(500) not null, user_id int not null ,quantity int not null , unitPrice int not null,orderedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,primary key(detailsId))";


    // execute
    if (!mysqli_query($conn , $tbl4)){
      echo "Unable to create orders details table <br>".mysqli_error($conn);
      die("Unable to create thge database");
    }

    // create FAQS table
    $tbl5 = "CREATE TABLE IF NOT EXISTS Faqs(id int unique auto_increment , name varchar(100) not null, email varchar(100)  , message varchar(500) , answer varchar(500) ,addedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,primary key(id))";

    // execute
    if (!mysqli_query($conn , $tbl5)){
      echo "Unable to create FAQs table <br>".mysqli_error($conn);
      die("Unable to create thge database");
      return;
    }


    $tbl6 = "CREATE TABLE IF NOT EXISTS Testimonies(id int unique auto_increment , name varchar(300) , testimony varchar(1000) ,primary key(id) )";
    // execute
    if (!mysqli_query($conn , $tbl6)){
      echo "Unable to create testimonies table table <br>".mysqli_error($conn);
      die("Unable to create thge database");
      return;
    }

    // create admin account
    // $admin_pass = password_hash("admin" , PASSWORD_DEFAULT);
    // $insert_admin = "INSERT into Users (username ,email , password ,
    //   country , gender , address , phone)
    //   values('admin','admin@gmail.com','$admin_pass','Kenya' ,
    //     'N/A'  , 'Nairobi' , '+25579189322')";
    //   if (!mysqli_query($conn, $insert_admin)) {
    //     // when not ruuned Successfully...
    //     echo "Unable to insert admin";
    //   }

    // ;
  }


}
