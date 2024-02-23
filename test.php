<?php
include "./includes/db.php";
include "./includes/header.php";
// phpinfo(); to check what version of php you got 
//*PASSWORD_DEFAULT
// echo password_hash('thepassword', PASSWORD_BCRYPT, array('cost' => 12));

// $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));


if(loggedInUserId()){
    echo $_SESSION['username'];
    echo "<br>";
    echo $_SESSION['id'];
};
echo "<br>";
if(userLikedPost(7)){
    echo "yes the post was liked";
}else{
    echo "the post was not liked";
}

include "./includes/footer.php";

?>