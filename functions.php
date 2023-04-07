<?php 


function confirmQuery($result){

    if(!$result){
      die("QUERY FAILED".mysqli_connect_error());
    }
  
  }

  
// Fetch Categorties List
function fetchCategories(){
    global $connection;
    $query = "SELECT * FROM `categories`";
    $query_fetch_database = mysqli_query($connection,$query);
    $categories_count = mysqli_num_rows($query_fetch_database);

    ?>
                <?php echo strtoupper("<h5 class='widget-title'>Categories ($categories_count)</h5>"); ?>
                <ul>

    <?php 

    if($categories_count > 0){

        while ($row = mysqli_fetch_assoc($query_fetch_database)) { 
            $cat_id = $row['cat_id'];
            ?>

            <li class='cat-item'><a href='category_post.php?id=<?php echo $cat_id; ?>'><?php echo $row['category_name']; ?> </a></li>

    <?php }
    }else{
        echo "NO CATEGORIES FOUNDS";
    }
    
}


// Single Posts View 

function singlePostsView(){

    if(isset($_GET['id'])){

        global $connection;

        $posts_id = $_GET['id'];

        $query = "UPDATE `posts` SET `posts_views_count`= posts_views_count + 1 WHERE `posts_id`='$posts_id'";
        $query_update_posts_views = mysqli_query($connection,$query);
        confirmQuery($query_update_posts_views);
    
        $query = "SELECT * FROM posts WHERE posts_id = $posts_id";
        $query_fetch_posts_from_id = mysqli_query($connection, $query);
    
        while($row = mysqli_fetch_assoc($query_fetch_posts_from_id)){

          $posts_title = $row['posts_title'];
          $posts_author = $row['posts_author'];
          $posts_date = $row['posts_date'];
          $posts_category_id = $row['posts_category_id'];
          $posts_comment_count = $row['posts_comment_count'];
          $posts_image = $row['posts_image'];
          $posts_description = $row['posts_description'];
          $posts_views_count = $row['posts_views_count'];
    ?> 
                <h1 class="edica-page-title" data-aos="fade-up"><?php echo $posts_title ?></h1>

                <p class="edica-blog-post-meta" data-aos="fade-up" data-aos-delay="100">
                    Written by <?php echo $posts_author ?>• <?php echo $posts_date ?>• 
                <?php 

                 $query = "SELECT * FROM `categories` WHERE `cat_id` = '$posts_category_id'";
                 $query_fetch_single_category =  mysqli_query($connection,$query);
                 
                 confirmQuery($query_fetch_single_category);

                 while($row = mysqli_fetch_assoc($query_fetch_single_category)){
                    $cat_id = $row['cat_id'];
                    $category_name = $row['category_name'];
                    echo $category_name;
                 }
                ?> • 
                <?php 
                  $query = "SELECT * FROM `comments` WHERE `comment_post_id`='$posts_id'";
                  $query_fecth_comment = mysqli_query($connection,$query);
                  confirmQuery($query_fecth_comment);
                  $query_count_comments = mysqli_num_rows($query_fecth_comment);
                  echo $query_count_comments;
                 
                ?> Comments</p>
    
                <section class="blog-post-featured-img" data-aos="fade-up" data-aos-delay="300">
                    <img src="image/<?php echo $posts_image ?>" alt="featured image" class="w-100">
                </section>
    
                <section class="post-content">
                    <div class="row">
                        <div class="col-lg-9 mx-auto" data-aos="fade-up">
                            <p><?php echo $posts_description ?></p>
                        </div>
                    </div>
    
                </section>
                <?php  
               
                     
                    }
                    
                }else{
                     header("Location: blog.php");
                }
}

//Blog Page All Posts Grid View 

