<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "./admin/functions.php"; ?>

<!-- Navigation -->

<?php include "includes/navigation.php"; ?>

<?php
if (isset($_POST['submit'])) {
    $user = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];



if (!empty($user) && !empty($password) && !empty($email)) {
    $user = mysqli_real_escape_string($conn, $user);
    $password = mysqli_real_escape_string($conn, $password);
    $email = mysqli_real_escape_string($conn, $email);

   
    /* 
    ?$query = "SELECT randSalt FROM users";
   ? $res = mysqli_query($conn, $query);
    ?if (!$res) {
       ? die(mysqli_error($conn));
    ?}
    ?$row = mysqli_fetch_assoc($res);
    ?$salt = $row['randSalt'];
     */
    // $salt = '$2y$10$iusesomecrazystrings22';
    // $password = crypt($password, $salt);
    

$password = password_hash($password,PASSWORD_BCRYPT,array('cost' => 12));

if(!usernameExists($user) && !emailExists($email)){


    $query = "INSERT INTO users (user_name,user_password,user_firstname,user_lastname,user_email,user_image,user_role,randSalt)";
    $query .= " VALUES ('$user','$password','','','$email','','subscriber','')";
    $res = mysqli_query($conn, $query);
    if (!$res) {
        die(mysqli_error($conn));
    }
  

    $msg = "User Registered successfully";
    echo "<div class='bg-success text-center'>$msg</div>";
}else{
    $msg =  "User already exists or email exists already";
    echo "<p class='bg-danger text-center'>$msg</p>";
}
} else {
    
    $msg = "fields cannot be empty";
    echo "<p class='bg-danger text-center'>$msg</p>";
}

 

   }


   

?>

<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="" method="post" id="login-form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input  type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input  type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input  type="password" name="password" id="key" class="form-control" placeholder="Password">
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