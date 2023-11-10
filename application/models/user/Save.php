<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Save extends CI_Model {
	public $timestamp="";
	public $session;// Session Year Like 2020-2021
	public $sessionid;//id like 1 or 2
	public function __construct(){
		date_default_timezone_set("Asia/Calcutta");
		$this->timestamp=date("Y-m-d H:i:s",time());

		$this->load->helper("get_fy");
		$session=get_fy();
		$query=$this->db->query("select id from session_table where session='$session'");
		$this->sessionid=$query->row()->id;
	}

	private function getReturnStatus($status,$msg){
		if($status){$class='w3-text-green';}else{$class='w3-text-red';}
		return ["status"=>$status,"message"=>"<div class='text-center $class'><b>$msg</b></div>"];
	}

	
public function getRenamedImage($img){
    $directory=dirname($img)."/";
    $file=basename($img);
    $pos=strrpos($file,".");
    $filename= substr($file,0,$pos)."-". rand(10000,999999);
    $extension=substr($file, $pos);
    return $directory.$filename.$extension;
}

	public function saveStudent($data){
		$target_dir = "uploads/students/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		if (filter_var($data["rollno"], FILTER_VALIDATE_INT) === 0 || !filter_var($data["rollno"], FILTER_VALIDATE_INT) === false) {}
		else{
			 return ["message"=>"<div class='text-center'><br><b class='w3-text-red'>Rollno format is invalid</b></div>","status"=>"failed"];
		}

		$query=$this->db->query("select * from erp_students where rollno=$data[rollno]");
		$rs=$query->row();
		if($rs){
			 return ["message"=>"<div class='text-center'><br><b class='w3-text-red'>Rollno already Exists</b></div>","status"=>"failed"];
		}

			$date=date_create($data["dob"]);
			$password= date_format($date,"dmY");

			if($data["active"]==0){
				$msg="<div class='text-center'><b class='w3-text-green'>Registration Successfull</b><br><b>Username is $data[rollno] and Password is $password</b> <br><p><b>Note:</b> Please get your Roll No. approved from Admin.</div>";
			}
			else{
				$msg="<div class='text-center'><b class='w3-text-green'>Student Added Successfull</b><br><b>Username is $data[rollno] and Password is $password</b></div>";
			}

	   	if(!empty($_FILES["image"]["name"])){
			$check = getimagesize($_FILES["image"]["tmp_name"]);
		   
		    if($check == false) {
		        return ["message"=>"<span class='w3-text-red'>File is not an image</span>","status"=>"failed"];
		    }

		    if (file_exists($target_file)) {
		   		$target_file=$this->getRenamedImage($target_file);
			}

			if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
				$data["image"]=$target_file;
				$this->insertStudentData($data);
		        $date=date_create($data["dob"]);
				$password= date_format($date,"dmY");
				 return ["message"=>$msg,"status"=>"ok"];

		    } else {
		      	 return ["message"=>"<div class='text-center'><br><b class='w3-text-red'>Sorry, there was an error uploading your file.</b></div>","status"=>"failed"];
		    }
		}
		else{
			$data["image"]="no";
			if($this->insertStudentData($data)){
				
				 return ["message"=>$msg,"status"=>"ok"];
			}else{
				 return ["message"=>"<div class='text-center'><br><b class='w3-text-red'>DB Error</b></div>","status"=>"failed"];
			}
		}
	}


