
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index">🏠</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php


                $query = 'SELECT * FROM categories';

                $res = mysqli_query($conn, $query);

                if (!$res) {
                    die("query failed");
                }

                while ($row = mysqli_fetch_assoc($res)) {
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];

                    $category_class = '';
                    $registration_class = '';
                    $contact_class ='';

                    //? gets the name of the php file
                    $pageName =  basename($_SERVER['PHP_SELF']);

                    $registration = 'registration.php';
                    $contact = 'contact.php';

                    if (isset($_GET['category']) && $_GET['category'] == $cat_id) {
                        $category_class = 'active';
                    } else if ($pageName == $registration) {
                        $registration_class = 'active';
                    }else if($pageName == $contact){
                        $contact_class = 'active';
                    }

                    echo "<li class='$category_class'><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                }
                ?>
                <li>
                    <a href="admin">ADMIN</a>
                </li>

                <!-- <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li> -->

                <?php
                //? CAN ONLY SEE THE EDIT POST IN NAVBAR IF THE USER HAS LOGGED IN
                if (isset($_SESSION['role'])) {

                    if (isset($_GET['p_id'])) {
                        $post_id = $_GET['p_id'];
                        echo  "<li><a href='./admin/posts.php?source=edit_post&p_id=$post_id'>Edit Post</a></li>";
                    }
                }

                if (!isset($_SESSION['username'])) {
                    echo  "<li class='$registration_class'><a href='registration.php'>Register</a></li>";
                }


                ?>

                <li class="<?php echo $contact_class; ?>"><a href='contact.php'>Contact</a></li>






            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>