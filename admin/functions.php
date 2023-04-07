<?php 

function confirmQuery($result){

  if(!$result){
    die("QUERY FAILED".mysqli_connect_error());
  }

}


function sessionMessage(){

  if(isset($_SESSION['success']) && $_SESSION['success'] != ""){
    echo '<h6 class="text-center p-3 mt-3 text-success">'. $_SESSION['success'].'</h6>';
    unset($_SESSION['success']);
  }else if(isset($_SESSION['error']) && $_SESSION['error'] != ""){
    echo '<h6 class="text-center p-3 mt-3 text-danger">'. $_SESSION['error'].'</h6>';
    unset($_SESSION['error']);
  }

}

// Read POsts Category

function fetchCategories(){

        global $connection;

        $query = "SELECT * FROM categories";
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
                            <th> Name</th>
                            <th> Image</th>
                            <th> Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

        <?php 
                        
        while($row = mysqli_fetch_assoc($query_fetch_categories)){

            $cat_id = $row['cat_id'];
            $category_name = $row['category_name'];
            $category_image = $row['category_image'];
            $category_status = $row['category_status'];
            $date = $row['date'];
        
        ?> 
                            <tr>
                            <td><?php echo $cat_id ?> </td>
                            <td><?php echo $category_name ?></td>
                            <td><img src="../image/<?php echo "{$category_image}"; ?>"></td>
                            <td><?php echo $category_status ?></td>
                            <td><?php echo $date ?></td>
                            <td>
                                <div class="d-flex align-items-center">

                                   <form action="categories_edit.php" method="POST"> 
                                            <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
                                            <button type="submit" class="btn btn-success btn-sm btn-icon-text mr-3" name="update_btn">
                                            Edit
                                            <i class="typcn typcn-edit btn-icon-append"></i>                          
                                            </button>
                                    </form>
                                    <form action="categories.php" method="POST"> 
                                            <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
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
                        </div>

        <?php
        }else{
            echo strtoupper("<h3 class='text-center p-3'> No Data found </h3>");
        }

}


// Register Posts Category
function addPostsCategory(){

    if(isset($_POST['register'])){

        global $connection;
 
        $category_name = mysqli_real_escape_string($connection,$_POST['category_name']);
        $category_image = $_FILES['category_image']['name'];  
        $category_image_temp = $_FILES['category_image']['tmp_name'];    

        // Duplicate Categories 

        $query = "SELECT * FROM categories";
        $query_fetch_categories = mysqli_query($connection,$query);
        $query_categories_count = mysqli_num_rows( $query_fetch_categories);

        if($query_categories_count > 0){

          $duplicate_categories = 0;
          while($row = mysqli_fetch_assoc( $query_fetch_categories)){
            
            $category_name_db = $row['category_name'];

            if($category_name == $category_name_db){
              $duplicate_categories++;
            }

          }

          if($duplicate_categories == 0){

            if($category_name == "" || empty($category_name)){
              $_SESSION['error'] = "Empty categories exists !";
            }elseif(strlen($category_name) >= 50){
              $_SESSION['error'] = "{$category_name} is more than 50ch !";
            }elseif(!empty($category_name)){

              $query = "INSERT INTO `categories`(`category_name`, `category_image`) VALUES ('$category_name','$category_image')";
              $query_insert_categories = mysqli_query($connection,$query);       
              confirmQuery($query_insert_categories);
              move_uploaded_file($category_image_temp,"../image/{$category_image}");
              $_SESSION['success'] = "is Added Successfully !";

            }else{
              $_SESSION['error'] = "Invalid Query !";
            }

          }else{
            $_SESSION['error'] = "{$category_name} is already exists !";
          }
         

        }else{
          $_SESSION['error'] = "No Data Found !";
        }

      }
      
}


//delete Posts Category

function deletePostsCategory(){

    if(isset($_POST['delete_btn'])){

        global $connection;

        $cat_id = $_POST['cat_id'];

        $query = "DELETE FROM `categories` WHERE `cat_id` = '$cat_id'";
        $query_delete_blood = mysqli_query($connection, $query);
        if(!$query_delete_blood){
          die("QUERY FAILED" . mysqli_connect_error());
        }else{
          $_SESSION['success'] = "{$cat_id} is Deleted Successfully !";
        }
       
      }
}

// Fetch POsts Category From Data