public function insertStudentData($data){
	$this->db->trans_start();
	$date=date_create($data["dob"]);
	$password= date_format($date,"dmY");
	$data["bioid"]=empty(trim($data["bioid"]))?0:$data["bioid"];
	$this->db->insert("login",["username"=>$data["rollno"],"password"=>$password,"role"=>"student","bioid"=>$data["bioid"]]);

	unset($data["bioid"]);
	
	$courseId = $data["courseId"];
	$batchId = $data["batchId"];
	$sessionId = 3;
	
	unset($data["courseId"]);
	unset($data["batchId"]);
	
	$data["studentId"]=$this->db->insert_id();
	$this->db->insert("erp_students",$data);
	$this->db->insert("erp_students_cbs",["studentId"=>$data["studentId"],"courseId"=>$courseId,"batchId"=>$batchId,"sessionId"=>$sessionId,"active"=>"1"]);
	$ok=$this->db->trans_complete();

	if(!empty($data["phone"]) && $data["active"]==0){
		$date=date_create($data["dob"]);
		$password= date_format($date,"dmY");
		$this->load->library("sms");
		$this->sms->sendSMS($data["phone"],"Thank you for registering with Pinnacle Educare.Your username is $data[rollno] And password is $password");
	}

	return $ok;
}



	public function uploadTimeTable($data){
		$from_date=$data["from_date"];
		$to_date=$data["to_date"];

		$begin = new DateTime($from_date);
		$end = new DateTime($to_date);

		$interval = DateInterval::createFromDateString('1 day');

		$period = new DatePeriod($begin, $interval, $end);

		foreach ($period as $dt) {
		    $newdate = $dt->format("Y-m-d");
		    $day = $dt->format("l");
		    if(isset($data[$day])){
		    	$day=strtolower($day);
		    	$from_time=$data[$day.'_from'];
		    	$to_time=$data[$day.'_to'];

		    	$schedule=["cid"=>$data["cid"],"bid"=>$data["bid"],"tid"=>$data["tid"],"subjectid"=>$data["subjectid"],"date"=>$newdate,"from_time"=>$from_time,"to_time"=>$to_time];
		    	$this->db->insert("erp_timetable",$schedule);
		    }
		}

		return ["message"=>"Schedule Created Successfully","status"=>"ok"];

	}

public function saveAdmissionEnquiry($data){
	if($this->db->insert("rec_admission_enquiries",$data)){
		$CI=&get_instance();
		$CI->load->model("user/get");
		$records=$CI->get->getAdmissionEnquiries();
		$lt=$records[0];
		$v=$lt;
		$status=[1=>"Active",2=>"Joined",3=>"Not Joined"];
		$last="<tr><td>$v->name</td><td>$v->phone</td><td>$v->source</td><td>$v->edate</td><td>".$status[$v->status]."</td><td><button class='action' onclick='fullInfo($v->id)'><i class='fa fa-eye'></i></button><button class='action' onclick='followUp($v->id)'><i class='fa fa-phone'></i></button><button class='action' onclick='editEnquiry($v->id)'><i class='fa fa-pencil'></i></button>
				<button class='action' onclick='deleteAdmissionEnquiry($v->id,this.parentElement.parentElement)'><i class='fa fa-remove'></i></button></td></tr>";
		return ["message"=>"Admission Enquiry Saved Successfully","status"=>true,"type"=>"save","last"=>$last,"id"=>$v->id,"lastdata"=>base64_encode(json_encode($v))];
	}
}

public function saveFollowUp($data){
	if($this->db->insert("rec_admission_enquiries_dates",["aeid"=>$data["aeid"],"response"=>$data["response"],"nextdate"=>$data["nextdate"],"followdate"=>$data["followdate"] ])){

		$CI=&get_instance();
		$CI->load->model("user/get");
		$records=$CI->get->getAdmissionEnquiries($data["aeid"]);
		$lt=$records[0];
		$v=$lt;

		return ["message"=>"Follow Up Saved Successfully","status"=>true,"id"=>$v->id,"lastdata"=>base64_encode(json_encode($v))];
	}
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

	return ["status"=>"ok","message"=>"<div class='text-center'><b class='w3-text-green'>Noticeboard Created Successfully</b></div>"];
}

