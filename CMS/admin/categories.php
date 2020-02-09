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
                            Welcome to admin
                            <small>Author</small>
                        </h1>
                        <div class="col-xs-6">
                        <?php insert_category(); ?>

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input class="form-control" type="text" name="cat_title" />
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submitter" value="Add Category" />
                            </div>
                        </form>

                        <?php
                           if(isset($_GET["edit"])){
                               $id = $_GET["cat_id"];

                               include "includes/edit_categories.php";
                           }
                        ?>

                        <?php edit_category(); ?>

                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php select_all_categories(); ?>

                                    <?php delete_category(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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

    <script src="js/script1.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>