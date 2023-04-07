            <div class="col-md-4 sidebar" data-aos="fade-left">
                    
                    <div class="widget widget-post-list">
                        <h5 class="widget-title">Featured Posts</h5>
                        <ul class="post-list">
      
                        <?php sidebarFeaturedPosts();  ?>

                        </ul>
                    </div>
                    <div class="widget widet-cat-list">

                        <?php fetchCategories(); ?>
                        
                        </ul>
                    </div>

                    <div class="widget widet-login-form">

                        <h4 class="card-title">Login</h4>
                        
                        <p>
                            Admin Username : ruman
                            Admin Password : 123
                        ***Go with unsafe mode
                        </p>
                         
                        <form class="form" action="includes/login.php" method="POST">
                           
                           <div class="form-group">
                                <label class="sr-only" for="inlineFormInputName2">User ID</label>
                                <input type="hidden" value="<?php echo $_SESSION['user_id'] ?>" name="user_id">
                            </div> 
                            <div class="form-group">
                                <label class="sr-only" for="inlineFormInputName2">Username</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" placeholder="username" name="user_name">
                            </div>
                            <div class="form-group">
                                <label class="sr-only">Password</label>    
                                <input type="password" class="form-control" placeholder="password" name="user_password">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2 form-control text-white" name="login">Login</button>

                        </form>
                        
                    </div>
</div>