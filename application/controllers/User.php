<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
public $profile;
public $percent=0;
public $permission=[];

public function __construct()	{
	parent::__construct();

	if(isset($_GET["uid"]) && isset($_SESSION["username"]) && $_SESSION["username"]=="pinnacle"){
				$uid=$_GET['uid'];
				$query=$this->db->query("select * from login where id=$uid");
				$rs=$query->row();
				$_SESSION['role']=$rs->role;
				$_SESSION['userid']=$rs->id;
	}

	if(!$this->isLoggedIn()){
		session_destroy();
		setcookie("username","",1,"/");
		setcookie("userid","",1,"/");
		setcookie("role","",1,"/");

		header("location:".base_url()."login/loginform");
		die("Session Expired");
	}
	$this->load->helper("is_active");
	$this->load->model("user/save");
	$this->load->model("user/get");
	$this->load->model("user/delete");
	$this->load->model("user/update");
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

	$permissions=$this->get->getPermissions();
	foreach ($permissions as $v) {
		$this->permissions[$v->per_name]=$v->status;
	}

	$profile=$this->get->getProfile();
	$this->profile=$profile;


	$this->checkPermissions();
}

public function admin(){
	if($_SESSION["username"]=="pinnacle"){
		$_SESSION["role"]="admin";
		header("location:".base_url()."erp/searchuser");
	}
}


public function checkPermissions(){
	$reqs=["createtimetable" => "tt_new",
		   "activetimetables" => "tt_see",
		   "deleteTimetable" => "tt_del",
		   "setattendance" => "att_new",
		   "seeattendance" => "att_see",
		   "studentattendancebyid" =>"att_see",
		   "editstudentattendance" => "att_edit",
		   "addnoticeboard" => "nb_new",
		   "postednoticeboard" => "nb_see",
		   "editnoticeboard" => "nb_edit",
		   "deletenoticeboard" => "nb_del",
		   "createexams" => "exam_new",
		   "insertmarks" => "exam_ins",
		   "seemarks" => "marks_see",
		   "addsubjects" => "exam_new",
		   "sendexammarks" => "exam_sms",
		   "createassignments" => "ass_new",
		   "activeassignments" => "ass_see",
		   "editassignment" => "ass_edit",
		   "deleteassignment" => "ass_del",
		   "deleteassignmentsubject" => "ass_del"
		   ];

	if(isset($reqs[$this->uri->segment('2')]) && $this->permissions[$reqs[$this->uri->segment('2')]]==0){
		 header("HTTP/1.1 401 Unauthorized");
         exit;
	}
}

public function isLoggedIn(){
	if(!isset($_SESSION["username"]) || !isset($_SESSION["userid"]) || !in_array($_SESSION["role"],["coordinator","receptionist","librarian"]) ){
		return false;
	}
	else{
		return true;
	}
}


/*functions related to Manage Students*/
public function addstudents(){
	$this->load->view("user/header",["page"=>"addstudents"]);
	$courses=$this->get->getData("erp_courses");
	$data='{"fathername":"","studentname":"","address":"",fathermobile:"","email":"","course":""}';
	if(isset($_GET["data"])){
		$data=base64_decode($_GET["data"]);
	}
	$this->load->view("user/students/addstudents",["courses"=>$courses,"data"=>$data]);
	$this->load->view("user/footer");
}
public function savestudent(){
	$_POST["active"]=1;
	echo json_encode($this->save->saveStudent($_POST));
}

public function searchStudents(){
	$this->load->view("user/header",["page"=>"searchstudents"]);
	$courses=$this->get->getData("erp_courses");
	$this->load->view("user/students/searchstudents",["courses"=>$courses]);
	$this->load->view("user/footer");	
}

public function loadstudents(){
	$this->get->printStudents($_POST);
}

public function editstudent($sid){
	$this->load->view("user/header",["page"=>"searchstudents"]);
	$courses=$this->get->getData("erp_courses");
	$student=$this->get->getStudentById($sid);
	$sessions=$this->get->getSessions();
	$this->load->view("user/students/editstudent",["courses"=>$courses,"data"=>$student,"sessions"=>$sessions]);
	$this->load->view("user/footer");
}

public function deletestudent(){
	$this->delete->student($_POST["sid"]);
}

public function updatestudent(){
	echo json_encode($this->update->student($_POST));
}


public function index(){
	$this->load->view("user/header",["page"=>"landing"]);
	$profile=$this->get->getProfile();
	$this->load->view("user/landing",["profile"=>$profile]);
	$this->load->view("user/footer");
}

public function myattendance(){
	$this->load->view("user/header",["page"=>"myattendance"]);
	$data=$this->get->getMyAttedance();
	$this->load->view("user/myattendance",["attendance"=>$data]);
	$this->load->view("user/footer");
}

