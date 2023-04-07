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
            

              <?php

              if(isset($_GET['source'])){
                $source = $_GET['source'];
              }else{
                $source = "";
              }

              switch($source){
                case 'edit_users':
                  include "includes/edit_users.php";
                  break;
                default:
                  include "includes/view_all_users.php";
              }
              
              ?>


             
           </div>

            
          </div>

        </div>


<?php include("includes/admin_footer.php"); ?>