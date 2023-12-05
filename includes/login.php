<?php session_start(); ?>

<?php include "db.php"; ?>

<?php
  if(isset($_POST['login'])){
    
    $user = $_POST['username'];
    $password = $_POST['password'];

$user = mysqli_real_escape_string($conn,$user);
$password = mysqli_real_escape_string($conn,$password);

$query = "SELECT * FROM users WHERE user_name = '$user'";

$res = mysqli_query($conn,$query);

if(!$res){
  die(mysqli_error($conn));
}

while($row = mysqli_fetch_assoc($res)){
  $id = $row['user_id'];
  $user_pass = $row['user_password'];//crypted password 
  $username= $row['user_name'];
  $firstname= $row['user_firstname'];
  $lastname = $row['user_lastname'];
  $role = $row['user_role'];
 
}
// $password = crypt($password,$user_pass);

//*if(password_verify($password,$user_pass)){ other way to check  , 
//  if($username === $user  && $password === $user_pass && $role === 'admin'){
  if(password_verify($password,$user_pass)){
  header("Location: ../admin");

  //?setting a session only when user logs in
  //? and can only access the admin page only if logged in
$_SESSION['username'] = $username;
$_SESSION['firstname'] = $firstname;
$_SESSION['lastname'] = $lastname;
$_SESSION['role'] = $role;
$_SESSION['id'] = $id;


}else{
  header("Location: ../index.php");
}


  }
?>