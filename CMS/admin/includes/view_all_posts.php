<?php 
   if(isset($_POST["checkBoxArray"])){
       foreach($_POST["checkBoxArray"] as $checkBoxValue){
           $bulkOptions = $_POST["select_options"];

           switch($bulkOptions){
                case "published":
                    $query = "UPDATE posts SET post_status = '$bulkOptions' WHERE post_id = '$checkBoxValue'";
                    $query_update = mysqli_query($connection, $query);
                    break;
                case "drafted":
                    $query = "UPDATE posts SET post_status = '$bulkOptions' WHERE post_id = '$checkBoxValue'";
                    $query_update = mysqli_query($connection, $query);
                    break;
                case "delete":
                    $query = "DELETE FROM posts WHERE post_id = '$checkBoxValue'";
                    $query_delete = mysqli_query($connection, $query);
                    break;
                case "clone":
                    $query_select = "SELECT * FROM posts WHERE post_id = '$checkBoxValue'";
                    $query_select_request = mysqli_query($connection, $query_select);
                    $row = mysqli_fetch_assoc($query_select_request);

                    $post_id = $row["post_id"];
                    $post_category_id = $row["post_category_id"];
                    $post_title = $row["post_title"];
                    $post_author = $row["post_author"];
                    $post_date = $row["post_date"];
                    $post_image = $row["post_image"];
                    $post_content = $row["post_content"];
                    $post_tags = $row["post_tags"];
                    $post_comment_count = $row["post_comment_count"];
                    $post_status = $row["post_status"];

                    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, 
                    post_content, post_tags, post_comment_count, post_status)";
        
                    $query .= "VALUES('$post_category_id', '$post_title', '$post_author', now(), '$post_image', 
                    '$post_content', '$post_tags', '$post_comment_count', '$post_status')";

                    $query_submit_data = mysqli_query($connection, $query);
                    break;
           }
       }
   }
?>

<form action="" method="post">
<table class="table table-bordered table-hover">

    <div id="bultOptionContainer" class="col-xs-4">
        <select class="form-control" name="select_options">
            <option value="">Select options</option>
            <option value="published">Publish</option>
            <option value="drafted">Draft</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>
        </select>
    </div>
    <div class="col-xs-4">
        <input type="submit" class="btn btn-success" value="Apply" name="Apply" />
        <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
    </div>
    <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox" /></th>
            <th>ID</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Content</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT * FROM posts";
            $query_all_posts = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($query_all_posts)){
                $post_id = $row["post_id"];
                $post_category_id = $row["post_category_id"];
                $post_title = $row["post_title"];
                $post_author = $row["post_author"];
                $post_date = $row["post_date"];
                $post_image = $row["post_image"];
                $post_content = $row["post_content"];
                $post_tags = $row["post_tags"];
                $post_comment_count = $row["post_comment_count"];
                $post_status = $row["post_status"];
                $post_view_count = $row["post_view_count"];

                $query_category = "SELECT * FROM category WHERE cat_id = $post_category_id";
                $query_category_req = mysqli_query($connection, $query_category);
                confirm($query_category_req);
                $row = mysqli_fetch_assoc($query_category_req);
                $categ_title = $row["cat_title"];

                echo "<tr>";
        ?>
                <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="<?php echo $post_id ?>" /></td>
        <?php
                echo "<td>$post_id</td>";
                echo "<td>$post_author</td>";
                echo "<td>$post_title</td>";
                echo "<td>$categ_title</td>";
                echo "<td>$post_status</td>";
                echo "<td><img width='100' src='../images/$post_image' /></td>";
                echo "<td>$post_content</td>";
                echo "<td>$post_tags</td>";

                $query_comment_count = "SELECT * FROM comments WHERE comment_post_id = '$post_id'";
                $query_comments = mysqli_query($connection, $query_comment_count);
                $comments_num = mysqli_num_rows($query_comments);

                echo "<td><a href='post_comments.php?id=$post_id'>$comments_num</a></td>";
                echo "<td>$post_date</td>";
                echo "<td><a href='posts.php?reset=$post_id'>$post_view_count</a></td>";
                echo "<td><a href='../post.php?p_id=$post_id'>View Post</a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id=$post_id'>edit</a></td>";
                echo "<td><a href='posts.php?delete=$post_id'>delete</a></td>";
                echo "</tr>";
            }
        ?>

        <?php 
        
            if(isset($_GET["reset"])){
                $post_id = $_GET["reset"];
                $query = "UPDATE posts SET post_view_count = 0 WHERE post_id = '$post_id'";
                $query_reset = mysqli_query($connection, $query);
            }
        
        ?>

        <?php 
            if(isset($_GET["delete"])){
                $item_id = $_GET["delete"];
                
                $query = "DELETE FROM posts WHERE post_id = $item_id";
                $query_delete = mysqli_query($connection, $query);
                header("Location: posts.php");

                if(!$query_delete){
                    die("Error " . mysqli_error($connection));
                }
            }
        ?>
    </tbody>
</table>
</form>