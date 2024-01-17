<?php session_start(); ?>

<?php

function ImagePlaceHolder($img = '')
{
    if (!$img) {
        return '💥no image found💥';
    } else {
        return $img;
    }
}




function insert_categories()
{
    global $conn;

    //ADD CATEGORIES
    if (isset($_POST['sub'])) {
        $title_cat = $_POST['cat_title'];

        if ($title_cat === "" || empty($title_cat)) {
            echo "title cannot be empty try again";
        } else {
            $query = "INSERT INTO categories (cat_title) VALUES ('$title_cat')";

            $results = mysqli_query($conn, $query);

            confirmQuery($results);
        }
    }
}

/////////////////////////////////////////////////////////////////////////////////
function find_all_categories()
{
    global $conn;
    //FIND ALL CATEGORIES
    $query = 'SELECT * FROM categories';

    $res = mysqli_query($conn, $query);

    confirmQuery($res);

    $count = mysqli_num_rows($res);

    echo ($count === 0) ? "nothing found" : "categories found";

?>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>id</th>
                <th>Category Title</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <?php
            while ($row = mysqli_fetch_assoc($res)) {
                $title = $row['cat_title'];
                $id = $row['cat_id'];
                echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$title}</td>";
                echo "<td><a href='categories.php?delete={$id}'>🗑️</a></td>";
                echo "<td><a href='categories.php?update={$id}'>📝</a></td>";
                echo "</tr>";
            }
        }


        ////////////////////////////////////////////////////////////////////////////
        function deleteCategory()
        {
            global $conn;
            //DELETE CATEGORY 
            if (isset($_GET['delete'])) {
                $id = $_GET['delete'];

                $del = "DELETE FROM categories WHERE cat_id= $id ";

                $resDel = mysqli_query($conn, $del);

                //redirects to categories.php file
                header("Location: categories.php");

                confirmQuery($resDel);
            }
        }


        ////////////////////////////////////////////////////////////////////////////////////
        function Add_Post()
        {
            global $conn;

            if (isset($_POST['create_post'])) {
                $post_title = escape($_POST['title']);
                $post_user = $_POST['user'];
                $post_category_id = $_POST['post_category']; //select 
                $post_status = strtolower($_POST['post_status']);

                $post_image = $_FILES['image']['name'];
                $post_image_temp = $_FILES['image']['tmp_name'];

                $post_tags = $_POST['post_tags'];
                $post_content = $_POST['post_content'];
                $post_date = date('d-m-y');
                // $post_comment_count =4;

                move_uploaded_file($post_image_temp, "../images/$post_image");


                $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_user,
    post_date,post_image,post_content,post_tags,post_comment_count,post_status,post_views_count,post_likes)";
                $query .= " VALUES ($post_category_id,'$post_title','$post_user','$post_user',now(),'$post_image','$post_content','$post_tags',0,'$post_status',0,0)";

                $res = mysqli_query($conn, $query);
                confirmQuery($res);

                $id = mysqli_insert_id($conn); //gets the id of the new post

                echo "<div class='bg-success'>Post created: <a href='posts.php'>view all Posts</a> <a href='../post.php?p_id=$id'>check Post</a></div>";
            }
        }


        //////////////////////////////////////////////////////////////////////////
        function confirmQuery($results)
        {
            global $conn;
            if (!$results) {
                die("query failed" . mysqli_error($conn));
            }
        }

        function updateProfile()
        {
            global $conn;

            if (isset($_POST['update_profile'])) {

                $username = $_POST['username'];
                $password = $_POST['password'];
                $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

                $fname = $_POST['firstname'];
                $lname = $_POST['lastname'];

                $email = $_POST['email'];

                $image = $_FILES['img']['name'];
                $temp_image = $_FILES['img']['tmp_name'];

                move_uploaded_file($temp_image, "../images/$image");

                $role = $_POST['role'];

                $id = $_SESSION['id'];

                $query = "UPDATE users SET ";
                $query .= "user_name = '$username', ";
                $query .= "user_password = '$password', ";
                $query .= "user_firstname = '$fname', ";
                $query .= "user_lastname = '$lname', ";
                $query .= "user_email = '$email', ";
                $query .= "user_image = '$image', ";
                $query .= "user_role = '$role' ";
                $query .= " WHERE user_id = $id";

                $res = mysqli_query($conn, $query);

                if (!$res) {
                    die(mysqli_error($conn));
                }
                header("Location: ./");
            }
        }

        //We will get the current timestamp  with time() which will be always different, and we will calculate the $time_out variable. Then if we don't have the user with that session id in the database table, we will insert new record. But if we have it (meaning the user is still on the site, means only time_out value is updated, it's still the same user, so we will only update the existing record). So, we are getting the time out by subtracting from the current timestamp (which is always different, from second to second) let's say 60 seconds, so we are checking for a record based on the last sixty seconds, if it's not expired, meaning user should be still online.

        // if($count == NULL) does that mean we do not have any result for user

        // - Yes, it means we do not have a result for that session id, either the record is old meaning if that's the case then that record is old.

        function getusersonline()
        {
            if (isset($_GET['onlineusers'])) {
                global $conn;

                if (!$conn) {
                    // session_start();
                    include("../includes/db.php");

                    $session = session_id(); //get the current session id
                    $time = time(); // sets current timestamp
                    $timeout = $time - 10;

                    //? checking if theres any users online 
                    $query = "SELECT * FROM users_online WHERE session = '$session'";

                    $res = mysqli_query($conn, $query);
                    $count = mysqli_num_rows($res);

                    //? if no users detected then insert new session id to table
                    if (!$count || $count == NULL) {
                        mysqli_query($conn, "INSERT INTO users_online (session,time) VALUES('$session','$time')");
                    } else {
                        //? if theres a session then update thier time 
                        mysqli_query($conn, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
                    }

                    //? where time > timeout
                    //? user logged out at time = 180 and $timeout = 180 - 10;
                    //? time will keep updating the timeout til it reaches the time
                    //? like this:
                    //? so paused at 180 - 10 = 170
                    //? starts time from 170,171,172,173,174,175,176,177,178,179,180
                    //? and then user appears offline

                    $users_online_query = mysqli_query($conn, "SELECT * FROM users_online WHERE time > '$timeout'");

                    while ($row = mysqli_fetch_assoc($users_online_query)) {
                        $time = $row['time'];
                        $session = $row['session'];
                    };



                    $count_online = mysqli_num_rows($users_online_query);
                    echo $count_online;
                }
            }
        }

        getusersonline();

        function escape($string)
        {
            global $conn;
            // trim(strip_tags($string));
            return mysqli_real_escape_string($conn, trim($string));
        }


        function recordCount($table)
        {
            global $conn;
            $query = "SELECT * FROM $table";
            $res = mysqli_query($conn, $query);
            return  mysqli_num_rows($res);
        }

        function statusCount($table, $status, $string)
        {
            global $conn;
            $query = "SELECT * FROM $table WHERE $status = '$string'";
            $res = mysqli_query($conn, $query);
            return mysqli_num_rows($res);
        }


        function is_admin($username = '')
        {
            global $conn;

            $query = "SELECT * FROM users WHERE user_name = '$username'";
            $res = mysqli_query($conn, $query);

            $row = mysqli_fetch_assoc($res);

            if ($row['user_role'] == 'admin') {
                return true;
            } else {
                return false;
            }
        }


        function usernameExists($user)
        {
            global $conn;
            $query = "SELECT user_name FROM users WHERE user_name = '$user'";
            $res = mysqli_query($conn, $query);
            confirmQuery($res);

            $count = mysqli_num_rows($res);

            if ($count > 0) {
                return true;
            } else {
                return false;
            }
            return $count;
        }

        function emailExists($email)
        {
            global $conn;
            $query = "SELECT user_email FROM users WHERE user_email = '$email'";
            $res = mysqli_query($conn, $query);
            confirmQuery($res);

            $count = mysqli_num_rows($res);

            if ($count > 0) {
                return true;
            } else {
                return false;
            }
            return $count;
        }


        function redirect($location)
        {
            header("Location:" . $location);
            exit;
        }

        // //////////////////////////////////////////////
        function ifItIsMethod($method = null)
        {
            if ($_SERVER['REQUEST_METHOD'] == strtoupper($method)) {
                return true;
            }
            return false;
        }

        function isLoggedin()
        {
            if (isset($_SESSION['username'])) {
                return true;
            } else {
                return false;
            }
        }
        ////////////////////////////////////////////////////////////////////////////////
        function query($query)
        {
            global $conn;
            return mysqli_query($conn, $query);
        }

        function loggedInUserId()
        {
            //if true
            if (isLoggedin()) {
                $user = $_SESSION['username'];
                $result = query("SELECT * FROM users WHERE user_name ='$user'");
                confirmQuery($result);
                $row = mysqli_fetch_assoc($result);
                $curUserId = $row['user_id'];

                return mysqli_num_rows($result) >= 1 ? $curUserId : false;
            }
            return false;
        }

        function userLikedPost($post_id = '')
        {
            $res =  query("SELECT * FROM likes WHERE user_id=" . loggedInUserId() . " AND post_id = $post_id");
            confirmQuery($res);
            return mysqli_num_rows($res) >= 1 ? true : false;
        }

        function getPostLikes($pid)
        {
            $result = query("SELECT * FROM likes WHERE post_id = $pid");
            confirmQuery($result);
            $count_likes = mysqli_num_rows($result);
            return $count_likes;
        }


        ////////////////////////////////////////////////////////////////////////////////////////////////
        function checkIfUserIsloggedInANDredirect($redirect_location = null)
        {
            if (isLoggedin()) {
                redirect($redirect_location);
            }
        }
        /////////////////////////////////////////////////////
        function register_user($user, $email, $password)
        {
            global $conn;

            $user = mysqli_real_escape_string($conn, $user);
            $password = mysqli_real_escape_string($conn, $password);
            $email = mysqli_real_escape_string($conn, $email);

            $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

            $query = "INSERT INTO users (user_name,user_password,user_firstname,user_lastname,user_email,user_image,user_role,randSalt,token)";
            $query .= " VALUES ('$user','$password','','','$email','','subscriber','','')";
            $res = mysqli_query($conn, $query);

            if (!$res) {
                die(mysqli_error($conn));
            }

            $msg = "User Registered successfully";
            echo "<div class='bg-success msg text-center'>$msg</div>";
        }

        function login_user($user, $password)
        {
            global $conn;

            $user = trim($user);
            $password = trim($password);
            $user = mysqli_real_escape_string($conn, $user);
            $password = mysqli_real_escape_string($conn, $password);

            $query = "SELECT * FROM users WHERE user_name = '$user'";

            $res = mysqli_query($conn, $query);

            if (!$res) {
                die(mysqli_error($conn));
            }

            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['user_id'];
                $user_pass = $row['user_password']; //crypted password 
                $username = $row['user_name'];
                $firstname = $row['user_firstname'];
                $lastname = $row['user_lastname'];
                $role = $row['user_role'];

                if (password_verify($password, $user_pass)) {
                    //?setting a session only when user logs in
                    //? and can only access the admin page only if logged in
                    $_SESSION['username'] = $username;
                    $_SESSION['firstname'] = $firstname;
                    $_SESSION['lastname'] = $lastname;
                    $_SESSION['role'] = $role;
                    $_SESSION['id'] = $id;

                    redirect("/CMS_TEMPLATE/admin");
                } else {
                    return false;
                }
            }

            return true;
            // $password = crypt($password,$user_pass);

            //*if(password_verify($password,$user_pass)){ other way to check  , 
            //  if($username === $user  && $password === $user_pass && $role === 'admin'){
        }
            ?>