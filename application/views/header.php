
<!DOCTYPE html>
<html>
<head>
<title><?=isset($title)?$title:'Pinnaclo Educare Institute, Sangrur: Best Coaching for JEE, NEET, Olympiads, NTSE, Boards'?></title>
<meta charset="utf-8">
<meta name="google-site-verification" content="Pm4hysoFQukknxsipZiM6xghe13p-PJDZfsk5rVqzGU" />
<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0,maximum-scale=1">
<meta name="facebook-domain-verification" content="pb2od5uxwwq1zby989mgxwicer1mni" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="icon" href="<?=base_url()?>favicon.jpg" type="image/jpg">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/normalize.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
  $( function() {
    $( ".datepicker").datepicker({dateFormat:"yy-mm-dd",changeMonth: true,
      changeYear: true,maxDate: new Date(2015,11,31)});
});
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-162833516-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-162833516-1');
</script>


<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/animate.css">
<?php include 'css/style.php'; ?>
<?php include 'css/header.php'; ?>
<?php include 'css/slideshow.php'; ?>
<?php include 'css/pages.php';?>
<?php include 'css/frontpage.php'; ?>
<?php require "css/slider.php"; ?>
<?php require "css/responsive.php"; ?>
<style>
li .fa-angle-down{
	display: none;
}

</style>
</head>
<body>

<div id="main-header" class="prevent-copy">

<div id="topbar">
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-6 top-left">
			<span class='fa fa-envelope'></span> <span class="top-bar-text">educare.pinnacle@gmail.com</span>
			<span class="fa fa-phone" style="margin-left:10px;"></span><span class="top-bar-text">9815355955, 9056254955</span>
		</div>
		<div class="col-sm-6 text-right">
			<i class="fa fa-facebook-official top-social"></i>
			<i class="fa fa-youtube-play top-social"></i>
			<i class="fa fa-twitter top-social"></i>
		</div>
	</div>	
	</div>
</div>

<div id="header-box">
	<a href="<?=base_url()?>">
		<img id='toplogo' src="<?=base_url()?>images/<?=isMobile()?'logo-mobile.png':'logo.png'?>">
	</a>
</div>



<div id="header">
<div class="container-fluid">

<ul class="menu">
<li> <a href='<?=base_url()?>' class="header-menu-item <?=is_active($page,"home")?>"> Home</a></li>
<li onclick="showSubMenu('about_us')" id='about_us'><a href="#" class="header-menu-item <?=is_active($page,"about_us")?>">About us <i class="fa fa-angle-down hidden-xs"></i></a>
<i class="fa fa-angle-right"></i>
<ul class="sub-menu">
	<li> <a href='<?=base_url()?>our-vision'> Values and vision</a></li>
	<li> <a href='<?=base_url()?>aims-and-responsibility'> Aims and Responsibilities</a></li>
	<li> <a href='<?=base_url()?>our-faculty'> Our Team</a></li>
	<li> <a href='<?=base_url()?>why-pinnacle'> Why Pinnacle</a></li>
	<li> <a href='<?=base_url()?>testimonials'> Testimonials</a></li>
</ul>
</li>
<li onclick="showSubMenu('resultsec')" id='resultsec'><a href="#" class="header-menu-item <?=is_active($page,"resultsec")?>">Results <i class="fa fa-angle-down hidden-xs"></i></a>
<i class="fa fa-angle-right"></i>
<ul class="sub-menu">
	<li> <a href='<?=base_url()?>result-of-juniors'> Result of Junior</a></li>
	<li> <a href='<?=base_url()?>result-of-seniors'> Result of Senior</a></li>
	<!-- <li> <a href='<?=base_url()?>home/resultsec/resultscbse'> CBSE Result</a></li> -->
</ul>
</li>
<li onclick="showSubMenu('ourcourses')" id='ourcourses'><a href="#" class="header-menu-item <?=is_active($page,"ourcourses")?>">Courses <i class="fa fa-angle-down hidden-xs"></i></a>
<i class="fa fa-angle-right"></i>
<ul class="sub-menu">
	<li> <a href='<?=base_url()?>home/ourcourses#!/8th'> 8th</a></li>
	<li> <a href='<?=base_url()?>home/ourcourses#!/9th'> 9th</a></li>
	<li> <a href='<?=base_url()?>home/ourcourses#!/10th'> 10th</a></li>
	<li> <a href='<?=base_url()?>home/ourcourses#!/11th'> 11th</a></li>
	<li> <a href='<?=base_url()?>home/ourcourses#!/12th'> 12th</a></li>
</ul>
</li>
<li onclick="showSubMenu('admission')" id='admission'><a href="#" class="header-menu-item <?=is_active($page,"admission")?>">Admission <i class="fa fa-angle-down hidden-xs"></i></a>
<i class="fa fa-angle-right"></i>
<ul class="sub-menu">
	<li> <a href='<?=base_url()?>admission-process'>Admission Process</a></li>
<!--	<li> <a href='<?=base_url()?>admission-sample-papers'>Sample Papers</a></li>
	<li> <a href='<?=base_url()?>admission-register'>Register</a></li>
-->
</ul>
</li>