function allPostsGridView(){

    global $connection;
    global $posts_count;

                $query = "SELECT * FROM posts";
                $query_fetch_posts = mysqli_query($connection, $query);
                $posts_count = mysqli_num_rows($query_fetch_posts);
                $posts_count = ceil($posts_count / 5);

                if($posts_count > 0){

                    while($row = mysqli_fetch_assoc($query_fetch_posts)){ 

                        $posts_image = $row['posts_image'];
                        $posts_title = $row['posts_title'];
                        $posts_author = $row['posts_author'];
                        $posts_id = $row['posts_id'];
                        $posts_status = $row['posts_status'];
                        $posts_category_id = $row['posts_category_id'];

                        if($posts_status == 'published'){ ?>

                        <div class="col-md-4 fetured-post blog-post" data-aos="fade-right">
                            <div class="blog-post-thumbnail-wrapper">
                            <a href="blog-single.php?id=<?php echo $posts_id; ?>" class="blog-post-permalink">
                                <img src="image/<?php echo $posts_image; ?>" alt="blog post">
                            </a>
                            </div>

                            <p class="blog-post-category"> 
                                
                                <?php  

                                $query = "SELECT * FROM `categories` WHERE `cat_id` = '$posts_category_id'";
                                $query_fetch_single_category =  mysqli_query($connection,$query);
                                
                                confirmQuery($query_fetch_single_category);

                                while($row = mysqli_fetch_assoc($query_fetch_single_category)){
                                   $cat_id = $row['cat_id'];
                                   $category_name = $row['category_name'];
                                   echo $category_name;
                                }
                                // echo "<br> by {$posts_author}";

                                ?>
                            
                            </p>

                            <a href="blog-single.php?id=<?php echo $posts_id; ?>" class="blog-post-permalink">
                                <h6 class="blog-post-title"> <?php echo $posts_title; ?> </h6>
                            </a>
                        </div>

                    <?php   }else{
                    }

                 }

                }else{
                    echo strtoupper("no posts found");
                }
}


// Sidebar Featured Posts 

function sidebarFeaturedPosts(){

    global $connection;
    $query = "SELECT * FROM posts LIMIT 0,10";
    $query_fetch_all_posts = mysqli_query($connection, $query);
    $posts_count = mysqli_num_rows($query_fetch_all_posts);
    
    if($posts_count > 0){

  
        while($row = mysqli_fetch_assoc($query_fetch_all_posts)){
    
        $posts_image = $row['posts_image'];
        $posts_title = $row['posts_title'];
        $posts_types = $row['posts_types'];
        $posts_id = $row['posts_id'];

            if ($posts_types == 'featured') { ?>

                                <li class="post">
                                    <a href="blog-single.php?id=<?php echo $posts_id; ?>" class="post-permalink media">
                                        <img src="image/<?php echo $posts_image; ?>" alt="blog post">
                                        <div class="media-body">
                                              <h6 class="post-title"><?php echo strtoupper($posts_title); ?></h6>  
                                        </div>
                                    </a>
                                </li>

        <?php
                }
               
          }
           
        }else{
            echo strtoupper("no posts found");
        }
}


// Search Posts Result 

function searchPostResult(){
    
    if(isset($_POST['submit'])){

        global $connection;
        $posts_seach = $_POST['posts_seach'];

         $query = "SELECT * FROM posts WHERE posts_tags LIKE '%$posts_seach%' ";

         $search_query = mysqli_query($connection, $query);

         if(!$search_query){
             die("QUERY FAILED".mysqli_connect_error());
         
         }else{
             $count = mysqli_num_rows($search_query);
             if($count == 0){
                 echo "<h2 class='text-center'>No Result Found </h2>";
             }else{
                 // echo "Yes, We Found Result";

                 while($row = mysqli_fetch_assoc($search_query)){ 

                     $posts_image = $row['posts_image'];
                     $posts_title = $row['posts_title'];
                     $posts_author = $row['posts_author'];
                     $posts_id = $row['posts_id'];
                     $posts_status = $row['posts_status']; ?>

                     <div class="col-md-6 fetured-post blog-post" data-aos="fade-right">
                         <div class="blog-post-thumbnail-wrapper">
                             <img src="image/<?php echo $posts_image; ?>" alt="blog post">
                         </div>

                         <p class="blog-post-category"> 
                             <?php  echo "by ".$posts_author ?>
                         
                         </p>

                         <a href="blog-single.php?id=<?php echo $posts_id; ?>" class="blog-post-permalink">
                             <h6 class="blog-post-title"> <?php echo $posts_title; ?> </h6>
                         </a>
                     </div>

                 <?php   

              }

             }
         }
         


     }else{
         header("Location: blog.php");
     }
}


// Category Page Result

