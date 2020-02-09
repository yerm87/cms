<?php
    if(isset($_POST["Submit_user"])){
        $user_firstname = $_POST["user_firstname"];
        $user_lastname = $_POST["user_lastname"];
        $user_role = $_POST["user_role"];
        $username = $_POST["username"];

        //$image = $_FILES["post_image"]["name"];
        //$image_temp = $_FILES["post_image"]["tmp_name"];

        $email = $_POST["email"];
        //$comments = 4;
        $password = $_POST["password"];

        //$date = date("d-m-y");

        //move_uploaded_file($image_temp, "../images/$image");

        $query = "INSERT INTO users(username, user_password, first_name, last_name, email, user_role)";
        
        $query .= "VALUES('$username', '$password', '$user_firstname', '$user_lastname', '$email', '$user_role')";

        $query_submit_data = mysqli_query($connection, $query);
        confirm($query_submit_data);

        echo "user was created " . "<a href='users.php'>View Users</a>"; 
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">First name</label>
        <input type="text" class="form-control" name="user_firstname" />
    </div>
    <div class="form-group">
        <label for="author">Last name</label>
        <input type="text" class="form-control" name="user_lastname" />
    </div>
    <select class="form-control" name="user_role">
    <?php
    /*
        $query = "SELECT * FROM users";
        $query_select_role = mysqli_query($connection, $query);
        confirm($query);
        while($row = mysqli_fetch_assoc($query_select_role)){
            $user_id = $row["user_id"];
            $role = $row["user_role"];*/
        echo "<option value='admin'>Admin</option>";
        echo "<option value='subscriber'>Subscriber</option>";
        //}
    ?>    
    </select>
    <!--<div class="form-group">
        <label for="post_category_id">Post Category</label>
        <input type="text" class="form-control" name="post_category_id" />
    </div>-->
    <div class="form-group">
        <label for="post_status">Username</label>
        <input type="text" class="form-control" name="username" />
    </div>
    <div class="form-group">
        <label for="post_image">Email</label>
        <input type="email" class="form-control" name="email" />
    </div>
    <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="text" class="form-control" name="password" />
    </div>
    <div class="form-group">
        <input type="submit" class="form-control" name="Submit_user" />
    </div>

</form>