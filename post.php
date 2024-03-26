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



            if (isset($_GET['p_id'])) {
                $id = $_GET['p_id'];

                $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $id";
                $view_res = mysqli_query($conn, $view_query);

                if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                    $query = "SELECT * FROM posts WHERE post_id = $id";
                } else {
                    $query = "SELECT * FROM posts WHERE post_id = $id AND post_status = 'published";
                }

                $query = "SELECT * FROM posts WHERE post_id = $id";
                $res = mysqli_query($conn, $query);
                if (mysqli_num_rows($res) < 1) {
                    echo "<h1 class='text-center'>no posts available</h1>";
                } else {



                    while ($row = mysqli_fetch_assoc($res)) {

                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];

            ?>
                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $post_title; ?></a>
                        </h2>

                        <p class="lead">
                            by
                            <a href="index.php">
                                <?php echo $post_author; ?>
                            </a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span>
                            <?php echo $post_date; ?>
                        </p>
                        <hr>
                        <img width='200' class="img-responsive" src="images/<?php echo ImagePlaceHolder($post_image); ?>" alt="">
                        <hr>
                        <p>
                            <?php echo $post_content; ?>
                        </p>
                        <!-- <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->
                    <?php
                    }

                    ?>

                    <?php

                    if (isset($_POST['create_comment'])) {
                        //getting comment_post_id from the post we click on 
                        // relating the comment_post_id from the post_id
                        $id = $_GET['p_id'];

                        $author = $_POST['comment_author'];
                        $email = $_POST['comment_email'];
                        $content = $_POST['comment_content'];



                        if (empty($author) || empty($email) || empty($content)) {
                            echo "<h3 class='text-danger'>💥Fields Cannot Be Empty💥</h3>";
                        } else {
                            $query = "INSERT INTO comments (comment_post_id,comment_author , comment_email ,comment_content,comment_status,comment_date) VALUES ($id,'$author','$email','$content','unapproved',now())";

                            $res = mysqli_query($conn, $query);

                            if (!$res) {
                                die(mysqli_error($conn));
                            }

                            // $query_comment = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $id";
                            // $res_comment = mysqli_query($conn, $query_comment);
                            redirect('post.php?p_id=' . $id);
                        }
                    }
                    ?>


                    <!-- Comments Form -->
                    <div class="well">
                        <h4>Leave a Comment:</h4>
                        <form action="" method="post" role="form">
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input class="form-control" name="comment_author" type="text">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>

                                <input class="form-control" name="comment_email" type="email">
                            </div>
                            <div class="form-group">
                                <label for="comment">Comment</label>
                                <textarea name="comment_content" class="form-control" rows="3"></textarea>
                            </div>
                            <button name="create_comment" type="submit" class="btn btn-primary">add comment</button>
                        </form>
                    </div>

                    <hr>

                    <!-- Posted Comments -->

                    <?php
                    // getting all comments if thier status is approved otherwise its hidden
                    $query = "SELECT *  FROM comments WHERE comment_post_id = $id ";
                    $query .= "AND comment_status = 'approved' ";
                    $query .= "ORDER BY comment_id DESC";
                    //order by id DESC gives us the latest comment at first , on top


                    $res = mysqli_query($conn, $query);
                    if (!$res) {
                        die(mysqli_error($conn));
                    }
                    $count = mysqli_num_rows($res);
                    if (!$count) {
                        echo "<h1 class='bg-danger'>No comments found</h1>";
                    }

                    while ($row = mysqli_fetch_assoc($res)) {
                        $author = $row['comment_author'];
                        $content = $row['comment_content'];
                        $date = $row['comment_date'];
                    ?>


                        <!-- Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img width="50" class="media-object" src="./images/<?php echo $img; ?>" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $author; ?>
                                    <small><?php echo $date; ?></small>
                                </h4>
                                <?php echo $content; ?>

                            </div>
                        </div>
                        <hr>

                <?php
                    }
                }
                ?>

                <?php if (isLoggedin()) { ?>

                    <div class="row">
                        <p class="pull-right">
                            <a href="" data-toggle="tooltip" data-placement="right" title="<?php echo userLikedPost($post_id) ? 'i liked this before' : 'you can like this post'; ?>" class="<?php echo userLikedPost($post_id) ? 'dislike' : 'like'; ?>">
                                <span class="<?php echo userLikedPost($post_id)
                                                    ? 'glyphicon glyphicon-thumbs-down'
                                                    : 'glyphicon glyphicon-thumbs-up' ?>">
                                </span>
                                <?php echo userLikedPost($post_id) ? 'Dislike' : 'Like'; ?>

                            </a>
                        </p>
                    </div>

                    <div class="row">
                        <p class="pull-right">

                            Likes : <?php
                                    echo getPostLikes($post_id);
                                    ?>
                        </p>
                    </div>
                <?php } else {  ?>

                    <div class="row">
                        <p class="pull-right">

                            Likes : <?php
                                    echo getPostLikes($id);
                                    ?>
                        </p>
                    </div>

                    <a class="text-center" href="login.php">
                        You need to <strong>login</strong> to like
                        the post 👤
                    </a>
                <?php }
                ?>
                <div class="clearfix"></div>
        </div>
    </div>
