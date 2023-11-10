<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller {

public $percent="";

public function __construct()	{
		parent::__construct();


		if(isset($_GET["tid"]) && isset($_SESSION["username"]) && $_SESSION["username"]=="pinnacle"){
				$tid=$_GET['tid'];
				$query=$this->db->query("select * from login where id=$tid");
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
		$this->load->model("teacher/save");
		$this->load->model("teacher/get");
		$this->load->model("teacher/delete");
		$this->load->model("teacher/update");
}

public function isLoggedIn(){
	if(!isset($_SESSION["username"]) || !isset($_SESSION["userid"]) || $_SESSION["role"]!="teacher"){
		return false;
	}
	else{
		return true;
	}
}

public function index(){
	$this->load->view("teacher/header",["page"=>"landing"]);
	$profile=$this->get->getProfile();
	$schedule=$this->get->getScheduleDetailsByDate(date("Y-m-d",time()));
	$cb=$this->get->getAssignedCoursesAndBatches();
	$admissions=$this->get->getAdmissionTasks();
	$this->load->view("teacher/landing",["profile"=>$profile,"schedule"=>$schedule,"cb"=>$cb,"admissions"=>$admissions]);
	$this->load->view("teacher/footer");
}
	
public function admin(){
	if($_SESSION["username"]=="pinnacle"){
		$_SESSION["role"]="admin";
		$this->db->where("username","pinnacle");
		$userid=$this->db->get("login")->row()->id;
		$_SESSION["userid"]=$userid;
		header("location:".base_url()."erp/searchteachers");
	}
}

public function myattendance(){
	$this->load->view("teacher/header",["page"=>"myattendance"]);
	$data=$this->get->getMyAttedance();
	$this->load->view("teacher/myattendance",["attendance"=>$data]);
	$this->load->view("teacher/footer");
}

public function attendancebydate(){
		echo json_encode($this->get->getMyAttendanceByDate($_POST));
}

function getchaptersbysubjectid(){
	$this->get->printChaptersBySubjectId($_POST["subid"]);
}

public function getassignedbatches(){
	$this->get->printAssignedBatches($_POST['cid']);
}

public function getassignedsubjects(){
	$this->get->printAssignedSubjects($_POST['bid']);
}

public function getstudentsbycoursebatch(){
	echo  json_encode($this->get->getStudentsByCB($_POST["cid"],$_POST["bid"]));
}

public function studentattendancebyid(){
	echo json_encode($this->get->getStudentAttendanceByDate($_POST));
}


public function seestudentattendance($sid){
	$this->load->view("teacher/header",["page"=>"seeattendance"]);
	$data=$this->get->getStudentAttendanceByID($sid);
	$this->load->view("teacher/seestudentattendance",["attendance"=>$data,"sid"=>$sid]);
	$this->load->view("teacher/footer");
}
public function updatestudentattendance(){
	echo json_encode($this->update->updateStudentAttendance($_POST));
}

public function seeattendance(){
	$this->load->view("teacher/header",["page"=>"seeattendance"]);
	$courses=$this->get->getAssignedCourses();
	$this->load->view("teacher/seeattendance",["courses"=>$courses]);
	$this->load->view("teacher/footer");
}


public function seetimetable(){
	$this->load->view("teacher/header",["page"=>"seetimetable"]);
	$timetables=$this->get->getTimeTables();
	$this->load->view("teacher/seetimetable",["timetables"=>$timetables]);
	$this->load->view("teacher/footer");	
}

public function getscheduledetailsbydate(){
	$data=$this->get->getScheduleDetailsByDate($_POST["dt"]);
	echo json_encode($data);
}

/*functions related to Noticeboard*/
public function addnoticeboard(){
	$this->load->view("teacher/header",["page"=>"addnoticeboard"]);
	$courses=$this->get->getAssignedCourses();
	$this->load->view("teacher/addnoticeboard",["courses"=>$courses]);
	$this->load->view("teacher/footer");
}
public function savenoticeboard(){
	echo json_encode($this->save->saveNoticeboard($_POST));
}
public function postednoticeboard(){
	$this->load->view("teacher/header",["page"=>"postednoticeboard"]);
	$data=$this->get->getPostedNoticeboard();
	$this->load->view("teacher/postednoticeboard",["data"=>$data]);
	$this->load->view("teacher/footer");
}
public function deletenoticeboard(){
	extract($_POST);
	$this->db->where("id",$nid);
	$this->db->delete("erp_noticeboard");
}
public function editnoticeboard($nid){
	$this->load->view("teacher/header",["page"=>"postednoticeboard"]);
	$noticeboard=$this->get->getNoticeboardById($nid);
	$courses=$this->get->getAssignedCourses();
	$cb=$this->get->getNoticeboardCB($nid);
	$this->load->view("teacher/editnoticeboard",["data"=>$noticeboard,"courses"=>$courses,"cb"=>$cb]);
	$this->load->view("teacher/footer");
}
public function updatenoticeboard(){
	echo json_encode($this->update->updateNoticeboard($_POST));
}
public function deletenoticeboardcb(){
	$this->db->where("id",$_POST["cbid"]);
	$this->db->delete("erp_noticeboard_cb");
}

/*functions related to Noticeboard End */


/*functions related to Homework*/
public function addhomework(){
	$this->load->view("teacher/header",["page"=>"addhomework"]);
	$batches=$this->get->getAssignedBatchesOfSubjects();
	$this->load->view("teacher/homework/addhomework",["batches"=>$batches]);
	$this->load->view("teacher/footer");
}
public function savehomework(){
	echo json_encode($this->save->saveHomeWork($_POST));
}
public function postedhomework(){
	$this->load->view("teacher/header",["page"=>"postedhomework"]);
	$data=$this->get->getPostedHomeWork();
	$this->load->view("teacher/homework/postedhomework",["data"=>$data]);
	$this->load->view("teacher/footer");
}
public function deletehomework(){
	echo json_encode($this->delete->deleteHomeWork($_POST["id"]));
}
function deletehomeworkentry(){
	echo json_encode($this->delete->deleteHomeWorkEntry($_POST["id"]));
}
public function edithomework($id){
	$this->load->view("teacher/header",["page"=>"postedhomework"]);
	$batches=$this->get->getAssignedBatchesOfSubjects();
	$hw=$this->get->getHomeworkById($id);
	$this->load->view("teacher/homework/edithomework",["batches"=>$batches,"hw"=>$hw]);
	$this->load->view("teacher/footer");
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
	$this->load->view("teacher/header",["page"=>"addchapter"]);
	$batches=$this->get->getAssignedBatchesOfSubjects();
	$chapters=$this->get->getAllChapters();
	$this->load->view("teacher/homework/addchapter",["batches"=>$batches,"chapters"=>$chapters]);
	$this->load->view("teacher/footer");
}
function savechapter(){
	echo json_encode($this->save->saveChapter($_POST));
}
function deletechapter(){
	echo json_encode($this->delete->deleteChapter($_POST["id"]));
}

/*functions related to Homework End */

public function createexams(){
	$this->load->view("teacher/header",["page"=>"createexams"]);
	$courses=$this->get->getAssignedCourses();
	$courses2=$this->get->getAssignedCoursesOfSubjects();
	$courses=array_unique(array_merge($courses,$courses2),SORT_REGULAR);
	$exams=$this->get->getExams();
	$this->load->view("teacher/createexams",["courses"=>$courses,"exams"=>$exams]);
	$this->load->view("teacher/footer");
}

public function saveexam(){
	echo json_encode($this->save->saveExam($_POST));
}

public function refreshexams(){
	$this->get->refreshExams();
}

public function deleteexam(){
	$id=$_POST["eid"];
	$this->db->where("id",$id);
	$this->db->delete("erp_exams");
}


public function addsubjects(){
	$this->load->view("teacher/header",["page"=>"addsubjects"]);
	$exams=$this->get->getExams();
	$this->load->view("teacher/addsubjects",["exams"=>$exams]);
	$this->load->view("teacher/footer");
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
	$this->load->view("teacher/header",["page"=>"createexams"]);
	$exam=$this->get->getExamById($id);
	$subs=$this->get->getSubjectsByExam($id);
	$this->load->view("teacher/editexam",["exam"=>$exam,"subjects"=>$subs]);
	$this->load->view("teacher/footer");	
}

public function deleteexamcb(){
	$this->db->where("id",$_POST["ecbid"]);
	$this->db->delete("erp_exam_subjects");
}

public function updateexam(){
	echo json_encode($this->update->exam($_POST));
}

public function insertmarks(){
	$this->load->view("teacher/header",["page"=>"insertmarks"]);
	$exam=$this->get->getExams();
	$this->load->view("teacher/insertmarks",["exams"=>$exam]);
	$this->load->view("teacher/footer");
}

public function getstudentsforexam(){
	$this->get->printStudentsForExam($_POST);
}


public function savemarks(){
	echo  json_encode($this->save->saveMarks($_POST));
}

public function seeMarks(){
	$this->load->view("teacher/header",["page"=>"seemarks"]);
	$exam=$this->get->getExams();
	$this->load->view("teacher/seemarks",["exams"=>$exam]);
	$this->load->view("teacher/footer");	
}
public function updatemarks(){
	echo  json_encode($this->update->updateMarks($_POST));
}

public function getexammarks(){
	$this->get->printExamMarks($_POST);
}

public function createassignments(){
	$this->load->view("teacher/header",["page"=>"createassignments"]);
	$batches=$this->get->getAssignedBatchesOfSubjects();
	$this->load->view("teacher/createassignments",["batches"=>$batches]);
	$this->load->view("teacher/footer");
}

public function uploadassignment(){
	echo json_encode($this->save->uploadAssignment($_POST));
}

public function activeassignments(){
	$this->load->view("teacher/header",["page"=>"activeassignments"]);
	$assignments=$this->get->getAssignments();
	$this->load->view("teacher/activeassignments",["assignments"=>$assignments]);
	$this->load->view("teacher/footer");
}
public function deleteassignment(){
	$this->delete->assignment($_POST["eid"]);	
}
public function deleteassignmentsubject(){
	$this->db->where("id",$_POST["eid"]);
	$this->db->delete("erp_assignments_cbs");
}

public function editassignment($id){
	$this->load->view("teacher/header",["page"=>"activeassignments"]);
	$assignment=$this->get->getAssignmentById($id);
	$batches=$this->get->getAssignedBatchesOfSubjects();
	$this->load->view("teacher/editassignment",["batches"=>$batches,"assignment"=>$assignment]);
	$this->load->view("teacher/footer");
}

public function updateassignment(){
	echo  json_encode($this->update->updateAssignment($_POST));
}


public function editstudentattendance(){
	$this->load->view("teacher/header",["page"=>"editattendance"]);
	$courses=$this->get->getAssignedCourses();
	$this->load->view("teacher/editstudentattendance",["courses"=>$courses]);
	$this->load->view("teacher/footer");
}



public function getstudents(){
	$this->get->printStudentsByCB($_POST);
}

function chat(){
	$this->load->view("teacher/header",["page"=>"chat"]);
	$cb=$this->get->getAssignedCoursesAndBatches();
	$cb2=$this->get->getAssignedCoursesAndBatchesOfSubjects();
	$cb=array_unique(array_merge($cb,$cb2),SORT_REGULAR);
	$ut=$this->get->getTeachersAndUsers();
	$this->load->view("teacher/chat",["cb"=>$cb,"ut"=>$ut]);
	$this->load->view("teacher/footer");	
}

function getchats($userid){
	$this->load->model("common/getcommon");
	$this->getcommon->getChats($userid);
}

function sendchat(){
	echo  json_encode($this->save->sendChat($_POST));
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


function videolectures(){
	$this->load->view("teacher/header",["page"=>"vl"]);
	$batches=$this->get->getAssignedBatchesOfSubjects();
	$this->load->view("teacher/online-courses/videolectures",["batches"=>$batches]);
	$this->load->view("teacher/footer");
}

function lecturenotes(){
	$this->load->view("teacher/header",["page"=>"ln"]);
	$batches=$this->get->getAssignedBatchesOfSubjects();
	$this->load->view("teacher/online-courses/lecturenotes",["batches"=>$batches]);
	$this->load->view("teacher/footer");
}

 function getLecturesByCBS($type){
	$this->get->searchLectures($_POST,$type);
}


}