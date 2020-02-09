<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT * FROM comments";
            $query_all_comments = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($query_all_comments)){
                $comment_id = $row["comment_id"];
                $comment_author = $row["comment_author"];
                $comment_content = $row["comment_content"];
                $comment_email = $row["comment_email"];
                $comment_status = $row["comment_status"];
                $comment_post_id = $row["comment_post_id"];
                $comment_date = $row["comment_date"];

                echo "<tr>";
                echo "<td>$comment_id</td>";
                echo "<td>$comment_author</td>";
                echo "<td>$comment_content</td>";
                echo "<td>$comment_email</td>";
                echo "<td>$comment_status</td>";

                $query_post = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                $query_params = mysqli_query($connection, $query_post);

                if(!$query_params){
                    die("Error message:" . mysqli_error($connection));
                }

                $row = mysqli_fetch_assoc($query_params);
                $post_title = $row["post_title"];

                echo "<td><a href='../post.php?p_id=$comment_post_id'>$post_title</a></td>";
                echo "<td>$comment_date</td>";
                echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
                echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id=$comment_id'>edit</a></td>";
                echo "<td><a href='comments.php?delete_comment=$comment_id'>delete</a></td>";
                echo "</tr>";
            }
        ?>

        <?php
            if(isset($_GET["approve"])){
                $selected_comment_id = $_GET["approve"];
                $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id=$selected_comment_id";
                $query_approve = mysqli_query($connection, $query);
                header("Location: comments.php");

                if(!$query_approve){
                    die("Error" . mysqli_error($connection));
                }
            }
            
            if(isset($_GET["unapprove"])){
                $selected_comment_id = $_GET["unapprove"];
                $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id=$selected_comment_id";
                $query_approve = mysqli_query($connection, $query);
                header("Location: comments.php");

                if(!$query_approve){
                    die("Error" . mysqli_error($connection));
                }
            }
        
        ?>

        <?php 
            if(isset($_GET["delete_comment"])){
                $item_id = $_GET["delete_comment"];
                
                $query = "DELETE FROM comments WHERE comment_id = $item_id";
                $query_delete = mysqli_query($connection, $query);
                header("Location: comments.php");

                if(!$query_delete){
                    die("Error " . mysqli_error($connection));
                }
            }
        ?>
    </tbody>
</table>