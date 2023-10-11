  <?php
    

if(isset($_POST['create_user'])){
$username = $_POST['user_name'];
$pass = $_POST['user_password'];

// $salts = '321312447328947938274983';
// $hash = '$2y$10$';
// $h_f = $hash . $salts;
// $pass = crypt($pass , $h_f);

$firstname =$_POST['user_firstname'];
$lastname = $_POST['user_lastname'];
$email = $_POST['user_email'];
$role = $_POST['user_role'];

$image = $_FILES['image']['name'];
$image_temp= $_FILES['image']['tmp_name'];

    
    move_uploaded_file($image_temp, "../images/$image");
    
    
$pass = password_hash($pass,PASSWORD_BCRYPT,array('cost' => 12));

    $query = "INSERT INTO users(user_name,user_password,user_firstname,user_lastname,user_email,user_image,user_role,randSalt)";
    $query .= " VALUES ('$username','$pass','$firstname','$lastname','$email','$image','$role',2)";
    
    $res = mysqli_query($conn,$query);
  
  if(!$res){
    die(mysqli_error($conn));
  }else{
    echo "added user successfully: " . " " ."<a href='users.php'>check user</a>" ;
  }
    
}
?>


  <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
          <label for="title">user name</label>
          <input type="text" class="form-control" name="user_name" />
      </div>


      <div class="form-group">
          <label for="title">password</label>
          <input type="password" class="form-control" name="user_password" />
      </div>

      <div class="form-group">
          <label for="status">first name</label>
          <input type="text" class="form-control" name="user_firstname" />
      </div>
      <div class="form-group">
          <label for="tags">last name</label>
          <input type="text" class="form-control" name="user_lastname" />
      </div>
      <div class="form-group">
          <label for="tags">Email</label>
          <input type="email" class="form-control" name="user_email" />
      </div>


      <div class="form-group">
          <label for="tags">user role</label>
          <!-- <input type="text" class="form-control" name="user_role" /> -->

          <select name="user_role" id="">
          <option value='subscriber'>SELECT OPTIONS</option>
          <option value='admin'>admin</option>
           <option value='subscriber'>subscriber</option>
      </select>


      </div>


      <div class="form-group">
          <label for="image">user Image</label>
          <input type="file" name="image" />
      </div>

     
     
   

      <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_user" value="add user">
      </div>
  </form>
