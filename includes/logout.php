<?php session_start(); ?>

<?php

$_SESSION['admin_user_id'] = null;     
$_SESSION['admin_user_name'] = null;
$_SESSION['admin_user_fname'] = null;
$_SESSION['admin_user_email_id'] = null;
$_SESSION['admin_user_password'] = null;
$_SESSION['admin_user_role'] = null;
$_SESSION['admin_user_status'] = null;
$_SESSION['admin_user_date'] = null;

header("Location: ../blog.php");


?>
<?php

$_SESSION['user_id'] = null;     
$_SESSION['user_name'] = null;
$_SESSION['user_fname'] = null;
$_SESSION['user_email_id'] = null;
$_SESSION['user_password'] = null;
$_SESSION['user_role'] = null;
$_SESSION['user_status'] = null;
$_SESSION['user_date'] = null;

header("Location: ../blog.php");


?>