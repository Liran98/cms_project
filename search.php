<?php include './includes/header.php'; ?>
<?php include "./includes/db.php"; ?>

<!-- Navigation -->
<?php include './includes/navigation.php'; ?>

<!-- Blog Sidebar Widgets Column -->
<?php include './includes/sidebar.php'; ?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php
            
            if(isset($_POST['sub'])){
        $search = $_POST['search'];
        
      $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
        
        $res = mysqli_query($conn,$query);
        
        if(!$res){
            die("search failed" . mysqli_error($conn));
        }
        
        //length
      $count = mysqli_num_rows($res);
        
        if($count === 0 ){
            echo "no results found , try something else";
        }else{
         
            echo ($count>1) ? "$count results found" : "$count result found ";
            
          
            
           while($row = mysqli_fetch_assoc($res)){
               
                
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];

?>


            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>




            <!-- First Blog Post -->
            <h2>
                <a href="#"><?php echo $post_title; ?></a>
            </h2>



            <p class="lead">
                by <a href="index.php"><?php echo $post_author; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
            <hr>
            <img width="400" class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
            <hr>
            <p><?php echo $post_content; ?></p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>



            <?php   
            }
                }
    
            }
            ?>










            <hr>


        </div>
    </div>
</div>



<?php include './includes/footer.php'; ?>