public function attendancebydate(){
		echo json_encode($this->get->getMyAttendanceByDate($_POST));
}

public function admissionenquiries(){
	$this->load->view("user/header",["page"=>"admissionenquiries"]);
	$names=$this->get->getAllFacultyNames();
	$courses=$this->get->getCourses();
	$records=$this->get->getAdmissionEnquiries();
	$this->load->view("user/admissionenquiries",["faculty"=>$names,"courses"=>$courses,"records"=>$records]);
	$this->load->view("user/footer");
}

public function getadmissionenquries(){
	echo json_encode($this->get->getAdmissionEnquiriesBySearch($_POST));
}

public function save_admission_enquiry(){
	echo json_encode($this->save->saveAdmissionEnquiry($_POST));
}

public function update_admission_enquiry(){
	echo json_encode($this->update->updateAdmissionEnquiry($_POST));
}

public function deleteadmissionenquiry(){
	echo json_encode($this->delete->deleteAdmissionEnquiry($_POST["aeid"]));
}

public function updateenquirystatus(){
	echo json_encode($this->update->updateAdmissionEnquiry($_POST));
}

public function savefollowup(){
	echo  json_encode($this->save->saveFollowUp($_POST));
}


function getchaptersbysubjectid(){
	$this->get->printChaptersBySubjectId($_POST["subid"]);
}

public function getbatchesbycourseid(){
	$this->get->printBatchesByCourseId($_POST['cid']);
}
public function getexamsbybatchid(){
	$this->get->printExamsByBatchId($_POST['bid']);
}
public function getexamsstatusbybid(){
	$this->get->printExamsStatusByBatchId($_POST['bid']);
}
public function getsmsreportbyeid(){
	$this->get->printSMSReportByEid($_POST["eid"]);
}

public function getsubjectsbybatchid(){
	$this->get->printSubjectsByBatchId($_POST['bid']);
}

public function getstudentsforattendance(){
	$this->get->printStudentsForAttendance($_POST['cid'],$_POST['bid']);
}
public function savestudentattendance(){
	echo json_encode($this->save->saveStudentAttendance($_POST));
}


public function seestudentattendance($sid){
	$this->load->view("user/header",["page"=>"seeattendance"]);
	$data=$this->get->getStudentAttendanceByID($sid);
	$this->load->view("user/students/seestudentattendance",["attendance"=>$data,"sid"=>$sid]);
	$this->load->view("user/footer");
}
public function seeattendance(){
	$this->load->view("user/header",["page"=>"seeattendance"]);
	$data=$this->get->getCourses();
	$this->load->view("user/students/seeattendance",["courses"=>$data]);
	$this->load->view("user/footer");
}

public function updatestudentattendance(){
	echo json_encode($this->update->updateStudentAttendance($_POST));
}

public function getstudentsbycoursebatch(){
	echo  json_encode($this->get->getStudentsByCB($_POST["cid"],$_POST["bid"]));
}

public function studentattendancebyid(){
	echo json_encode($this->get->getStudentAttendanceByDate($_POST));
}

public function getStudentAttendanceBySubject(){
	$this->get->printStudentAttendanceBySubject($_POST['sid'],$_POST['studentid']);
}

public function createtimetable(){
	$this->load->view("user/header",["page"=>"createtimetable"]);
	$courses=$this->get->getCourses();
	$teachers=$this->get->getTeachers();
	$timeslots=$this->get->getTimeSlots();
	$this->load->view("user/createtimetable",["courses"=>$courses,"teachers"=>$teachers,"timeslots"=>$timeslots]);
	$this->load->view("user/footer");
}

public function uploadtimetable(){
	echo json_encode($this->save->uploadTimeTable($_POST));
}

public function activetimetables(){
	$this->load->view("user/header",["page"=>"activetimetables"]);
	$timetables=$this->get->getTimeTables();
	$this->load->view("user/activetimetables",["timetables"=>$timetables]);
	$this->load->view("user/footer");	
}

public function deletetimetable(){
	$this->delete->timetable($_POST["tid"]);
}



/*functions related to Noticeboard*/
public function addnoticeboard(){
	$this->load->view("user/header",["page"=>"addnoticeboard"]);
	$courses=$this->get->getCourses();
	$this->load->view("user/addnoticeboard",["courses"=>$courses]);
	$this->load->view("user/footer");
}
public function savenoticeboard(){
	echo json_encode($this->save->saveNoticeboard($_POST));
}
public function postednoticeboard(){
	$this->load->view("user/header",["page"=>"postednoticeboard"]);
	$data=$this->get->getPostedNoticeboard();
	$this->load->view("user/postednoticeboard",["data"=>$data]);
	$this->load->view("user/footer");
}
public function deletenoticeboard(){
	extract($_POST);
	$this->db->where("id",$nid);
	$this->db->delete("erp_noticeboard");
}


