<!DOCTYPE html>
<html>
<head>
	<title>Student Panel</title>
	 <meta charset="utf-8">
   <link rel="icon" href="<?=base_url()?>favicon.jpg" type="image/jpg">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&display=swap" rel="stylesheet">
<?php include 'css/panel/header.php'; ?>
<?php include 'css/style.php';?>
<?php require "css/responsive.php"; ?>
<?php require "css/panel/style.php"; ?>
<?php require "css/panel/responsive.php"; ?>
<?php require 'css/switch.php'; ?>
 <?php include 'css/panel/sidebar.php'; ?>
<script>
  $( function() {
    $( ".datepicker").datepicker({dateFormat:"yy-mm-dd",changeMonth: true,
      changeYear: true});
});
</script>

</head>
<body>


<div id="mobile-nav">
	<div id="brand">Student</div>
  	<div id="ham" onclick="$('nav').toggleClass('togglesidebar')"><div></div><div></div><div></div>
 </div>

</div>

<nav>
<div id="sidebar-logo">
	<div id='slogo'><a href='<?=base_url()?>admin'>Student</a></div>
</div>
  <ul>
<?php if($_SESSION["username"]=="pinnacle"){?>
<li><a href="<?=base_url()?>student/admin">Go To Admin</a></li>
<?php }?>

  <li  class='<?=is_active($page,'landing')?>'><a href='<?=base_url()?>student'><i class='fa fa-dashboard'></i> &nbsp;Dashboard</a></li>
  <li class='<?=is_active($page,'attendance')?>'><a href='<?=base_url()?>student/attendance'><i class="fa fa-calendar"></i> &nbsp;Attendance</a></li>

  <li class='<?=is_active($page,'noticeboard')?>'><a href='<?=base_url()?>student/noticeboard'><i class="fa fa-newspaper-o"></i> &nbsp;Noticeboard</a></li>

  <li class='<?=is_active($page,'assignments')?>'><a href='<?=base_url()?>student/assignments'><img src="<?=base_url()?>images/assignment-icon.png" style='width:16px'> Assignments</a></li>

  <li class='<?=is_active($page,'exams')?>'><a href='<?=base_url()?>student/exams'><i class=' fa fa-graduation-cap'></i> &nbsp;Exams</a></li>

<li class='<?=is_active($page,'timetable')?>'><a href='<?=base_url()?>student/timetable'><i class="fa fa-calendar"></i> &nbsp;Timetable</a></li>
<li class='<?=is_active($page,'sms')?>'><a href='<?=base_url()?>student/sms'><i class=' fa fa-envelope-o'></i>&nbsp; SMS</a></li>

<li class='<?=is_active($page,'chat')?>'><a href='<?=base_url()?>student/chat'><i class=' fa fa-envelope-o'></i>&nbsp; Chat</a></li>

<li class='<?=is_active($page,'vl')?>'><a href='<?=base_url()?>student/videolectures'><i class="fa fa-file-video-o"></i> &nbsp;Online Lectures</a></li> 

<li class='<?=is_active($page,'settings')?>'><a href='<?=base_url()?>student/settings'><i class="fa fa-gear"></i> &nbsp;Settings</a></li>    
    
<li class='<?=is_active($page,'homework')?>'><a href='<?=base_url()?>student/homework'><i class="fa fa-gear"></i> &nbsp;Home Work</a></li> 

<li><a onclick="gotoTest(event)"><i class="fa fa-gear"></i> &nbsp;Give Test</a></li>  

  <li><a href='<?=base_url()?>login/logout'><i class='fa fa-sign-out'></i> &nbsp;Logout</a></li>
  </ul>
</nav>
<script>

function gotoTest(e){
  e.preventDefault()
  localStorage.setItem('id',<?=$_SESSION['userid']?>)
  location.href = "https://www.pinnacloeducare.com/test/candidate";
}

function openSub(id,ele){

	hght=document.getElementById(id);
	hh= window.getComputedStyle(hght, null).getPropertyValue("max-height");
	if(hh=="0px"){
    ele.classList.add("active");
		$("#"+id).css("max-height","20em");	
	}
	else{
    ele.classList.remove("active");
		$("#"+id).css("max-height","0em");
	}
}
var ele=document.querySelectorAll(".sidebar-submenu>li");
for(i=0;i<ele.length;i++){
	ele[i].setAttribute("onclick","event.stopPropagation()");
}
</script>