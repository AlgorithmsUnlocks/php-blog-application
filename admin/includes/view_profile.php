<?php
        
        if(isset($_SESSION['admin_user_name'])){

            $admin_user_name = $_SESSION['admin_user_name'];
            
            $query = "SELECT * FROM users WHERE `user_name` = '$admin_user_name'";
            $query_fetch_user_profile = mysqli_query($connection,$query);

            confirmQuery($query_fetch_user_profile);
            
            while($row = mysqli_fetch_assoc($query_fetch_user_profile)){

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

<?php 

if(isset($_POST['update_user'])){

    $user_id  = $_POST['user_id'];
    $user_name  = $_POST['user_name'];
    $user_fname  = $_POST['user_fname'];
    $user_email = $_POST['user_email'];
    $user_password  = $_POST['user_password'];
    $user_role  = $_POST['user_role'];
    $user_status  = $_POST['user_status'];


    // $query = "UPDATE `users` SET `user_name`='$user_name',`user_fname`='$user_fname',`user_password`='$user_password',`user_role`='$user_role' WHERE `user_id` = '$user_id'";
    // $query_update_user = mysqli_query($connection,$query);

    // confirmQuery($query_update_user);

    // header("Location: profile_settings.php");


    $query = "UPDATE `users` SET `user_name`='$user_name',`user_full_name`='$user_fname',`user_password`='$user_password',`user_role`='$user_role',`user_email_id`='$user_email',`user_status`='$user_status' WHERE `user_id`='$user_id'";
    $query_update_user = mysqli_query($connection,$query);

    confirmQuery($query_update_user);
    header("Location: profile_settings.php");
}


?>



<div class="profile-card">

<div class="card">
    <img src=""/>

    <div class="card-body">
        <h3 class="text-center"> Your Profile Information</h3>
        <p class="text-center text-success">Account has been created on : <?php echo $date ?></p>



      <div class="col-md-12 mt-5 mb-5">
        <form action="" method="POST" enctype="multipart/form-data">

           <div class="row">
             <div class="form-group col-md-6">
                <label for="username"><strong>Username </strong></label>
                <input type="text" class="form-control" value="<?php echo $user_name ?>" name="user_name">
            </div>
            <div class="form-group col-md-6">
                <label for="username"><strong>Full Name</strong></label>
                <input type="text" class="form-control" value="<?php echo $user_fname ?>" name="user_fname">
             </div>
           </div>

           <div class="row">
            <div class="form-group col-md-6">
                <label for="username"><strong>Email</strong></label>
                <input type="text" class="form-control" value="<?php echo $user_email ?>" name="user_email">
            </div>
            <div class="form-group col-md-6">
                <label for="username"><strong>Password</strong></label>
                <input type="text" class="form-control" value="<?php echo $user_password ?>" name="user_password">
            </div>
           </div>

           <div class="row">
            <div class="form-group col-md-6">
                <label for="username"><strong>Role </strong></label>
                <input type="text" class="form-control" value="<?php echo $user_role ?>" disabled>

                <select class="form-control" name="user_role">
                    <option value="admin">Admin </option>
                    <option value="subscriber">Subscriber </option>       
                </select>

            </div>
            <div class="form-group col-md-6">
                <label for="username"><strong>Status </strong></label>
                <input type="text" class="form-control" value="<?php echo $user_status ?>"disabled>

                <select class="form-control" name="user_status">
                     <option value="active">Active </option>
                     <option value="draft">Draft </option>
                 </select>
            </div>
           </div>

          
            <div class="form-group">
                <input type="hidden" class="form-control" value="<?php echo $user_id ?>" name="user_id">
            </div>
            <div class="form-group">
                <input type="submit" class="form-control btn btn-danger" value="Update Profile" name="update_user">
            </div>
           
        </form>
      </div>

    </div>
</div>

</div>