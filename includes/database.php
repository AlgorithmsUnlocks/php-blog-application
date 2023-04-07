<?php 

// Most Secure Way of Creating Database Connection 

$db['server_name'] = "localhost";
$db['user_name'] = "id20299075_blog_application_user";
$db['user_password'] = "??RiG[Rr1x]b7@oo";
$db['database_name'] = "id20299075_blog_application";

foreach($db as $Key => $value){
    define(strtoupper("$Key"), $value);
}
$connection = mysqli_connect(SERVER_NAME,USER_NAME,USER_PASSWORD,DATABASE_NAME);
if(!$connection){
    die("CONNECTION FAILED" . mysqli_connect_error());
}

?>