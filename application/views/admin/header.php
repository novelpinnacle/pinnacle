
<!DOCTYPE html>
<html>
<head>
	<title>Admin Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&display=swap" rel="stylesheet">
<?php include 'css/style.php'; ?>
<?php include 'css/panel/header.php'; ?>
<?php require "css/responsive.php"; ?>
<?php require "css/panel/style.php"; ?>
<?php require "css/panel/responsive.php"; ?>
</head>
<body>

<div id="header">
<div class="container-fluid">
<div id="logo">School ERP</div>
<ul class="menu">
<li><a href="<?=base_url()?>" class="header-menu-item active">Home</a></li>		
<li><a href="<?=base_url()?>login/logout" class="header-menu-item">Logout</a></li>
</ul>

<div class="bars-container" onclick="myFunction(this)">
  <div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div>
</div>

</div>
</div>
<div class="mobile-menu-wrapper">
<ul class="mobile-menu" id="mobile-menu">
</ul>
</div>