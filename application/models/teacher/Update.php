<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Model {

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
		return ["status"=>"ok","message"=>"<div class='text-center'><br><b class='w3-text-green'>Noticeboard Updated Successfully</b></div>"];
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

	public function exam($data){
		extract($data);
		$this->db->where("id",$id);
		$this->db->update("erp_exams",["examname"=>$examname]);

		$CI =& get_instance();
		$CI->load->model("teacher/get");

		$subs=$CI->get->getSubjectsByExam($id);
		foreach ($subs as $v) {
			$this->db->where("id",$v->id);
			$this->db->update("erp_exam_subjects",["passmarks"=>$data["passmarks-$v->id"],"totalmarks"=>$data["totalmarks-$v->id"]]);
		}

		return ["status"=>"ok","message"=>"<div class='text-center'><br><b class='w3-text-green'>Exam Updated Successfully</b></div>"];

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

				for($i=0;$i<count($batch);$i++){
					$this->db->insert("erp_assignments_cbs",["aid"=>$aid,"bid"=>$batch[$i],"sid"=>$subject[$i]]);
				}

				return ["status"=>"ok","message"=>"<div class='text-center'><br><b class='w3-text-green'>Assignment Updated Successfully</b></div>"];

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

}
?>