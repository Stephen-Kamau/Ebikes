<?php
include 'top.php';

include ('connect.php');

// faq container
$faq = [];


if (isset($_POST['faq_submit'])) {
	  	$name = mysqli_real_escape_string($conn,$_POST['name']);
	  	$email = mysqli_real_escape_string($conn,$_POST['email']);
			$message = mysqli_real_escape_string($conn,$_POST['message']);
      $answer = "Message Not answered Yet";

      // insert
      $query = "INSERT INTO Faqs(name , email , message , answer) VALUES('$name' , '$email' , '$message' , '$answer')";
      if(mysqli_query($conn , $query)){
				$_SESSION['done'] = "Message send successfully";
        array_push($_SESSION['success'] , "Send successfully");

        $q = "SELECT * FROM Faqs";
        $res = mysqli_query($conn , $q);
        if($res){
        while($row = mysqli_fetch_array($res)){
          if($row['answer'] != $answer){
            array_push($faq , $row);
          }
        }
        }
      }
      else{
				$_SESSION['undone'] = "Unable to add your QUESTION: ";
        array_push($_SESSION['errors'] , "Unable to add");
        // echo "
        //     <div class='alert alert-danger'>
        //     <strong>Not added yet  mysqli_error($conn) </strong></div>";
        // return;
      }
}

// arra []

?>


<body>
    <?php

    include 'header.php';
    ?>
    <h1>contact us</h1>


   <!-- Page Banner Section Start-->
    <div class="page-banner-section section" style="background-image: url(img/contact.jpg)">
        <div class="container">
            <div class="row">
                 <!--Page Title Start-->
                <div class="page-title text-center col">
                    <h1>contact us</h1>
                </div> <!--Page Title End -->

            </div>
        </div>
    </div><!-- Page Banner Section End-->


    <!-- Contact Section Start-->

    <div class="contact-section section bg-white pt-120">
        <div class="container">
            <div class="row">

                <div class="col-xl-10 col-12 ml-auto mr-auto">

                    <div class="contact-wrapper">
                        <div class="row">

                            <div class="contact-info col-lg-5 col-12">
                            <div class="FAQS">
                                <p><h3>FAQS</h3></p>

                                <?php

                                for ($i=0; $i <count($faq) ; $i++) {
                                echo "
                                <p>
                                  <b>{$faq[$i]['message']}</b>
                                  {$faq[$i]['answer']}
                                </p>";
                                }

                                 ?>
                             </div>
                             <p><h4 class="title">Contact Info</h4></p>
                             <ul>
                                 <li><span>Address:</span> ur address goes here,street Crossroad 123</li>
                                 <li><span>Phone:</span> +99 859 658 589 . +69 587 456 25</li>
                                 <li><span>Eax:</span> +55 784 7585 . + 985 698 586</li>
                                 <li><span>Email:</span> e-cycle@email.com</li>
                             </ul>

                            </div>
                            <div class="contact-form col-lg-7 col-12">
                                <h4 class="title">Send Your Massage</h4>
                                <form id="contact-form" method="post" action="">
                                    <input type="text" name="name" required  placeholder="Your Name">
                                    <input type="email" name="email" required placeholder="Your Email">
                                    <textarea name="message" required placeholder="Your Message"></textarea>
                                    <input type="submit" value="Submit"  name="faq_submit" id="submit">

                                </form>

                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div><!-- Contact Section End-->




    <?php
    include 'footer.php';
    include 'bottom.php';
    ?>