</div>
<?php
                // if isset($_GET['p_id]){}    
            } else {
                header("Location: index.php");
            }
?>
<?php
//name liked from ajax
if (isset($_POST['liked'])) {

    $uid = $_POST['uid'];
    $pid = $_POST['pid'];

    echo $pid;
    echo $uid;
    //FETCHING POST
    $query_post = "SELECT * FROM posts WHERE post_id =$pid";
    $res = mysqli_query($conn, $query);

    if (!$res) {
        die(mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($res);
    $likes = $row['post_likes'];
    //UPDATE POST WITH LIKES
    $res_update = mysqli_query($conn, "UPDATE posts SET post_likes=$likes + 1 WHERE post_id =$pid");
    if (!$res_update) {
        die(mysqli_error($conn));
    }
    //CREATE LIKES FOR POST

    $res_inser = mysqli_query($conn, "INSERT INTO likes(user_id, post_id) VALUES($uid, $pid)");
    if (!$res_inser) {
        die(mysqli_error($conn));
    }
    exit();
}


if (isset($_POST['unliked'])) {
    $user_id = $_POST['uid'];
    $post_id = $_POST['pid'];
    //1 fetching likes
    $query_post = "SELECT * FROM posts WHERE post_id =$post_id";
    $res = mysqli_query($conn, $query_post);

    if (!$res) {
        die(mysqli_error($conn));
    }

    $row = mysqli_fetch_array($res);
    $likes = $row['post_likes'];

    //2 deleting likes
    mysqli_query($conn, "DELETE FROM likes WHERE post_id =$post_id AND user_id= $user_id");


    //3 updating likes
    mysqli_query($conn, "UPDATE posts SET post_likes=$likes-1 WHERE post_id =$post_id");

    exit();
}
?>

<script>
    //close the php with ; otherwise wont work  


    $(document).ready(function() {
        let user_id = <?php echo loggedInUserId(); ?>;
        let post_id = <?php echo $id; ?>;

        $("[data-target = 'tooltip']").tooltip();
        $('.like').click(function(e) {
            $.ajax({
                url: "post.php?p_id=<?php echo $id; ?>",
                type: "post",
                data: {
                    'liked': 1,
                    'pid': post_id,
                    'uid': user_id, //hardcoded user
                }
            });
        });

        $('.dislike').click(function(e) {
            $.ajax({
                url: "post.php?p_id=<?php echo $id; ?>",
                type: "post",
                data: {
                    'unliked': 1,
                    'pid': post_id,
                    'uid': user_id,
                }
            })
        });
    });
</script>

<!-- // mysqli_stmt_free_result($stmt); -->

<?php include './includes/footer.php'; ?>