<?php
    include "includes/admin_header.php";
?>

    <div id="wrapper">

        <!-- Navigation -->
        
        <?php
            include "includes/admin_navigation.php";
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome
                            <small><?php echo $_SESSION["username"]; ?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                        <?php 
                                            $query = "SELECT * FROM posts";
                                            $select_all_posts = mysqli_query($connection, $query);
                                            $post_count = mysqli_num_rows($select_all_posts);
                                            $postNum = $post_count > 1 ? 'Posts' : 'Post';

                                            echo "<div class='huge'>$post_count</div>";
                                            echo "<div>$postNum</div>";
                                        ?>

                                        <div></div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    <?php
                        $query = "SELECT * FROM comments";
                        $select_all_comments = mysqli_query($connection, $query);
                        $comment_rows = mysqli_num_rows($select_all_comments);
                        $numComments = $comment_rows > 1 ? 'Comments' : 'Comment';
                        echo "<div class='huge'>$comment_rows</div>";
                        echo "<div>$numComments</div>";                    
                    ?>

                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <?php
                        $query = "SELECT * FROM users";
                        $select_all_users = mysqli_query($connection, $query);
                        $user_rows = mysqli_num_rows($select_all_users);
                        $numUsers = $user_rows > 1 ? 'Users' : 'User';
                        echo "<div class='huge'>$user_rows</div>";
                        echo "<div>$numUsers</div>";                    
                    ?>

                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <?php
                        $query = "SELECT * FROM category";
                        $select_all_categories = mysqli_query($connection, $query);
                        $category_rows = mysqli_num_rows($select_all_categories);
                        $numCategories = $category_rows > 1 ? 'Categories' : 'Category';
                        echo "<div class='huge'>$category_rows</div>";
                        echo "<div>$numCategories</div>";                    
                    ?>

                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

<?php
    $query_active_post = "SELECT * FROM posts WHERE post_status = 'published'";
    $select_all_active_posts = mysqli_query($connection, $query_active_post);
    $active_posts_count = mysqli_num_rows($select_all_active_posts);

    $query = "SELECT * FROM posts WHERE post_status = 'drafted'";
    $select_drafted_posts = mysqli_query($connection, $query);
    $drafted_posts_count = mysqli_num_rows($select_drafted_posts);

    $query_comment = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
    $select_unapproved_comments = mysqli_query($connection, $query_comment);
    $unapproved_comments_count = mysqli_num_rows($select_unapproved_comments);

    $query_user = "SELECT * FROM users WHERE user_role = 'subscriber'";
    $select_subscribers = mysqli_query($connection, $query_user);
    $subscribers_count = mysqli_num_rows($select_subscribers);
?>

<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],

          <?php
             $element_name = ["All posts", "Active posts", "Drafted Posts", "Categories", "Comments", "Pending comments", 
             "Users", "Subscribers"];
             $element_count = [$post_count, $active_posts_count, $drafted_posts_count, $category_rows, $comment_rows, 
             $unapproved_comments_count, $user_rows, $subscribers_count];

             for($i = 0; $i < 8; $i++){
                 echo "['$element_name[$i]'" . ", " . "$element_count[$i]],";
             }
          
          ?>
          //['Posts', 1000]
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
</script>

<div id="columnchart_material" style="width: auto; height: 500px;"></div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <script src="js/scripts.js"></script>

    <script src="js/script1.js"></script>

    <script src="js/script2.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
