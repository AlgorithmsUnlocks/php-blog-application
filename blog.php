<?php include("functions.php"); ?>
<?php include("includes/database.php"); ?>
<?php include("includes/header.php"); ?>

    <div class="edica-loader"> </div>

    <!-- Navigation -->
    <?php include("includes/navbar.php"); ?>
    <!-- Navigation -->

    <main class="blog">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">Personal Blog in Here <br> <span>( ... )</span></h1>
            <section class="featured-posts-section">
                <div class="row">

<?php
                allPostsGridView();
?>
                </div>
            </section> <!-- First Section end-->

            <!-- Paginition -->
            <nav aria-label="...">
                <ul class="pagination pagination-lg">
                   <?php 
                   for($i=1; $i<= $posts_count; $i++){
                    echo " <li class='page-item'><a class='page-link' href='blog.php?page={$i}'>{$i}</a></li>";
                   }
                   ?>
                   
                </ul>
            </nav>
  
            <div class="row mt-5">
                <div class="col-md-8">

                    <section>
                        <div class="row blog-post-row">

                            <div class="col-md-6 blog-post" data-aos="fade-up">
                                <div class="blog-post-thumbnail-wrapper">
                                    <img src="assets/images/blog_4.jpg" alt="blog post">
                                </div>
                                <p class="blog-post-category">Blog post</p>
                                <a href="#!" class="blog-post-permalink">
                                    <h6 class="blog-post-title">Front becomes an official Instagram Marketing Partner</h6>
                                </a>
                            </div>

                        </div>
                    </section>

                </div><!-- Second Section end-->

                <?php include("includes/sidebar.php"); ?>
               
            </div>
        </div>

    </main>

   
<?php include("includes/footer.php"); ?>