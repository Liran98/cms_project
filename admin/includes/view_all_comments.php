 <form action="" method="post">
     <select name="select_all_comments" id="">
         <option value="">Select option</option>
         <option value="approved">approve</option>
         <option value="unapproved">unapprove</option>
         <option value="delete">delete</option>
     </select>
     <button class='btn btn-primary' type='submit'>submit</button>


     <?php

        if (isset($_POST['checkboxarray'])) {

            $select = $_POST['select_all_comments'];

            $checkbox = $_POST['checkboxarray'];

            foreach ($checkbox as $val) {
                switch ($select) {
                    case 'approved':
                        $query = "UPDATE comments SET comment_status = '$select' WHERE comment_id = $val";
                        $res = mysqli_query($conn, $query);
                        break;

                    case 'unapproved':
                        $query = "UPDATE comments SET comment_status = '$select' WHERE comment_id = $val";
                        $res = mysqli_query($conn, $query);
                        break;

                    case 'delete':
                        $query = "DELETE FROM comments WHERE comment_id =$val";
                        $res = mysqli_query($conn, $query);
                        break;
                }
            }
        }
        ?>

     <table class="table table-bordered table-hover">
         <thead>
             <tr>
                 <th><input id="selectAllBoxes" type="checkbox"></th>
                 <th> id</th>
                 <th>author </th>
                 <th> comment</th>
                 <th>email</th>
                 <th> status</th>
                 <th> in response to</th>
                 <th> date</th>
                 <th> approve</th>
                 <th> unapprove</th>
                 <th> delete</th>
             </tr>
         </thead>
         <tbody>
             <?php
                $query = "SELECT * FROM comments";
                $res = mysqli_query($conn, $query);

                if (!$res) {
                    die("query failed" . mysqli_error($conn));
                }

                while ($row = mysqli_fetch_assoc($res)) {
                    $comment_id = $row['comment_id'];
                    $comment_post_id = $row['comment_post_id'];
                    $comment_date = $row['comment_date'];
                    $comment_author = $row['comment_author'];
                    $comment_email = $row['comment_email'];
                    $comment_content = $row['comment_content'];
                    $comment_status = $row['comment_status'];
                ?>
                 <tr>
                     <td><input type="checkbox"  class="checkBoxes" name="checkboxarray[]" value="<?php echo $comment_id; ?>"></td>
                     <td><?php echo $comment_id; ?></td>
                     <td><?php echo $comment_author; ?></td>
                     <td><?php echo $comment_content; ?></td>

                     <?php

                        //    $cat_query = "SELECT * FROM categories WHERE cat_id =$post_category_id";
                        //    $cat_res = mysqli_query($conn,$cat_query);
                        //                                 
                        //    while($row = mysqli_fetch_assoc($cat_res)){
                        //                    
                        //        $cat_title = $row['cat_title'];
                        //        
                        //                                }
                        ?>
                     <td><?php echo $comment_email; ?></td>

                     <td><?php echo $comment_status; ?></td>


                     <?php
                        // we get the comment_post_id from the p_id when clicking on a certain post


                        //MOVE TO THE POST WHERE YOU COMMENTED     
                        $post_query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                        $post_res = mysqli_query($conn, $post_query);
                        while ($post_row = mysqli_fetch_assoc($post_res)) {
                            $title = $post_row['post_title'];
                            $id = $post_row['post_id'];

                            echo "<td><a href='../post.php?p_id=$id'>$title</a></td>";
                        }

                        ?>




                     <td><?php echo $comment_date; ?></td>

                     <td><a href="comments.php?approve=<?php echo $comment_id; ?>">approve</a>
                     <td><a href="comments.php?unapprove=<?php echo $comment_id; ?>">unapprove</a></td>

                     <td><a href="comments.php?delete=<?php echo $comment_id; ?>">🗑️</a></td>

                 </tr>
             <?php
                }
                ?>

         </tbody>
     </table>
 </form>

 <?php

    if (isset($_GET['unapprove'])) {
        $id = $_GET['unapprove'];

        $query = "UPDATE comments SET comment_status = 'unapproved'  WHERE comment_id=$id";

        $res = mysqli_query($conn, $query);

        if (!$res) {
            die(mysqli_error($conn));
        }

        header("Location: comments.php");
    }

    if (isset($_GET['approve'])) {
        $id = $_GET['approve'];

        $query = "UPDATE comments SET comment_status = 'approved'  WHERE comment_id=$id";

        $res = mysqli_query($conn, $query);

        if (!$res) {
            die(mysqli_error($conn));
        }

        header("Location: comments.php");
    }




    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $query = "DELETE FROM comments WHERE comment_id =$id";

        $res = mysqli_query($conn, $query);

        if (!$res) {
            die(mysqli_error($conn));
        }

        $query_comment = "UPDATE posts SET post_comment_count = post_comment_count - 1 WHERE post_id = $id";
        $res_comment = mysqli_query($conn, $query_comment);
        if (!$res_comment) {
            die(mysqli_error($conn));
        }
        header("Location: comments.php");
    }

    ?>