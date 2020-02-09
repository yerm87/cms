<?php

function insert_category() {

    global $connection;

    if(isset($_POST["submitter"])){
        $value = $_POST["cat_title"];
        if($value == "" || empty($value)){
            echo "Please enter valid value";
        } else {
            $query = "INSERT INTO category(cat_title)";
            $query .= "VALUES('{$value}')";
            $query_insert = mysqli_query($connection, $query);
        }
    }
}

function select_all_categories() {
    global $connection;

    $query = "SELECT * FROM category";
    $select_all_categories = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_all_categories)){
        $cat_id = $row["cat_id"];
        $cat_title = $row["cat_title"];
        echo "<tr>";
        echo "<td>$cat_id</td>";
        echo "<td>$cat_title</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_title}&cat_id={$cat_id}'>edit</a></td>";
        echo "</tr>";
    }
}

function delete_category() {
    global $connection;

    if(isset($_GET["delete"])){
        $param = $_GET["delete"];
        $query = "DELETE FROM category WHERE cat_id = '$param'";
        $query_delete = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}

function edit_category() {
    global $connection;

    if(isset($_POST["submit_edit"])){
        $edit_value = $_POST["edit_category"];
        $id = $_GET["cat_id"];

        $query = "UPDATE category SET cat_title = '$edit_value' WHERE cat_id = '$id'";
        $query_update = mysqli_query($connection, $query);
    }
}

function confirm($query) {
    global $connection;

    if(!$query){
        die("Something wrong " . mysqli_error($connection));
    }
}

function get_sessions_number(){

    if(isset($_GET["usersonline"])){
    global $connection;

    if(!$connection){
        session_start();

        include("../includes/db.php");

        $session = session_id();
        $time = time();
        $timeout = $time + 20;

        $query = "SELECT * FROM users_online WHERE user_session = '$session'";
        $query_sessions = mysqli_query($connection, $query);
        $count = mysqli_num_rows($query_sessions);

        if($count === 0){
            $query = "INSERT INTO users_online(user_session, user_time) VALUES('$session', '$timeout')";
            $query_insert = mysqli_query($connection, $query);
        } else {
            //$query = "UPDATE users_online SET user_time = '$timeout' WHERE user_session = '$session'";
            //mysqli_query($connection, $query);
        }

        $query_count = mysqli_query($connection, "SELECT * FROM users_online WHERE user_time > '$time'");
        echo $count = mysqli_num_rows($query_count);
    }
}
}

get_sessions_number();

?>