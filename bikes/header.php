<?php

// session_start();
include ('connect.php');





?>

<!-- button -->
<style media="screen">
  .addToCart {
    background-color: #555555;
    width: 150px;
    border-radius: 12px;
    height: 44px;
    color: #c1c1c1;
    font-size: 30;
    font-weight: bold;
  }
</style>
<div class="header-section section">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header-top-wrapper">
                        <div class="row">
                            <div class="header-logo col-md-4 col-12">
                                <a href="" class="logo"><img src="img/logo.png" alt="logo" class="logo"></a>
                                <h1>E-Cycle</h1>
                            </div>
                            <div class="account-menu col-md-8 col-12">
                                <ul>
                                  <?php
                                  if (isset($_SESSION['username']) )  {
                                    ?>
                                    <li><a href="logout.php" class="text-danger" style="color:red; font-size:27px;">Logout</a></li>
                                    <li class="text-danger strong">
                                      <a href="account.php" style="color:red; font-size:27px;">My Account
                                        <?php
                                        $username = $_SESSION['username'];
                                        // echo $username;

                                    }
                                      ?>
                                    </a>


                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom section">
        <div class="container">
            <div class="row">
                <div class="header-bottom-wrapper text-center col">
                    <div class="header-bottom-logo">
                        <a href="index.php" class="logo"><img src="img/logo.png" alt="logo"></a>
                    </div>
                    <nav id="main-menu" class="main-menu">
                        <ul>
                            <li class="active"><a href="index.php">home</a></li>
                            <li><a href="shop.php">shop</a></li>
                            <li><a href="contact.php">contact</a></li>
                            <?php
                            if(isset($_SESSION['admin'])){
                              echo '<li><a href="dashboard.php">Admin</a></li>';

                            }
                            ?>


                            <li><a href="" data-toggle="dropdown">  <i class="fa fa-shopping-cart"  id="MyCart"></i> <sup><span id="cartNum" class="num"></span></sup></a>
                              <!-- use javascript and some storage methods to store some values for cart -->

                                <div class="mini-cart-brief dropdown-menu text-left">

                                    <div class="all-cart-product clearfix" id="AllCarts" style="">
                                      <!-- <script type="text/javascript">
                                        const presentItems = JSON.parse(localStorage.getItem('carts'));

                                      </script> -->
                                    </div>
                                    <!-- end the div fot display cart -->
                                    <div class="cart-totals">
                                        <h5>Total £<span id="totalPrice"></span></h5>
                                    </div>
                                    <!-- end -->
                                    <div class="cart-bottom  clearfix">
                                      <?php
                                      if (!isset($_SESSION['username'])) {

                                        echo '<a href="login.php">Please Login To continue</a>';
                                      }
                                      else{
                                        echo '<a href="#" onclick="checkout()">Check out</a>';
                                      }
                                      ?>
                                    </div>
                                </div>

                                <!-- end the cart javascript -->
                            </li>

                        </ul>
                    </nav>

                    <div class="mobile-menu section d-md-none"></div>


                    <div>
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

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

 ?>