function categoryPage(){

    if(isset($_GET['id'])){

        global $connection;
        $id = $_GET['id'];
        // echo $id;

         $query = "SELECT * FROM posts WHERE posts_category_id = '$id'";

         $search_query = mysqli_query($connection, $query);

         if(!$search_query){
             die("QUERY FAILED".mysqli_connect_error());
         
         }else{
             $count = mysqli_num_rows($search_query);
             if($count == 0){
                 echo "<h2 class='text-center'>No Result Found </h2>";
             }else{
                 // echo "Yes, We Found Result";

                 while($row = mysqli_fetch_assoc($search_query)){ 

                     $posts_image = $row['posts_image'];
                     $posts_title = $row['posts_title'];
                     $posts_author = $row['posts_author'];
                     $posts_id = $row['posts_id'];
                     $posts_status = $row['posts_status']; ?>

                     <div class="col-md-6 fetured-post blog-post" data-aos="fade-right">
                         <div class="blog-post-thumbnail-wrapper">
                             <img src="image/<?php echo $posts_image; ?>" alt="blog post">
                         </div>

                         <p class="blog-post-category"> 
                             <?php  echo "by ".$posts_author ?>
                         
                         </p>

                         <a href="blog-single.php?id=<?php echo $posts_id; ?>" class="blog-post-permalink">
                             <h6 class="blog-post-title"> <?php echo $posts_title; ?> </h6>
                         </a>
                     </div>

                 <?php   

              }

             }
         }
         


     }else{
         header("Location: blog.php");
     }
}



// Single Blog Page Related Posts Based on Category 

function relatedPosts(){
    
if(isset($_GET['id'])){
    global $connection;

    $posts_id = $_GET['id'];
    // echo $posts_id;
    $query = "SELECT * FROM posts WHERE posts_id = '$posts_id'";
    $query_fecth_single_posts = mysqli_query($connection,$query);

    confirmQuery($query_fecth_single_posts);

    while($row = mysqli_fetch_assoc($query_fecth_single_posts)){
        $single_posts_category_id = $row['posts_category_id'];
        $single_posts_title =$row['posts_title'];
    }
    // echo $single_posts_category_id;
    $query = "SELECT * FROM posts LIMIT 0,4";
    $query_fecth_all_posts = mysqli_query($connection,$query);

    confirmQuery($query_fecth_all_posts);
    
    while($row = mysqli_fetch_assoc($query_fecth_all_posts)){
        $posts_id = $row['posts_id'];
        $posts_category_id = $row['posts_category_id'];
        $posts_image = $row['posts_image'];
        $posts_title = $row['posts_title'];

       if(($single_posts_category_id == $posts_category_id) && ($single_posts_title != $posts_title)){ ?>

                            <div class="col-md-4 related_posts" data-aos="fade-right" data-aos-delay="100">

                                <img src="image/<?php echo $posts_image; ?>" alt="related post" class="post-thumbnail">
                                <p class="post-category">
                                    <?php 
                                     $query = "SELECT * FROM `categories` WHERE `cat_id` = '$single_posts_category_id'";
                                     $query_fetch_single_category =  mysqli_query($connection,$query);
                                     
                                     confirmQuery($query_fetch_single_category);

                                     while($row = mysqli_fetch_assoc($query_fetch_single_category)){
                                        $cat_id = $row['cat_id'];
                                        $category_name = $row['category_name'];
                                        echo $category_name;
                                     }
                                    ?>
                                </p>
                                <a href="blog-single.php?id=<?php echo $posts_id; ?>" class="blog-post-permalink">
                                <h6 class="blog-post-title"> <?php echo $posts_title; ?> </h6>
                                </a>

                            </div>
   
      <?php }
    }
}

}



// Dynamics Comments 


function singlePostsAllComments(){

    global $connection;

    if(isset($_GET['id'])){

        $posts_id = $_GET['id'];
        
        $query = "SELECT * FROM `comments` WHERE `comment_post_id` = '$posts_id'";
        $query_fetch_single_post_comment = mysqli_query($connection,$query);
        
        confirmQuery($query_fetch_single_post_comment);

        while($row = mysqli_fetch_assoc($query_fetch_single_post_comment)){

            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_email = $row['comment_email'];
            $comment_content = $row['comment_content'];
            $comment_status = $row['comment_status'];
            $author_image = $row['author_image']; 
            
            if($comment_status == "Approved"){
            ?>

            <div class="review-comment-cards">
                <div class="d-flex align-items-center">
                    <img src="image/<?php echo $author_image; ?>" width="100" style="border-radius: 50px; margin-right: 10px"/>
                    <p>
                        <h4><?php echo $comment_author; ?> </h2>
            
                    </p>
                </div>
                <div class="d-flex align-items-center mt-3">
            
                    <p>
                    <?php echo $comment_content; ?>
            
                    </p>
                </div>
             </div>   

    <?php }
        }
    }
}



?>