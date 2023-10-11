<!--PROCEDURAL PHP -->
<!--IF THE FORM GONNA BE IN THE SAME PAGE THEN ACTION CAN BE EMPTY-->
<form action="" method="post">

    <div class="form-group">
        <label for="edit-cat">Edit Category</label>
        <?php
                     //GETTING UPDATE INPUT VALUE
                             if(isset($_GET['update'])){
                                 
                                 $id = $_GET['update'];
                                 
                   $query = "SELECT * FROM categories WHERE cat_id={$id}";
                   $res = mysqli_query($conn,$query);
                                 
                    while($row = mysqli_fetch_assoc($res)){
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];

                        ?>

        <input value="<?php if(isset($cat_title)){echo $cat_title;}?>" placeholder="edit category" class="form-control" name="cat_title" type="text">
        <?php } }?>



        <?php
                    //UPDATING CATEGORY
        
    if(isset($_POST['update-category'])){
    $inputUpdate = $_POST['cat_title'];
                                     
   $query = "UPDATE categories SET cat_title = '{$inputUpdate}' ";
  $query .= "WHERE cat_id={$cat_id}";
                                     
                                     
 $res = mysqli_query($conn,$query);
                                     
if(!$res){
die("query failed" . mysqli_error($conn));
  }
        header("Location: categories.php");
        
}
                                 
                                 
                                 ?>

        <div class="form-group">
            <input class="btn btn-success" value="Edit" name="update-category" type="submit">
        </div>


    </div>







</form>
