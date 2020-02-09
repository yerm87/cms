<?php 
    include "db.php";
?>
<?php
    session_start();
?>

<?php 
    if(isset($_POST["submit_login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);

        $query_salt = "SELECT randSalt FROM users";
        $query_randSalt = mysqli_query($connection, $query_salt);

        if(!$query_randSalt){
            die("Error" . mysqli_error($connection));
        }
            
        $row = mysqli_fetch_assoc($query_randSalt);
        $saltRand = $row["randSalt"];
        //$password = crypt($password, $saltRand);

        $query = "SELECT * FROM users";
        $query_login = mysqli_query($connection, $query);

        echo $password . "<br/>";

        if(!$query_login){
            echo "Error" . mysqli_error($connection);
        }

        while($row = mysqli_fetch_assoc($query_login)){

            $fetched_username = $row["username"];
            $fetched_password = $row["user_password"];
            $user_role = $row["user_role"];
            echo $fetched_password . "<br />";

            if($username === $fetched_username && $password === $fetched_password){

                $_SESSION["username"] = $fetched_username;
                $_SESSION["password"] = $fetched_password;
                $_SESSION["user_role"] = $user_role;
                $_SESSION["last_activity"] = time();

                header("Location: ../admin");
                return;
            } else {
                header("Location: ../index.php");
            }
        }
    }
?>