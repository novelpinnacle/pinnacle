<!DOCTYPE html>
<html>
<head>
	<title>user Panel</title>
  <link rel="icon" href="<?=base_url()?>favicon.jpg" type="image/jpg">
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-html5-1.6.1/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
 <!-- 
 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script> -->

<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,700,900&display=swap" rel="stylesheet">
<?php include 'css/panel/header.php'; ?>
<?php include 'css/style.php';?>
<?php require "css/responsive.php"; ?>
<?php require "css/panel/style.php"; ?>
<?php require "css/panel/responsive.php"; ?>
<?php require 'css/switch.php'; ?>
 <?php include 'css/panel/sidebar.php'; ?>
<script>
  $( function() {
    $(".datepicker").datepicker({dateFormat:"yy-mm-dd",changeMonth: true,
      changeYear: true});
});
</script>

</head>
<body>
<div id="mobile-nav">
	<div id="brand">user</div>
  	<div id="ham" onclick="$('nav').toggleClass('togglesidebar')"><div></div><div></div><div></div>
 </div>
</div>

<nav>
<div id="sidebar-logo">
	<div id='slogo'><a href='<?=base_url()?>user'><?=$this->profile->name?><span style='font-weight: normal;font-size:15px'>[<?=ucfirst($this->profile->role)?>]</span></a></div>
</div>
  <ul>
  <?php if($_SESSION["username"]=="pinnacle"){?>
<li><a href="<?=base_url()?>user/admin">Go To Admin</a></li>
<?php }?>

  <li  class='<?=is_active($page,'landing')?>'><a href='<?=base_url()?>user'>Dashboard</a></li>
  <li  class='<?=is_active($page,'myattendance')?>'><a href='<?=base_url()?>user/myattendance'>My Attendance <?=number_format((float)$this->percent, 2, '.', '');?>%</a></li>

  <li onclick="openSub('ma',this)" class="<?=in_array($page,["admissionenquiries"])?'active':''?>"> <a>Reception</a>
    <ul class='sidebar-submenu' id='ma'>
      <li>
          <a class='<?=is_active($page,'admissionenquiries')?>' href='<?=base_url()?>user/admissionenquiries'>Admission Enquiry</a>
      </li>
    </ul>
  </li>

 <li onclick="openSub('ms',this)" class="<?=in_array($page,["addstudents","searchstudents"])?'active':''?>"><a>Manage Students</a>
    <ul class='sidebar-submenu' id='ms'>
  <li><a class='<?=is_active($page,'addstudents')?>' href='<?=base_url()?>user/addstudents'>Add Students</a></li>
  <li><a class='<?=is_active($page,'searchstudents')?>' href='<?=base_url()?>user/searchstudents'>Search Students</a></li>
    </ul>
  </li>




