<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>

    <?php

        if(isset($_POST["submit"])){
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $createdBefore = false;

            $username = mysqli_real_escape_string($connection, $username);
            $email = mysqli_real_escape_string($connection, $email);
            $password = mysqli_real_escape_string($connection, $password);

            $query_users = "SELECT * FROM users";
            $query_users_checking = mysqli_query($connection, $query_users);

            if(!$query_users_checking){
                echo "Error warning " . mysqli_error($connection);
            }
            while($row = mysqli_fetch_assoc($query_users_checking)){
                $username_database = $row["username"];
                if($username === $username_database){
                    $createdBefore = true;
                }
            }

            if(!empty($username) && !empty($email) && !empty($password) && !$createdBefore){
                $query = "SELECT randSalt FROM users";
                $query_randSalt = mysqli_query($connection, $query);

                if(!$query_randSalt){
                    die("Error" . mysqli_error($connection));
                }
            
                $row = mysqli_fetch_assoc($query_randSalt);
                $saltRand = $row["randSalt"];
                //$password = crypt($password, $saltRand);

                $query_register = "INSERT INTO users(username, email, user_password, user_role)";
                $query_register .= "VALUES('$username', '$email', '$password', 'subscriber')";

                $query_insert_data = mysqli_query($connection, $query_register);

                if(!$query_insert_data){
                    die("Error" . mysqli_error($connection));
                }

                $message = "registration was submitted";
            } else if(empty($username) || empty($email) || empty($password)) {
                $message = "fields cannot be empty";
            } else if($createdBefore){
                $message = "This username already exist";
            }
        } else {
            $message = "";
        }

    ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h5><?php echo $message; ?></h5>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
