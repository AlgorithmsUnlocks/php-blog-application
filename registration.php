<?php include("functions.php"); ?>
<?php include("includes/database.php"); ?>
<?php include("includes/header.php"); ?>

    <div class="edica-loader"> </div>

    <!-- Navigation -->
    <?php include("includes/navbar.php"); ?>
    <!-- Navigation -->

    <main class="blog">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">Registration</h1>
            <section class="col-md-6 m-auto register_page">

             <?php 
             
             if(isset($_POST['register'])){
                $username = mysqli_real_escape_string($connection,$_POST['username']);
                $email = mysqli_real_escape_string($connection,$_POST['email']);
                $password = mysqli_real_escape_string($connection,$_POST['password']);

                // Password Encryption System 

                // $hashFormate = "$2y$10$";
                // $salt = "iusesomecreazystrings20";
                // $hashF_and_salt = $hashFormate . $salt;
                // $password = crypt($password, $hashF_and_salt);

                if(!empty($username) && !empty($email) && !empty($password)){
                    $query = "INSERT INTO `users`(`user_name`,`user_password`,`user_email_id`) VALUES ('$username','$password','$email')";
                    $query_insert_users = mysqli_query($connection,$query);
                    confirmQuery($query_insert_users);
                    
                    echo "<h6 class='bg-warning text-white p-3'>Registration Successfull, Login In</h6>";
                }else{
                    echo "<h6 class='bg-warning text-white p-3'>Empty data can not be register</h6>";
                }

             }
             
             ?>

                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="register" id="btn-login" class="btn btn-primary form-control text-white" value="Register">
                    </form>

            </section> 
  
            <div class="row">
                <div class="col-md-8">

                    <section>
                        <div class="row blog-post-row">

                            <div class="col-md-6 blog-post" data-aos="fade-up">
                                <div class="blog-post-thumbnail-wrapper">
                                    <img src="assets/images/blog_4.jpg" alt="blog post">
                                </div>
                                <p class="blog-post-category">Blog post</p>
                                <a href="#!" class="blog-post-permalink">
                                    <h6 class="blog-post-title">Front becomes an official Instagram Marketing Partner</h6>
                                </a>
                            </div>

                        </div>
                    </section>

                </div><!-- Second Section end-->

                <?php include("includes/sidebar.php"); ?>
               
            </div>
        </div>

    </main>

   
<?php include("includes/footer.php"); ?>