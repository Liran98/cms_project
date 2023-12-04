<?php include './includes/header.php'; ?>
<?php include "./includes/db.php"; ?>

<!-- Navigation -->
<?php include './includes/navigation.php'; ?>

<!-- Blog Sidebar Widgets Column -->
<?php include './includes/sidebar.php'; ?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            if (isset($_GET['category'])) {
                $category_id = $_GET['category'];


                if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                    $query = "SELECT * FROM posts WHERE post_category_id =$category_id";
                } else {
                    $query = "SELECT * FROM posts WHERE post_category_id =$category_id AND post_status = 'published";
                }


                // $query = "SELECT * FROM posts WHERE post_category_id =$category_id AND post_status = 'published";
                $res = mysqli_query($conn, $query);

                $count_cate = mysqli_num_rows($res);

                if ($count_cate < 1) {
                    echo "<h1 class='text-center'>no categories found</h1>";
                } else {



                    while ($row = mysqli_fetch_assoc($res)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'], 0, 250);
            ?>
                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                        </h2>

                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                        <hr>
                        <img width='200' class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                        <hr>
            <?php
                    }
                }
            } else {
                header("Location: index.php");
            }
            ?>
        </div>
    </div>
</div>

<?php include './includes/footer.php'; ?>