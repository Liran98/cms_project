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

            $query = "SELECT * FROM posts WHERE post_status = 'published'";

            $res = mysqli_query($conn, $query);

            $count = mysqli_num_rows($res);
            if ($count === 0) {
                echo "<h1 class='text-center'>no posts found add one maybe?</h1>";
            }

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
                    by <a href="author_posts.php?auth_name=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>">
                        <?php echo $post_author; ?>
                    </a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                    <img width='200' class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
            <?php
            }
            ?>
            <hr>
        </div>
    </div>
</div>



<?php include './includes/footer.php'; ?>