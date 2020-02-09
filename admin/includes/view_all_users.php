<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT * FROM users";
            $query_all_posts = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($query_all_posts)){
                $user_id = $row["user_id"];
                $username = $row["username"];
                $password = $row["user_password"];
                $first_name = $row["first_name"];
                $last_name = $row["last_name"];
                $email = $row["email"];
                $user_image = $row["user_image"];
                $role = $row["user_role"];
/*
                $query_category = "SELECT * FROM category WHERE cat_id = $post_category_id";
                $query_category_req = mysqli_query($connection, $query_category);
                confirm($query_category_req);
                $row = mysqli_fetch_assoc($query_category_req);
                $categ_title = $row["cat_title"];*/

                echo "<tr>";
                echo "<td>$user_id</td>";
                echo "<td>$username</td>";
                echo "<td>$first_name</td>";
                echo "<td>$last_name</td>";
                echo "<td>$email</td>";
                echo "<td>$role</td>";
                echo "<td><a href='users.php?source=edit_user&u_id=$user_id'>edit</a></td>";
                echo "<td><a href='users.php?delete_user=$user_id'>delete</a></td>";
                echo "<td><a href='users.php?change_to_admin=admin&user_id=$user_id'>Admin</a></td>";
                echo "<td><a href='users.php?change_to_subs&user_id=$user_id'>Subscriber</a></td>";
                echo "</tr>";
            }
        ?>

        <?php 
            if(isset($_GET["change_to_admin"])){
                $id = $_GET["user_id"];
                $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $user_id";
                $subs_query = mysqli_query($connection, $query);
                confirm($subs_query);

                header("Location: users.php");
            }
        ?>

        <?php
            if(isset($_GET["change_to_subs"])){
                $id = $_GET["user_id"];
                $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $user_id";
                $subs_query = mysqli_query($connection, $query);
                confirm($subs_query);

                header("Location: users.php");
            }
        ?>

        <?php 
            if(isset($_GET["delete_user"])){
                if(isset($_SESSION["username"]))
                    $item_id = $_GET["delete"];
                
                    $query = "DELETE FROM users WHERE user_id = $user_id";
                    $query_delete = mysqli_query($connection, $query);
                    header("Location: users.php");

                    if(!$query_delete){
                        die("Error " . mysqli_error($connection));
                    }
                }
            }
        ?>
    </tbody>
</table>