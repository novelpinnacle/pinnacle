<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Save extends CI_Model {
	public $session;
	public $sessionid;
	public $timestamp="";
	public function __construct(){
		$this->load->helper("get_fy");
		$session=get_fy();
		$query=$this->db->query("select id from session_table where session='$session'");
		$this->sessionid=$query->row()->id;

		date_default_timezone_set("Asia/Calcutta");
		$this->timestamp=date("Y-m-d H:i:s",time());
	}

	private function checkDBError(){
		if($this->db->error()["message"]!=""){
			die(json_encode(["status"=>false,"message"=>"<div class='text-center w3-text-red'><b>".$this->db->error()["message"]."</b></div>"]));
		}
	}


	public function getRenamedImage($img){
	    $directory=dirname($img)."/";
	    $file=basename($img);
	    $pos=strrpos($file,".");
	    $filename= substr($file,0,$pos)."-". rand(10000,999999);
	    $extension=substr($file, $pos);
	    return $directory.$filename.$extension;
	}

	public function saveStudentAttendance($data){
	extract($data);

	if(empty(trim($sid))){
		return ["status"=>"failed","message"=>"<div class='text-center'><br><b class='w3-text-red'>Please Select Subject</b></div>"];
	}
	if(empty(trim($cid))){
		return ["status"=>"failed","message"=>"<div class='text-center'><br><b class='w3-text-red'>Please Select Course</b></div>"];
	}
	if(empty(trim($bid))){
		return ["status"=>"failed","message"=>"<div class='text-center'><br><b class='w3-text-red'>Please Select Batch</b></div>"];
	}

	if(empty(trim($date))){
		$date=date("Y-m-d");
	}
	$CI =& get_instance(); 
	$CI->load->model("teacher/get");
	$studs=$CI->get->getStudentsByCB($cid,$bid);

	$query=$this->db->query("select * from erp_studentattendance where date='$date' and sid=$sid ");
	if($query->row()){
		return ["status"=>"failed","message"=>"<div class='text-center'><br><b class='w3-text-red'>Attendande Already Set</b></div>"];
	}

	foreach ($studs as $v) {
		$this->db->insert("erp_studentattendance",["cid"=>$cid,'bid'=>$bid,'sid'=>$sid,"status"=>$data[$v->sid],"studentid"=>$v->sid,"date"=>$date]);
	}

	return ["status"=>"ok","message"=>"<div class='text-center'><br><b class='w3-text-green'>Attendance Set Successfully</b></div>"];

	}


public function saveNoticeboard($data){
	extract($data);
	$data["uploadby"]=$_SESSION["userid"];
	$this->db->insert("erp_noticeboard",["content"=>$content,"uploadby"=>$data["uploadby"],"session"=>$this->sessionid]);

	$id=$this->db->insert_id();
	$arr[]="";
	for($i=0;$i<count($cid);$i++) {
		if(in_array($cid[$i].$bid[$i], $arr)){continue;}
		$this->db->insert("erp_noticeboard_cb",["nid"=>$id,"cid"=>$cid[$i],"bid"=>$bid[$i]]);
		$arr[]=$cid[$i].$bid[$i];
	}

	return ["status"=>"ok","message"=>"<div class='text-center'><br><b class='w3-text-green'>Noticeboard Created Successfully</b></div>"];
}

public function saveHomework($data){
		
	$bsc_count=$data["bsc_count"];
	
	for($b=0;$b<$bsc_count;$b++){
		$bsc_data=array();
		parse_str($data["bscdata_$b"],$bsc_data);
		

		$this->db->insert("erp_homework",["batchid"=>$bsc_data["batchid"],"subjectid"=>$bsc_data["subjectid"] ,"chapterid"=>$bsc_data["chapterid"],"datetime"=>$this->timestamp ,"uploadby"=>$_SESSION["userid"],"session"=>$this->sessionid]);
		$homeworkid=$this->db->insert_id();

		$this->checkDBError();

		$count=$data["count"];
		for($i=0;$i<$count;$i++){
			$records=array();
			parse_str($data["data_$i"],$records);
		
			for($j=0;$j<count($records["exercise"]);$j++){

				$this->db->insert("erp_homework_lectures",["homeworkid"=>$homeworkid,"lectureno"=>$records["lectureno"],"exercise"=>$records["exercise"][$j],"questions"=>$records["questions"][$j] ]);

				$this->checkDBError();
			}
		}
	}	
	return ["status"=>true,"message"=>"Homework Uploaded Successfully"];


}

public function saveExam($data){
	$data["createdby"]=$_SESSION["userid"];
	$data["session"]=$this->sessionid;
	$this->db->insert("erp_exams",$data);
	return ["status"=>"ok","message"=>"<div class='text-center'><br><b class='w3-text-green'>Exam Created Successfully</b></div>"];

}
public function saveExamSubjects($data){
	extract($data);

		$this->db->where(["eid"=>$eid]);
		$qu=$this->db->get("erp_exam_marks");
		if($qu->row()){
			return ["status"=>"fail","message"=>"<div class='text-center'><br><b class='w3-text-red'>Exam is Published</b></div>"];
		}

	for($i=0;$i<count($sid);$i++){
		
	$this->db->where(["sid"=>$sid[$i],"eid"=>$eid]);
	$query=$this->db->get("erp_exam_subjects");
	$rs=$query->row();
	if($rs){continue;}

		$subjectid=$sid[$i];
		$pm=$passmarks[$i];
		$tm=$totalmarks[$i];

		$this->db->insert("erp_exam_subjects",["eid"=>$eid,"passmarks"=>$pm,"totalmarks"=>$tm,"sid"=>$subjectid]);
	}
	return ["status"=>"ok","message"=>"<div class='text-center'><br><b class='w3-text-green'>Subjects Added Successfully</b></div>"];

}


public function saveMarks($data){
	extract($data);

		$this->db->where(["eid"=>$eid]);
		$qu=$this->db->get("erp_exam_marks");
		if($qu->row()){
			return ["status"=>"fail","message"=>"<div class='text-center'><br><b class='w3-text-red'>Marks Already Uploaded</b></div>"];
		}

	$query=$this->db->query("select es.sid,ex.category from erp_students es inner join erp_exams ex on es.course=ex.cid and es.batch=ex.bid where ex.id=$eid");
	$result=$query->result();

	$query=$this->db->query("select exs.sid,es.subject from erp_exam_subjects exs inner join erp_subjects es on es.id=exs.sid where exs.eid=$eid");
	$subjects=$query->result();

	foreach ($result as $v) {

	if($v->category==1){

		if(isset($data["ck-$v->sid"])){$attendance=0;}else{$attendance=1;}

			$i=0;
		foreach($subjects as $s){

		$marksdata=["eid"=>$eid,"subjectid"=>$s->sid,"studentid"=>$v->sid,"marks"=>$data["marks-$v->sid"][$i],"correct"=>$data["correct-$v->sid"][$i],"wrong"=>$data["wrong-$v->sid"][$i],"attendance"=>$attendance];

		$this->db->insert("erp_exam_marks",$marksdata);
		$i++;
		}

	}
	if($v->category==2){

		if(isset($data["ck-$v->sid"])){$attendance=0;}else{$attendance=1;}


		$i=0;
		foreach($subjects as $s){
		$marksdata=["eid"=>$eid,"subjectid"=>$s->sid,"studentid"=>$v->sid,"marks"=>$data["marks-$v->sid"][$i],"attendance"=>$attendance];
		$this->db->insert("erp_exam_marks",$marksdata);
		$i++;
		}
				
	}
	

	}
	return ["status"=>"ok","message"=>"<div class='text-center'><br><b class='w3-text-green'>Marks Uploaded Successfully</b></div>"];

}

	public function uploadAssignment($data){
		extract($data);
	
	$target_dir = "uploads/assignments/";
	$target_file = $target_dir . basename($_FILES["assignment"]["name"]);

   	
   	if(empty($_FILES["assignment"]["name"])){
		return ["message"=>"<span class='w3-text-red'>Please Choose File</span>","status"=>"failed"];
	}

    if (file_exists($target_file)) {
      $target_file=$this->getRenamedImage($target_file);
	}
	
	if (move_uploaded_file($_FILES["assignment"]["tmp_name"], $target_file)) {
		
		$data["path"]=$target_file;
		$data["uploadby"]=$_SESSION["userid"];
		$this->db->insert("erp_assignments",["title"=>$title,"uploadby"=>$data["uploadby"],"path"=>$data["path"],"session"=>$this->sessionid]);

		$id=$this->db->insert_id();

		for($i=0;$i<count($batch);$i++){
			$this->db->insert("erp_assignments_cbs",["aid"=>$id,"bid"=>$batch[$i],"sid"=>$subject[$i]]);
		}

        return ["message"=>"<span class='w3-text-green'>File Uploaded Successfully</span>","status"=>"ok"];
    } else {
       return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed"];
    }



	}

	function sendChat($data){
		$this->db->insert("chat",["message"=>$data["message"],"sender"=>$_SESSION['userid'],"batchid"=>0 ]);
		$id=$this->db->insert_id();
		$this->db->insert("chat_recipients",["chatid"=>$id,"userid"=>$data["receipient"]]);
		return $this->getReturnStatus(true,"Message Sent Successfully");
	}

	function saveChapter($data){
		foreach ($data["chapter"] as $chapter) {
			$this->db->insert("erp_subject_chapter",["subjectid"=>$data["subjectid"],"chapter"=>$chapter]);
		}
		
		$this->checkDBError();
		return ["status"=>true,"message"=>"Chapters Added Successfully"];
	}

}
?>