public function saveExam($data){
	$data["createdby"]=$_SESSION["userid"];
	$data["session"]=$this->sessionid;
	$this->db->insert("erp_exams",$data);
	return ["status"=>"ok","message"=>"<div class='text-center'><b class='w3-text-green'>Exam Created Successfully</b></div>"];

}
public function saveExamSubjects($data){
	extract($data);

		$this->db->where(["eid"=>$eid]);
		$qu=$this->db->get("erp_exam_marks");
		if($qu->row()){
			return ["status"=>"fail","message"=>"<div class='text-center'><b class='w3-text-red'>Exam is Published</b></div>"];
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
	return ["status"=>"ok","message"=>"<div class='text-center'><b class='w3-text-green'>Subjects Added Successfully</b></div>"];

}


public function saveMarks($data){
	extract($data);

		$this->db->where(["eid"=>$eid]);
		$qu=$this->db->get("erp_exam_marks");
		if($qu->row()){
			return ["status"=>"fail","message"=>"<div class='text-center'><b class='w3-text-red'>Marks Already Uploaded</b></div>"];
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
		return ["status"=>"ok","message"=>"<div class='text-center'><b class='w3-text-green'>Marks Uploaded Successfully</b></div>"];

}
	/*Related to get xlsx rows*/
	public function getArr($subject){
		$file=$_FILES["xlsx"]["tmp_name"];

		if ( $xlsx = SimpleXLSX::parse($file) ) {
			$row=$xlsx->rows(0);			
			
			$subject_position=0;
			for($i=0;$i<count($row[0]);$i++){
				if( strtolower($row[0][$i])==strtolower($subject)){
					$subject_position=$i;
					break;
				}
			}
			$temp=[];
			foreach ($row as $key=>$v) {
				if($key==0){continue;}
				$temp[]=$v[$subject_position];		
			}

			return $temp;

		} else {
			echo SimpleXLSX::parseError();
		}
	}

	public function getMarks($subject,$subjects){
		$file=$_FILES["xlsx"]["tmp_name"];
		if ( $xlsx = SimpleXLSX::parse($file) ) {
			$row=$xlsx->rows(0);			
			
			foreach ($subjects as $sub) {
				//change it to for loop using $i = 0 etc
				foreach($row[0] as $key=>$v){
					if($row[0][$key]==$sub){
						$row[1][$key]=$sub."-".$row[1][$key];
						$row[1][$key+1]=$sub."-".$row[1][$key+1];
						$row[1][$key+2]=$sub."-".$row[1][$key+2];
					}			
				}
			}


			$subject_position=0;
			for($i=0;$i<count($row[1]);$i++){
				if( strtolower($row[1][$i])==strtolower($subject)){
					$subject_position=$i;
					break;
				}
			}

			$temp=[];
			foreach ($row as $key=>$v) {
				if($key==0 || $key==1){continue;}
				$temp[]=$v[$subject_position];		
			}

			return $temp;

		} else {
			echo SimpleXLSX::parseError();
		}
	}

	public function lowercolumns($col){
		return strtolower($col);
	}

	public function checkColumnExists($column){
		 $file=$_FILES["xlsx"]["tmp_name"];
		 $xlsx = SimpleXLSX::parse($file) ;
		 $row=$xlsx->rows(0);
		 $row[0]=array_map([$this,"lowercolumns"],$row[0]);
		 return in_array(strtolower($column), $row[0]);
	}
	
	public function checkObjectiveColumnExists($column){
		 $file=$_FILES["xlsx"]["tmp_name"];
		 $xlsx = SimpleXLSX::parse($file) ;
		 $row=$xlsx->rows(0);
		 $row[1]=array_map([$this,"lowercolumns"],$row[1]);
		 return in_array(strtolower($column), $row[1]);
	}


	public function uploadXLSX($data){
		$examid=$data["eid"];

		$CI=&get_instance();
		$CI->load->model("user/get");
		$examinfo=$CI->get->getExamById($examid);

		include_once 'SimpleXLSX.php';
		$xlsx=SimpleXLSX::parse($_FILES["xlsx"]["tmp_name"]);
		if(!$xlsx){
			return ["message"=>"File Format is Invalid","status"=>false];
		}

		$subjects=$this->getSubjectsByEXAM_CB($examid);

		if($examinfo->category==2){

			foreach ($subjects as $sub) {
				if(!$this->checkColumnExists($sub)){
					return ["message"=>"Subject $sub Not Provided","status"=>false];
				}
			}

			if(!$this->checkColumnExists("attendance")){
				return ["message"=>"Attendance Not Provided.","status"=>false];
			}

			if(!$this->checkColumnExists("roll no")){
				return ["message"=>"Roll No Not Provided","status"=>false];
			}
		}
		else{

			foreach ($subjects as $sub) {
				if(!$this->checkColumnExists($sub)){
					return ["message"=>"Subject $sub Not Provided","status"=>false];
				}
			}

			if(!$this->checkObjectiveColumnExists("Attendance")){
				return ["message"=>"Attendance Not Provided.","status"=>false];
			}

			if(!$this->checkObjectiveColumnExists("roll no")){
				return ["message"=>"Roll No Not Provided","status"=>false];
			}
		}
		
		if($examinfo->category==2){
		
			$marks=[];
			foreach ($subjects as $v) {
				$marks[strtolower($v)]=$this->getArr($v);
			}

		}
		else{
			$marks=[];
			foreach ($subjects as $v) {
				$marks[strtolower($v)."-Marks"]=$this->getMarks(strtolower($v)."-Marks",$subjects);
				$marks[strtolower($v)."-Correct"]=$this->getMarks(strtolower($v)."-Correct",$subjects);
				$marks[strtolower($v)."-Wrong"]=$this->getMarks(strtolower($v)."-Wrong",$subjects);
			}
		}

		if($examinfo->category==2){
			$rolls=$this->getArr("roll no");
			$attendance=$this->getArr("attendance");
		}
		else{
			$rolls=$this->getMarks("roll no",$subjects);
			$attendance=$this->getMarks("attendance",$subjects);
		}

		$rolls_sids=$this->getStudentIdsByRollNos($rolls);


		$subject_ids=$this->getSubjectIDByName($subjects,$examid);


		$at=0;
		foreach ($attendance as $a) {
			if(!in_array($a, [0,1])){
				return ["message"=>"Invalid Attendance '$a' is Provided at Row ".($at+2).". It must be eighter 0 or 1","status"=>false];
			}
			$at++;
		}

		foreach ($marks as $key => $v) {
			$i=0;
			foreach($v as $mark){
				if(!is_numeric($mark) || $mark<0){
					return ["message"=>"Marks '$mark' at Row ".($i+2)." is not valid","status"=>false];
				}
				$i++;
			}		
		}

		

		$rollsall=$this->getStudentRollNos($examinfo->cid,$examinfo->bid);
		
		$diff1=array_diff($rollsall, $rolls);
		if(count($diff1)>0){
			$notrolls="";
			foreach ($diff1 as $d1) {
				$notrolls.=$d1.",";
			}
			$notrolls=rtrim($notrolls,",");

			return ["message"=>"Students with Roll Nos $notrolls Not Provided","status"=>false];
		}

		$diff2=array_diff( $rolls,$rollsall);
		if(count($diff2)>0){
			$morerolls="";
			foreach ($diff2 as $d2) {
				$morerolls.=$d2.",";
			}
			$morerolls=rtrim($morerolls,",");

			return ["message"=>"Unwanted Students with Roll Nos $morerolls Provided","status"=>false];
		}


		if($examinfo->category==2){
			foreach ($marks as $key => $v) {
				$subid=$subject_ids[$key];
				$i=0;
				foreach($v as $mark){
					$studentid=$rolls_sids[$rolls[$i]];
					//echo $examid." ".$subid." ".$studentid." $mark<br>";
					$this->insertMarksOneByOne(["eid"=>$examid,"subjectid"=>$subid,"studentid"=>$studentid,"marks"=>$mark,"attendance"=>$attendance[$i] ]);
					$i++;
				}		
			}
		}
		else{

			foreach ($marks as $key => $v) {
				if(explode("-", $key)[1]!="Marks"){
					continue;
				}
				$subid=$subject_ids[strtolower(explode("-", $key)[0])];
				$i=0;
				foreach ($v as $mark) {
					$studentid=$rolls_sids[$rolls[$i]];
					//echo $marks[strtolower(explode("-", $key)[0]) ."-Marks"][$i]."<br>";
					$m=$marks[strtolower(explode("-", $key)[0]) ."-Marks"][$i];
					$c=$marks[strtolower(explode("-", $key)[0]) ."-Correct"][$i];
					$w=$marks[strtolower(explode("-", $key)[0]) ."-Wrong"][$i];

					$this->insertMarksOneByOne(["eid"=>$examid,"subjectid"=>$subid,"studentid"=>$studentid,"marks"=>$m,"correct"=>$c,"wrong"=>$w,"attendance"=>$attendance[$i] ]);
					$i++;
				}
			}

		}

		return ["message"=>"Marks Uploaded Successfully","status"=>true];

	}

	public function insertMarksOneByOne($data){
		$this->db->insert("erp_exam_marks",$data);
	}
	public function getStudentRollNos($cid,$bid){
		$query=$this->db->query("select rollno from erp_students where course=$cid and batch=$bid");
		$roll=[];
		foreach ($query->result() as $v) {
			$roll[]=$v->rollno;
		}
		return $roll;
	}

	public function getSubjectsByEXAM_CB($examid){
		$query=$this->db->query("SELECT DISTINCT es.subject from erp_subjects es inner join erp_exams ex on es.cid=ex.cid and es.bid=ex.bid where ex.id=$examid");
		$temp=[];
		foreach ($query->result() as $v) {
			$temp[]=$v->subject;
		}
		return $temp;
	}

	public function getStudentIdsByRollNos($rollnos){
		$rollno="";
		foreach ($rollnos as  $v) {
			$rollno.="$v,";
		}
		$rollno=rtrim($rollno,',');
		$query=$this->db->query("select sid,rollno from erp_students where rollno in($rollno)");
		$roll_sid=[];
		foreach ($query->result() as $v) {
			$roll_sid[$v->rollno]=$v->sid;
		}
		return $roll_sid;
	}

	public function getSubjectIDByName($subjects,$examid){
		$subject="";
		foreach ($subjects as $v) {
			$subject.="'$v',";
		}
		$subject=rtrim($subject,",");
		$query=$this->db->query("select es.id,es.subject from erp_subjects es inner join erp_exams ex on es.cid=ex.cid and es.bid=ex.bid where ex.id=$examid and es.subject in($subject)");
		$subject_ids=[];
		foreach ($query->result() as $v) {
			$subject_ids[strtolower($v->subject)]=$v->id;
		}
		return $subject_ids;
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

		for($i=0;$i<count($course);$i++){
			$this->db->insert("erp_assignments_cbs",["aid"=>$id,"bid"=>$batch[$i],"sid"=>$subject[$i]]);
		}

        return ["message"=>"<span class='w3-text-green'>File Uploaded Successfully</span>","status"=>"ok"];
    } else {
       return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed"];
    }



	}

	public function sendExamReport($data){
		$this->load->library("ranks");
		$this->load->library("sendemail");
		$this->load->library("sms");
		$data["text"]=urldecode($data["text"]);
		$query=$this->db->query("select st.name,st.email,st.sid,st.fmobile,ex.id, ex.examname,sum(DISTINCT exm.marks) as marks,exm.studentid,exm.subjectid,est.fmobile,sum(DISTINCT exs.totalmarks) as totalmarks,date_format(ex.examdate,'%e-%b-%Y') as examdate,ex.examdate as wformatdate from erp_exam_marks exm inner join erp_exam_subjects exs on exs.eid=exm.eid inner join erp_students est on est.sid=exm.studentid inner join erp_exams ex on ex.id=exm.eid inner join erp_students st on st.sid=exm.studentid where exm.eid=$data[eid] group by exm.studentid");
		$rs=$query->result();

		$marks=$this->getMarksByExam($data["eid"]);
		$CI=&get_instance();
		$CI->load->model("user/get");
		$subjects=$CI->get->getSubjectsListByExamId($data["eid"]);
		foreach ($rs as $v) {
			$message=$data["text"];
			$message=str_replace("<name>", $v->name, $message);
			$message=str_replace("<exam-name>", $v->examname, $message);	
			$message=str_replace("<exam-date>", $v->examdate, $message);	
			$message=str_replace("<exam-marks>", $v->marks, $message);
			$message=str_replace("<exam-rank>", $this->ranks->getOverAllRank($data["eid"],$v->marks), $message);
			$message=str_replace("<exam-total>", $v->totalmarks, $message);
			
			foreach ($subjects as $sub) {
				$message=str_replace("<$sub-marks>", $marks[$v->sid][$sub]["marks"] , $message);
				$message=str_replace("<$sub-correct>", $marks[$v->sid][$sub]["correct"] , $message);
				$message=str_replace("<$sub-wrong>", $marks[$v->sid][$sub]["wrong"] , $message);
				$message=str_replace("<$sub-total>", $marks[$v->sid][$sub]["total"] , $message);
				$message=str_replace("<$sub-percentage>", $marks[$v->sid][$sub]["percentage"] , $message);
				$message=str_replace("<$sub-rank>",$marks[$v->sid][$sub]["rank"], $message);
			}

			if($data["medium"]=="sms" || $data["medium"]=="both"){
				$response=$this->sms->sendSMS($v->fmobile,$message);
				$api_status="";
				if(strpos($response,"SMS-SHOOT-ID")!==FALSE){
					$api_status=explode("/", $response)[1];
				}
				else{
					$api_status=$response;
				}
				$this->db->insert("sms_report",["msg"=>$message,"number"=>$v->fmobile,"sid"=>$v->sid,"api_status"=>$api_status,"eid"=>$data["eid"],"timestamp"=>$this->timestamp,"examdate"=>$v->wformatdate,"session"=>$this->sessionid]);
			}
			if($data["medium"]=="email" || $data["medium"]=="both"){
				$this->sendemail->sendEmail($v->email,"Exam Report",$message);
			}

			$status=["sms"=>1,"email"=>2,"both"=>3];
			$this->db->where("id",$data["eid"]);
			$this->db->update("erp_exams",["sms_status"=>$status[$data["medium"]]]);

		}
		return ["message"=>"Report Sent Successfully","status"=>true];

	}

	public function saveTemplate($data){
		if($this->db->insert("report_template",$data)){
			return ["message"=>"Template Saved Successfully","status"=>true];
		}
	}


	public function getMarksByExam($eid){
		$this->load->library("ranks");
		$query=$this->db->query("SELECT exm.studentid,exm.subjectid,esub.subject,exm.marks,exm.studentid ,exm.correct,exm.wrong,exs.totalmarks from erp_exam_marks exm inner join erp_exam_subjects exs on exs.sid =exm.subjectid and exs.eid=exm.eid inner join erp_subjects esub on esub.id=exm.subjectid where exm.eid=$eid");
		$rs = $query->result();
		$data=[];
		foreach ($rs as $v) {
			$percentage=ceil(($v->marks/$v->totalmarks)*100);
			$rank=$this->ranks->getRank($eid,$v->subjectid,$v->marks);
			$data[$v->studentid][strtolower($v->subject)]=["marks"=>$v->marks,"percentage"=>$percentage,"correct"=>$v->correct,"wrong"=>$v->wrong,"total"=>$v->totalmarks,"rank"=>$rank];
		}
		return $data;
	}

	function saveChapter($data){
		
		foreach ($data["chapter"] as $chapter) {
			$this->db->insert("erp_subject_chapter",["subjectid"=>$data["subjectid"],"chapter"=>$chapter]);
		}

		return ["status"=>true,"message"=>"Chapters Added Successfully"];
	}

	function saveHomework($data){
		
	$bsc_count=$data["bsc_count"];
	
	for($b=0;$b<$bsc_count;$b++){
		$bsc_data=array();
		parse_str($data["bscdata_$b"],$bsc_data);
		

		$this->db->insert("erp_homework",["batchid"=>$bsc_data["batchid"],"subjectid"=>$bsc_data["subjectid"] ,"chapterid"=>$bsc_data["chapterid"],"datetime"=>$this->timestamp ,"uploadby"=>$_SESSION["userid"],"session"=>$this->sessionid]);
		$homeworkid=$this->db->insert_id();

		$count=$data["count"];
		for($i=0;$i<$count;$i++){
			$records=array();
			parse_str($data["data_$i"],$records);
		
			for($j=0;$j<count($records["exercise"]);$j++){

				$this->db->insert("erp_homework_lectures",["homeworkid"=>$homeworkid,"lectureno"=>$records["lectureno"],"exercise"=>$records["exercise"][$j],"questions"=>$records["questions"][$j] ]);
			}
		}
	}	
	return ["status"=>true,"message"=>"Homework Uploaded Successfully"];


}

}
?>