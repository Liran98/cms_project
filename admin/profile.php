<?php include "./includes/admin_header.php"; ?>



<div id="wrapper">

    <!-- Navigation -->
    <?php include "./includes/admin_navigation.php"; ?>
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        welcome admin
                        <?php
                      
                       $user = $_SESSION['username'];
                        if (isset($_SESSION['username'])) {
                            echo "<small>$user</small>";
                        }
                        ?>
                       
                    </h1>
<form action="" method="post" enctype="multipart/form-data">
<?php                                         //? user coming from session
 $query = "SELECT * FROM users WHERE user_name = '$user'";
 $res = mysqli_query($conn,$query);

 $check = mysqli_num_rows($res);

 if(!$check){
  return include "./includes/logout.php";
 }else{
    if(!$res){
        die(mysqli_error($conn));
     }
    
     while($row = mysqli_fetch_assoc($res)){
        $id = $row['user_id'];
        $username = $row['user_name'];
        $password = $row['user_password'];
        $fname = $row['user_firstname'];
        $lname = $row['user_lastname'];
        $email = $row['user_email'];
        $image = $row['user_image'];
        $role = $row['user_role'];
     }
     ?>
    
     <?php updateProfile(); ?>
    <div class="form-group">
        <label for="username">username</label>
        <input value="<?php echo $username;?>" type="text" class="form-control" name="username" />
    </div>
    <div class="form-group">
        <label for="password">password</label>
        <input  type="password" class="form-control" name="password" />
    </div>
    
    <div class="form-group">
        <label for="firstname">firstname</label>
        <input value="<?php echo $fname;?>" type="text" class="form-control" name="firstname" />
    </div>
    <div class="form-group">
        <label for="lastname">lastname</label>
        <input value="<?php echo $lname;?>" type="text" class="form-control" name="lastname" />
    </div>
    <div class="form-group">
        <label for="email">email</label>
        <input value="<?php echo $email;?>" type="text" class="form-control" name="email" />
    </div>
    <div class="form-group">
        <img src="../images/<?php echo $image; ?>"/>
        <input type="file"  name="img" />
    </div>
    <div class="form-group">
        <label for="role">role</label>
        <select name="role" id="">
       <option value='subscriber'><?php echo $role; ?></option>
    
       <?php
       if($role === 'admin'){
         echo "<option value='subscriber'>Subscriber</option>";
       }else{
         echo "<option value='admin'>Admin</option>";
       }
       
       ?>
    </select>
      
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_profile" value="update profile">
    </div>
    
    </form>
    
    
                    </div>
                </div>
                <!-- /.row -->
    
            </div>
            <!-- /.container-fluid -->
    
        </div>
        <!-- /#page-wrapper -->
    
    </div>
    <!-- /#wrapper -->
 
   <?php } ?>
<?php include "./includes/admin_footer.php"; ?>