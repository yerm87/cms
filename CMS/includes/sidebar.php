<div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" name="searchParam">
                        <span class="input-group-btn">
                            <button name="submitter" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Login</h4>
                    <form action="includes/login.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Enter username">
                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                        <button name="submit_login" class="btn btn-default" type="submit">
                               Login
                        </button>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <?php
                       
                       $query = "SELECT * FROM category";
                       $select_category_sidebar = mysqli_query($connection, $query);

                    ?>
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <?php
                                   while($query_param = mysqli_fetch_assoc($select_category_sidebar)){
                                       $category_name = $query_param["cat_title"];
                                       $category_id = $query_param["cat_id"];
                                       echo "<li><a href='index.php?category=$category_id'>$category_name</a></li>";
                                   }
                                ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        <!--
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>-->
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php
                    include "widget.php";
                ?>

            </div>