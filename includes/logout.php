<?php 

    session_start();

    $session = session_id();
    mysqli_query($connection, "DELETE FROM users_online WHERE user_session = '$session'");

    $_SESSION["username"] = null;
    $_SESSION["password"] = null;
    $_SESSION["user_role"] = null;

    session_destroy();

    header("Location: ../index.php");

?>