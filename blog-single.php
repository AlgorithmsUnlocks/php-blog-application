<?php include("functions.php"); ?>
<?php include("includes/database.php"); ?>
<?php include("includes/header.php"); ?>

    <div class="edica-loader"></div>

    <?php include("includes/navbar.php"); ?>

    <main class="blog-post">
        <div class="container">

<?php singlePostsView(); ?>
            
            <div class="row">
                <div class="col-lg-9 mx-auto">


                <section class="comment-section">
                        <h2 class="section-title mb-5" data-aos="fade-up">Reviews</h2>

 <?php singlePostsAllComments(); ?>

                </section>


                    <section class="related-posts">
                         <h2 class="section-title mb-4" data-aos="fade-up">Related Posts</h2>
                         <div class="row">

<?php relatedPosts(); ?>

                         </div>

                    </section>

        
                    <section class="comment-section">
                        <h2 class="section-title mb-5" data-aos="fade-up">Leave a Comments</h2>

<?php 

if(isset($_GET['id'])){
    $posts_id = $_GET['id'];
    // echo $posts_id;
}
if(isset($_POST['register'])){

    $comment_content = $_POST['comment_content'];
    $comment_author = $_POST['comment_author'];
    $comment_email = $_POST['comment_email'];
    $posts_id = $_GET['id'];

    $author_image = $_FILES['author_image']['name'];
    $author_image_loc = $_FILES['author_image']['tmp_name'];

   if(!empty($comment_author) && !empty($comment_content) && !empty($comment_email)){
     // echo $posts_id;
    //  if(isset($SESSION['user_name']) || isset($_SESSION['admin_user_name'])){
        $query = "INSERT INTO `comments`(`comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `author_image`) VALUES ('$posts_id','$comment_author','$comment_email','$comment_content','$author_image')";
        $query_insert_comment = mysqli_query($connection,$query);
        confirmQuery($query_insert_comment);
        echo "<a class='bg-primary text-white p-3'>Your comment is under reviews</a>";
    //  }else{
    //     echo "<a class='bg-primary text-white p-3'>Must be login for comments</a>";
    //  }
    
   }else{
    echo "<a class='bg-primary text-white p-3'>Empty Comments is not allows</a>";
   }
}



?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-12" data-aos="fade-up">
                                <label for="comment" class="sr-only">Comment</label>
                                <textarea class="form-control" col="30" rows="10" name="comment_content" placeholder="Comment*"> </textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4" data-aos="fade-right">
                                    <label for="name" class="sr-only">Name</label>
                                    <input type="text" class="form-control" name="comment_author" placeholder="Name*">
                                </div>
                                <div class="form-group col-md-4" data-aos="fade-up">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" class="form-control" name="comment_email" placeholder="Email*">
                                </div>
                                <div class="form-group col-md-4" data-aos="fade-left">
                                    <label for="website" class="sr-only">Image</label>
                                    <input type="file" class="form-control" name="author_image">
                                </div>
                                <div class="form-group col-md-4" data-aos="fade-left">
                                    <label for="website" class="sr-only">Posts Id</label>
                                    <input type="hidden" class="form-control" name="posts_id">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12" data-aos="fade-up">
                                    <input type="submit" value="Send Message" class="btn btn-warning" name="register">
                                </div>
                            </div>
                        </form>


                    </section>
                    
                    
                </div>
            </div>

        </div>
    </main>


<?php include("includes/footer.php"); ?>