<?php if($this->permissions["att_new"]==1 || $this->permissions["att_edit"]==1 || $this->permissions["att_see"]==1){ ?>
    <li  class='<?=is_active($page,'seeattendance')?>'><a href='<?=base_url()?>user/seeattendance'>Students Attendance</a></li>
<?php } ?>


  <?php if($this->permissions["nb_new"]==1 || $this->permissions["nb_see"]==1){ ?>
     <li onclick="openSub('nb',this)"  class="<?=in_array($page,["addnoticeboard","postednoticeboard"])?'active':''?>"><a>NoticeBoard</a>
      <ul id='nb' class='sidebar-submenu'>
      <?php if($this->permissions["nb_new"]==1) {?>
      <li><a class='<?=is_active($page,'addnoticeboard')?>' href='<?=base_url()?>user/addnoticeboard'>Upload Noticeboard</a></li>
      <?php }?>
      <?php if($this->permissions["nb_see"]==1) {?>
      <li><a class='<?=is_active($page,'postednoticeboard')?>' href='<?=base_url()?>user/postednoticeboard'>Posted Noticeboards</a></li>
      <?php }?>
      </ul>
    </li>
  <?php }?>
  <?php if($this->permissions["tt_new"]==1 || $this->permissions["tt_see"]==1){ ?>
  <li onclick="openSub('tt',this)" class="<?=in_array($page,["createtimetable","activetimetables"])?'active':''?>"><a>Timetable</a>
    <ul class='sidebar-submenu' id='tt'>
    <?php if($this->permissions["tt_new"]==1) {?>
      <li><a class='<?=is_active($page,'createtimetable')?>' href='<?=base_url()?>user/createtimetable'>Create Timetable</a></li>
      <?php }?>
      <?php if($this->permissions["tt_see"]==1) {?>
       <li><a class='<?=is_active($page,'activetimetables')?>' href='<?=base_url()?>user/activetimetables'>Active Timetables</a></li>
       <?php } ?>
    </ul>
  </li>
  <?php }?>
  <?php if($this->permissions["exam_new"]==1 || $this->permissions["exam_see"]==1 || $this->permissions["exam_edit"]==1 || $this->permissions["exam_del"]==1 || $this->permissions["exam_ins"]==1 || $this->permissions["exam_sms"]==1){ ?>
  <li onclick="openSub('ex',this)" class="<?=in_array($page,["createexams","addsubjects","insertmarks","seemarks","sendexammarks","preparemessage","uploadmarks"])?'active':''?>"><a>Exams</a>
      <ul class='sidebar-submenu' id='ex'>
        <?php if($this->permissions["exam_new"]==1 || $this->permissions["exam_see"]==1 ) {?>
          <li><a class='<?=is_active($page,'createexams')?>' href='<?=base_url()?>user/createexams'>Create Exam</a></li>
          <?php }?>
            <?php if($this->permissions["exam_new"]==1){?>
          <li><a class='<?=is_active($page,'addsubjects')?>' href='<?=base_url()?>user/addsubjects'>Add Subjects</a></li>
          <?php }?>
          <?php if($this->permissions["exam_ins"]==1) {?>
          <li><a class='<?=is_active($page,'insertmarks')?>' href='<?=base_url()?>user/insertmarks'>Insert Marks</a></li>
           <li><a class='<?=is_active($page,'uploadmarks')?>' href='<?=base_url()?>user/uploadmarks'>Upload Marks</a></li>
          <?php }?>
          <?php if($this->permissions["marks_see"]==1) {?>
          <li><a class='<?=is_active($page,'seemarks')?>' href='<?=base_url()?>user/seemarks'>See Marks</a></li>
          <?php }?>
          <?php if($this->permissions["exam_sms"]==1) {?>
          <li><a class='<?=is_active($page,'sendexammarks')?>' href='<?=base_url()?>user/sendexammarks'>Send Exam Message</a></li>
          <?php }?>
      </ul>
  </li>
  <?php }?>
  <?php if($this->permissions["ass_new"]==1 || $this->permissions["ass_see"]==1){ ?>
 <li onclick="openSub('asm',this)" class="<?=in_array($page,["createassignments","activeassignments"])?'active':''?>"><a>Assignments</a>
    <ul class='sidebar-submenu' id='asm'>
    <?php if($this->permissions["ass_new"]==1) {?>
      <li><a class='<?=is_active($page,'createassignments')?>' href='<?=base_url()?>user/createassignments'>Upload Assignments</a></li>
      <?php }?>
      <?php if($this->permissions["ass_see"]==1) {?>
      <li><a class='<?=is_active($page,'activeassignments')?>' href='<?=base_url()?>user/activeassignments'>Active Assignments</a></li>
      <?php }?>
    </ul>
  </li>
  <?php }?>
  <li onclick="openSub('hw',this)"  class="<?=in_array($page,["addchapter", "addhomework","postedhomework"])?'active':''?>"><a>Home Work</a>
      <ul id='hw' class='sidebar-submenu'>
         <li><a class='<?=is_active($page,'addchapter')?>' href='<?=base_url()?>user/addchapter'>Add Chapter</a></li>
        <li><a class='<?=is_active($page,'addhomework')?>' href='<?=base_url()?>user/addhomework'>Upload Home Work</a></li>
        <li><a class='<?=is_active($page,'postedhomework')?>' href='<?=base_url()?>user/postedhomework'>Posted Home Work</a></li>
      </ul>
    </li>
  <li  class='<?=is_active($page,'sms')?>'><a href='<?=base_url()?>user/sendsms'>Send SMS</a></li>
    <li  class='<?=is_active($page,'chat')?>'><a href='<?=base_url()?>user/chat'>Chat System</a></li>
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