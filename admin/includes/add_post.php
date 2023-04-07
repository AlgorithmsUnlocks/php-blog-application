<?php addNewPosts(); ?>


<div class="container">

<?php sessionMessage(); ?>

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
              echo "<option value='{$cat_id}'>".$category_name."</option>";
            }
            
            ?>
            </select>
         </div>
       </div>
       <div class="form-group row">
         <label for="exampleInputUsername2" class="col-sm-4 col-form-label"><strong>Posts Title</strong></label>
         <div class="col-sm-8">
           <input type="text" class="form-control" name="posts_title">
         </div>
       </div>
       <div class="form-group row">
         <label for="exampleInputUsername2" class="col-sm-4 col-form-label"><strong>Posts Author</strong></label>
         <div class="col-sm-8">
           <input type="text" class="form-control" name="posts_author">
         </div>
       </div>
       <div class="form-group row">
         <label for="exampleInputUsername2" class="col-sm-4 col-form-label"><strong>Posts Comments Count</strong></label>
         <div class="col-sm-8">
           <input type="text" class="form-control" name="posts_comment_count">
         </div>
       </div>
       <div class="form-group row">
       <label for="exampleInputUsername2" class="col-sm-4 col-form-label"><strong> Posts Image</strong></label>
         <div class="col-sm-8">
           <input type="file" class="form-control" name="posts_image">
         </div>
       </div>
       <div class="form-group row">
         <label for="summernote" class="col-sm-4 col-form-label"><strong>Posts Description</strong></label>
         <div class="col-sm-8">
           <textarea class="form-control" col="30" rows="10" name="posts_description" ></textarea>
         </div>
       </div>
       <div class="form-group row">
         <label for="exampleInputUsername2" class="col-sm-4 col-form-label"><strong>Posts Tags</strong></label>
         <div class="col-sm-8">
           <input type="text" class="form-control" name="posts_tags">
         </div>
       </div>
       <div class="form-group row">
         <label for="exampleInputUsername2" class="col-sm-4 col-form-label"><strong>Posts Types</strong></label>
         <div class="col-sm-8">
           <select class="form-control" name="posts_types">
                <option value="recently published">recently published</option>
                <option value="featured">featured</option>
           </select>
         </div>
       </div>
       <div class="form-group row">
         <label for="exampleInputUsername2" class="col-sm-4 col-form-label"><strong>Posts Status</strong></label>
         <div class="col-sm-8">
            <select class="form-control" name="posts_status">
                <option value="published">published</option>
                <option value="draft">draft</option>
           </select>
         </div>
       </div>
       <div class="text-center">
         <button type="submit" class="btn btn-primary mr-2" name="register_posts">Add Posts</button>
       </div>
     </form>
</div>