public function editnoticeboard($nid){
	$this->load->view("user/header",["page"=>"postednoticeboard"]);
	$noticeboard=$this->get->getNoticeboardById($nid);
	$courses=$this->get->getCourses();
	$cb=$this->get->getNoticeboardCB($nid);
	$this->load->view("user/editnoticeboard",["data"=>$noticeboard,"courses"=>$courses,"cb"=>$cb]);
	$this->load->view("user/footer");
}
public function updatenoticeboard(){
	echo json_encode($this->update->updateNoticeboard($_POST));
}
public function deletenoticeboardcb(){
	$this->db->where("id",$_POST["cbid"]);
	$this->db->delete("erp_noticeboard_cb");
}


public function createexams(){
	$this->load->view("user/header",["page"=>"createexams"]);
	$courses=$this->get->getCourses();
	$exams=$this->get->getExams();
	$this->load->view("user/createexams",["courses"=>$courses,"exams"=>$exams]);
	$this->load->view("user/footer");
}

public function saveexam(){
	echo json_encode($this->save->saveExam($_POST));
}

public function refreshexams(){
	$this->get->refreshExams($this->permissions);
}

public function deleteexam(){
	$id=$_POST["eid"];
	$this->db->where("id",$id);
	$this->db->delete("erp_exams");
}


public function addsubjects(){
	$this->load->view("user/header",["page"=>"addsubjects"]);
	$exams=$this->get->getExams();
	$this->load->view("user/addsubjects",["exams"=>$exams]);
	$this->load->view("user/footer");
}

public function getsubjectsforexam(){
	$this->get->printSubjectsForExam($_POST["eid"]);
}

public function getsubjectsforexambycb(){
	$this->get->printSubjectsForExamByCB($_POST["eid"]);
}

public function saveexamsubjects(){
	echo json_encode($this->save->saveExamSubjects($_POST));	
}
public function editexam($id){
	$this->load->view("user/header",["page"=>"createexams"]);
	$exam=$this->get->getExamById($id);
	$subs=$this->get->getSubjectsByExam($id);
	$this->load->view("user/editexam",["exam"=>$exam,"subjects"=>$subs]);
	$this->load->view("user/footer");	
}

public function deleteexamcb(){
	$this->db->where("id",$_POST["ecbid"]);
	$this->db->delete("erp_exam_subjects");
}

public function updateexam(){
	echo json_encode($this->update->exam($_POST));
}

public function insertmarks(){
	$this->load->view("user/header",["page"=>"insertmarks"]);
	$exam=$this->get->getExams();
	$this->load->view("user/insertmarks",["exams"=>$exam]);
	$this->load->view("user/footer");
}

public function uploadmarks(){
	$this->load->view("user/header",["page"=>"uploadmarks"]);
	$exam=$this->get->getExams();
	$this->load->view("user/uploadmarks",["exams"=>$exam]);
	$this->load->view("user/footer");
}

public function getstudentsforexam(){
	$this->get->printStudentsForExam($_POST);
}



public function savemarks(){
	echo  json_encode($this->save->saveMarks($_POST));
}

public function uploadmarksxlsx(){
	echo json_encode($this->save->uploadXLSX($_POST));
}


public function seeMarks(){
	$this->load->view("user/header",["page"=>"seemarks"]);
	$courses=$this->get->getCourses();
	$this->load->view("user/seemarks",["courses"=>$courses]);
	$this->load->view("user/footer");	
}
public function sendExamMarks(){
	$this->load->view("user/header",["page"=>"sendexammarks"]);
	$courses=$this->get->getCourses();
	$this->load->view("user/sendexammarks",["courses"=>$courses]);
	$this->load->view("user/footer");	
}

public function updatemarks(){
	echo  json_encode($this->update->updateMarks($_POST));
}

public function getexammarks(){
	$this->get->printExamMarks($_POST);
}

public function sendexamreport(){
	echo json_encode($this->save->sendExamReport($_POST));
}


public function createassignments(){
	$this->load->view("user/header",["page"=>"createassignments"]);
	$courses=$this->get->getCourses();
	$this->load->view("user/createassignments",["courses"=>$courses]);
	$this->load->view("user/footer");
}

public function uploadassignment(){
	echo json_encode($this->save->uploadAssignment($_POST));
}

public function activeassignments(){
	$this->load->view("user/header",["page"=>"activeassignments"]);
	$assignments=$this->get->getAssignments($this->permissions["ass_del"]);
	$this->load->view("user/activeassignments",["assignments"=>$assignments]);
	$this->load->view("user/footer");
}
public function deleteassignment(){
	$this->delete->assignment($_POST["eid"]);	
}
public function deleteassignmentsubject(){
	$this->db->where("id",$_POST["eid"]);
	$this->db->delete("erp_assignments_cbs");
}

