
<!DOCTYPE html>
<html>
<head>
	<title>Admin CMS</title>
<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&display=swap" rel="stylesheet">
<?php include 'css/panel/header.php'; ?>
<?php include 'css/style.php';?>
<?php require "css/responsive.php"; ?>
<?php require "css/panel/style.php"; ?>
<?php require "css/panel/responsive.php"; ?>
<?php require 'css/switch.php'; ?>
</head>
<body>

<div id="header">
<div class="container-fluid">
<div id="logo"><a href='<?=base_url()?>admin'>School CMS</a></div>
<ul class="menu">	
<li><a href="<?=base_url()?>cms" class="header-menu-item <?=is_active("$page",'slideshow')?>">Slideshow</a></li>
<li><a href="<?=base_url()?>cms/toppers" class="header-menu-item <?=is_active("$page",'toppers')?>">Toppers</a></li>
<li  onclick="showSubMenu('resultsall')" id='resultsall'><a href="#" class="header-menu-item">Results <i class="fa fa-angle-down hidden-xs"></i></a>
<i class="fa fa-angle-right"></i>
<ul class="sub-menu">
	<li> <a href='<?=base_url()?>cms/resultsjunior'><i style="margin-right:5px"></i> Junior Results</a></li>
	<li><a href='<?=base_url()?>cms/resultssenior'><i style="margin-right:5px"></i> Senior Results</a></li>
	<li><a href='<?=base_url()?>cms/resultscbse'><i style="margin-right:5px"></i> CBSE Results</a></li>
</ul>
</li>
<li><a href="<?=base_url()?>cms/features" class="header-menu-item <?=is_active("$page",'features')?>">Features</a></li>
<li><a href="<?=base_url()?>cms/teachers" class="header-menu-item  <?=is_active("$page",'teachers')?>">Teachers</a></li>
<li  onclick="showSubMenu('gallery')" id='gallery'><a href="#" class="header-menu-item">Gallery <i class="fa fa-angle-down hidden-xs"></i></a>
<i class="fa fa-angle-right"></i>
<ul class="sub-menu">
<li> <a href='<?=base_url()?>cms/images'><i class="fa fa-image" style="margin-right:5px"></i> Images</a></li>
	<li><a href='<?=base_url()?>cms/videos'><i class="fa fa-video-camera" style="margin-right:5px"></i> Videos</a></li>
</ul>
</li>
<li><a href="<?=base_url()?>cms/testimonials" class="header-menu-item  <?=is_active("$page",'testimonials')?>">Testimonials</a></li>
<li><a href="<?=base_url()?>cms/showcase" class="header-menu-item <?=is_active("$page",'showcase')?>">Showcase</a></li>
<li><a href="<?=base_url()?>cms/events" class="header-menu-item  <?=is_active("$page",'events')?>">Events</a></li>
<li><a href="<?=base_url()?>cms/news" class="header-menu-item  <?=is_active("$page",'news')?>">News</a></li>
<li><a href="<?=base_url()?>cms/faqs" class="header-menu-item  <?=is_active("$page",'faqs')?>">FAQs</a></li>

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