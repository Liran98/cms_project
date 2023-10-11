   <?php
    if (isset($_GET['user_id'])) {
        $id = $_GET['user_id'];

        $query = "SELECT * FROM users WHERE user_id = $id";
        $res = mysqli_query($conn, $query);

    ?>

       <form action="" method="post" enctype="multipart/form-data">

           <?php
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['user_id'];
                $username = $row['user_name'];
                $pass = $row['user_password'];
                $fname = $row['user_firstname'];
                $lname = $row['user_lastname'];
                $email = $row['user_email'];
                $img = $row['user_image'];
                $role = $row['user_role'];


            ?>
               <div class="form-group">
                   <label for="username">username</label>
                   <input value="<?php echo $username; ?>" type="text" class="form-control" name="username" />
               </div>
               <div class="form-group">
                   <label for="password">password</label>
                   <input autocomplete="off" type="password" class="form-control" name="password" />
               </div>

               <div class="form-group">
                   <label for="firstname">firstname</label>
                   <input value="<?php echo $fname; ?>" type="text" class="form-control" name="firstname" />
               </div>
               <div class="form-group">
                   <label for="lastname">lastname</label>
                   <input value="<?php echo $lname; ?>" type="text" class="form-control" name="lastname" />
               </div>
               <div class="form-group">
                   <label for="email">email</label>
                   <input value="<?php echo $email; ?>" type="text" class="form-control" name="email" />
               </div>
               <div class="form-group">
                   <?php
                    $query = "SELECT * FROM users";
                    $res = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($res)) {
                        $image = $row['user_image'];
                    }
                    ?>
                   <img src="../images/<?php echo $image; ?>" />
                   <input type="file" name="img" />
               </div>
               <div class="form-group">
                   <label for="role">role</label>
                   <select name="role" id="">
                       <option value='<?php echo $role; ?>'><?php echo $role; ?></option>

                       <?php
                        if ($role === 'admin') {
                            echo "<option value='subscriber'>Subscriber</option>";
                        } else {
                            echo "<option value='admin'>Admin</option>";
                        }

                        ?>
                   </select>

               </div>

               <div class="form-group">
                   <input class="btn btn-primary" type="submit" name="update_user" value="update user">
               </div>
       <?php
            }
        }



        ?>
       </form>
   
   
   
   
   <?php

    if (isset($_GET['user_id'])) {
        $id = $_GET['user_id'];

        if (isset($_POST['update_user'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            $username = mysqli_real_escape_string($conn, $username);
            $password = mysqli_real_escape_string($conn, $password);
           
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];

            $image = $_FILES['img']['name'];
            $temp_image = $_FILES['img']['tmp_name'];
            move_uploaded_file($temp_image, "../images/$image");


     if(!empty($password)){
        $pass = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
        
        $query = "UPDATE users SET user_name ='$username' , user_password ='$pass' , user_firstname ='$firstname', ";
        $query .= "user_lastname ='$lastname' , user_email ='$email' , user_image ='$image' , user_role ='$role' ";
        $query .= "WHERE user_id =$id";


        $res = mysqli_query($conn, $query);

        if (!$res) {
            die(mysqli_error($conn));
        }

        header("Location: users.php");
     }else{
        echo "<p class='text-danger'>password required !</p>";
     }


        }
    }



?>



   