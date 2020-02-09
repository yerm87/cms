<?php
    if(isset($_GET["p_id"])){
        $post_id = $_GET["p_id"];
        $query = "SELECT * FROM posts WHERE post_id = $post_id";
        $query_update = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($query_update);

        $post_title = $row["post_title"];
        $post_id = $row["post_id"];
        $post_category_id = $row["post_category_id"];
        $post_author = $row["post_author"];
        $post_date = $row["post_date"];
        $post_image = $row["post_image"];
        $post_content = $row["post_content"];
        $post_tags = $row["post_tags"];
        $post_comment_count = $row["post_comment_count"];
        $post_status = $row["post_status"];
    }
?>

<?php 
    if(isset($_POST["update_post"])){
        $id = $_GET["p_id"];

        $title = $_POST["title"];
        $select_category = $_POST["select_category"];

        $author = $_POST["author"];
        $status = $_POST["post_status"];

        $image = $_FILES["post_image"]["name"];
        $image_temp = $_FILES["post_image"]["tmp_name"];

        $tags = $_POST["post_tags"];
        $comments = $_POST["post_comments"];
        $content = $_POST["post_content"];

        $date = date("d-m-y");

        move_uploaded_file($image_temp, "../images/$image");

        if(empty($image)){
            $query = "SELECT * FROM posts WHERE post_id = $post_id";
            $query_image = mysqli_query($connection, $query);

            $row = mysqli_fetch_assoc($query_image);
            $image = $row["post_image"];
        }

        $query = "UPDATE posts SET post_category_id = '$select_category', ";
        $query .= "post_title = '$title', ";
        $query .= "post_author = '$author', ";
        $query .= "post_date = '$date', ";
        $query .= "post_image = '$image', ";
        $query .= "post_content = '$content', ";
        $query .= "post_tags = '$tags', ";
        $query .= "post_comment_count = '$comments', ";
        $query .= "post_status = '$status' ";
        $query .= "WHERE post_id = $post_id";

        $query_refresh = mysqli_query($connection, $query);
        confirm($query_refresh);

        echo "<p>Post updated <a href='../post.php?p_id=$post_id'>View post</a> or <a href='posts.php'>Edit more posts</a></p>";
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $post_title ?>" />
    </div>
    <label for="select_category">Category</label>
    <select class="form-control" name="select_category">
    <?php
        $query = "SELECT * FROM category";
        $query_select_categories = mysqli_query($connection, $query);
        confirm($query);
        while($row = mysqli_fetch_assoc($query_select_categories)){
            $cat_id = $row["cat_id"];
            $cat_title = $row["cat_title"];
            echo "<option value='$cat_id'>$cat_title</option>";
        }
    ?>    
    </select>
    <!--<div class="form-group">
        <label for="post_category_id">Post Category</label>
        <input type="text" class="form-control" name="post_category_id" value="<?php echo $post_category_id ?>" />
    </div>-->
    <label for="author">Author</label>
    <select class="form-control" name="author">
            <?php 

                $query = "SELECT * FROM posts";
                $query_select = mysqli_query($connection, $query);
                $array_authors = array();

                while($row = mysqli_fetch_assoc($query_select)){
                    $p_author = $row["post_author"];

                    if(!in_array($p_author, $array_authors)){
                        echo "<option value='$p_author'>$p_author</option>";
                    }

                    array_push($array_authors, $p_author);
                }
            ?>
    </select>
    <label for="post_status">Status</label>
    <select class="form-control" name="post_status">
        <option value="<?php echo $post_status ?>"><?php echo $post_status ?></option>
        <?php 
            if($post_status === "published"){
                echo "<option value='drafted'>draft</option>";
            } else {
                echo "<option value='published'>published</option>";
            }
        ?>
    </select>
    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image ?>" />
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="post_image" />
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags ?>" />
    </div>
    <div class="form-group">
        <label for="post_comments">Comments</label>
        <input type="text" class="form-control" name="post_comments" value="<?php echo $post_comment_count ?>" />
    </div>
    <div class="form-group">
        <label for="post_content">Content</label>
        <textarea id="body" type="text" class="form-control" name="post_content" cols="30" rows="10"><?php echo $post_status ?>
        </textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="form-control" name="update_post" />
    </div>

</form>