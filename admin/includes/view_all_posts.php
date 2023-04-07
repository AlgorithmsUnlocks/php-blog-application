<?php
if(isset($_POST['checkBoxesArray'])){
    
    foreach($_POST['checkBoxesArray'] as $postsValueId){

       $bulk_option = $_POST['bulk_option'];

     
       switch($bulk_option){
        case 'published':   
            $query = "UPDATE posts SET posts_status='$bulk_option' WHERE `posts_id`='$postsValueId'";
            $query_update_posts_status = mysqli_query($connection,$query);
            confirmQuery($query_update_posts_status);  
            echo "<a class='bg-primary text-white p-3' href='posts.php'>Posts status is updated to published -> View Posts {$postsValueId}</a>";         
            break;
        case 'draft':   
            $query = "UPDATE posts SET posts_status='$bulk_option' WHERE `posts_id`='$postsValueId'";
            $query_update_posts_status = mysqli_query($connection,$query);
            confirmQuery($query_update_posts_status);           
            echo "<a class='bg-primary text-white p-3' href='posts.php'>Posts status is updated to Draft -> View Posts {$postsValueId}</a>";  
            break;
        case 'delete':   
            $query = "DELETE FROM posts WHERE posts_id='$postsValueId'";
            $query_delete_posts = mysqli_query($connection,$query);
            confirmQuery($query_delete_posts);    
            echo "<a class='bg-primary text-white p-3'>Posts has been deleted successfully </a>";        
            break;
        case 'clone':   

            
            $query = "SELECT * FROM `posts` WHERE `posts_id`='$postsValueId'";
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
              $posts_description = $row['posts_description'];
              $posts_tags = $row['posts_tags'];
              $posts_types = $row['posts_types'];
              $posts_status = $row['posts_status'];

              $query = "INSERT INTO `posts`(`posts_category_id`, `posts_title`, `posts_author`,`posts_comment_count`, `posts_image`, `posts_description`, `posts_tags`, `posts_types`, `posts_status`) VALUES ('$posts_category_id','$posts_title','$posts_author','$posts_comment_count','$posts_image','$posts_description','$posts_tags','$posts_types','$posts_status')";
              $query_clone_posts = mysqli_query($connection,$query);
              confirmQuery($query_clone_posts);
              echo "<a class='bg-primary text-white p-3'>Posts clone has been successfully created </a>"; 
            }

            // echo "<a class='bg-primary text-white p-3'>Posts status has been deleted successfully </a>";        
            break;
       }
    }
}


?>

<!-- Posts Views Reset to Zero -->
<?php 

if(isset($_GET['posts_views_id'])){
  $posts_views_id = $_GET['posts_views_id'];

  $query = "UPDATE `posts` SET `posts_views_count`= 0 WHERE `posts_id`='$posts_views_id'";
  $query_reset_views = mysqli_query($connection,$query);
  confirmQuery($query_reset_views);
  echo "<a href='' class='bg-primary text-white'>Views Reset to 0</a>";
}


?>

<script>
// alert("Working");
function selectAll(){
    // alert("Working");
         	var items=document.getElementsByClassName('checkBoxes');
         	for(var i=0; i<items.length; i++){
         		if(items[i].type=='checkbox'){
                    items[i].checked=true;
                }	 
         	}
}
function UnSelectAll(){
    // alert("Working");
         	var items=document.getElementsByClassName('checkBoxes');
         	for(var i=0; i<items.length; i++){
         		if(items[i].type=='checkbox'){
                    items[i].checked=false;
                }	 
         	}
}

</script>


