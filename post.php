<?php
    include "includes/header.php";
    include "includes/db.php";
?>

    <!-- Navigation -->
    <?php
        include "includes/navigation.php";
    ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php 
                    $the_post_id = $_GET["p_id"];

                    $query_views = "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = '$the_post_id'";
                    $query_views_update = mysqli_query($connection, $query_views);
                    if(!$query_views_update){
                        die("Error message");
                    }

                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
                    $select_all_posts_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        $post_id = $row["post_id"];
                        $post_title = $row["post_title"];
                        $post_author = $row["post_author"];
                        $post_date = $row["post_date"];
                        $post_content = $row["post_content"];
                        $post_image = $row["post_image"];
                        $post_view_count = $row["post_view_count"];

                ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?> </p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>

                <hr>

                <?php } ?>


                  <!-- Blog Comments -->

                <?php 
                
                    if(isset($_POST["create-comment"])){
                        $the_post_id = $_GET["p_id"];

                        $author = $_POST["comment-author"];
                        $email = $_POST["comment-email"];
                        $content = $_POST["comment-content"];

                        if(!empty($author) && !empty($email) && !empty($content)){

                            $date = date("d-m-y");

                            $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content,
                            comment_status, comment_date)";
                            $query .= "VALUES('$the_post_id', '$author', '$email', '$content', 'unapproved', '$date')";

                            $select_query = mysqli_query($connection, $query);
                            if(!$select_query){
                                die("error");
                            }
                        

                            $query_comment_count = "SELECT * FROM posts WHERE post_id = $the_post_id";
                            $new_query = mysqli_query($connection, $query_comment_count);
                   
                            $row = mysqli_fetch_assoc($new_query);
                            $post_comment_count = intval($row["post_comment_count"]) + 1;

                            $query_post = "UPDATE posts SET post_comment_count = '$post_comment_count'";
                            $query_post .= "WHERE post_id = $the_post_id";

                            $selected_query = mysqli_query($connection, $query_post);
                            if(!$selected_query){
                                die("error");
                            }
                        } else {
                            echo "<script>alert('Fields cannot be empty')</script>";
                        }

                    }

                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <label for="comment-author">Author</label>
                            <input type="text" class="form-control" name="comment-author" />
                        </div>
                        <div class="form-group">
                            <label for="comment-email">Email</label>
                            <input type="email" class="form-control" name="comment-email" />
                        </div>
                        <div class="form-group">
                            <label for="comment-content">Comment</label>
                            <textarea class="form-control" rows="3" name="comment-content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create-comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <div class="media">

                <?php 
                   
                    $query = "SELECT * FROM comments WHERE comment_post_id = '$the_post_id'";
                    $query .= "AND comment_status = 'approved'";
                    $query .= "ORDER BY comment_id DESC";

                    $query_comment = mysqli_query($connection, $query);
                    if(!$query_comment){
                        die("error");
                    }
                    while($row = mysqli_fetch_assoc($query_comment)){
                        $author = $row["comment_author"];
                        $date = $row["comment_date"];
                        $content = $row["comment_content"];

                ?>

                    <!-- Comment -->
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $author ?>
                                <small><?php echo $date ?></small>
                            </h4>
                            <?php echo $content ?>
                        </div>
                    <?php } ?>
                </div>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php
                include "includes/sidebar.php";
            ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php
            include "includes/footer.php";
        ?>