<?php include "./includes/admin_header.php"; ?>
<div id="wrapper">
    <!-- Navigation -->
    <?php include "./includes/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        welcome to admin
                        <small> <?php echo $_SESSION['username']; ?></small>
                    </h1>
                    <h1>

                    </h1>
                </div>
            </div>
               <!-- /.row -->
            
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row ">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'>
                                        <p class="posts_online"></p>
                                       
                                    </div>
                                    <div>Posts</div>
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
                                    <div class='huge'>
                                        <?php
                                        $query = 'SELECT * FROM comments';
                                        $res = mysqli_query($conn, $query);
                                        $count_comment = mysqli_num_rows($res);
                                        echo $count_comment;
                                        ?>
                                    </div>
                                    <div>Comments</div>
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
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'>
                                        <?php
                                        $query = 'SELECT * FROM users';
                                        $res = mysqli_query($conn, $query);
                                        $count_user = mysqli_num_rows($res);
                                        echo $count_user;
                                        ?>
                                    </div>
                                    <div> Users</div>
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
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'>
                                        <?php
                                        $query = 'SELECT * FROM categories';
                                        $res = mysqli_query($conn, $query);
                                        $count_categories = mysqli_num_rows($res);
                                        echo $count_categories;
                                        ?>
                                    </div>
                                    <div>Categories</div>
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
            <!-- /.row -->

            <?php
            $query_pub = "SELECT * FROM posts WHERE post_status = 'published'";
            $res_count_pub = mysqli_query($conn, $query_pub);
            $count_post_pub = mysqli_num_rows($res_count_pub);

            $query = "SELECT * FROM posts WHERE post_status = 'draft'";
            $res_count = mysqli_query($conn, $query);
            $count_post_draft = mysqli_num_rows($res_count);

            $query_comment = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
            $res_comment = mysqli_query($conn, $query_comment);
            $count_comment_unapproved = mysqli_num_rows($res_comment);

            $query_user = "SELECT * FROM users WHERE user_role = 'subscriber'";
            $res_user = mysqli_query($conn, $query_user);
            $count_user_subs = mysqli_num_rows($res_user);
            ?>



            <?php
            $elements_count = ["", $count_post_pub, $count_post_draft, $count_categories, $count_user, $count_user_subs, $count_comment, $count_comment_unapproved];

            $elements_text = ['All Posts', 'Active Posts', 'Draft Posts', 'Categories', 'Users', 'Subscribers', 'Comments', 'Unapproved Comments'];

       
            ?>
            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
                            <?php
                            for ($i = 0; $i < 8; $i++) {
                                $text = $elements_text[$i];
                                $count = $elements_count[$i];
                                echo "['$text','$count'],";
                            }
                            ?>

                        ]);

                        var options = {

                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                    
                </script>

                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
            </div>


            </body>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "./includes/admin_footer.php"; ?>