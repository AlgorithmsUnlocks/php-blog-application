
<?php include("functions.php"); ?>
<?php include("includes/database.php"); ?>
<?php include("includes/header.php"); ?>

    <div class="edica-loader"> </div>

    <!-- Navigation -->
    <?php include("includes/navbar.php"); ?>
    <!-- Navigation -->

    <main class="blog">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up"> Result </h1>

            <section class="featured-posts-section">
                <div class="row">


                <?php categoryPage(); ?>
 
                </div>
            </section> <!-- First Section end-->
  
        </div>

    </main>

   
<?php include("includes/footer.php"); ?>