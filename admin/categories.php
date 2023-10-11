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
                         <small>Author</small>
                     </h1>

                     <div class="col-xs-6">


                         <!--ADD CATEGORIES-->
                         <?php insert_categories();?>




                         <form action="" method="post">
                             <div class="form-group">
                                 <label for="cat-title">add Category</label>
                                 <input placeholder="category" class="form-control" name="cat_title" type="text">
                             </div>
                             <div class="form-group">
                                 <input class="btn btn-primary" value="add category" name="sub" type="submit">
                             </div>
                         </form>


                         <?php
                         //UPDATE 
                         if(isset($_GET['update'])){
                             $cat_id = $_GET['update'];
                             
                        include  "./includes/update_categories.php"; 
                         }
                          
                         
                         ?>
                     </div>
                     <!--ADD CATEGORY FORM-->

                     <div class="col-xs-6">

                         <?php
                         // FIND 
                               find_all_categories();      
                                     ?>

                         <?php
                         //DELETE
                    deleteCategory();
                     ?>
                         </tr>
                         </tbody>
                         </table>

                     </div>
                 </div>
             </div>
             <!-- /.row -->

         </div>
         <!-- /.container-fluid -->

     </div>
     <!-- /#page-wrapper -->

 </div>
 <!-- /#wrapper -->

 <?php include "./includes/admin_footer.php"; ?>
