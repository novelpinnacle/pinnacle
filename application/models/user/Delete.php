<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete extends CI_Model {

	public function student($sid){
		$query=$this->db->query("select * from erp_students where sid='$sid'");
		$rs=$query->row();
		if($rs){
			if(file_exists($rs->image)){
				unlink($rs->image);
			}
			
			$this->db->where("sid",$sid);
			$this->db->delete("erp_students");
			
		}
	}

	public function timetable($id){
		$query=$this->db->query("select path from erp_timetable where id=$id");
		$rs=$query->row();
		if($rs){
			$path=$rs->path;
			if(file_exists($path)){
				unlink($path);
			}
			$this->db->where("id",$id);
			$this->db->delete("erp_timetable");
		}
	}
		public function assignment($id){
		$query=$this->db->query("select path from erp_assignments where id=$id");
		$rs=$query->row();
		if($rs){
			$path=$rs->path;
			if(file_exists($path)){
				unlink($path);
			}
			$this->db->where("id",$id);
			$this->db->delete("erp_assignments");
		}
	}

	public function deleteAdmissionEnquiry($id){
		$this->db->where("id",$id);
		$this->db->delete("rec_admission_enquiries");
		
		if($this->db->affected_rows()>0){
			return ["status"=>true,"message"=>"Admission Enquiry Deleted Successfully"];
		}
		else{
			return ["status"=>false,"message"=>"Could Not Delete Admission Enquiry"];
		}
	}

	function deleteChapter($id){
		$this->db->where("id",$id);
		$this->db->delete("erp_subject_chapter");
		if($this->db->affected_rows()>0){
			return ["status"=>true];
		}
		else{
			return ["status"=>false];
		}	
	}

	function deleteHomeWorkEntry($id){
		$this->db->where("id",$id);
		$this->db->delete("erp_homework_lectures");
		if($this->db->affected_rows()>0){
			return ["status"=>true];
		}
		else{
			return ["status"=>false];
		}
	}
	function deleteHomeWork($id){
		$this->db->where("id",$id);
		$this->db->delete("erp_homework");
		if($this->db->affected_rows()>0){
			return ["status"=>true];
		}
		else{
			return ["status"=>false];
		}
	}

}
?>