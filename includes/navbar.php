<header class="edica-header">
        <div class="container">

            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="blog.php"><h3>Best Blog </h3></a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#edicaMainNav" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="edicaMainNav">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                        <!-- <li class="nav-item active">
                            <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">About</a>
                        </li> -->
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="blogDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Blog</a>
                            <div class="dropdown-menu" aria-labelledby="blogDropdown">
                                <a class="dropdown-item" href="blog.html">Blog Archive</a>
                                <a class="dropdown-item" href="blog-single.html">Blog Post</a>
                            </div>
                        </li> -->
                       
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link" href="blog.php">Blog Post</a>
                        </li>                      
                        <li>
                           <form action="search_posts.php" method="post" id="search_form">
                             <div class="form-group">
                                <input type="text" name="posts_seach" class="form-control" placeholder="Search your query">
                             </div>
                             <div class="form-group">
                                <input type="submit" value="Search" name="submit" class="submit-btn">
                             </div>
                           </form>
                        </li>
                        
                      
                    </ul>
                    <ul class="navbar-nav mt-2 mt-lg-0">
        
                        <?php
                        if(isset($_SESSION['admin_user_role'])){?>
                            <li class="nav-item">
                              <a class="nav-link" href="admin">Go Admin </a>
                            </li>
                        <?php
                            if(isset($_GET['id'])){
                              $posts_id = $_GET['id'];
                            ?>

                            <li class="nav-item">
                                 <a class="nav-link" href="admin/posts.php?source=edit_post&post_id=<?php echo $posts_id
                                 ?>">Edit Posts </a>
                             </li>
                       <?php }
                              
                           }elseif(isset($_SESSION['user_role'])){?>

                                <li class="nav-item">
                                     <a class="nav-link" href="users_profile.php">Go Profile </a>
                                </li>
                                
                          <?php }else{?>
                              <li class="nav-item">
                              <a class="nav-link" href="registration.php">Registration </a>
                        </li>
                        
                          <?php }
                        ?>

                    </ul>
                </div>
            </nav>
        </div>
    </header>