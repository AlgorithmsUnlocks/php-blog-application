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

           <div class="col-md-12">
             <div class="card">

              <?php

              if(isset($_GET['source'])){
                $source = $_GET['source'];
              }else{
                $source = "";
              }

              switch($source){
                case 'add_post':
                  include "includes/add_post.php";
                  break;
                case 'edit_post':
                  include "includes/edit_post.php";
                  break;
                default:
                  include "includes/view_all_posts.php";
              }
              
              ?>


             </div>    
           </div>

            
          </div>

        </div>


<?php include("includes/admin_footer.php"); ?>