<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
?>


<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>


<?php

require './vendor/autoload.php';
require './classes/Config.php';


if (!ifItIsMethod('get') && !isset($_GET['forgot'])) {
    redirect('index');
}



if (ifItIsMethod('post')) {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        $length = 50;

        $token = bin2hex(openssl_random_pseudo_bytes($length));

        if (emailExists($email)) {
            $stmt =  mysqli_prepare($conn, "UPDATE users SET token = '$token' WHERE user_email = ?");
            //s for string
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            /*
            *
            *
            configure 
            *
            *
            */
            $mail = new PHPMailer();
            // echo get_class($mail);
            $mail->isSMTP();
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;   
                                 //class config from config.php config::                   //Enable verbose debug output
            $mail->Host       = Config::SMTP_HOST;                     //Set the SMTP server to send through
            $mail->Username   = Config::SMTP_USER;                     //SMTP username
            $mail->Password   = Config::SMTP_PASSWORD;                               //SMTP password
            $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
            $mail->Port       = Config::SMTP_PORT;
            $mail->SMTPAuth   = true;
            $mail->isHTML(true); //Enable HTML

            $mail->setFrom('liran@gmail.com', 'liran');
            $mail->addAddress($email);
            $mail->Subject = 'This is a test email';

            $mail->Body = '<p>Click here to reset password
            
            <a href="http://localhost:8888/CMS_TEMPLATE/reset.php?email=' . $email . '&token=' . $token . '">Reset</a>
            
            </p>';

            if ($mail->send()) {
                echo 'Email was sent successfully';
            } else {
                echo 'Sending email failed';
            }


            echo "<p class='bg-success text-center'>it does exists</p>";
        } else {
            echo "<p class='bg-danger text-center'>it does not exists</p>";
            // mysqli_stmt_error($stmt)
        }
    }
}

?>
<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                            <?php if (!isset($email)) : ?>

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here
                                </p>
                                <div class="panel-body">




                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control" type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->
                            <?php else: ?>
                            <h1>check your email</h1>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php"; ?>

</div> <!-- /.container -->