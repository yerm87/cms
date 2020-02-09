<?php
    if(isset($_POST["submit"])){
        $title = $_POST["title"];
        $post_category_id = $_POST["post_category_id"];
        $author = $_POST["author"];
        $status = $_POST["post_status"];

        $image = $_FILES["post_image"]["name"];
        $image_temp = $_FILES["post_image"]["tmp_name"];

        $post_tags = $_POST["post_tags"];
        //$comments = 4;
        $content = $_POST["post_content"];

        //$date = date("d-m-y");

        move_uploaded_file($image_temp, "../images/$image");

        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content,
        post_tags, post_comment_count, post_status)";
        
        $query .= "VALUES('$post_category_id', '$title', '$author', now(), '$image', '$content', '$post_tags',
        0, '$status')";

        $query_submit_data = mysqli_query($connection, $query);
        confirm($query_submit_data);

        $post_id = mysqli_insert_id($connection);

        echo "<p>Post created <a href='../post.php?p_id=$post_id'>View post</a>";
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" />
    </div>
    <select class="form-control" name="post_category_id">
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
        <input type="text" class="form-control" name="post_category_id" />
    </div>-->
    <label for="author">Author</label>
     
    <select class="form-group" name="author">
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
    <select class="form-control" name="post_status">
        <option value="published">Publish</option>
        <option value="drafted">Draft</option>
    </select>
    <!--<div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status" />
    </div>-->
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="post_image" />
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" />
    </div>
    <div class="form-group">
        <label for="post_comments">Comments</label>
        <input type="text" class="form-control" name="post_comments" />
    </div>
    <div class="form-group">
        <label for="post_content">Content</label>
        <textarea id="body" type="text" class="form-control" name="post_content" cols="30" rows="10">
        </textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="form-control" name="submit" />
    </div>

</form>