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
                    <h1 class="page-header">
                        Welcome to admin
                        <small>Author</small>
                    </h1>
                    <?php
                        if(isset($_GET["source"])){
                            $source = $_GET["source"];
                        } else {
                            $source = "";
                        }
                        
                        switch($source){
                            case "add_post":
                                include "includes/add_post.php";
                                break;
                            case "edit_post":
                                include "includes/edit_post.php";
                                break;
                            case 200:
                                echo "line 200";
                                break;
                            default:
                                include "includes/view_all_posts.php";
                                break;
                        }
                    ?>

                </div>
                <!-- /.row -->

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

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>