function fetchEditCategroyData(){

  if(isset($_POST['update_btn'])){
    global $connection;
    $cat_id = $_POST['cat_id'];
    
    $query = "SELECT * FROM categories WHERE cat_id = '$cat_id'";
    $query_fetch_single_cat = mysqli_query($connection,$query);

    confirmQuery($query_fetch_single_cat);

    while($row = mysqli_fetch_assoc($query_fetch_single_cat)){
     
        $category_name = $row['category_name'];
        $category_image = $row['category_image'];
        $category_status = $row['category_status'];
        $date = $row['date']; ?>

    <form class="forms-sample" action="categories.php" method="POST" enctype="multipart/form-data">
       <div class="form-group row">
         <label for="exampleInputUsername2" class="col-sm-6 col-form-label"><strong> Categories Name</strong></label>
         <div class="col-sm-12">
           <input type="text" class="form-control"  value="<?php echo $category_name; ?>" name="category_name">
         </div>
       </div>
       <div class="form-group row">
         <label for="exampleInputUsername2" class="col-sm-6 col-form-label"><strong> Categories Status</strong></label>
         <div class="col-sm-12">
           <input type="text" class="form-control"  value="<?php echo $category_status; ?>" name="category_status">
         </div>
       </div>
       <div class="form-group row">
       <label for="exampleInputUsername2" class="col-sm-6 col-form-label"><strong> Categories Image</strong></label>
         <div class="col-sm-12">
           <input type="file" class="form-control" value="<?php echo $category_image; ?>" name="category_image">
         </div>
       </div>
       <div class="form-group row">
         <div class="col-sm-12">
           <input type="hidden" class="form-control" value="<?php echo $cat_id; ?>" name="cat_id">
         </div>
       </div>
       <div class="text-center">
         <button type="submit" class="btn btn-primary mr-2" name="update_btn">Edit Category</button>
       </div>
     </form>


   <?php
    }

   }
   
   
}


// Edit Posts Categories 

function editPostsCategory(){

  if(isset($_POST['update_btn'])){

    global $connection;

    $cat_id = $_POST['cat_id'];
    $category_name = $_POST['category_name'];

   $category_image = $_FILES['category_image']['name'];  
   $category_image_temp = $_FILES['category_image']['tmp_name'];

    $category_status = $_POST['category_status'];

    $query = "UPDATE `categories` SET `category_name`='$category_name',`category_image`='$category_image',`category_status`='$category_status' WHERE cat_id = '$cat_id'";
    $query_edit_cat = mysqli_query($connection,$query);
    confirmQuery($query_edit_cat);
    move_uploaded_file($category_image_temp,"../image/{$category_image}");
    $_SESSION['success'] = "{$cat_id} is Edited Successfully !";

  }
}





// Start Posts Funcitons 



function fetchAllPosts(){

  global $connection;

  $query = "SELECT * FROM posts";
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
 
  ?> 
                      <tr>
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
                      <td><?php echo $posts_comment_count ?></td>
                      <td><img src="../image/<?php echo "{$posts_image}"; ?>"></td>
                      <td><?php echo $posts_description."..." ?></td>
                      <td><?php echo $posts_tags ?></td>
                      <td><?php echo $posts_types ?></td>
                      <td><?php echo $posts_status ?></td>
                      <td>
                          <div class="d-flex align-items-center">

                          <a href="posts.php?source=edit_post&post_id=<?php echo $posts_id; ?>">
                                      <button type="submit" class="btn btn-success btn-sm btn-icon-text mr-3" name="update_btn">
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
                  </div>

  <?php
  }else{
      echo strtoupper("<h3 class='text-center p-3'> No Data found </h3>");
  }

}


// Add New Posts 


function addNewPosts(){
  global $connection;

  if(isset($_POST['register_posts'])){
   
    $posts_category_id = mysqli_real_escape_string($connection,$_POST['posts_category_id']);
    $posts_title = mysqli_real_escape_string($connection,$_POST['posts_title']);
    $posts_author = mysqli_real_escape_string($connection,$_POST['posts_author']);
    $posts_comment_count = mysqli_real_escape_string($connection,$_POST['posts_comment_count']);
    $posts_description = mysqli_real_escape_string($connection,$_POST['posts_description']);
    $posts_tags = mysqli_real_escape_string($connection,$_POST['posts_tags']);
    $posts_types = mysqli_real_escape_string($connection,$_POST['posts_types']);
    $posts_status = mysqli_real_escape_string($connection,$_POST['posts_status']);
 
    $posts_image = $_FILES['posts_image']['name'];
    $posts_image_loc = $_FILES['posts_image']['tmp_name'];
 
    $query = "INSERT INTO `posts`(`posts_category_id`, `posts_title`, `posts_author`, `posts_comment_count`, `posts_image`, `posts_description`, `posts_tags`, `posts_types`, `posts_status`) VALUES ('$posts_category_id','$posts_title','$posts_author','$posts_comment_count','$posts_image','$posts_description','$posts_tags','$posts_types','$posts_status')";
 
    if(!empty($posts_title) && !empty($posts_author) && !empty($posts_tags)){
     $query_insert_posts = mysqli_query($connection,$query);
     confirmQuery( $query_insert_posts);
   
     move_uploaded_file($posts_image_loc,"../image/{$posts_image}");
 
     $_SESSION['success'] = "Successfully Added Post!";
 
    }else{
     $_SESSION['error'] = "Can not Added Post! (empty)";
    }
    
 }
}



