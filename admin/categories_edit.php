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


          <div class="row">

          <div class="col-md-8">
              
              <div class="card">
               <div class="card-body">

                <h4 class="card-title text-center">Edit Posts Categories</h4>

               <?php fetchEditCategroyData(); ?>


               </div>
               
             </div>


           </div>

          </div>

        </div>


<?php include("includes/admin_footer.php"); ?>