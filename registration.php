<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<!-- Navigation -->

<?php include "includes/navigation.php"; ?>

<?php

if (isset($_GET['lang']) && !empty($_GET['lang'])) {

    $_SESSION['lang'] = $_GET['lang'];

    if (isset($_SESSOION['lang']) && $_SESSOION['lang'] !== $_GET['lang']) {

        echo "<script>location.reload()</script>";
    }
}

if (isset($_SESSION['lang'])) {
    include "includes/languages/".$_SESSION['lang'].".php";
} else {
    include "includes/languages/en.php";
}

// if (isset($_POST['submit'])) {
//?if the method is post then do the next action
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);



    $error = [
        'username' => '',
        'email' => '',
        'password' => '',
    ];

    if (strlen($user) < 4) {
        $error['username'] = "Invalid username should atlease  4 characters";
    }
    if (strlen($password) < 6) {
        $error['password'] = "Invalid password should atlease 6 characters";
    }
    if ($user == '') {
        $error['username'] = "user cannot be empty";
    }
    if ($password == '') {
        $error['password'] = "password must not be empty";
    }
    if ($email == '') {
        $error['email'] = "email must not be empty";
    }
    if (emailExists($email)) {
        $error['email'] = "email exists pick another one <h3><a href='./index.php'>Login Instead👤</a></h3>";
    }
    if (usernameExists($user)) {
        $error['username'] = 'username already exists';
    }


    foreach ($error as $key => $val) {
        //? if val  empty then register user = means if no errors 
        if (empty($val)) {

            unset($error[$key]);
        }
    } //forEach


    if (empty($error)) {
        register_user($user, $email, $password);

        login_user($user, $password);
    }
}


?>

<!-- Page Content -->
<div class="container">

    <form action="" method="get" id="lang_form">
        <select onchange="changeLanguage()" class="select" name="lang" >
            <option>SELECT</option>
            <option value="en" <?php if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'en') {
                                    echo "selected";
                                } ?>>English</option>
            <option value="he" <?php if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'he') {
                                    echo "selected";
                                } ?>>Hebrew</option>
        </select>
    </form>


    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1><?php echo _REGISTER; ?></h1>
                        <form role="form" action="" method="post" id="login-form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" value="<?php echo isset($user) ? $user : '' ?>" name="username" id="username" class="form-control" placeholder="<?php echo _USERNAME; ?>" autocomplete="on">
                                <p class="bg-danger text-center"><?php echo isset($error['username']) ?  $error['username'] : '' ?></p>
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" value="<?php echo isset($email) ? $email : '' ?>" name="email" id="email" class="form-control" placeholder="<?php echo _EMAIL; ?>">
                                <p class="bg-danger text-center"><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="<?php echo _PASSWORD; ?>">
                                <p class="bg-danger text-center"><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
                            </div>


                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>

    <script>
        function changeLanguage() {
            document.getElementById('lang_form').addEventListener('submit', function(e) {
                console.log("it works");
            });
        }
    </script>