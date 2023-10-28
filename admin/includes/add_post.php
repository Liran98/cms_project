     <?php
Add_Post();

?>

     <form action="" method="post" enctype="multipart/form-data">
         <div class="form-group">
             <label for="title">Post Title</label>
             <input type="text" class="form-control" name="title" />
         </div>

         <div class="form-group">
             <label for="post_category">Post Category Id</label>
             <select name="post_category" id="">
                 <?php
                 
             $query = "SELECT * FROM categories";
             $res = mysqli_query($conn,$query);
                 
             if(!$res){
                 die("query failed");
             }
             while($row=mysqli_fetch_assoc($res)){
                 $cat_title = $row['cat_title'];
                 $cat_id = $row['cat_id'];
                 
                 echo  "<option value='$cat_id'>$cat_title</option>";
             }
             ?>


             </select>
         </div>

         <div class="form-group">
             <label for="Users">Users</label>
             <select name="user" id="">
                <?php
                $query = "SELECT * FROM users";
                $res = mysqli_query($conn,$query);

                while($row=mysqli_fetch_assoc($res)){
                    $user = $row['user_name'];
                    $id = $row['user_id'];
                    echo "<option value='$user'>$user</option>";
                }
                
                ?>
             </select>
         </div>




         <div class="form-group">
             <label for="post_status">Post Status</label>
             <!-- <input type="text" class="form-control" name="post_status" /> -->
             <select name="post_status">
            <option value="DRAFT">Select status</option>
            <option value="DRAFT">Draft</option>
            <option value="PUBLISHED">Published</option>
             </select>
         </div>

         <div class="form-group">
             <label for="post_image">Post Image</label>
             <input type="file" name="image" />
         </div>

         <div class="form-group">
             <label for="post_tags">Post Tags</label>
             <input type="text" class="form-control" name="post_tags" />
         </div>

         <div class="form-group">
             <label for="summernote">Post Content</label>
             <textarea class="form-control" name="post_content" id="summernote" rows="10" cols="30"></textarea>
         </div>

         <div class="form-group">
             <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
         </div>
     </form>
