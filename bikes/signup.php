<?php

include ('connect.php');

if (isset($_POST['signup'])) {
	//filter the data and create variables to hold them
	  	$username = mysqli_real_escape_string($conn,$_POST['username']);
	  	$email = mysqli_real_escape_string($conn,$_POST['email']);
			$gender = mysqli_real_escape_string($conn,$_POST['gender']);
			$country = mysqli_real_escape_string($conn,$_POST['country']);
			$dob = mysqli_real_escape_string($conn,$_POST['dob']);
			$address = mysqli_real_escape_string($conn,$_POST['address']);
			$phone = mysqli_real_escape_string($conn,$_POST['phone']);
			$password = mysqli_real_escape_string($conn,$_POST['password']);
	  	$password1 = mysqli_real_escape_string($conn,$_POST['cpassword']);
      $login = "offline";

      if($password != $password1){
				$_SESSION['undone'] = "Password Does not match";
				array_push($_SESSION['errors'] , "Password Doesnt Match");
        echo "<script>window.open('signup.php', '_self')</script>";
      }


			if (!empty($name)) {
				$_SESSION['undone'] = "Username is empty";
				array_push($_SESSION['errors'] , "Username is empty");
    	}

  		// if (strlen($password) < 8) {
  		// echo "<script>alert('Password must be over 8 characters long')</script>";
  	  // }

  	$lookEmail = "SELECT * from Users where email = '$email'";
  	$query = mysqli_query($conn,$lookEmail);
    $numRow = mysqli_num_rows($query);

    if ($numRow >1){
			$_SESSION['undone'] = "Email already used";
			array_push($_SESSION['errors'] , "Email already used");
       // echo "<script>alert('Email Already exists')</script>";
       echo "<script>window.open('signup.php', '_self')</script>";
       exit();
    }
    else{
			$password = password_hash($password ,PASSWORD_DEFAULT);
    	$insert = "INSERT into Users (username ,email , password ,
        country , gender , dob , address , phone)
        values('$username','$email','$password','$country' ,
          '$gender' , '$dob' , '$address' , '$phone')";

    	$query = mysqli_query($conn, $insert);
    	if ($query){
				$_SESSION['done'] = "You have successfully Registered";
				array_push($_SESSION['success'] , "You Have Successfully regeesterd into the E-cycle..");
    		echo "<script>window.open('login.php', '_self')</script>";
    	}
    	else{
				$_SESSION['undone'] = "Registeration Failed .. Please try again";
				array_push($_SESSION['errors'] , "Regestration Failed...An error occured please try again");

    	}
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
          margin-left: 7%;
				}
				.header-logo h2{
					font-size: 30px;
					min-width: 150px;
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
			<div class ="signup">
				<?php
				if (isset($_SESSION['undone'])) {
					$error = $_SESSION['undone'];
					echo "
					<div class='alert alert-danger' role='alert'>
					<p>$error </p>
					</div>
					";
					unset ($_SESSION["undone"]);
				}




			if (isset($_SESSION['done'])) {
				$success = $_SESSION['done'];
				echo "
				<div class='alert alert-success' role='alert'>
				<p>$success </p>
				</div>
				";
				unset ($_SESSION["done"]);
			}


		?>
		    <form action="signup.php" method="post">
		        <div class="form-header">
		            <p style="font-size:30px; text-allign:center;margin-left:100px;"><b>Register to E-cycle</b></p>
		        </div>
		        <div class="form-group">
		            <label>Username</label>
		            <input type="text" name="username" id="username" class="form-control" autocomplete="off" required="required">
		        </div>
		        <div class="form-group">
		            <label>Email</label>
		            <input type="email" id="email" name="email" class="form-control" autocomplete="off" required="required">
		        </div>
						<div class="form-group">
								<label>Phone</label>
								<input type="number" id="phone" name="phone" class="form-control" autocomplete="off" required="required">
						</div>
		        <div class="form-group">
		            <label>Password</label>
		            <input type="Password" id="pass1" name="password" class="form-control" autocomplete="off" required="required">
		        </div>
		        <div class="form-group">
		            <label>Confirm Password</label>
		            <input type="Password"  id="pass2" name="cpassword" class="form-control" autocomplete="off" required="required">
		        </div>
					<div class="form-group">
			        <label>Enter Postal Address</label>
			        <input type="text" name="address" id="Address" class="form-control" autocomplete="off" required="required">
			    </div>
					<div class="form-group">
			      <label>Enter Date of Birth</label>
						<input type="date" id="dob" name="dob" class="form-control" value="2021-07-22"  min="1924-01-01" max="2021-07-31">
			    </div>
	        <div class="form-group">
	            <label>Country</label>
	            <select class="form-control" name="country" required="required">
	                <option disabled="disabled">Select country</option>
	                <option value="kenya">Kenya</option>
	                <option value="uganda">Uganda</option>
	                <option value="Ethiopia">Ethiopia</option>
	                <option value="sudan">Sudan</option>
	            </select>
	       </div>
        <div class="form-group">
            <label>Gender</label>
            <select class="form-control" name="gender" required="required">
                <option disabled="disabled">Select gender</option>
                <option value="Male">Male</option>
                <option value="Female">Femail</option>
                <option value="Others">Other</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block btn-lg" name="signup">Sign UP</button>
        </div>
		</form>
			<div class="text-center small" style="color:black;">
				All ready have an account? <a href="login.php"><b>Login</b></div>
			</div>

	</div>

<?php include 'bottom.php'; ?>
</body>

</html>
