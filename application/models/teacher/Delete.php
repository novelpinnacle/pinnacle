<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete extends CI_Model {
	
	private function checkDBError(){
		if($this->db->error()["message"]!=""){
			die(json_encode(["status"=>false,"message"=>"<div class='text-center w3-text-red'><b>".$this->db->error()["message"]."</b></div>"]));
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
}
?>