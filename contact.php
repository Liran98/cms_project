<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<?php
if (isset($_POST['submit'])) {
$to = "lirankhalil61@gmail.com";
$user = $_POST['username'];
$email = $_POST['email'];
$msg = $_POST['txtbody'];
$subject = $_POST['subject'];

$headers = array(
    'From' => $email,
    'Reply-To' => $to,
    
);


mail($to,$subject,$msg,$headers); 

}

?>

<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Contact</h1>
                        <form role="form" action="" method="post"  autocomplete="off">

                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input value="@gmail.com" type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                           
                            <div class="form-group">
                                <label for="subject" class="sr-only">subject</label>
                                <input type="text" placeholder="subject" name="subject"/>
                            </div>
<textarea name="txtbody" id="" cols="30" rows="10"></textarea>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="send">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>