<?php include("../includes/database.php"); ?>
<?php ob_start(); ?>
<?php session_start(); ?>
<?php
if(!(isset($_SESSION['admin_user_name']))){
  header("Location: ../blog.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> Admin Panel for Management</title>
  <!-- base:css -->
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <!-- favicon  -->
  <link rel="shortcut icon" href="" />

  <link rel="stylesheet" href="css/style.css">


<!-- Google Charts CDN -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  
</head>
<body>