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
                        welcome to Admin
                        <small> 👤<?php echo strtoupper(get_user_name()); ?></small>
                    </h1>
                    <h1>

                    </h1>
                </div>
            </div>
            <!-- /.row -->


           

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row ">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge '>
                                        <span class="posts_online">
                                            <?php
                                           echo $count_posts = count_records(get_all_user_posts());
                                            ?>
                                        </span>
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
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'>
                                        <?php
                                        echo $count_comment= count_records(get_all_posts_user_comments());
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
               
                     
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'>
                                        <?php
                                        echo $count_categories =  count_records(get_all_user_cat());
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

            $count_post_pub = count_records(get_all_user_published_posts());
            $count_post_draft = count_records(get_all_user_draft_posts());
            $count_comment_unapproved = statusCount('comments','comment_status','unapproved');
            $count_user_subs = statusCount('users','user_role','subscriber');
            ?>

            <?php
            $elements_count = [$count_posts, $count_post_pub, $count_post_draft, $count_categories , $count_comment, $count_comment_unapproved];
            $elements_text = ['All Posts', 'Published Posts', 'Draft Posts', 'Categories', 'Comments', 'Unapproved Comments'];
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
                            for ($i = 0; $i < count($elements_text); $i++) {
                                $text = $elements_text[$i];
                                $count = $elements_count[$i];
                                echo "['$text',$count],";
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