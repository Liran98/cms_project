 <?php
    //? check box array is the checkbox input , "<input name="checkboxArray[]" 
    //? getting the id of the post from the checkbox input value="<?php echo $id;"
    //? and could edit or delete more than one post at a time 
    // include "includes/delete_modal.php";

    if (isset($_POST['checkboxArray'])) {
        $select = $_POST['post_selection'];
        $box = $_POST['checkboxArray'];

        foreach ($box as $id) {
            switch ($select) {
                case 'published':
                    $query = "UPDATE posts SET post_status = '$select' WHERE post_id =$id ";
                    $res = mysqli_query($conn, $query);
                    break;

                case 'draft':
                    $query = "UPDATE posts SET post_status = '$select' WHERE post_id =$id ";
                    $res = mysqli_query($conn, $query);
                    break;

                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id =$id ";
                    $res = mysqli_query($conn, $query);
                    break;

                case 'clone':
                    $query = "SELECT * FROM posts WHERE post_id = $id";
                    $res = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($res)) {
                        $post_title = $row['post_title'];
                        $post_category_id = $row['post_category_id'];
                        $post_date = $row['post_date'];
                        $post_author = $row['post_author'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_content = $row['post_content'];
                    }
                    $loggedUser = $_SESSION['username'];
                    $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_user,
post_date,post_image,post_content,post_tags,post_comment_count,post_status,post_views_count)";
                    $query .= " VALUES ($post_category_id,'$post_title','$post_author','$loggedUser',now(),'$post_image','$post_content','$post_tags',0,'$post_status',0)";

                    $res = mysqli_query($conn, $query);
                    if (!$res) {
                        die(mysqli_error($conn));
                    }
                    break;
            }
        }
    }
    ?>


 <form enctype="multipart/form-data" action="" method="post">

     <select class="form-select form-select-lg mb-3" name="post_selection">
         <option value="">Select</option>
         <option value="published">Published</option>
         <option value="draft">Draft</option>
         <option value="delete">Delete</option>
         <option value="clone">Clone</option>

     </select>

     <div class="input-group">
         <button name='reset' type="submit" class="btn btn-danger">Reset Views</button>
         <button name='apply' type="submit" class="btn btn-success">Apply</button>
         <button type="submit" class="btn btn-info "><a href="posts.php?source=add_post">Add New</a></button>

         <table class="table table-bordered table-hover">
             <thead>
                 <tr>
                     <th><input id="selectAllBoxes" type="checkbox"></th>
                     <th>id</th>
                     <th>users</th>
                     <th>title</th>
                     <th>category</th>
                     <th>status</th>
                     <th>image/ViewPost</th>
                     <th>tags</th>
                     <th>comments</th>
                     <th>date</th>
                     <th>Views</th>
                     <th>delete</th>
                     <th>edit</th>
                     <th>published</th>
                     <th>draft</th>

                 </tr>
             </thead>
             <tbody>
                 <?php
                    // $query = "SELECT * FROM posts ORDER BY post_id DESC";
                    
                    // $query = "SELECT posts.post_id, posts.post_author,posts.post_title, ";
                    // $query .= "posts.post_user, posts.post_date, posts.post_image, ";
                    // $query .= "posts.post_content, posts.post_tags, posts.post_comment_count ";
                    // $query .= "posts.post_status , posts_views_count ";
                    // $query .= "categories.cat_id, categories.cat_title FROM posts ";
                    // $query .= "LEFT JOIN categories ON posts.posts_category_id = categories.cat_id";
                    
                    //? you can pull data from both tables
                    $query = "SELECT * FROM posts LEFT JOIN
                     categories ON posts.post_category_id
                      = categories.cat_id ORDER BY
                       posts.post_id DESC";

                    $res = mysqli_query($conn, $query);

                     if(!$res){
                         die(mysqli_error($conn));
                     }


                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['post_id'];
                        $post_user = $row['post_user'];
                        $author = $row['post_author'];
                        $title = $row['post_title'];
                        //id
                        $post_category_id = $row['post_category_id'];
                        $status = $row['post_status'];
                        $img = $row['post_image'];
                        $tags = $row['post_tags'];
                        $comments = $row['post_comment_count'];
                        $date = $row['post_date'];
                        $view = $row['post_views_count'];
                        
                        //? from categories table
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];

                        if (empty($tags)) {
                            $tags = "no tags found";
                        }



                        $comment_count_query = mysqli_query($conn, "SELECT * FROM comments WHERE comment_post_id = $id");
                        $comment_count = mysqli_num_rows($comment_count_query);
                    ?>
                     <tr>
                         <!--//? name for checkbox has an array so we could update more than one box at a time checkboxArray[] -->
                         <td><input class="checkBoxes" name="checkboxArray[]" value="<?php echo $id; ?>" type="checkbox"></td>

                         <td><?php echo $id; ?></td>

                         <?php
                            if (!empty($author)) {
                                echo "<td> $author </td>";
                            } else if (!empty($post_user)) {
                                echo "<td> $post_user </td>";
                            }

                            ?>



                         <td><?php echo $title; ?></td>

                         <?php

                            // $cat_query = "SELECT * FROM categories WHERE cat_id =$post_category_id";
                            // $cat_res = mysqli_query($conn, $cat_query);

                            // while ($row = mysqli_fetch_assoc($cat_res)) {

                            //     $cat_title = $row['cat_title'];
                            // }

                            if (empty($cat_title)) {
                                echo "<td>please edit your post 
                                <a href='posts.php?source=edit_post&p_id=$id'>📝</a></td>";
                            } else {
                                echo "<td>$cat_title</td>";
                            }
                            ?>
                         <td><?php echo $status; ?></td>
                         <td><?php echo "<a href='../post.php?p_id=$id'><img class='img-responsive' src='../images/$img' /></a>"; ?></td>
                         <td><?php echo $tags; ?></td>
                         <td><a href="./post_comments.php?id=<?php echo $id; ?>"><?php echo $comment_count; ?></a></td>
                         <td><?php echo $date; ?></td>
                         <td><a href="posts.php?reset_views=<?php echo $id; ?>"><?php echo $view; ?>👁️‍🗨️</a></td>

                         <!-- you can use rel on <a></a> then call it with javascript -->
                         <!-- <a rel="post_id" href=""></a> -->

                         <td><a data-get="<?php echo $id; ?>" class="del_link">🗑️</a></td>

                         <td><a href="posts.php?source=edit_post&p_id=<?php echo $id; ?>">📝</a></td>
