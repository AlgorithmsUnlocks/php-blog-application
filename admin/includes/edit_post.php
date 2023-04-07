<?php 

if(isset($_GET['post_id'])){

  $post_id = $_GET['post_id'];
 
  $query = "SELECT * FROM `posts` WHERE `posts_id`='$post_id'";
  $query_fetch_posts = mysqli_query($connection,$query);
  
  confirmQuery($query_fetch_posts);

  while($row = mysqli_fetch_assoc($query_fetch_posts)){

    $posts_id = $row['posts_id'];
    $posts_category_id = $row['posts_category_id'];
    $posts_title = $row['posts_title'];
    $posts_author = $row['posts_author'];
    $posts_date = $row['posts_date'];
    $posts_comment_count = $row['posts_comment_count'];
    $posts_image = $row['posts_image'];
    $posts_description = htmlspecialchars($row['posts_description']);
    $posts_tags = $row['posts_tags'];
    $posts_types = $row['posts_types'];
    $posts_status = $row['posts_status'];
  }
}

?>
<div class="container">

<?php 
editPostAction();
?>

<form class="forms-sample p-3" action="" method="POST" enctype="multipart/form-data">
     
       <div class="form-group row">
         <label for="exampleInputUsername2" class="col-sm-4 col-form-label"><strong>Posts Categories</strong></label>
         <div class="col-sm-8">

          <select class="form-control" name="posts_category_id"> 
          <?php
          
          $query = "SELECT * FROM `categories`";
          $query_fetch_category = mysqli_query($connection,$query);
          confirmQuery($query_fetch_category);
          while($row = mysqli_fetch_assoc($query_fetch_category)){
            $cat_id = $row['cat_id'];
            $category_name = $row['category_name'];

            // if($posts_category_id == $cat_id){
            //   echo "<option value='{$cat_id}'>".$category_name."</option>";
            // } 
            echo "<option value='{$cat_id}'>".$category_name."</option>";
          }
          
          ?>
          
          </select>

         </div>
       </div>
       <div class="form-group row">
         <label for="exampleInputUsername2" class="col-sm-4 col-form-label"><strong>Posts Title</strong></label>
         <div class="col-sm-8">
           <input type="text" class="form-control" name="posts_title" value="<?php echo $posts_title; ?>">
         </div>
       </div>
       <div class="form-group row">
         <label for="exampleInputUsername2" class="col-sm-4 col-form-label"><strong>Posts Author</strong></label>
         <div class="col-sm-8">
           <input type="text" class="form-control" name="posts_author" value="<?php echo $posts_author; ?>">
         </div>
       </div>
       <div class="form-group row">
       <label for="exampleInputUsername2" class="col-sm-4 col-form-label"><strong> Posts Image</strong></label>
         <div class="col-sm-8">
           <img src="../image/<?php echo $posts_image; ?>" width="300">
           <!-- <input type="file" class="form-control" name="posts_image"> -->
         </div>
       </div>
       <div class="form-group row">
         <label for="exampleInputUsername2" class="col-sm-4 col-form-label"><strong>Posts Description</strong></label>
         <div class="col-sm-8">
           <textarea class="form-control" col="30" rows="10" name="posts_description"> <?php echo htmlspecialchars($posts_description); ?></textarea> 
         </div>
       </div>
       <div class="form-group row">
         <label for="exampleInputUsername2" class="col-sm-4 col-form-label"><strong>Posts Tags</strong></label>
         <div class="col-sm-8">
           <input type="text" class="form-control" name="posts_tags" value="<?php echo $posts_tags; ?>">
         </div>
       </div>
       <div class="form-group row">
         <label for="exampleInputUsername2" class="col-sm-4 col-form-label"><strong>Posts Types</strong></label>
         <div class="col-sm-8">
           <select class="form-control" name="posts_types">
               <option value="<?php echo $posts_types; ?>"><?php echo $posts_types; ?></option>
                <?php
                if($posts_types == 'featured'){
                  echo "<option value='recently published'>recently published</option>";
                }elseif($posts_types == 'recently published'){
                  echo "<option value='featured'>featured</option>";
                }
                
                ?>
           </select>
         </div>
       </div>
       <div class="form-group row">
         <label for="exampleInputUsername2" class="col-sm-4 col-form-label"><strong>Posts Status</strong></label>
         <div class="col-sm-8">
            <select class="form-control" name="posts_status">
            <option value="<?php echo $posts_status; ?>"><?php echo $posts_status; ?></option>
                <?php
                if($posts_status == 'published'){
                  echo "<option value='draft'>draft</option>";
                }elseif($posts_status == 'recently published'){
                  echo "<option value='published'>published</option>";
                }
                
                ?> 
           </select>
         </div>
       </div>
       <input type="hidden" name="posts_id" value="<?php echo $posts_id ?>">
       <div class="text-center">
         <button type="submit" class="btn btn-primary mr-2" name="edit_posts">Edit Posts</button>
       </div>
     </form>

</div>