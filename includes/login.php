<?php include("database.php"); ?>
<?php 
                    
                    if(isset($_POST['login'])){

                       $user_name = $_POST['user_name'];
                       $user_password = $_POST['user_password'];
                       
                       $query = "SELECT * FROM `users` WHERE `user_name`= '$user_name'";
                       $query_fetch_users = mysqli_query($connection,$query);
                    
                       while($row = mysqli_fetch_assoc($query_fetch_users)){

                                $db_user_id = $row['user_id'];
                                $db_user_name = $row['user_name'];
                                $db_user_fname = $row['user_full_name'];
                                $db_user_email = $row['user_email_id'];
                                $db_user_password = $row['user_password'];
                                $db_user_role = $row['user_role'];
                                $db_user_status = $row['user_status'];
                                $db_user_date = $row['date'];  
                        }
                        if($user_name !== $db_user_name && $user_password !== $db_user_password){
                           header("Location: ../blog.php");
                        }else if($user_name == $db_user_name && $user_password == $db_user_password){

                            if(($db_user_role == 'admin') && ($db_user_status == 'active')){
                              
                                session_start();
                                $_SESSION['admin_user_id'] = $db_user_id;     
                                $_SESSION['admin_user_name'] = $db_user_name;
                                $_SESSION['admin_user_fname'] = $db_user_fname;
                                $_SESSION['admin_user_email_id'] = $db_user_email;
                                $_SESSION['admin_user_password'] = $db_user_password;
                                $_SESSION['admin_user_role'] = $db_user_role;
                                $_SESSION['admin_user_status'] = $db_user_status;
                                $_SESSION['admin_user_date'] = $db_user_date;

                              //   echo $_SESSION['user_id'].$_SESSION['user_name']. $_SESSION['user_password'].$_SESSION['date'];

                                header("Location: ../admin");
                            }elseif(($db_user_role == 'subscriber') && ($db_user_status == 'active')){
                                 session_start();
                                 $_SESSION['user_id'] = $db_user_id;     
                                 $_SESSION['user_name'] = $db_user_name;
                                 $_SESSION['user_fname'] = $db_user_fname;
                                 $_SESSION['user_email_id'] = $db_user_email;
                                 $_SESSION['user_password'] = $db_user_password;
                                 $_SESSION['user_role'] = $db_user_role;
                                 $_SESSION['user_status'] = $db_user_status;
                                 $_SESSION['user_date'] = $db_user_date;

                                 header("Location: ../users_profile.php");
                            }else{
                              header("Location: ../blog.php");
                            }

                         }else{
                            header("Location: ../blog.php");
                         }

                       }
                    
?>