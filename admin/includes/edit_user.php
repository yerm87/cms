<?php
    if(isset($_GET["u_id"])){
        $u_id = $_GET["u_id"];
        $query = "SELECT * FROM users WHERE user_id = $u_id";
        $query_update = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($query_update);

        $user_id = $row["user_id"];
        $username = $row["username"];
        $user_password = $row["user_password"];
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
        $email = $row["email"];
        $user_role = $row["user_role"];
    }
?>

<?php 
    if(isset($_POST["update_user"])){
        $id = $_GET["u_id"];

        $the_username = $_POST["username"];
        $select_role = $_POST["select_role"];

        $the_first_name = $_POST["first_name"];
        $the_last_name = $_POST["last_name"];

        $email = $_POST["email"];
        $the_user_password = $_POST["user_password"];

        $query = "UPDATE users SET username = '$the_username', ";
        $query .= "user_password = '$the_user_password', ";
        $query .= "first_name = '$the_first_name', ";
        $query .= "last_name = '$the_last_name', ";
        $query .= "email = '$email', ";
        $query .= "user_role = '$select_role'";
        $query .= "WHERE user_id = $id";

        $query_refresh = mysqli_query($connection, $query);
        confirm($query_refresh);
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username ?>" />
    </div>
    <select class="form-control" name="select_role">
        <option value='<?php echo $user_role ?>'><?php echo $user_role ?></option>
    <?php
        $query = "SELECT * FROM users WHERE user_id = $u_id";
        $query_select_users = mysqli_query($connection, $query);
        confirm($query);
        $row = mysqli_fetch_assoc($query_select_users);
        $user_role = $row["user_role"];
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