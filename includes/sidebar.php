<?php

$error = [
    'username' => '',
    'pass' => ''
];

checkIfUserIsloggedInANDredirect('/CMS_TEMPLATE/admin');

if (ifItIsMethod('post')) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    if (isset($username) && isset($password)) {
        login_user($username, $password);
    } else {
        redirect('/CMS_TEMPLATE/index');
    }
    $query = "SELECT * FROM users WHERE user_name = '$username'";
    $res = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($res)) {
        $id = $row['user_id'];
        $user = $row['user_name'];
        $user_pass = $row['user_password'];
    }
if(!$id){
    redirect('index');
}else{
    if (!$password || $user_pass !== $password) {
        //uniqid() returns random id
        $error['pass'] = 'invalid password' . "<br>";
        $error['pass'] .= "<a href='forgot_pass.php?user_pass_id=$id'>Forgot password?</a>";
    }
    if (!$username) {
        $error['username'] = 'invalid username';
    }
}
    
}
?>

<div class="col-md-4">
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="sub" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!--                search form-->

        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">

        <?php
        $cate_query = mysqli_query($conn, "SELECT * FROM categories");
        $cate_count = mysqli_num_rows($cate_query);
        $Allpages = floor(ceil($cate_count / 5));

        if (isset($_GET['dapage'])) {
            $page = $_GET['dapage'];
        } else {
            $page = "";
        }

        if ($page == 1 || $page == "") {
            $curpage = 0;
        } else {
            $curpage = ($page * 5) - 5;
        }

        $query = "SELECT * FROM categories LIMIT $curpage,5";

        $res = mysqli_query($conn, $query);

        if (!$res) {
            die(mysqli_error($conn));
        }
        ?>

        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    while ($row = mysqli_fetch_assoc($res)) {
                        $cat_title = $row['cat_title'] . "<br>";
                        $cat_id = $row['cat_id'];

                        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                    }
                    ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->

            <!-- /.col-lg-6 -->
            <ul class="pager">
                <?php
                for ($i = 1; $i <= $Allpages; $i++) {
                    if ($i == 1 && $page == "" || $page == $i) {
                        echo "<li ><a class='bg-dark' href='index.php?dapage=$i'>$i</a></li>";
                    } else {
                        echo "<li><a href='index.php?dapage=$i'>$i</a></li>";
                    }
                }
                ?>
            </ul>
        </div>



    </div>

    <!-- Side Widget Well -->

    <?php include "widget.php"; ?>
    <!-- Blog Search Well -->
    <div class="well">
        <!--
            //other ways doing if else , with php
             <?php // if('') 
                ?>
        <?php //else 
        ?>
        <?php //endif 
        ?> 
     -->
        <?php



        if (isset($_SESSION['username'])) {
            $curUser = $_SESSION['username'];
            echo "<h2>this user is logged in: $curUser </h2>";
            echo "<a href='admin/includes/logout.php' name='logout' class='btn btn-danger'>LogOut</a>";
        } else {
        ?>

            <h4>Login</h4>
            <form method="post">
                <div class="form-group">
                    <label for="username">username</label>
                    <input name="username" type="text" class="form-control" placeholder="Enter username">
                    <p class='bg-danger text-center'><?php echo $error['username']; ?></p>
                </div>
                <div class="input-group">
                    <input name="password" type="password" class="form-control" placeholder="Enter password">
                    <p class='bg-danger text-center'><?php echo $error['pass']; ?></p>
                    <span class="input-group-btn">
                        <button class="btn btn-info" name="login" type="sumbit">
                            Login
                        </button>

                    </span>
                </div>
            </form>
        <?php
        }
        ?>
        <!--                search form-->

        <!-- /.input-group -->
    </div>
</div>

<?php

// if(isset($_POST['logout'])){
//     include 'admin/includes/logout.php';
//     header("Location: index.php");
// }

?>