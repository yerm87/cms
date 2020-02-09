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
                
                if(isset($_GET["category"])){
                    $the_cat_id = $_GET["category"];

                    $query = "SELECT * FROM posts WHERE post_category_id = $the_cat_id";
                    $query_request = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($query_request)){
                        $post_id = $row["post_id"];
                        $post_title = $row["post_title"];
                        $post_author = $row["post_author"];
                        $post_date = $row["post_date"];
                        $post_content = substr($row["post_content"], 0, 100);
                        $post_image = $row["post_image"];
            ?>

                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?> </p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <?php
                    }
                } else {

                ?>

                <?php 
            
                    if(isset($_GET["page"])){
                        $page = $_GET["page"];
                    } else {
                        $page = 1;
                    }

                    $page_result_end = $page * 5;
                    $page_result_start = $page_result_end - 5;
        
                ?>

                <?php 
                    
                    $query = "SELECT * FROM posts LIMIT $page_result_start, $page_result_end";
                    $select_all_posts_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        $post_id = $row["post_id"];
                        $post_title = $row["post_title"];
                        $post_author = $row["post_author"];
                        $post_date = $row["post_date"];
                        $post_content = substr($row["post_content"], 0, 100);
                        $post_image = $row["post_image"];
                        $post_status = $row["post_status"];

                    if($post_status == "published"){
                        
                ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <?php echo $post_author ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?> </p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id ?>">
                   <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More 
                <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <?php } 
                }
                }
                ?>

            <ul class="pager">
               <?php 

                  $query = "SELECT * FROM posts WHERE post_status = 'published'";
                  $query_posts = mysqli_query($connection, $query);
                  $posts_count = mysqli_num_rows($query_posts);
                  
                  $posts_count = $posts_count / 5;
                  $posts_count = ceil($posts_count);
                  
                  for($i=1; $i<=$posts_count; $i++){
                      if($i == $page){
                        echo "<li><a class='active_link' href='index.php?page=$i'>$i</a></li>";
                      } else {
                            echo "<li><a href='index.php?page=$i'>$i</a></li>";
                      }
                  }

               ?>
            </ul>

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
