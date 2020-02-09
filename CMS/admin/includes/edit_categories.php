<?php  ?>
<form action="" method="post">
    <div class="form-group">
    <?php
        $param = $_GET["cat_id"];
        $query = "SELECT * FROM category WHERE cat_id = '$param'";
        $search_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($search_query)){
            $title = $row["cat_title"];
            echo "<label for='cat_title'>Edit Category</label>";
            echo "<input class='form-control' name='edit_category' type='text' value='$title' />";
            echo "<div class='form-group'>";
            echo "<input class='btn btn-primary' type='submit' name='submit_edit' value='Edit Category' />";
            echo "</div>";
        }                                       
    ?>
    </div>
</form>