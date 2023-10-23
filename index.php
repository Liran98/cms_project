<?php include "./includes/header.php"; ?>
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
            $query = "SELECT * FROM posts";
            $res = mysqli_query($conn, $query);
            $page_count = mysqli_num_rows($res);

            $num_pages = floor(ceil($page_count / 5));

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = "";
            }

            if ($page === 1 || $page === "") {
                $curpage = 0;
            } else {
                $curpage = ($page * 5) - 5;
            }

//? LIMIT is similar to slice in js , $curpage is 1 then show first 5 posts
//? $curpage is 2 then multiple it by 5 is 10 then minus 5 is 5 
            $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $curpage,5";

            $res = mysqli_query($conn, $query);
            $count = mysqli_num_rows($res);
            if ($count === 0) {
                echo "<h1 class='text-center'>no posts found add one maybe?</h1>";
            }



            while ($row = mysqli_fetch_assoc($res)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_user = $row['post_user'];
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
                    by <a href="author_posts.php?auth_name=<?php echo $post_user; ?>&p_id=<?php echo $post_id; ?>">
                        <?php echo $post_user; ?>
                    </a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                    <img width='200' class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                </a>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            <?php
            }

            ?>
        </div>
    </div>
</div>
<!-- /.row -->

<hr>

<ul class="pager">
    <?php
    //? making buttons for paginations depends on how many posts are there
    //? if theres 30 posts and we want 5 posts on each page then thats 6 buttons
    for ($i = 1; $i <= $num_pages; $i++) {
        if ($i == 1 && $page === "" || $page == $i) {
            echo "<li><a class='bg-dark' href='index.php?page=$i'>$i</a></li>";
        } else {
            echo "<li><a href='index.php?page=$i'>$i</a></li>";
        }
    }


    ?>


</ul>


<?php include './includes/footer.php'; ?>