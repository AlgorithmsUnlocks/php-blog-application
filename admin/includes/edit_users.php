<?php 

//fetch user information with get supper global method

if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
   
    $query = "SELECT * FROM users WHERE user_id = '$user_id'";
    $query_fetch_single_users = mysqli_query($connection,$query);
    
    confirmQuery($query_fetch_single_users);

    while($row = mysqli_fetch_assoc($query_fetch_single_users)){
        
        $user_id  = $row['user_id'];
        $user_name  = $row['user_name'];
        $user_fname  = $row['user_full_name'];
        $user_email = $row['user_email_id'];
        $user_password  = $row['user_password'];
        $user_role  = $row['user_role'];
        $user_status  = $row['user_status'];
        $date  = $row['date'];

    }
}


?>



<div class="col-md-8 m-auto">
    
    <div class="card mb-5">
     <div class="card-body">

       <h4 class="card-title text-center">Update Users Data</h4>

<?php 
       
    // Update Users Data 

if(isset($_POST['update_data'])){

    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $user_fname = $_POST['user_fname'];
    $user_password = $_POST['user_password'];
    $user_role = $_POST['user_role'];
    $user_email = $_POST['user_email'];
    $user_status = $_POST['user_status'];

    $query = "UPDATE `users` SET `user_name`='$user_name',`user_full_name`='$user_fname',`user_password`='$user_password',`user_role`='$user_role',`user_email_id`='$user_email',`user_status`='$user_status' WHERE `user_id`='$user_id'";
    $query_update_user = mysqli_query($connection,$query);

    confirmQuery($query_update_user);
    
    echo "<a class='btn btn-success form-control' href='users.php'>Updated Successfull -> View Users</a>";

}        
       
       
?>
      
       <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">
         <div class="form-group row">
            <div class="col-sm-6">
             <label for="exampleInputUsername2" class="col-sm-6 col-form-label"><strong>Username</strong></label>
             <input type="text" class="form-control"  value="<?php echo $user_name ?>" name="user_name">
           </div>
           <div class="col-sm-6">
              <label for="exampleInputUsername2" class="col-sm-6 col-form-label"><strong> Full Name</strong></label>
              <input type="text" class="form-control" name="user_fname" value="<?php echo $user_fname ?>">
          </div>
         </div>
       
         <div class="form-group row">
           <div class="col-sm-6">
            <label for="exampleInputUsername2" class="col-sm-6 col-form-label"><strong>Email Address</strong></label>
           
             <input type="email" class="form-control" name="user_email" value="<?php echo $user_email ?>">
           </div>
           <div class="col-sm-6">
              <label for="exampleInputUsername2" class="col-sm-6 col-form-label"><strong> User Password</strong></label>
            
             <input type="text" class="form-control" name="user_password" value="<?php echo $user_password ?>">
            </div>
         </div>
       
         <div class="form-group row">
         <div class="col-sm-6">
             <label for="exampleInputUsername2" class="col-sm-6 col-form-label"><strong> User Role</strong></label>
            <select class="form-control" name="user_role">
                <option value="admin">Admin </option>
                <option value="subscriber">Subscriber </option>
                
            </select>
           </div>
           <div class="col-sm-6">
             <label for="exampleInputUsername2" class="col-sm-6 col-form-label"><strong> User Status</strong></label>
            
             <select class="form-control" name="user_status">
                <option value="active">Active </option>
                <option value="draft">Draft </option>
            </select>
           </div>
         </div>
         <div class="col-sm-6">
             <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id ?>">
            </div>
         <div class="text-center">
           <button type="submit" class="btn btn-primary mr-2" name="update_data">Update User</button>
         </div>
       </form>

     </div>
   </div>


 </div>