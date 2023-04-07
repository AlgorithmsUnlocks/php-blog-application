
<?php

// Delete Comments 


if(isset($_GET['comment_id'])){
  $comment_id = $_GET['comment_id'];
  
  $query = "DELETE FROM `comments` WHERE `comment_id`= '$comment_id'";
  $query_delet_comment = mysqli_query($connection,$query);
  confirmQuery($query_delet_comment);
  echo "<a class='bg-primary text-white p-3'>Comments has been deleted succssfully</a>";
}



?>


<?php

$query = "SELECT * FROM comments";
  $query_fetch_categories = mysqli_query($connection, $query);
  $total_categories = mysqli_num_rows($query_fetch_categories);
  // echo $total_blood_count;

  if($total_categories > 0){
  
  ?>
                  <div class="table-responsive pt-3">

                  <table class="table table-striped project-orders-table">
                  <thead>
                      <tr>
                      <th class="ml-5">ID</th>
                      <th>  Posts ID</th>
                      <th>  Author</th>
                      <th>  Email</th>
                      <th> Content</th>
                      <th>  Status</th>
                      <th> Image</th>
                      <th>  Date</th>
                      <th>Actions</th>
                      </tr>
                  </thead>
                  <tbody>

  <?php 
                  
  while($row = mysqli_fetch_assoc($query_fetch_categories)){

      $comment_id = $row['comment_id'];
      $comment_post_id = $row['comment_post_id'];
      $comment_author = $row['comment_author'];
      $comment_email = $row['comment_email'];
      $comment_content = substr($row['comment_content'],0,5);
      $comment_status = $row['comment_status'];
      $author_image = $row['author_image'];
      $comment_date = $row['comment_date'];
 
  ?> 
                      <tr>
                      <td><?php echo $comment_id ?> </td>
                      <td>
                        <?php 
                                    $query = "SELECT * FROM `posts` WHERE posts_id = '$comment_post_id'";
                                    $query_fetch_category = mysqli_query($connection,$query);
                                    confirmQuery($query_fetch_category);
                                    while($row = mysqli_fetch_assoc($query_fetch_category)){
                                      $posts_id = $row['posts_id'];
                                      $posts_title = substr($row['posts_title'],0,10);
                                      echo $posts_title."...";
                                    }
                        ?>
                      </td>
                      <td><?php echo $comment_author ?> </td>
                      <td><?php echo $comment_email ?></td>
                      <td><?php echo $comment_content."..." ?></td>
                      <td><?php echo $comment_status ?></td>
                      <td>
                        <?php 
                        // if($author_image != ''){
                        //   echo "<img src='../image/$author_image'> ";
                        // }
                       
                        ?>
                          <img src="../image/<?php echo "{$author_image}"; ?>">
                      </td>
                      <td><?php echo $comment_date ?></td>
                      <td>
                          <div class="d-flex align-items-center m-1">

                            <p> <a href="comments.php?source=edit_comments&id=<?php echo $comment_id ?>" class="approve_btn_comments"> Approved </a></p>
                            <!-- <p> <a href="#" class="unapprove_btn_comments"> Un-Approved </a></p> -->
                            <p> <a href="comments.php?comment_id=<?php echo $comment_id ?>" class="delete_btn_comments"> Delete </a></p>

                          </div>
                      </td>
                      </tr>
  <?php } ?>
                  </tbody>
                  </table>
                  </div>

  <?php
  }else{
      echo strtoupper("<h3 class='text-center p-3'> No Data found </h3>");
  }


?>