<?php
//  fetchAllPosts();
$query = "SELECT * FROM posts";
  $query_fetch_categories = mysqli_query($connection, $query);
  $total_categories = mysqli_num_rows($query_fetch_categories);
  // echo $total_blood_count;

  if($total_categories > 0){
  
  ?>
                  <div class="table-responsive pt-3">

                  <form action="" method="POST">


                <div class="row">
                  <div class="col-md-4" id="bulkOptionContainer">
                    <select class="form-control" name="bulk_option">
                        <option>Selct Option</option>
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                        <option value="delete">Delete</option>
                        <option value="clone">Clone</option>
                    </select>
                  </div>
                  
                  <div class="col-md-4">
                     <input type="submit" value="Apply" class="btn btn-primary" name="apply">
                      <a href="posts.php?source=add_post" class="btn btn-primary">Add New </a>  
                  </div>

                </div>

                  <table class="table table-striped project-orders-table">
                  <thead>
                      <tr>
                      <th> <input type="checkbox" id="selectAllBoxes" onclick='selectAll()'/>
                      <input type="button" onclick='UnSelectAll()' value="X"/>
                    </th>
                      <th class="ml-5">ID</th>
                      <th>  Title</th>
                      <th>  Author</th>
                      <th>  Category</th>
                      <th>  Date</th>
                      <th> Comment Count</th>
                      <th>  Image</th>
                      <th>  Description</th>
                      <th>  Tags</th>
                      <th> Types</th>
                      <th> Status</th>
                      <th> Views</th>
                      <th>Actions</th>
                      </tr>
                  </thead>
                  <tbody>

  <?php 
                  
  while($row = mysqli_fetch_assoc($query_fetch_categories)){

      $posts_id = $row['posts_id'];
      $posts_category_id = $row['posts_category_id'];
      $posts_title = $row['posts_title'];
      $posts_author = $row['posts_author'];
      $posts_date = $row['posts_date'];
      $posts_comment_count = $row['posts_comment_count'];
      $posts_image = $row['posts_image'];
      $posts_description = substr($row['posts_description'],5,10);
      $posts_tags = $row['posts_tags'];
      $posts_types = $row['posts_types'];
      $posts_status = $row['posts_status'];
      $posts_views_count = $row['posts_views_count'];
 
  ?> 
                      <tr>
 
                      <td><input type="checkbox" class="checkBoxes" name="checkBoxesArray[]" value="<?php echo $posts_id; ?>"/></td>
                      <td><?php echo $posts_id ?> </td>
                      <td><?php echo $posts_title ?></td>
                      <td><?php echo $posts_author ?> </td>


                      <?php 

                       $query = "SELECT * FROM `categories` WHERE cat_id = '$posts_category_id'";
                       $query_fetch_category = mysqli_query($connection,$query);
                       confirmQuery($query_fetch_category);
                       while($row = mysqli_fetch_assoc($query_fetch_category)){
                         $cat_id = $row['cat_id'];
                         $category_name = $row['category_name'];
                         echo "<td> $category_name </td>";
                       }
                      
                      ?>

                      <td><?php echo $posts_date ?></td>
                      <td><?php
                    //    echo $posts_comment_count 

                        $query = "SELECT * FROM `comments` WHERE `comment_post_id`='$posts_id'";
                        $query_fecth_comment = mysqli_query($connection,$query);
                        confirmQuery($query_fecth_comment);
                        $query_count_comments = mysqli_num_rows($query_fecth_comment);
                        echo $query_count_comments;
                       
                       ?></td>
                      <td><img src="../image/<?php echo "{$posts_image}"; ?>"></td>
                      <td><?php echo $posts_description."..." ?></td>
                      <td><?php echo $posts_tags ?></td>
                      <td><?php echo $posts_types ?></td>
                      <td><?php echo $posts_status ?></td>
                      <td>
                              <a href="posts.php?source=view_all_posts&posts_views_id=<?php echo $posts_id; ?>">
                                 <?php echo $posts_views_count ?>     
                              </a>
                      </td>
                      
                      <td>
                          <div class="d-flex align-items-center">

                            <a href="../blog-single.php?id=<?php echo $posts_id; ?>" target="_blank">
                                       <button type="button" class="btn btn-primary btn-sm btn-icon-text mr-3">
                                       View
                                       <i class="typcn typcn-eye btn-icon-append"></i>                          
                                       </button>
                              </a>

                              <a href="posts.php?source=edit_post&post_id=<?php echo $posts_id; ?>" >
                                       <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                                       Edit
                                       <i class="typcn typcn-edit btn-icon-append"></i>                          
                                       </button>
                              </a>

                              <form action="posts.php?source=view_all_posts" method="POST"> 
                                      <input type="hidden" name="post_id" value="<?php echo $posts_id; ?>">
                                      <button type="submit" class="btn btn-danger btn-sm btn-icon-text" name="delete_btn">
                                      Delete
                                          <i class="typcn typcn-delete-outline btn-icon-append"></i>                          
                                      </button>
                              </form>

                          </div>
                      </td>
                      </tr>
  <?php } ?>
                  </tbody>
                  </table>
                  </form>
                  </div>

  <?php
  }else{
      echo strtoupper("<h3 class='text-center p-3'> No Data found </h3>");
  }

 ?>


<?php  deletePosts(); ?>