<td><a href="posts.php?pub=<?php echo $id; ?>">published</a></td>
<td><a href="posts.php?draft=<?php echo $id; ?>">draft</a></td>

                     </tr>
                 <?php
                    }


                    ?>

             </tbody>
         </table>
 </form>

 <?php

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $query = "DELETE FROM posts WHERE post_id = $id";

        $res = mysqli_query($conn, $query);

        if (!$res) {
            die(mysqli_error($conn));
        }

        header("Location: posts.php");
    }

    if (isset($_POST['reset'])) {
        $query = "UPDATE posts SET post_views_count = 0";
        $res = mysqli_query($conn, $query);

        header("Location: posts.php");
    }
    ?>

 <?php
    if (isset($_GET['reset_views'])) {
        $view_id = $_GET['reset_views'];
        $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($conn, $_GET['reset_views']) . "";
        $res = mysqli_query($conn, $query);
        header("Location: posts.php");
    }



    if(isset($_GET['pub'])){
        $p_id = $_GET['pub'];
        $query = "UPDATE posts SET post_status = 'published' WHERE post_id = $p_id";
        $res = mysqli_query($conn,$query);

        if(!$res){
            die(mysqli_error($conn));
        }
        header("Location: posts.php");
    }
    if(isset($_GET['draft'])){
        $p_id = $_GET['draft'];
        $query = "UPDATE posts SET post_status = 'draft' WHERE post_id = $p_id";
        $res = mysqli_query($conn,$query);

        if(!$res){
            die(mysqli_error($conn));
        }
        header("Location: posts.php");
    }
    ?>