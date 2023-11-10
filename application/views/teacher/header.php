<!DOCTYPE html>
<html>
<head>
	<title>Teacher Panel</title>
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
	<div id="brand">Teacher</div>
  	<div id="ham" onclick="$('nav').toggleClass('togglesidebar')"><div></div><div></div><div></div>
 </div>

</div>

<nav>
<div id="sidebar-logo">
	<div id='slogo'><a href='<?=base_url()?>admin'>Teacher</a></div>
</div>
  <ul>

  <?php if($_SESSION["username"]=="pinnacle"){?>
<li><a href="<?=base_url()?>teacher/admin">Go To Admin</a></li>
<?php }?>

  <li  class='<?=is_active($page,'landing')?>'><a href='<?=base_url()?>teacher'>Dashboard</a></li>
  <li  class='<?=is_active($page,'myattendance')?>'><a href='<?=base_url()?>teacher/myattendance'>My Attendance <?=$this->percent?>%</a></li>

<li  class='<?=is_active($page,'seeattendance')?>'><a href='<?=base_url()?>teacher/seeattendance'>Student Attendance</a></li>


   <li onclick="openSub('nb',this)"  class="<?=in_array($page,["addnoticeboard","postednoticeboard"])?'active':''?>"><a>NoticeBoard</a>
      <ul id='nb' class='sidebar-submenu'>
    <li><a class='<?=is_active($page,'addnoticeboard')?>' href='<?=base_url()?>teacher/addnoticeboard'>Upload Noticeboard</a></li>
    <li><a class='<?=is_active($page,'postednoticeboard')?>' href='<?=base_url()?>teacher/postednoticeboard'>Posted Noticeboards</a></li>
    </ul>
  </li>

 <li  class='<?=is_active($page,'seetimetable')?>'><a href='<?=base_url()?>teacher/seetimetable'>See Timetable</a></li>

  <li onclick="openSub('ex',this)" class="<?=in_array($page,["createexams","addsubjects","insertmarks","seemarks"])?'active':''?>"><a>Exams</a>
  <ul class='sidebar-submenu' id='ex'>
  <li><a class='<?=is_active($page,'createexams')?>' href='<?=base_url()?>teacher/createexams'>Create Exam</a></li>
   <li><a class='<?=is_active($page,'addsubjects')?>' href='<?=base_url()?>teacher/addsubjects'>Add Subjects</a></li>
    <li><a class='<?=is_active($page,'insertmarks')?>' href='<?=base_url()?>teacher/insertmarks'>Insert Marks</a></li>
     <li><a class='<?=is_active($page,'seemarks')?>' href='<?=base_url()?>teacher/seemarks'>See Marks</a></li>
  </ul>
  </li>

 <li onclick="openSub('asm',this)" class="<?=in_array($page,["createassignments","activeassignments"])?'active':''?>"><a>Assignments</a>
  <ul class='sidebar-submenu' id='asm'>
  <li><a class='<?=is_active($page,'createassignments')?>' href='<?=base_url()?>teacher/createassignments'>Upload Assignments</a></li>
   <li><a class='<?=is_active($page,'activeassignments')?>' href='<?=base_url()?>teacher/activeassignments'>Active Assignments</a></li>
  </ul>
  </li>

   <li onclick="openSub('hw',this)"  class="<?=in_array($page,["addchapter", "addhomework","postedhomework"])?'active':''?>"><a>Home Work</a>
      <ul id='hw' class='sidebar-submenu'>
         <li><a class='<?=is_active($page,'addchapter')?>' href='<?=base_url()?>teacher/addchapter'>Add Chapter</a></li>
        <li><a class='<?=is_active($page,'addhomework')?>' href='<?=base_url()?>teacher/addhomework'>Upload Home Work</a></li>
        <li><a class='<?=is_active($page,'postedhomework')?>' href='<?=base_url()?>teacher/postedhomework'>Posted Home Work</a></li>
      </ul>
    </li>
    <li onclick="openSub('onlinecourses',this)"  class="<?=in_array($page,["vl","ln"])?'active':''?>"><a>Online Courses</a>
      <ul id='onlinecourses' class='sidebar-submenu'>
         <li><a class='<?=is_active($page,'vl')?>' href='<?=base_url()?>teacher/videolectures'>Video Lectures</a></li>
         <li><a class='<?=is_active($page,'ln')?>' href='<?=base_url()?>teacher/lecturenotes'>Lecture Notes</a></li>
      </ul>
    </li>

<!--  <li class='<?=is_active($page,'chat')?>'><a href='<?=base_url()?>teacher/chat'>Chat</a></li>
 -->

    
  <li><a href='<?=base_url()?>login/logout'>Logout</a></li>
  </ul>
</nav>
<script>
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