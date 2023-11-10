<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Model {

public function getRenamedImage($img){
    $directory=dirname($img)."/";
    $file=basename($img);
    $pos=strrpos($file,".");
    $filename= substr($file,0,$pos)."-". rand(10000,999999);
    $extension=substr($file, $pos);
    return $directory.$filename.$extension;
}

	public function updateAdmissionEnquiry($data){
		$this->db->where("id",$data["id"]);
		$id=$data["id"];
		unset($data["id"]);
		if($this->db->update("rec_admission_enquiries",$data)){

			$CI=&get_instance();
			$CI->load->model("user/get");
			$records=$CI->get->getAdmissionEnquiries($id);
			$lt=$records[0];
			$v=$lt;

			return ["message"=>"Admission Enquiry Updated Successfully","status"=>true,"id"=>$v->id,"lastdata"=>base64_encode(json_encode($v))];
		}
	}

	public function updateStudentAttendance($data){
		foreach ($data as $key => $value) {
			if($key=="newentry" || $key=="userid"){continue;}

			if(empty(trim($value))){
				$this->db->where("id",explode("_", $key)[1]);
				$this->db->delete("erp_attendance");
				continue;
			}

			$this->db->where("id",explode("_", $key)[1]);
			$this->db->update("erp_attendance",["datetime"=>$value]);
		}
		if(date_create_from_format("Y-m-d H:i:s",$_POST["newentry"])!=false){
			$this->db->insert("erp_attendance",["userid"=>$data["userid"],"datetime"=>$data["newentry"	] ]);
		}

		return ["message"=>"Attendance Updated Successfully"];

	}

	public function student($data){
		extract($data);
		$target_dir = "uploads/students/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
	   	
	   	if(!empty($_FILES["image"]["name"])){

			$check = getimagesize($_FILES["image"]["tmp_name"]);
		    if($check == false) {
		        return ["message"=>"<span class='w3-text-red'>File is not an image</span>","status"=>"failed","newimg"=>""];
		    }

		    if (file_exists($target_file)) {
		    	$target_file=$this->getRenamedImage($target_file);
			}

			if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
				
				 $CI =& get_instance();
				 $CI->load->model("admin/erp/get");
				 $old=$this->get->getStudentById($sid);
				 $oldfile=$old->image;
				 if(file_exists($oldfile)){unlink($oldfile);}
				 $data["image"]=$target_file;
				 return $this->updateStudentData($data);

		    } else {
		       return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed","newimg"=>""];
		    }


		}else{
			return $this->updateStudentData($data);
		}
	}

	public function updateStudentData($data){
		
		$data["bioid"]=empty(trim($data["bioid"]))?0:$data["bioid"];
		if(!empty($data["bioid"])){
			$this->db->where("id",$data["sid"]);
			$this->db->update("login",["bioid"=>$data["bioid"]]);
		}

		$date=date_create($data["dob"]);
		$password= date_format($date,"dmY");

		$this->db->where("id",$data["sid"]);
		$this->db->update("login",["password"=>$password,"username"=>$data["rollno"]]);

		$this->db->where("sid",$data["sid"]);
		unset($data["sid"]);
		unset($data["bioid"]);
		$this->db->update("erp_students",$data);
		$newimg="";
		if(isset($data["image"])){$newimg=$data["image"];}
		return ["message"=>"<div class='text-center'><b class='w3-text-green'>Student Updated Successfully</b></div>","status"=>"ok","newimg"=>$newimg];
	}

	public function updateNoticeboard($data){
	extract($data);
	
	$this->db->where("id",$nid);
	$this->db->update("erp_noticeboard",["content"=>$content]);		

	if(isset($updatecb)){

		$arr[]="";
		for($i=0;$i<count($cid);$i++) {
			if(in_array($cid[$i].$bid[$i], $arr)){continue;}
			$this->db->insert("erp_noticeboard_cb",["nid"=>$nid,"cid"=>$cid[$i],"bid"=>$bid[$i]]);
			$arr[]=$cid[$i].$bid[$i];
		}
			
	}
	

	return ["status"=>"ok","message"=>"<div class='text-center'><b class='w3-text-green'>Noticeboard Updated Successfully</b></div>"];
}

