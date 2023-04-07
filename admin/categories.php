<?php include("functions.php"); ?>
<?php include("includes/admin_header.php"); ?>
  
  <div class="container-scroller">

    <!-- partial:partials/_navbar.html -->

    <?php include("includes/admin_navbar.php"); ?>

    <!-- partial -->


    <div class="container-fluid page-body-wrapper">

      <!-- partial:partials/_settings-panel.html -->

      <!-- partial:partials/_sidebar.html -->

    <?php include("includes/admin_sidebar.php"); ?> 

          <!-- partial -->



      <div class="main-panel">
        <div class="content-wrapper">

        <?php addPostsCategory(); ?>
        <?php deletePostsCategory(); ?>
        <?php editPOstsCategory(); ?>


          <div class="row">

          <div class="col-md-4">
              
              <div class="card">
               <div class="card-body">

                 <h4 class="card-title text-center">Add Posts Categories</h4>
                
                 <form class="forms-sample" action="categories.php" method="POST" enctype="multipart/form-data">
                   <div class="form-group row">
                     <label for="exampleInputUsername2" class="col-sm-6 col-form-label"><strong> Categories Name</strong></label>
                     <div class="col-sm-12">
                       <input type="text" class="form-control"  placeholder="category name" name="category_name">
                     </div>
                   </div>
                   <div class="form-group row">
                   <label for="exampleInputUsername2" class="col-sm-6 col-form-label"><strong> Categories Image</strong></label>
                     <div class="col-sm-12">
                       <input type="file" class="form-control" name="category_image">
                     </div>
                   </div>
                   <div class="text-center">
                     <button type="submit" class="btn btn-primary mr-2" name="register">Register Category</button>
                   </div>
                 </form>

               </div>
             </div>


           </div>

           <div class="col-md-8">
             <div class="card">

             <?php sessionMessage(); ?>

             <?php fetchCategories(); ?>

             </div>
           </div>

            
          </div>

        </div>


<?php include("includes/admin_footer.php"); ?>