// Edit Posts 

function editPostAction(){

  global $connection;
  if(isset($_POST['edit_posts'])){
  
    $posts_id = mysqli_real_escape_string($connection,$_POST['posts_id']);
    $posts_category_id = mysqli_real_escape_string($connection,$_POST['posts_category_id']);
    $posts_title = mysqli_real_escape_string($connection,$_POST['posts_title']);
    $posts_author = mysqli_real_escape_string($connection,$_POST['posts_author']);
    // $posts_comment_count = mysqli_real_escape_string($connection,$_POST['posts_comment_count']);
    $posts_description = mysqli_real_escape_string($connection,$_POST['posts_description']);
    $posts_tags = mysqli_real_escape_string($connection,$_POST['posts_tags']);
    $posts_types = mysqli_real_escape_string($connection,$_POST['posts_types']);
    $posts_status = mysqli_real_escape_string($connection,$_POST['posts_status']);
  
    // $posts_image = $_FILES['posts_image']['name'];
    // $posts_image_loc = $_FILES['posts_image']['tmp_name'];
  
    $query ="UPDATE `posts` SET `posts_category_id`='$posts_category_id',`posts_title`='$posts_title',`posts_author`='$posts_author',`posts_description`='$posts_description',`posts_tags`='$posts_tags',`posts_types`='$posts_types',`posts_status`='$posts_status' WHERE `posts_id` = '$posts_id'";
    $query_update_posts = mysqli_query($connection,$query);
    confirmQuery($query_update_posts);
    // move_uploaded_file($posts_image_loc,"../image/{$posts_image}");
   
    echo "<a href='posts.php' class='btn btn-primary form-control'>Updated Posts Success -> View Posts</a>";
    // $_SESSION['success'] = "{$posts_id} is edited Successfully !";
  }
  
  
}

// Delete Posts 

function deletePosts(){
  global $connection;
  if(isset($_POST['delete_btn'])){
    $post_id = $_POST['post_id'];
 
    $query = "DELETE FROM `posts` WHERE `posts_id` = '$post_id'";
    $query_delete_posts = mysqli_query($connection,$query);
    confirmQuery($query_delete_posts);
 
    $_SESSION['success'] = "Successfully Deleted Post!";
    
 }
}



// Register User  => Minimum 1 user in database for working this query ;

function registerUser(){

  if(isset($_POST['register'])){

    global $connection;

    $user_name = $_POST['user_name'];
    $user_fname = $_POST['user_fname'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_role = $_POST['user_role'];
    $user_status = $_POST['user_status'];

    // Duplicate Categories 

    $query = "SELECT * FROM users";
    $query_fetch_users = mysqli_query($connection,$query);
    $query_users_count = mysqli_num_rows( $query_fetch_users);

    if($query_users_count > 0){

      $duplicate_username = 0;
      while($row = mysqli_fetch_assoc( $query_fetch_users)){
        
        $users_name_db = $row['user_name'];

        if($user_name == $users_name_db){
          $duplicate_username++;
        }

      }

      if($duplicate_username == 0){

        if($user_name == "" || empty($user_name)){
          $_SESSION['error'] = "Empty user name exists !";
        }elseif(strlen($user_name) >= 20){
          $_SESSION['error'] = "{$user_name} is more than 20ch !";
        }elseif(!empty($user_name) && !empty($user_password)){

          $query = "INSERT INTO `users`(`user_name`, `user_full_name`, `user_password`, `user_role`, `user_email_id`, `user_status`) VALUES ('$user_name','$user_fname','$user_password','$user_role','$user_email','$user_status')";

          $query_insert_users = mysqli_query($connection,$query);
          confirmQuery($query_insert_users);
          
          $_SESSION['success'] = "is Added Successfully !";

        }else{
          $_SESSION['error'] = "Invalid Query !";
        }

      }else{
        $_SESSION['error'] = "{$user_name} is already exists !";
      }
     

    }else{
      $_SESSION['error'] = "No Data Found !";
    }

  }
}



?>