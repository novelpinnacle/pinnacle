<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Erp extends CI_Controller {

function __construct()	{
	parent::__construct();
	if(!$this->isLoggedIn()){
		header("location:".base_url()."login/loginform");
		die("Session Expired");
	}
	$this->load->helper("is_active");
	$this->load->model("erp/save","saveerp");
	$this->load->model("erp/get","geterp");
	$this->load->model("erp/delete","deleteerp");
	$this->load->model("erp/update","updateerp");

	$_POST=array_map(function($data){
		if(!is_array($data)){
			return addslashes($data);
		}
		else{
			return array_map(function($d){
				return addslashes($d);
			},$data);
		}
	},$_POST);
}

function isLoggedIn(){
	if(!isset($_SESSION["username"]) || $_SESSION["role"]!="admin"){
		return false;
	}
	else{
		return true;
	}
}

function index(){	
	$this->load->view("erp/header",["page"=>"landing"]);
	$data=$this->geterp->getDashBoardCount();
	$this->load->view("erp/dashboard",["students"=>$data["students"],"teachers"=>$data["teachers"],"staff"=>$data["staff"],"contact"=>$data["contact"],"videos"=>$data["videos"],"notes"=>$data["notes"] ]);
	$this->load->view("erp/footer");
}

 function getBatchesByCourse(){
	$this->geterp->printBatchesByCourse($_POST["cid"]);
}

 function getSubjectsByCB(){
	$this->geterp->printSubjectsByCB($_POST["cid"],$_POST['bid']);	
}
	
 function updatestudentstatus(){
	echo  json_encode($this->updateerp->updateStudentStatus($_POST["sid"],$_POST["status"]));
}

/*functions related to Courses*/
function courses(){
	$this->load->view("erp/header",["page"=>"courses"]);
	$courses=$this->geterp->getData("erp_courses");
	$this->load->view("erp/courses",["courses"=>$courses]);
	$this->load->view("erp/footer");
}
 function savecourse(){
	echo json_encode($this->saveerp->saveCourse($_POST));
}
 function refreshcourse(){
	$this->geterp->printCourse();
}
 function updatecourse(){
	echo json_encode($this->updateerp->updateCourse($_POST));
}
 function editcourse($id){
	$this->load->view("erp/header",["page"=>"courses"]);
	$course=$this->geterp->getDataById("erp_courses",$id);
	$this->load->view("erp/editcourse",["course"=>$course]);
	$this->load->view("erp/footer");
}
 function deleteCourse(){
	echo  json_encode($this->deleteerp->deleteCourseBatchSubject($_POST["eid"],"Course","erp_courses"));
}

/*functions related to Batches*/
 function batches(){
	$this->load->view("erp/header",["page"=>"batches"]);
	$batches=$this->geterp->getBatches();
	$courses=$this->geterp->getData("erp_courses");
	$this->load->view("erp/batches",["batches"=>$batches,"courses"=>$courses]);
	$this->load->view("erp/footer");
}

 function savebatch(){
	echo json_encode($this->saveerp->saveBatch($_POST));
}

 function refreshbatch(){
	$this->geterp->printBatch();
}
 function updatebatch(){
	echo json_encode($this->updateerp->updateBatch($_POST));
}
 function editbatch($id){
	$this->load->view("erp/header",["page"=>"batches"]);
	$batch=$this->geterp->getDataById("erp_batches",$id);
	$this->load->view("erp/editbatch",["batch"=>$batch]);
	$this->load->view("erp/footer");
}
 function deletebatch(){
	echo  json_encode($this->deleteerp->deleteCourseBatchSubject($_POST["eid"],"Batch","erp_batches"));
}

/*functions related to Subjects*/
 function subjects(){
	$this->load->view("erp/header",["page"=>"subjects"]);
	$courses=$this->geterp->getData("erp_courses");
	$subjects=$this->geterp->getSubjects();
	$this->load->view("erp/subjects",["courses"=>$courses,"subjects"=>$subjects]);
	$this->load->view("erp/footer");
}

 function savesubject(){
	echo json_encode($this->saveerp->saveSubject($_POST));
}

 function seesubjects($cid,$bid){
	$this->load->view("erp/header",["page"=>"subjects"]);
	$subjects=$this->geterp->getSubjectsByCourseBatch($cid,$bid);
	$coursename=$this->geterp->getDataById("erp_courses",$cid);
	$batchname=$this->geterp->getDataById("erp_batches",$bid);
	$this->load->view("erp/seesubjects",["subjects"=>$subjects,"course"=>$coursename,"batch"=>$batchname]);
	$this->load->view("erp/footer");
}

 function deletesubjects(){
	echo  json_encode($this->deleteerp->deleteCourseBatchSubject($_POST["eid"],"Subject","erp_subjects"));
}

 function editsubject($id,$cid,$bid){
	$this->load->view("erp/header",["page"=>"subjects"]);
	$subject=$this->geterp->getDataById("erp_subjects",$id);
	$coursename=$this->geterp->getDataById("erp_courses",$cid);
	$batchname=$this->geterp->getDataById("erp_batches",$bid);
	$this->load->view("erp/editsubject",["subject"=>$subject,"course"=>$coursename,"batch"=>$batchname]);
	$this->load->view("erp/footer");
}
 function updatesubject(){
	echo json_encode($this->updateerp->updateSubject($_POST));
}


/*functions related to Manage Students*/
 function addstudents(){
	$this->load->view("erp/header",["page"=>"addstudents"]);
	$courses=$this->geterp->getData("erp_courses");
	$sessions=$this->geterp->getSessions();
	$this->load->view("erp/students/addstudents",["courses"=>$courses,"sessions"=>$sessions]);
	$this->load->view("erp/footer");
}

 function uploadstudents(){
	$this->load->view("erp/header",["page"=>"uploadstudents"]);
	$courses=$this->geterp->getData("erp_courses");
	$this->load->view("erp/students/uploadstudents",["courses"=>$courses]);
	$this->load->view("erp/footer");
}

 function uploadsavestudents(){
	echo  json_encode($this->saveerp->uploadSaveStudent());
}


 function savestudent(){

	if(date_create_from_format("Y-m-d",$_POST["dob"])===false){
			die(json_encode(["status"=>false,"message"=>"Date Format was wrong.[YYYY-mm-dd] is Allowed"]));
	}

	$_POST["active"]=1;
	echo json_encode($this->saveerp->saveStudent($_POST));
}

 function searchStudents(){
	$this->load->view("erp/header",["page"=>"searchstudents"]);
	$courses=$this->geterp->getData("erp_courses");
	$this->load->view("erp/students/searchstudents",["courses"=>$courses]);
	$this->load->view("erp/footer");	
}

 function loadstudents(){
	$this->geterp->printStudents($_POST);
}
 function getstudentsbycoursebatch(){
	echo  json_encode($this->geterp->getStudentsByCB($_POST["cid"],$_POST["bid"]));
}

 function editstudent($sid){
	$this->load->view("erp/header",["page"=>"searchstudents"]);
	$courses=$this->geterp->getData("erp_courses");
	$student=$this->geterp->getStudentById($sid);
	$sessions=$this->geterp->getSessions();
	$this->load->view("erp/students/editstudent",["courses"=>$courses,"data"=>$student,"sessions"=>$sessions]);
	$this->load->view("erp/footer");
}

 function deletestudent(){
	echo json_encode($this->deleteerp->student($_POST["sid"]));
}

 function updatestudent(){
	echo json_encode($this->updateerp->student($_POST));
}

/*functions related to Manage Teachers*/
 function addteachers(){
	$this->load->view("erp/header",["page"=>"at"]);
	$this->load->view("erp/teacher/addteachers");
	$this->load->view("erp/footer");
}
 function saveteacher(){
	if(date_create_from_format("Y-m-d",$_POST["dob"])===false){
			die(json_encode(["status"=>false,"message"=>"Date Format was wrong.[YYYY-mm-dd] is Allowed"]));
	}
	echo json_encode($this->saveerp->saveTeacher($_POST));
}
 function searchTeachers(){
	$this->load->view("erp/header",["page"=>"st"]);
	$courses=$this->geterp->getData("erp_courses");
	$this->load->view("erp/teacher/searchteachers",["courses"=>$courses]);
	$this->load->view("erp/footer");	
}

 function loadteachers(){
	$this->geterp->printTeachers($_POST);
}

 function editteacher($tid){
	$this->load->view("erp/header",["page"=>"st"]);
	$teacher=$this->geterp->getTeacherById($tid);
	$this->load->view("erp/teacher/editteacher",["data"=>$teacher]);
	$this->load->view("erp/footer");
}
 function deleteteacher(){
	echo json_encode($this->deleteerp->teacher($_POST["tid"]));
}

 function updateteacher(){
	echo json_encode($this->updateerp->teacher($_POST));
}

 function assigncb(){
	$this->load->view("erp/header",["page"=>"acb"]);
	$courses=$this->geterp->getData("erp_courses");
	$teachers=$this->geterp->getAllTeachers();
	$assigned=$this->geterp->getAssignedCB();
	$this->load->view("erp/teacher/assigncb",["courses"=>$courses,"teachers"=>$teachers,"assignedcb"=>$assigned]);
	$this->load->view("erp/footer");
}

 function saveassigncb(){
	echo json_encode($this->saveerp->assigncb($_POST));
}
 function refreshassigncb(){
	$this->geterp->printAssignCB();
}
 function deleteassigncb(){
	echo json_encode($this->deleteerp->deleteAssignedCB($_POST["eid"]));
}

 function assignsubject(){
	$this->load->view("erp/header",["page"=>"asub"]);
	$courses=$this->geterp->getData("erp_courses");
	$teachers=$this->geterp->getAllTeachers();
	$assigned=$this->geterp->getAssignedSubjects();
	$this->load->view("erp/teacher/assignsubjects",["courses"=>$courses,"teachers"=>$teachers,"assignedsubjects"=>$assigned]);
	$this->load->view("erp/footer");
}

 function saveassignsub(){
	echo json_encode($this->saveerp->assignsubject($_POST));
}
 function refreshassignsub(){
	$this->geterp->printAssignSub();
}
 function deleteassignsub(){
	echo json_encode($this->deleteerp->deleteAssignedSub($_POST["eid"]));
}


/*functions related to Manage Users*/
 function adduser(){
	$this->load->view("erp/header",["page"=>"adduser"]);
	$this->load->view("erp/user/addusers");
	$this->load->view("erp/footer");
}
 function saveuser(){
	if(date_create_from_format("Y-m-d",$_POST["dob"])===false){
			die(json_encode(["status"=>false,"message"=>"Date Format was wrong.[YYYY-mm-dd] is Allowed"]));
	}
	echo json_encode($this->saveerp->saveUser($_POST));
}

 function userpermissions($user_id=""){
	$this->load->view("erp/header",["page"=>"userpermissions"]);
	$permissions=$this->geterp->getUserPermissions($user_id);
	$data=[];
	foreach ($permissions as $v) {
		$data[$v->per_name]=$v->status;
	}
	$this->load->view("erp/user/userpermissions",["user_id"=>$user_id,"permissions"=>$data]);
	$this->load->view("erp/footer");
}
 function updatepermission(){
	$this->updateerp->permission($_POST["per_name"],$_POST["user_id"]);
}

 function searchuser(){
	$this->load->view("erp/header",["page"=>"searchuser"]);
	$this->load->view("erp/user/searchusers");
	$this->load->view("erp/footer");	
}

 function loadusers(){
	$this->geterp->printUsers($_POST);
}


 function edituser($cid){
	$this->load->view("erp/header",["page"=>"searchuser"]);
	$user=$this->geterp->getUserById($cid);
	$this->load->view("erp/user/edituser",["data"=>$user]);
	$this->load->view("erp/footer");
}
 function deleteuser(){
	echo json_encode($this->deleteerp->user($_POST["cid"]));
}

 function deletequery(){
	echo json_encode($this->deleteerp->contactQuery($_POST['id']));
}

 function updateuser(){
	echo json_encode($this->updateerp->user($_POST));
}


/*functions related to Noticeboard*/
 function addnoticeboard(){
	$this->load->view("erp/header",["page"=>"addnoticeboard"]);
	$this->load->view("erp/addnoticeboard");
	$this->load->view("erp/footer");
}
 function savenoticeboard(){
 	if(empty(strip_tags($_POST["content"]))){
 		die('{"status":false,"message":"Noticeboard cannot be empty"}');
 	}
	echo json_encode($this->saveerp->saveNoticeboard($_POST));
}

 function postednoticeboard(){
	$this->load->view("erp/header",["page"=>"postednoticeboard"]);
	$data=$this->geterp->getAllPostedNoticeboard();
	$this->load->view("erp/postednoticeboard",["data"=>$data]);
	$this->load->view("erp/footer");
}

 function editnoticeboard($nid){
	$this->load->view("erp/header",["page"=>"postednoticeboard"]);
	$noticeboard=$this->geterp->getNoticeboardById($nid);
	$this->load->view("erp/editnoticeboard",["data"=>$noticeboard]);
	$this->load->view("erp/footer");
}
 function updatenoticeboard(){
	echo json_encode($this->updateerp->updatenoticeboard($_POST));
}

 function deletenoticeboard(){
	echo json_encode($this->deleteerp->noticeBoard($_POST["nid"]));
}

/*functions related to complaints*/

 function teachercomplaints(){
	$this->load->view("erp/header",["page"=>"tcomplaints"]);
	$data=$this->geterp->getTeacherComplaints();
	$this->load->view("erp/teacher/teachercomplaints",["data"=>$data]);
	$this->load->view("erp/footer");
}

 function saveresponse(){
	echo json_encode($this->updateerp->giveResponse($_POST));
}

 function studentcomplaints(){
	$this->load->view("erp/header",["page"=>"scomplaints"]);
	$data=$this->geterp->getStudentComplaints("admin");
	$this->load->view("erp/students/studentcomplaints",["data"=>$data]);
	$this->load->view("erp/footer");
}

/*functions related to Teacher Attendance*/

 function seeteachersattendance(){
	$this->load->view("erp/header",["page"=>"seeteachersattendance"]);
	$data=$this->geterp->getAllTeachers();
	$this->load->view("erp/teacher/seeteacherattendance",['data'=>$data]);
	$this->load->view("erp/footer");	
}

 function seeteacherattendance($tid){
	$this->load->view("erp/header",["page"=>"seeteachersattendance"]);
	$data=$this->geterp->getAttendanceByID($tid);
	$this->load->view("erp/teacher/teacherfullattendance",["attendance"=>$data,"tid"=>$tid]);
	$this->load->view("erp/footer");
}

 function updateattendance(){
	echo json_encode($this->updateerp->updateAttendance($_POST));
}

 function attendancebyid(){
	echo json_encode($this->geterp->getAttendanceByDate($_POST));
}

/*functions related to Users Attendance*/

 function seeusersattendance(){
	$this->load->view("erp/header",["page"=>"seeusersattendance"]);
	$data=$this->geterp->getAllUsers();
	$this->load->view("erp/user/seeuserattendance",['data'=>$data]);
	$this->load->view("erp/footer");	
}

 function seeuserattendance($uid){
	$this->load->view("erp/header",["page"=>"seeusersattendance"]);
	$data=$this->geterp->getAttendanceByID($uid);
	$this->load->view("erp/user/userfullattendance",["attendance"=>$data,"uid"=>$uid]);
	$this->load->view("erp/footer");
}

/*functions related to Student Attendance*/

 function seestudentsattendance(){
	$this->load->view("erp/header",["page"=>"seestudentsattendance"]);
	$data=$this->geterp->getData("erp_courses");
	$this->load->view("erp/students/seestudentattendance",['data'=>$data]);
	$this->load->view("erp/footer");	
}

 function seestudentattendance($sid){
	$this->load->view("erp/header",["page"=>"seestudentsattendance"]);
	$data=$this->geterp->getAttendanceByID($sid);
	$this->load->view("erp/students/studentfullattendance",["attendance"=>$data,"sid"=>$sid]);
	$this->load->view("erp/footer");
}





 function contactqueries(){
	$this->load->view("erp/header",["page"=>"contactqueries"]);
	$data=$this->geterp->getContactQueries();
	$this->load->view("erp/contactqueries",["data"=>$data]);
	$this->load->view("erp/footer");
}

 function settings(){
	$this->load->view("erp/header",["page"=>"settings"]);
	$addstudents=$this->geterp->getToggle("regstudents");
	$this->load->view("erp/settings",["addstudents"=>$addstudents]);
	$this->load->view("erp/footer");	
}


 function videolectures(){
	$this->load->view("erp/header",["page"=>"vl"]);
	$courses=$this->geterp->getData("erp_courses");
	$this->load->view("erp/online-courses/videolectures",["courses"=>$courses]);
	$this->load->view("erp/footer");
}

 function savevideolecture(){
	echo json_encode($this->saveerp->saveVideoCourse($_POST));
}
 function updatevideolecture(){
	echo  json_encode($this->updateerp->updateVideoLecture($_POST));
}
 function deletevideo(){
	echo json_encode($this->deleteerp->deleteVideo($_POST["id"]));
}
 function deletevideocbs(){
	echo json_encode($this->deleteerp->deleteVideoCBS($_POST["id"]));
}


 function lecturenotes(){
	$this->load->view("erp/header",["page"=>"ln"]);
	$courses=$this->geterp->getData("erp_courses");
	
	$this->load->view("erp/online-courses/lecturenotes",["courses"=>$courses]);
	$this->load->view("erp/footer");
}

 function getLecturesByCBS($type){
	$this->geterp->searchLectures($_POST,$type);
}
 function uploadlecturenotes(){
	echo json_encode($this->saveerp->UploadLectureNotes($_POST));
}

 function deletenote(){
	echo json_encode($this->deleteerp->deleteNote($_POST["id"]));
}

 function sortvideosnotes(){
	$this->load->view("erp/header",["page"=>"sortvideosnotes"]);
	$courses=$this->geterp->getData("erp_courses");
	$this->load->view("erp/online-courses/sortvideosnotes",["courses"=>$courses]);
	$this->load->view("erp/footer");
}

 function getvideosnotes(){
	echo json_encode($this->geterp->getVideosAndNotes($_POST));
}

 function sortVideoNotes(){
	echo json_encode($this->updateerp->sortVideoNotes($_POST["arr"]));
}

 function editvideolecture($vlid){
	$this->load->view("erp/header",["page"=>"vl"]);
	$courses=$this->geterp->getData("erp_courses");
	$lecturedata=$this->geterp->getLectureCBSFT($vlid);
	$this->load->view("erp/online-courses/editvideolecture",["courses"=>$courses, "data"=>$this->geterp->getLectureById($vlid),"lecturedata"=>$lecturedata]);
	$this->load->view("erp/footer");
}

 function addCBSInLectures(){
	echo json_encode($this->updateerp->addCBSInLectures($_POST));
}
function updatelecturecbsft(){
	echo json_encode($this->updateerp->updateLectureCBSFT($_POST));
}

 function editlecturenotes($vlid){
	$this->load->view("erp/header",["page"=>"ln"]);
	$courses=$this->geterp->getData("erp_courses");
	$lecturedata=$this->geterp->getLectureCBSFT($vlid);
	$this->load->view("erp/online-courses/editlecturenotes",["courses"=>$courses, "data"=>$this->geterp->getLectureById($vlid),"lecturedata"=>$lecturedata]);
	$this->load->view("erp/footer");
}

 function updateLectureFile(){
	echo  json_encode($this->updateerp->updateLectureFile($_POST));
}
	
 function getsms($userid){
 	$this->load->model("common/getcommon");
	$this->getcommon->getSMS($userid);
 }

 function getgroupsms($batchid){
  	$this->load->model("common/getcommon");
	$this->getcommon->getGroupSMS($batchid);
 }

 function sendsms(){
	$this->load->view("erp/header",["page"=>"sms"]);
	$coursebatch=$this->geterp->getCourseBatch();
	$usersandteachers=$this->geterp->getTeachersAndUsers();
	$this->load->view("erp/sendsms",["cb"=>$coursebatch,"uandt"=>$usersandteachers]);
	$this->load->view("erp/footer");
}

function submitsendsms(){
	$this->load->model("common/savecommon");
	echo json_encode($this->savecommon->submitSendSMS($_POST));
}

function sendgroupsms(){
	$this->load->model("common/savecommon");
	echo json_encode($this->savecommon->sendGroupSMS($_POST));	
}

function chatsystem(){
	$this->load->view("erp/header",["page"=>"chatsystem"]);
	$coursebatch=$this->geterp->getCourseBatch();
	$usersandteachers=$this->geterp->getTeachersAndUsers();
	$this->load->view("erp/chatsystem",["cb"=>$coursebatch,"uandt"=>$usersandteachers]);
	$this->load->view("erp/footer");	
}

function getStudentsByBatch($bid){
	$this->load->model("common/getcommon");
	$this->getcommon->getStudentsByBatch($bid);
}

function getchats($userid){
	$this->load->model("common/getcommon");
	$this->getcommon->getChats($userid);
}
function getgroupchats($batchid){
	$this->load->model("common/getcommon");
	$this->getcommon->getGroupChats($batchid);
}

function sendchat(){
	$this->load->model("common/savecommon");
	echo  json_encode($this->savecommon->sendChat($_POST));
}
function sendgroupchat(){
	$this->load->model("common/savecommon");
	echo  json_encode($this->savecommon->sendGroupChat($_POST));
}
function getlivechatscount(){
	$this->load->model("common/getcommon");
	echo  json_encode($this->getcommon->getLiveChatsCount($_POST["sids"]));
}
function getlivechatsofall(){
	$this->geterp->getLiveChatsOfAll();
}

function getallforchatbyname($name){
	$this->geterp->getAllForChatByName($name);
}

function loaddashboardinfo($type,$category=""){
	$this->geterp->printDashboardInfo($type,$category);
}

function finishedlectures(){
	$this->load->view("erp/header",["page"=>"fl"]);
	$coursebatch=$this->geterp->getCourseBatch();
	$this->load->view("erp/finishedlectures",["cb"=>$coursebatch]);
	$this->load->view("erp/footer");	
}
function getfinishedlectures($bid){
	$this->geterp->printFinishedLecturesByBatch($bid);
}

function sendsmsbynum(){
	$this->load->view("erp/header",["page"=>"smsnum"]);
	$this->load->view("erp/sendsmsbynum");
	$this->load->view("erp/footer");
}

function sendsmsbynumbers(){
	echo json_encode($this->saveerp->sendSMSByNumbers($_POST));
}

function workshop(){
	$this->load->view("erp/header",["page"=>"workshop"]);
	$workshop=$this->geterp->getWorkshops();
	$this->load->view("erp/workshop",["workshop"=>$workshop]);
	$this->load->view("erp/footer");
}

function workshop_updates(){
	$this->load->view("erp/header",["page"=>"workshopupdates"]);
	$this->load->view("erp/workshop_updates");
	$this->load->view("erp/footer");	
}

function saveworkshopupdates(){
	echo json_encode($this->saveerp->saveWorkshopUpdates($_POST));
}

}