<?php

if(isset($_GET['p_id'])){
    $id = $_GET['p_id'];

if(isset($_POST['update_post'])){
    
        $title = $_POST['title'];
        $category = $_POST['post_category'];
        $author = $_POST['author'];
        $status = $_POST['post_status'];
        $img = $_FILES['image']['name'];
        $temp_img = $_FILES['image']['tmp_name'];
        $tags = $_POST['post_tags'];
        $content = $_POST['post_Content'];
    
    move_uploaded_file($temp_img,"../images/$img");
    
    if(empty($img)){
    $query = "SELECT * FROM posts WHERE post_id = $id";
    $res = mysqli_query($conn,$query);

    while($row = mysqli_fetch_assoc($res)){
        $img = $row['post_image'];
        
    }
    }  
    $query = "UPDATE posts SET ";
    $query .="post_title = '{$title}', ";
    $query .="post_category_id = '{$category}', ";
    $query .="post_date = now(), ";
    $query .="post_author = '{$author}', ";
    $query .="post_status = '{$status}', ";
    $query .="post_tags = '{$tags}', ";
    $query .="post_content = '{$content}', ";
    $query .="post_image = '{$img}', ";
    $query .="post_views_count = 0 ";
    $query .="WHERE post_id = {$id} ";
    
    $res = mysqli_query($conn,$query);
    
    if(!$res){
        die(mysqli_error($conn));
        
    }else{
 echo "<p class='bg-success'>Post Updated successfully: " . "<a href='../post.php?p_id=$id'>Check Post</a>
 <br>
 <a href='posts.php'>View other Posts</a></p>";
    }
    }
}

?>
  
  
  <?php


if(isset($_GET['p_id'])){
$id = $_GET['p_id'];
   
    $query = "SELECT * FROM posts WHERE post_id = $id";
    $res = mysqli_query($conn,$query);
    
    ?>
 
   <form action="" method="post" enctype="multipart/form-data">

       <?php
    while($row = mysqli_fetch_assoc($res)){
        $title = $row['post_title'];
        $category = $row['post_category_id'];
        $author = $row['post_author'];
        $status = $row['post_status'];
        $img = $row['post_image'];
        $tags = $row['post_tags'];
        $content = $row['post_content'];
        
        
        ?>
       <div class="form-group">
           <label for="title">Post Title</label>
           <input value="<?php echo $title;?>" type="text" class="form-control" name="title" />
       </div>


       <div class="form-group">
           <label for="post_category">Post Category Id</label>
           <?php
       $query ="SELECT * FROM categories";
        $res = mysqli_query($conn,$query);
        if(!$res){
            die(mysqli_error($conn)); 
        }
       ?>
           <select name="post_category" id="">
               <?php
        while($row = mysqli_fetch_assoc($res)){
            $title = $row['cat_title'];
            $id = $row['cat_id'];
            ?>
               <option value="<?php echo $id;?>"><?php echo $title;?></option>
               <?php
               }
               ?>

           </select>

       </div>

       <div class="form-group">
           <label for="title">Post Author</label>
           <input value="<?php echo $author;?>" type="text" class="form-control" name="author" />
       </div>

       <div class="form-group">
           <label for="post_status">Post Status</label>
           
           <select name="post_status" id="">
           <option value="<?php echo $status; ?>"><?php echo $status;?></option>
            <?php
            if($status === 'published'){
                echo "<option value='draft'>draft</option>";
            }else{
                echo "<option value='published'>published</option>";
            }
            ?>
           
         
           </select>
       </div>

       <div class="form-group">
           <label for="post_image">Post Image</label>
           <img width="100" src="../images/<?php echo $img;?>" />
           <input type="file" name="image" />
       </div>

       <div class="form-group">
           <label for="post_tags">Post Tags</label>
           <input value="<?php echo $tags;?>" type="text" class="form-control" name="post_tags" />
       </div>

       <div class="form-group">
           <label for="post_content">Post Content</label>
           <textarea name="post_Content"  class="form-control"  id="summernote" value=""><?php echo $content; ?></textarea>
       </div>

       <div class="form-group">
           <input class="btn btn-primary" type="submit" name="update_post" value="update Post">
       </div>
       <?php
    }
    
}



?>
   </form>



  
