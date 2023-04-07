<?php 

if(isset($_GET['user_id'])){
  $user_id = $_GET['user_id'];
 
  $query = "DELETE FROM `users` WHERE `user_id`='$user_id'";
  $query_delete_users = mysqlI_query($connection,$query);
  confirmQuery($query_delete_users);
  echo "<a class='btn btn-success form-control' href='users.php'>Deleted Successfull -> View Users</a>";
}

?>



<div class="row">


<div class="col-md-8 m-auto">
    
    <div class="card mb-5">
     <div class="card-body">

       <h4 class="card-title text-center">Register Users</h4>

<?php registerUser(); ?>
      
       <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">
         <div class="form-group row">
            <div class="col-sm-6">
             <label for="exampleInputUsername2" class="col-sm-6 col-form-label"><strong>Username</strong></label>
             <input type="text" class="form-control"  placeholder="user name" name="user_name">
           </div>
           <div class="col-sm-6">
              <label for="exampleInputUsername2" class="col-sm-6 col-form-label"><strong> Full Name</strong></label>
              <input type="text" class="form-control" name="user_fname" placeholder="user first name">
          </div>
         </div>
       
         <div class="form-group row">
           <div class="col-sm-6">
            <label for="exampleInputUsername2" class="col-sm-6 col-form-label"><strong>Email Address</strong></label>
           
             <input type="email" class="form-control" name="user_email" placeholder="user last name">
           </div>
           <div class="col-sm-6">
              <label for="exampleInputUsername2" class="col-sm-6 col-form-label"><strong> User Password</strong></label>
            
             <input type="password" class="form-control" name="user_password" placeholder="user password">
            </div>
         </div>
       
         <div class="form-group row">
         <div class="col-sm-6">
             <label for="exampleInputUsername2" class="col-sm-6 col-form-label"><strong> User Role</strong></label>
            <select class="form-control" name="user_role">
                <option value="subscriber">Subscriber </option>
                <option value="admin">Admin </option>
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
         <div class="text-center">
           <button type="submit" class="btn btn-primary mr-2" name="register">Register User</button>
         </div>
       </form>

     </div>
   </div>


 </div>

 <div class="col-md-12">
   <div class="card mb-5" >

   <?php sessionMessage(); ?>
    
   
   <?php 
   
   $query = "SELECT * FROM users";
   $query_fetch_users = mysqli_query($connection, $query);
   $total_users = mysqli_num_rows($query_fetch_users);
   // echo $total_blood_count;

   if($total_users > 0){
   
   ?>
                   <div class="table-responsive pt-3">

                   <table class="table table-striped project-orders-table">
                   <thead>
                       <tr>
                       <th class="ml-5">ID</th>
                       <th> Username</th>
                       <th> Full Name</th>
                       <th> Email</th>
                       <th> Password</th>
                       <th> Role</th>
                       <th> Status</th>
                       <th>Date</th>
                       <th>Actions</th>
                       </tr>
                   </thead>
                   <tbody>

   <?php 
                   
   while($row = mysqli_fetch_assoc($query_fetch_users)){

       $user_id  = $row['user_id'];
       $user_name  = $row['user_name'];
       $user_fname  = $row['user_full_name'];
       $user_email = $row['user_email_id'];
       $user_password  = $row['user_password'];
       $user_role  = $row['user_role'];
       $user_status  = $row['user_status'];
       $date  = $row['date'];
   
   ?> 
                       <tr>
                       <td><?php echo $user_id ?> </td>
                       <td><?php echo $user_name ?></td>
                       <td><?php echo $user_fname ?></td>
                       <td><?php echo $user_email ?></td>
                       <td><?php echo $user_password ?></td>
                       <td><?php echo $user_role ?> </td>
                       <td><?php echo $user_status ?></td>
                       <td><?php echo $date ?></td>
                       <td>
                           <div class="d-flex align-items-center">

                          
                              <a href="users.php?source=edit_users&user_id=<?php echo $user_id; ?>">
                                       <button type="submit" class="btn btn-success btn-sm btn-icon-text mr-3" name="update_btn">
                                       Edit
                                       <i class="typcn typcn-edit btn-icon-append"></i>                          
                                       </button>
                              </a>
                        
                              <a href="users.php?user_id=<?php echo $user_id; ?>">
                                       <button type="submit" class="btn btn-danger btn-sm btn-icon-text" name="delete_btn">
                                       Delete
                                           <i class="typcn typcn-delete-outline btn-icon-append"></i>                          
                                       </button>
                                </a>

                           </div>
                       </td>
                       </tr>
   <?php } ?>
                   </tbody>
                   </table>
                   </div>

   <?php
   }
   
   ?>

   </div>
 </div>

</div>