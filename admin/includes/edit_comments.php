<?php 

if(isset($_POST['update_comments'])){

    $comments_id = $_POST['comments_id'];
    // echo $comments_id;
    $comment_status = $_POST['comment_status'];

    $query = "UPDATE `comments` SET `comment_status`='$comment_status' WHERE `comment_id` = '$comments_id'";
    $query_update_comment = mysqli_query($connection,$query);
    confirmQuery($query_update_comment);

    echo "<script>location.href='comments.php';</script>";

}



if(isset($_GET['id'])){

    // echo $_POST['register'];
    $comment_id = $_GET['id'];

    $query = "SELECT * FROM `comments` WHERE `comment_id`= '$comment_id'";
    $query_fetch_single_comment = mysqli_query($connection,$query);
    confirmQuery($query_fetch_single_comment);

    while($row= mysqli_fetch_assoc($query_fetch_single_comment)){

        $comment_status = $row['comment_status'];
        $comment_id = $row['comment_id'];  ?>


     <form class="forms-sample p-3" action="" method="POST" enctype="multipart/form-data">
    
       <div class="form-group row">
         <label for="exampleInputUsername2" class="col-sm-4 col-form-label"><strong>Comments Status</strong></label>
         <div class="col-sm-8">
           <select class="form-control" name="comment_status" value="<?php echo $comment_status ?>">
                <option value="Approved">Approved</option>
                <option value="draft">draft</option>
                <option value="Un-Approved">Un-Approved</option>
           </select>
         </div>
       </div>
       <div class="form-group row">
         <div class="col-sm-8">
           <input type="hidden" class="form-control" name="comments_id" value="<?php echo $comment_id; ?>">
         </div>
       </div>

       <div class="text-center">
         <button type="submit" class="btn btn-primary mr-2" name="update_comments">Submit </button>
       </div>
     </form>


   <?php }
 
}




?>


<div class="container">

</div>