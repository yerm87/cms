<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>

    <?php
       $message = "Test message";
       $message = wordwrap($message, 70);
       mail("romuse@mail.ru", "Test", $message);
    ?>

    <?php

        if(isset($_POST["submit"])){
            $to = $_POST["email"];
            $subject = $_POST["subject"];
            $body = $_POST["body"];

            $to = mysqli_real_escape_string($connection, $to);
            $subject = mysqli_real_escape_string($connection, $subject);

            $body = wordwrap($body, 70);
            mail($to, $subject, $body);

        }

    ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your subkect">
                        </div>
                        <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