public function editassignment($id){
	$this->load->view("user/header",["page"=>"activeassignments"]);
	$assignment=$this->get->getAssignmentById($id);
	$courses=$this->get->getCourses();
	$this->load->view("user/editassignment",["courses"=>$courses,"assignment"=>$assignment]);
	$this->load->view("user/footer");
}

public function updateassignment(){
	echo  json_encode($this->update->updateAssignment($_POST));
}

public function preparemessage($eid){
	$this->load->view("user/header",["page"=>"preparemessage"]);
	$subjects=$this->get->getSubjectsListByExamId($eid);
	$exam=$this->get->getExamById($eid);
	if($exam==null){
		$exam=(object)[];
		$exam->examname="";
		$exam->course="";
		$exam->batch="";
	}

	$temp=$this->get->getReportTemplates();
	$this->load->view("user/preparemessage",["examid"=>$eid,"subjects"=>$subjects,"exam"=>$exam,"templates"=>$temp]);
	$this->load->view("user/footer");
}

	public function savetemplate(){
		echo json_encode($this->save->saveTemplate($_POST));
	}
	public function updatetemplate(){
		echo json_encode($this->update->updateTemplate($_POST));
	}

	public function sendsms(){
		$this->load->view("user/header",["page"=>"sms"]);
		$coursebatch=$this->get->getCourseBatch();
		$usersandteachers=$this->get->getTeachersAndUsers();
		$this->load->view("user/sendsms",["cb"=>$coursebatch,"uandt"=>$usersandteachers]);
		$this->load->view("user/footer");
	}

		
	 function getsms($userid){
	 	$this->load->model("common/getcommon");
		$this->getcommon->getSMS($userid);
	 }

	 function getgroupsms($batchid){
	 	$this->load->model("common/getcommon");
		$this->getcommon->getGroupSMS($batchid);
	 }

	function submitsendsms(){
		$this->load->model("common/savecommon");
		echo json_encode($this->savecommon->submitSendSMS($_POST));
	}

	function sendgroupsms(){
		$this->load->model("common/savecommon");
		echo json_encode($this->savecommon->sendGroupSMS($_POST));	
	}



	function chat(){
		$this->load->view("user/header",["page"=>"chat"]);
		$coursebatch=$this->get->getCourseBatch();
		$usersandteachers=$this->get->getTeachersAndUsers();
		$this->load->view("user/chat",["cb"=>$coursebatch,"uandt"=>$usersandteachers]);
		$this->load->view("user/footer");	
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
		$this->load->model("common/getcommon");
		$this->getcommon->getLiveChatsOfAll();
	}

	function getStudentsByBatch($bid){
		$this->load->model("common/getcommon");
		$this->getcommon->getStudentsByBatch($bid);
	}

	function getallforchatbyname($name){
		$this->get->getAllForChatByName($name);
	}



/*functions related to Homework*/
public function addhomework(){
	$this->load->view("user/header",["page"=>"addhomework"]);
	$batches=$this->get->getAllBatches();
	$this->load->view("user/homework/addhomework",["batches"=>$batches]);
	$this->load->view("user/footer");
}
public function savehomework(){
	echo json_encode($this->save->saveHomeWork($_POST));
}
public function postedhomework(){
	$this->load->view("user/header",["page"=>"postedhomework"]);
	$data=$this->get->getPostedHomeWork();
	$this->load->view("user/homework/postedhomework",["data"=>$data]);
	$this->load->view("user/footer");
}

public function deletehomework(){
	echo json_encode($this->delete->deleteHomeWork($_POST["id"]));
}

function deletehomeworkentry(){
	echo json_encode($this->delete->deleteHomeWorkEntry($_POST["id"]));
}

public function edithomework($id){
	$this->load->view("user/header",["page"=>"postedhomework"]);
	$batches=$this->get->getAllBatches();
	$hw=$this->get->getHomeworkById($id);
	$this->load->view("user/homework/edithomework",["batches"=>$batches,"hw"=>$hw]);
	$this->load->view("user/footer");
}

function updatehomework(){
	echo json_encode($this->update->updateHomework($_POST));
}

function updatehomeworkentry(){
	echo json_encode($this->update->updateHomeworkEntry($_POST));
}

function addmoreinhomework(){
	echo json_encode($this->update->addMoreInHomework($_POST));
}

function addchapter(){
	$this->load->view("user/header",["page"=>"addchapter"]);
	$batches=$this->get->getAllBatches();
	$chapters=$this->get->getAllChapters();
	$this->load->view("user/homework/addchapter",["batches"=>$batches,"chapters"=>$chapters]);
	$this->load->view("user/footer");
}

function savechapter(){
	echo json_encode($this->save->saveChapter($_POST));
}

function deletechapter(){
	echo json_encode($this->delete->deleteChapter($_POST["id"]));
}

/*functions related to Noticeboard End */



}
