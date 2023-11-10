<!DOCTYPE html>
<html>
<head>
	<title>Admin home</title>
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&display=swap" rel="stylesheet">


<!--  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css"> -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-html5-1.6.1/datatables.min.js"></script>

<!-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script> 
 -->


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/datatables.min.js"></script>


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
	<div id="brand">Admin</div>
  	<div id="ham" onclick="$('nav').toggleClass('togglesidebar')"><div></div><div></div><div></div>
 </div>

</div>

<nav>
<div id="sidebar-logo">
	<div id='slogo'><a href='<?=base_url()?>admin'>Admin ERP</a></div>
</div>
  <ul>
  <li  class='<?=is_active($page,'landing')?>'><a href='<?=base_url()?>erp'><i class='fa fa-dashboard'></i> &nbsp;Dashboard</a></li>
    <li onclick="openSub('cb',this)" class="<?=in_array($page,["batches","courses","subjects"])?'active':''?>"><a><i class='fa fa-graduation-cap'></i> &nbsp;Courses &amp; Batches</a>
      <ul class='sidebar-submenu' id='cb'>
		<li><a class='<?=is_active($page,'courses')?>' href='<?=base_url()?>erp/courses'><i class=" fa fa-angle-double-right"></i> Courses</a></li>
		<li><a class='<?=is_active($page,'batches')?>' href='<?=base_url()?>erp/batches'><i class=" fa fa-angle-double-right"></i> Batches</a></li>
		<li><a class='<?=is_active($page,'subjects')?>' href='<?=base_url()?>erp/subjects'><i class=" fa fa-angle-double-right"></i> Subjects</a></li>
      </ul>
    </li>
    
    <li onclick="openSub('ms',this)" class="<?=in_array($page,["addstudents","searchstudents","seestudentsattendance","uploadstudents"])?'active':''?>"><a><i class=' fa fa-users'></i> &nbsp;Manage Students</a>
      <ul class='sidebar-submenu' id='ms'>
		<li><a class='<?=is_active($page,'addstudents')?>' href='<?=base_url()?>erp/addstudents'><i class=" fa fa-angle-double-right"></i> Add Students</a></li>
    <li><a class="<?=is_active($page,'uploadstudents')?>" href="<?=base_url()?>erp/uploadstudents"><i class=" fa fa-angle-double-right"></i> Upload Students</a></li>
		<li><a class='<?=is_active($page,'searchstudents')?>' href='<?=base_url()?>erp/searchstudents'><i class=" fa fa-angle-double-right"></i> Search Students</a></li>
    <li><a class="<?=is_active($page,'seestudentsattendance')?>" href="<?=base_url()?>erp/seestudentsattendance"><i class=" fa fa-angle-double-right"></i> Students Attendance</a></li>
      </ul>
    </li>

    <li onclick="openSub('mt',this)"  class="<?=in_array($page,["at","st","asub","acb","seeteachersattendance"])?'active':''?>"><a><i class=' fa fa-users'></i> &nbsp;Manage Teachers</a>
      <ul id='mt' class='sidebar-submenu'>
		<li><a class='<?=is_active($page,'at')?>' href='<?=base_url()?>erp/addteachers'><i class=" fa fa-angle-double-right"></i> Add Teachers</a></li>
		<li><a class='<?=is_active($page,'st')?>' href='<?=base_url()?>erp/searchteachers'><i class=" fa fa-angle-double-right"></i> Search Teachers</a></li>
		<li><a class='<?=is_active($page,'acb')?>' href='<?=base_url()?>erp/assigncb'><i class=" fa fa-angle-double-right"></i> Assign Course Batch</a></li>
		<li><a class='<?=is_active($page,'asub')?>' href='<?=base_url()?>erp/assignsubject'><i class=" fa fa-angle-double-right"></i> Assign Subject</a></li>
    <li><a class="<?=is_active($page,'seeteachersattendance')?>" href="<?=base_url()?>erp/seeteachersattendance"><i class=" fa fa-angle-double-right"></i> Teachers Attendance</a></li>
      </ul>
    </li>

    <li onclick="openSub('mco',this)"  class="<?=in_array($page,["adduser","searchuser","userpermissions","seeusersattendance"])?'active':''?>"><a><i class=' fa fa-users'></i> &nbsp;Manage Users</a>
      	<ul class='sidebar-submenu' id='mco'>
      		<li><a class='<?=is_active($page,'adduser')?>' href='<?=base_url()?>erp/adduser'><i class=" fa fa-angle-double-right"></i> Add Users</a></li>
      		<li><a class='<?=is_active($page,'searchuser')?>' href='<?=base_url()?>erp/searchuser'><i class=" fa fa-angle-double-right"></i> Search User</a></li>
          <li><a class="<?=is_active($page,'seeusersattendance')?>" href="<?=base_url()?>erp/seeusersattendance"><i class=" fa fa-angle-double-right"></i> Users Attendance</a></li>
      </ul>
    </li>


     <li onclick="openSub('nb',this)"  class="<?=in_array($page,["addnoticeboard","postednoticeboard"])?'active':''?>"><a><i class="fa fa-newspaper-o"></i> &nbsp;NoticeBoard</a>
        <ul id='nb' class='sidebar-submenu'>
      <li><a class='<?=is_active($page,'addnoticeboard')?>' href='<?=base_url()?>erp/addnoticeboard'><i class=" fa fa-angle-double-right"></i> Upload Noticeboard</a></li>
      <li><a class='<?=is_active($page,'postednoticeboard')?>' href='<?=base_url()?>erp/postednoticeboard'><i class=" fa fa-angle-double-right"></i> Posted Noticeboards</a></li>
      </ul>
    </li>
     
      <li onclick="openSub('comps',this)"  class="<?=in_array($page,["tcomplaints","scomplaints"])?'active':''?>"><a><i class=" fa fa-commenting"></i> &nbsp;Complaints</a>
      	<ul id='comps' class='sidebar-submenu'>
			<li><a class='<?=is_active($page,'tcomplaints')?>' href='<?=base_url()?>erp/teachercomplaints'><i class=" fa fa-angle-double-right"></i> Teacher's Complaints</a></li>
			<li><a class='<?=is_active($page,'scomplaints')?>' href='<?=base_url()?>erp/studentcomplaints'><i class=" fa fa-angle-double-right"></i> Student's Complaints</a></li>
      </ul>
    </li>

 <li onclick="openSub('oc',this)" class="<?=in_array($page,["vl","ln","sortvideosnotes"])?'active':''?>"><a><i class='  fa fa-graduation-cap'></i> &nbsp;Online Courses</a>
    <ul id="oc" class="sidebar-submenu">
        <li><a class='<?=is_active($page,'vl')?>' href='<?=base_url()?>erp/videolectures'><i class="fa fa-angle-double-right"></i> Video Lectures</a></li>
        <li><a  class='<?=is_active($page,'ln')?>' href='<?=base_url()?>erp/lecturenotes'><i class="fa fa-angle-double-right"></i> Lectures Notes</a></li>
        <li><a  class='<?=is_active($page,'sortvideosnotes')?>' href='<?=base_url()?>erp/sortvideosnotes'><i class="fa fa-angle-double-right"></i> Sort Videos/Notes</a></li>
    </ul>
 </li>
 <li  class='<?=is_active($page,'contactqueries')?>'><a href='<?=base_url()?>erp/contactqueries'><i class='fa fa-address-book'></i> &nbsp;Contact Queries</a></li>
 <li class="<?=is_active($page,'settings')?>"><a href="<?=base_url()?>erp/settings"><i class='fa fa-gear'></i> &nbsp;Settings</a></li>
 
 <li class="<?=is_active($page,'sms')?>"><a href="<?=base_url()?>erp/sendsms"><i class='fa fa-envelope-o'></i> &nbsp;Send SMS</a></li>

<li class="<?=is_active($page,'chatsystem')?>"><a href="<?=base_url()?>erp/chatsystem"><i class='fa fa-envelope-o'></i> &nbsp;Chat System</a></li>

<li class="<?=is_active($page,'fl')?>"><a href="<?=base_url()?>erp/finishedlectures"><i class='fa fa-graduation-cap'></i> &nbsp;Finished Lectures </a></li>

<li class="<?=is_active($page,'workshop')?>"><a href="<?=base_url()?>erp/workshop"><i class='fa fa-graduation-cap'></i> &nbsp;Workshop </a></li>
<li class="<?=is_active($page,'workshopupdates')?>"><a href="<?=base_url()?>erp/workshop_updates"><i class='fa fa-graduation-cap'></i> &nbsp;Workshop Updates</a></li>

 <li class="<?=is_active($page,'smsnum')?>"><a href="<?=base_url()?>erp/sendsmsbynum"><i class='fa fa-envelope-o'></i> &nbsp;Send SMS By Num.</a></li>

  <li><a href='<?=base_url()?>login/logout'><i class='fa fa-sign-out'></i> &nbsp;Logout</a></li>
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