<li onclick="showSubMenu('studentcorner')" id='studentcorner'><a href="#" class="header-menu-item <?=is_active($page,"studentcorner")?>">Student Corner <i class="fa fa-angle-down hidden-xs"></i></a>
<i class="fa fa-angle-right"></i>
<ul class="sub-menu">
	<li> <a href='<?=base_url()?>test'>Login</a></li>
	<?php if($this->regstudents){?><li> <a href='<?=base_url()?>home/register'>Register</a></li><?php }?>
</ul>
</li>

<li onclick="showSubMenu('ntse')" id='ntse'><a href="#" class="header-menu-item <?=is_active($page,"ntse")?>">NTSE<i class="fa fa-angle-down hidden-xs"></i></a>
<i class="fa fa-angle-right"></i>
<ul class="sub-menu">
	<li> <a href='<?=base_url()?>ntse/about'>About NTSE</a></li>
	<li> <a href='<?=base_url()?>ntse'>Register</a></li>
</ul>
</li>

<li onclick="showSubMenu('ptqe')" id='ptqe'><a href="#" class="header-menu-item <?=is_active($page,"ptqe")?>">PTQE-2024 <i class="fa fa-angle-down hidden-xs"></i></a>
<i class="fa fa-angle-right"></i>
<ul class="sub-menu">
	<li> <a href='<?=base_url()?>ptqe-2024'>About</a></li>
<!--	<li> <a href='<?=base_url()?>ptqe-2023#how-to-register'>How to Register</a></li>-->
	<li> <a href='<?=base_url()?>ptqe'>Register</a></li>
	<li> <a href='https://www.pinnacloeducare.com/test/ptqe-2023-search'>Result </a></li>
<!--	<li> <a href='<?=base_url()?>ptqe-2023#sample-papers'>Sample Papers</a></li> -->
<!--	<li> <a href='https://www.pinnacloeducare.com/test/ptqe-stage2-search'>Result</a></li>-->
</ul>
</li>

<li onclick="showSubMenu('psat')" id='psat'><a href="#" class="header-menu-item <?=is_active($page,"psat")?>">PSAT-2023 <i class="fa fa-angle-down hidden-xs"></i></a>
<i class="fa fa-angle-right"></i>
<ul class="sub-menu">
	<li> <a href='<?=base_url()?>about-psat-2023'>About</a></li>
	<li> <a href='<?=base_url()?>about-psat-2023#how-to-register'>How to Register</a></li>
	<li> <a href='<?=base_url()?>psat2023/register'>Register</a></li>
<!--	<li> <a href='<?=base_url()?>psat-2022-sample-papers'>Sample Papers</a></li>-->
<!--	<li> <a href='https://www.pinnacloeducare.com/test/'>Login</a></li> -->
</ul>
</li>

<!-- <li onclick="showSubMenu('gal')" id='gal'><a href="#" class="header-menu-item <?=is_active($page,"gallery")?>">Gallery <i class="fa fa-angle-down hidden-xs"></i> </a>-->
<!--<i class="fa fa-angle-right"></i>-->
<!--<ul class="sub-menu">-->
<!--	<li> <a href='<?=base_url()?>home/gallery/images'><i class="fa fa-image" style="margin-right:5px"></i> Images</a></li>-->
<!--	<li><a href='<?=base_url()?>home/gallery/videos'><i class="fa fa-video-camera" style="margin-right:5px"></i> Videos</a></li>-->
<!--</ul>-->
<!--</li> -->


<!--<li><a href="<?=base_url()?>frequently-asked-questions" class="header-menu-item <?=is_active($page,"faqs")?>">FAQs</a></li>
-->
<li><a href="<?=base_url()?>contact-us" class="header-menu-item <?=is_active($page,"contact")?>">Contact</a></li>
<li><a href="https://www.pinnacloeducare.com/test/" class="header-menu-item"><i class="fa fa-user-circle"></i> <span class='hidden-sm hidden-md hidden-lg'>Employee</span> Login</a>
<li><a href="https://www.pinnacloeducare.com/test/" class="header-menu-item visible-xs "><i class="fa fa-user-circle"></i> Student Login</a>
</li>

</ul>

</div>
</div>
<div class="bars-container" onclick="myFunction(this)">
  <div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div>
</div>
</div>
<div class="mobile-menu-wrapper">
<ul class="mobile-menu" id="mobile-menu">
</ul>
</div>

<script>

mh=document.getElementById("main-header");
	onscroll=function(){
		if(innerWidth>=768){
		if(pageYOffset>=50){
			mh.style.top="-39px";
			document.body.style.paddingTop="63px";
			toplogo.src="<?=base_url()?>images/logo-mobile.png";
			toplogo.style.height='64px';
			toplogo.style.width="auto";
			toplogo.style.marginTop="35px";
		}
		else{
			mh.style.top="0";
			document.body.style.paddingTop="97px";
			toplogo.src="<?=base_url()?>images/logo.png";
			toplogo.style.height='99px';
			toplogo.style.width="100%";
			toplogo.style.marginTop="0";	
		}
	}

	}
function myFunction(x) {
document.getElementById("mobile-menu").innerHTML=document.getElementsByClassName("menu")[0].innerHTML;
  x.classList.toggle("change");
  $(".mobile-menu-wrapper").toggleClass("show-mobile-menu");
}

function showSubMenu(id){
	$('#'+id+' i.fa-angle-right').toggleClass('fa-angle-down');
	$('#'+id+' .sub-menu').toggleClass('mobile-submenu-show');
}
</script>