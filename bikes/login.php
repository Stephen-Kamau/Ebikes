
<?php
// session_start();
    include ('connect.php');
    if(!isset($_SESSION['attempts'])){
      $_SESSION['attempts'] = 0;
    }

    else{
      if($_SESSION['attempts'] >3){
        $_SESSION['undone'] = "You cannot login try again after 10 minutes";
        array_push($_SESSION['errors'] , "You cannot login again ");
        header("location:index.php");
      }
    }
    if (isset($_POST['signin']))
    {
        $user = mysqli_real_escape_string($conn,$_POST['username']);
        $pass = mysqli_real_escape_string($conn,$_POST['password']);

        //check if username is found
        $check = "SELECT * from Users  where username = '$user' LIMIT 1";

        //query the results
        $results = mysqli_query($conn , $check);
        if(!$results){
          $_SESSION['undone'] = "Unable to allowe login Bad request";
          array_push($_SESSION['errors'] , "Unable to allow login bad request ");
           echo "Unable to run the query";
        }
        //create the record rows
        $row =mysqli_num_rows($results);
        $resToArray = mysqli_fetch_array($results , MYSQLI_ASSOC);

        //check number of rows to be one
        if ($row == 1)
        {
            // check password match
            $hash = $resToArray['password'];
            if(!password_verify($pass , $hash)){
              $_SESSION['attempts'] =$_SESSION['attempts']+1;
              $_SESSION['undone'] = "Wrong Password";
              array_push($_SESSION['errors'] , "Wrong password");
            }
            else{
              $getUser = "SELECT * from Users where username = '$user'";
              $exUser = mysqli_query($conn , $getUser);
              $numRow = mysqli_fetch_array($exUser);
              $lastOnline = $numRow['lastOnline'];

              // check if the time period is over one year
                if(strtotime($lastOnline) < strtotime('-1 year') ){
                  $query_del = "DELETE FROM Users WHERE username = '$user'";
                  mysqli_query($conn , $query_del);
                  $_SESSION['undone'] = "You have a more than a year activeness Please reactivate your account";
                  array_push($_SESSION['errors'] , "You have a more than a year activeness Please reactivate your account");

                }else{

                  // update the last lastOnline date

                  $update = "UPDATE Users set lastOnline = time() WHERE username = '$user'";
                  mysqli_query($conn , $update);

                  // get a session active
                  $_SESSION['username'] = $user;
                  $username = $_SESSION['username'];

                  // success session
                  $success = $_SESSION['success'];
                  array_push($success , "Logged well");

                  $_SESSION['done'] = "Logged in well";
                  // check if it is an admin logged in
                  if($numRow['isAdmin'] == 1){
                    $_SESSION['admin']= 'admin';
                  }

                  header("location:index.php");

                  // echo "<script>window.open('index.php,'_self')</script>";
                }
            }
       	}
       	else{
          $_SESSION['attempts']=$_SESSION['attempts']+1;
          $_SESSION['undone'] = "Username not found";
          array_push($_SESSION['errors'] , "Username not found");
       	}
    }

?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <?php  include 'top.php';  ?>

    <style media="screen">
          body{
            max-width: 550px;
            margin: 0 auto;
            margin-top: 4%;
          }
          .header-logo{
            text-align: center;
            align-items: center;
            height: 100px;
            margin-left: 12%;
          }
          .header-logo h2{
            font-size: 30px;
            min-width: 200px;
          }
    </style>
  </head>
<body>
    <div class="container">
        <div class="row">
          <div class="header-logo col-md-4 col-12">
              <a href="index.php" class="logo"><img src="img/logo.png" alt="logo" class="logo"></a>
              <h2>E-Cycle</h2>
          </div>
        </div>
        <div class ="signin">
          <?php
          $errors = $_SESSION['errors'];
          if(count($errors)>0){
            echo "
            <div class='alert alert-danger' role='alert'>
            <p>$errors[0]</p>
            </div>

            ";
            unset ($_SESSION["errors"]);
            unset ($_SESSION["undone"]);
        }

        $success = $_SESSION['success'];
        if(count($success)>0){
          echo "
          <div class='alert alert-success' role='alert'>
          <p>$success[0]</p>
          </div>

          ";
          unset ($_SESSION["done"]);
      }


          ?>
            <form action="login.php" method="post">
                <div class="form-header" style="font-size:30px; text-allign:center;margin-left:100px;">
                    <b>Login to E-Cycle</b>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" autocomplete="off" required="required">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="Password" name="password" class="form-control" autocomplete="off" required="required">
                </div>

                <div class="form-group">
                    <label class="">Forgot Password? <a href="forgotPassword.php"> <b>click here</b></a></label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-lg" name="signin" id="log">SignIn</button>
                </div>
            </form>
            <div class="text-center small" style="color: #600300;">Not Regestered? <a href="signup.php"><b>signup</b></a></div>
        </div>
      </div>

<?php include 'bottom.php'; ?>
</body>

</html>
