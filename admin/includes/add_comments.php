<?php 

if(isset($_POST['register'])){

    // echo $_POST['register'];
    $comment_post_id = mysqli_real_escape_string($connection,$_POST['comment_post_id']);
    $comment_author = mysqli_real_escape_string($connection,$_POST['comment_author']);
    $author_email = mysqli_real_escape_string($connection,$_POST['author_email']);
    $comment_content = mysqli_real_escape_string($connection,nl2br($_POST['comment_content']));
    $comment_status = mysqli_real_escape_string($connection,$_POST['comment_status']);

    $author_image = $_FILES['author_image']['name'];
    $author_image_loc = $_FILES['author_image']['tmp_name'];

    if(!empty($author_email) && !empty($comment_content) && !empty($comment_author)){

        $query = "INSERT INTO `comments`(`comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `author_image`) VALUES ('$comment_post_id','$comment_author','$author_email','$comment_content','$comment_status','$author_image')";

        $query_insert_comments = mysqli_query($connection,$query);
        
        confirmQuery($query_insert_comments);

        move_uploaded_file( $author_image_loc,"../image/{$author_image}");

        echo "<a class='btn btn-success form-control' href='comments.php'>Comment Successfull -> View Comments</a>";

    }else{
      echo "<p class='btn btn-success form-control'>Empty Comments</p>";
    }



    

}


?>


<div class="container">

<?php sessionMessage(); ?>

<form class="forms-sample p-3" action="" method="POST" enctype="multipart/form-data">
    
       <div class="form-group row">
         <label for="exampleInputUsername2" class="col-sm-4 col-form-label"><strong>Posts Name</strong></label>
         <div class="col-sm-8">
          <select class="form-control" name="comment_post_id"> 
            <?php
            
            $query = "SELECT * FROM `posts`";
            $query_fetch_category = mysqli_query($connection,$query);
            confirmQuery($query_fetch_category);
            while($row = mysqli_fetch_assoc($query_fetch_category)){    
              $posts_id = $row['posts_id'];
              $posts_title = $row['posts_title'];
              echo "<option value='{$posts_id}'>".$posts_title."</option>";
            }
            
            ?>
            </select>
         </div>
       </div>
       <div class="form-group row">
         <label for="exampleInputUsername2" class="col-sm-4 col-form-label"><strong>Comment Author</strong></label>
         <div class="col-sm-8">
           <input type="text" class="form-control" name="comment_author">
         </div>
       </div>
       <div class="form-group row">
         <label for="exampleInputUsername2" class="col-sm-4 col-form-label"><strong>Author Email</strong></label>
         <div class="col-sm-8">
           <input type="email" class="form-control" name="author_email" placeholder="Email*">
         </div>
       </div>
       <div class="form-group row">
         <label for="exampleInputUsername2" class="col-sm-4 col-form-label"><strong>Comments Conent</strong></label>
         <div class="col-sm-8">
           <textarea class="form-control" col="50" rows="20" name="comment_content"> </textarea>
         </div>
       </div>
       <div class="form-group row">
         <label for="exampleInputUsername2" class="col-sm-4 col-form-label"><strong>Comments Status</strong></label>
         <div class="col-sm-8">
           <select class="form-control" name="comment_status">
                <option value="draft">draft</option>
                <option value="Approved">Approved</option>
                <option value="Un-Approved">Un-Approved</option>s
           </select>
         </div>
       </div>
       <div class="form-group row">
       <label for="exampleInputUsername2" class="col-sm-4 col-form-label"><strong> Author Image</strong></label>
         <div class="col-sm-8">
           <input type="file" class="form-control" name="author_image">
         </div>
       </div>

       <div class="text-center">
         <button type="submit" class="btn btn-primary mr-2" name="register">Add Comments</button>
       </div>
     </form>
</div>