<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Student extends CI_Controller {

	public $percent=0;

	public function __construct()	{
			parent::__construct();
			 header("location:https://www.pinnacloeducare.com/test");
            die();
			if(isset($_GET["sid"]) && isset($_SESSION["username"]) && $_SESSION["username"]=="pinnacle"){
				$sid=$_GET['sid'];
				$query=$this->db->query("select * from login where id=$sid");
				$rs=$query->row();
				$_SESSION['role']=$rs->role;
				$_SESSION['userid']=$rs->id;
			}
    
			if(!$this->isLoggedIn()){
				session_destroy();
				setcookie("username","",1,"/");
				setcookie("userid","",1,"/");
				setcookie("role","",1,"/");
			//	header("location:".base_url()."login/loginform");
			//	die("Session Expired");
			}
			$this->load->helper("is_active");
			$this->load->helper("get_fy");
			$this->load->model("student/save");
			$this->load->model("student/get");
			$this->load->model("student/delete");
			$this->load->model("student/update");	
			if($this->get->getProfile()->active!=1){
				session_destroy();
				die("<div style='font-family:verdana;text-align:center;font-size:30px;color:red;'>Your Account is not verified by Admin.<br><a style='font-size:20px;' href='".base_url()."'>Go To Home</a></div>");
			}

	}

	public function isLoggedIn(){
		if(!isset($_SESSION["username"]) || !isset($_SESSION["userid"]) || $_SESSION["role"]!="student"){
			return false;
		}
		else{
			return true;
		}
	}

	public function index(){
		$this->load->view("student/header",["page"=>"landing"]);
		$profile=$this->get->getProfile();
		$notice=$this->get->Noticeboard();
		$exams=$this->get->getExamsForDashboard();
		$this->load->view("student/landing",["profile"=>$profile,"noticeboard"=>$notice,"attendance"=>$this->percent,"exams"=>$exams]);
		$this->load->view("student/footer");
	}

	public function admin(){
		if($_SESSION["username"]=="pinnacle"){
			$_SESSION["role"]="admin";
			$this->db->where("username","pinnacle");
			$userid=$this->db->get("login")->row()->id;
			$_SESSION["userid"]=$userid;
			header("location:".base_url()."erp/searchstudents");
		}
	}

	public function attendance(){
		$this->load->view("student/header",["page"=>"attendance"]);
		$data=$this->get->getMyAttedance();
		$this->load->view("student/attendance",["attendance"=>$data]);
		$this->load->view("student/footer");
	}

	public function attendancebydate(){
		echo json_encode($this->get->getAttendanceByDate($_POST));
	}


	public function noticeboard(){
	$this->load->view("student/header",["page"=>"noticeboard"]);
	$notice=$this->get->Noticeboard();
	$this->load->view("student/noticeboard",["data"=>$notice]);
	$this->load->view("student/footer");
	}
	public function assignments(){
	$this->load->view("student/header",["page"=>"assignments"]);
	$data=$this->get->Assignments();
	$this->load->view("student/assignments",["data"=>$data]);
	$this->load->view("student/footer");
	}

	public function exams(){
	$this->load->view("student/header",["page"=>"exams"]);
	$exams=$this->get->getExamsForDashboard();
	$this->load->view("student/exams",["exams"=>$exams]);
	$this->load->view("student/footer");
	}


	public function timetable(){
		$this->load->view("student/header",["page"=>"timetable"]);
		$timetables=$this->get->getTimeTables();
		$this->load->view("student/timetable",["timetables"=>$timetables]);
		$this->load->view("student/footer");
	}

	public function getscheduledetailsbydate(){
		$data=$this->get->getScheduleDetailsByDate($_POST["dt"]);
		echo json_encode($data);
	}

	public function sms(){
		$this->load->view("student/header",["page"=>"sms"]);
		$data=$this->get->SMS();
		$this->load->view("student/sms",["sms"=>$data]);
		$this->load->view("student/footer");
	}

	public function videolectures($vid=""){
		$subs=$this->get->getLectureSubjects();
		$this->load->view("student/videolectures-new",["subjects"=>$subs,"vid"=>$vid]);
	}

	function updatelecturestatus(){
		echo json_encode($this->save->updateLectureStatus($_POST["id"]));
	}

	function settings(){
		$this->load->view("student/header",["page"=>"settings"]);
		$session=$this->get->getSessions();
		$activesession=$this->get->getActiveSession();
		$this->load->view("student/settings",["sessions"=>$session,"activesession"=>$activesession]);
		$this->load->view("student/footer");
	}

	function updatesession(){
		echo json_encode($this->update->updateSession($_POST["session"]));
	}

	function homework(){
		$this->load->view("student/header",["page"=>"homework"]);
		$homework=$this->get->getHomework();
		$this->load->view("student/homework",["data"=>$homework]);
		$this->load->view("student/footer");	
	}

	function chat(){
		$this->load->view("student/header",["page"=>"chat"]);
		$teachers=$this->get->getTeachersAndUsers();
		$this->load->view("student/chat",["teachers"=>$teachers]);
		$this->load->view("student/footer");	
	}

	function getchats($userid){
		$this->load->model("common/getcommon");
		$this->getcommon->getChats($userid);
	}

	function sendchat(){
		$this->load->model("common/savecommon");
		echo  json_encode($this->savecommon->sendChat($_POST));
	}

	function getlivechatscount(){
		$this->load->model("common/getcommon");
		echo  json_encode($this->getcommon->getLiveChatsCount($_POST["sids"]));
	}

	function getlatestlectures(){
		echo json_encode($this->get->getLatestLectures());
	}


}