public function exam($data){
extract($data);
$this->db->where("id",$id);
$this->db->update("erp_exams",["examname"=>$examname,"examdate"=>$examdate]);

$CI =& get_instance();
$CI->load->model("coordinator/get");

$subs=$CI->get->getSubjectsByExam($id);
foreach ($subs as $v) {
	$this->db->where("id",$v->id);
	$this->db->update("erp_exam_subjects",["passmarks"=>$data["passmarks-$v->id"],"totalmarks"=>$data["totalmarks-$v->id"]]);
}

return ["status"=>"ok","message"=>"<div class='text-center'><b class='w3-text-green'>Exam Updated Successfully</b></div>"];

}
public function updateMarks($data){
extract($data);
$this->db->where(["id"=>$mid]);
$this->db->update("erp_exam_marks",[$col=>$val]);
}

public function updateAssignment($data){
extract($data);


	if(!empty($_FILES["assignment"]["name"])){

		$target_dir = "uploads/assignments/";
		$target_file = $target_dir . basename($_FILES["assignment"]["name"]);
		$basename = pathinfo($target_file, PATHINFO_BASENAME);
		$ext =".".pathinfo($target_file, PATHINFO_EXTENSION);
		$onlyname=basename($basename,$ext);
		$target_file=$target_dir.$onlyname.rand(10000,99999).$ext;
		$query=$this->db->query("select path from erp_assignments where id=$aid");
		$rs=$query->row();
		if($rs){
			$path=$rs->path;
			if(file_exists($path)){
				unlink($path);
			}
		}

		if (move_uploaded_file($_FILES["assignment"]["tmp_name"], $target_file)) {	
			$this->db->where("id",$aid);
			$this->db->update("erp_assignments",["path"=>$target_file]);
		}

	}

		$this->db->where("id",$aid);
		$this->db->update("erp_assignments",["title"=>$title]);

		for($i=0;$i<count($course);$i++){
			$this->db->insert("erp_assignments_cbs",["aid"=>$aid,"bid"=>$batch[$i],"sid"=>$subject[$i]]);
		}

		return ["status"=>"ok","message"=>"<div class='text-center'><b class='w3-text-green'>Assignment Updated Successfully</b></div>"];

}

	public function updateTemplate($data){
		$this->db->where("id",$data["id"]);
		if($this->db->update("report_template",["template"=>$data["template"],"name"=>$data["name"]])){
			return ["message"=>"Template Updated Successfully","status"=>true];
		}
	}

	public function updateHomework($data){
		extract($data);
		
		$this->db->where("id",$homeworkid);
		unset($data["homeworkid"]);
		$this->db->update("erp_homework",$data);		

		return ["status"=>"ok","message"=>"<div class='text-center'><br><b class='w3-text-green'>Homework Updated Successfully</b></div>"];
	}
	
	function updateHomeworkEntry($data){
		extract($data);
		$this->db->where("id",$id);
		$this->db->update("erp_homework_lectures",[$column=>$data]);
	}

	function addMoreInHomework($data){
		$count=$data["count"];
		for($i=0;$i<$count;$i++){
			$records=array();
			parse_str($data["data_$i"],$records);
			for($j=0;$j<count($records["exercise"]);$j++){
				$this->db->insert("erp_homework_lectures",["homeworkid"=>$data["homeworkid"],"lectureno"=>$records["lectureno"],"exercise"=>$records["exercise"][$j],"questions"=>$records["questions"][$j]]);
			}
		}
		return ["status"=>true,"message"=>"Homework Updated Successfully"];
	}



}
?>