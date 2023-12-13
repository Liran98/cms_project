<?php session_start(); ?>
<?php include "db.php"; ?>
<?php include "../admin/functions.php"; ?>

<?php
if (isset($_POST['login'])) {
  $user = $_POST['username'];
  $password = $_POST['password'];
  login_user($user, $password);
}
?>