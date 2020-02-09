<?php
    include "includes/admin_header.php";
?>

    <div id="wrapper">

        <!-- Navigation -->
        
        <?php
            include "includes/admin_navigation.php";
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <h1 class="page-header">
                        Welcome to admin
                        <small>Author</small>
                    </h1>

<?php 

    $username = $_SESSION["username"];
    $query = "SELECT * FROM users WHERE username = '$username'";
    $query_user_profile = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($query_user_profile)){
        $user_id = $row["user_id"];
        $the_username = $row["username"];
        $password = $row["user_password"];
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
        $email = $row["email"];
        $user_image = $row["user_image"];
        $user_role = $row["user_role"];

?>


    <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $the_username ?>" />
    </div>
    <select class="form-control" name="select_role">
        <option value='<?php echo $user_role ?>'><?php echo $user_role ?></option>
    <?php
    

        if($user_role == "admin"){
            echo "<option value='subscriber'>Subscriber</option>";
        } else {
            echo "<option value='admin'>Admin</option>";
        }
        
    ?>    
    </select>
    <!--<div class="form-group">
        <label for="post_category_id">Post Category</label>
        <input type="text" class="form-control" name="post_category_id" />
    </div>-->
    <div class="form-group">
        <label for="author">First name</label>
        <input type="text" class="form-control" name="first_name" value="<?php echo $first_name ?>" />
    </div>
    <div class="form-group">
        <label for="post_status">Last name</label>
        <input type="text" class="form-control" name="last_name" value="<?php echo $last_name ?>" />
    </div>
    <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="email" class="form-control" name="email" value="<?php echo $email ?>" />
    </div>
    <div class="form-group">
        <label for="post_comments">Password</label>
        <input type="password" class="form-control" name="user_password" value="<?php echo $user_password ?>" />
    </div>
    <div class="form-group">
        <input type="submit" class="form-control" name="update_user" />
    </div>

</form>
<?php } ?>

<?php 

    if(isset($_POST["update_user"])){

        $the_username = $_POST["username"];
        $select_role = $_POST["select_role"];

        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];

        $email = $_POST["email"];
        $user_password = $_POST["user_password"];

        $query = "UPDATE users SET user_role = '$select_role', ";
        $query .= "username = '$the_username', ";
        $query .= "first_name = '$first_name', ";
        $query .= "last_name = '$last_name', ";
        $query .= "email = '$email', ";
        $query .= "user_password = '$user_password' ";
        $query .= "WHERE username = '$username'";

        $query_refresh = mysqli_query($connection, $query);
        confirm($query_refresh);

        $_SESSION["username"] = $the_username;
    }

?>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>