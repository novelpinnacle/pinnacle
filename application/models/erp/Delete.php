<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete extends CI_Model {

	private function getReturnStatus($status,$msg){
		if($status){$class='w3-text-green';}else{$class='w3-text-red';}
		return ["status"=>$status,"message"=>"<div class='text-center $class'><b>$msg</b></div>"];
	}

	private function checkDBError(){
		if($this->db->error()["message"]!=""){
			die(json_encode(["status"=>false,"message"=>"<div class='text-center w3-text-red'><b>".$this->db->error()["message"]."</b></div>"]));
		}
	}

	public function student($sid){
		$query=$this->db->query("select image from erp_students where sid='$sid'");
		$rs=$query->row();
		if($rs){
			if(file_exists($rs->image)){
				unlink($rs->image);
			}
			$this->db->where("id",$sid);
			if(!$this->db->delete("login")){
				$this->checkDBError();
			}

			if($this->db->affected_rows()>0){
				return ["status"=>true];
			}
			return  $this->getReturnStatus(false,"No Rows Affected");
		} else{
			return  $this->getReturnStatus(false,"No Student Found With SID $sid");
		}

	}

public function deleteCourseBatchSubject($id,$name,$table){
	$this->db->where("id",$id);
	$this->db->delete($table);

	$this->checkDBError();

	if( $this->db->affected_rows() > 0){
		return  $this->getReturnStatus(true,"$name Deleted Successfully");
	}
	else{
		return  $this->getReturnStatus(false,"No Rows Affected");
	}

}

public function deleteAssignedCB($id){
	$this->db->where("id",$id);
	$this->db->delete("erp_assignedcb");
	$this->checkDBError();
	if($this->db->affected_rows()>0){
		return  $this->getReturnStatus(true,"Assigned Course and Batch Removed Successfully");
	}
	return  $this->getReturnStatus(false,"No Rows Affected");
}

public function deleteAssignedSub($id){
	$this->db->where("id",$id);
	$this->db->delete("erp_assignedsubjects");
	$this->checkDBError();
	if($this->db->affected_rows()>0){
		return  $this->getReturnStatus(true,"Assigned Subjects Removed Successfully");
	}
	return  $this->getReturnStatus(false,"No Rows Affected");
}

public function teacher($tid){
	
	$query=$this->db->query("select image from erp_teachers where tid='$tid'");
	$rs=$query->row();
	if($rs){
		if(file_exists($rs->image)){
			unlink($rs->image);
		}
		$this->db->where("id",$tid);
		$this->db->delete("login");
		$this->checkDBError();

		if($this->db->affected_rows()>0)
			return ["status"=>true];
		return  $this->getReturnStatus(false,"No Rows Affected");
	}
	return  $this->getReturnStatus(false,"No Teacher Found With TID $tid");
	
}

public function user($cid){
	$query=$this->db->query("select image from erp_users where cid='$cid'");
	$rs=$query->row();
	if($rs){
		if(file_exists($rs->image)){
			unlink($rs->image);
		}
		$this->db->where("id",$cid);
		$this->db->delete("login");
		$this->checkDBError();
		if($this->db->affected_rows()>0)
			return ["status"=>true];
		return  $this->getReturnStatus(false,"No Rows Affected");
	}

	return  $this->getReturnStatus(false,"No User Found With ID $cid");
}

public function noticeBoard($nid){
	extract($_POST);
	$this->db->where("id",$nid);
	$this->db->delete("erp_noticeboard");
	$this->checkDBError();
	if($this->db->affected_rows()>0){
		return ["status"=>true,"message"=>"NoticeBoard Deleted Successfully"];
	}
	return ["status"=>false,"message"=>"No Rows Affected"];
}

public function contactQuery($id){
	$this->db->where("id",$id);
	$this->db->delete("contact_queries");
	$this->checkDBError();
	if($this->db->affected_rows()>0){
		return ["status"=>true];
	}
	return ["status"=>false,"message"=>"No Affected Rows"];
}

public function deleteVideo($id){
	$this->db->where("id",$id);
	$this->db->delete("video_lectures");
	$this->checkDBError();
	if($this->db->affected_rows()>0)
		return ["message"=>"Video Deleted Successfully","status"=>true];
	return ["message"=>"No Rows Affected","status"=>false];
}

public function deleteVideoCBS($id){
	$this->db->where("id",$id);
	$this->db->delete("video_lectures_cbs");
	$this->checkDBError();
	if($this->db->affected_rows()>0)
		return ["message"=>"Course Batch and Subject Deleted Successfully","status"=>true];
	return ["message"=>"No Rows Affected","status"=>false];
}

public function deleteNote($id){

	$query=$this->db->query("select videoid from video_lectures where id='$id'");
	$this->checkDBError();

	if(!$query){
		return ["message"=>"Video With ID $id Not Found","status"=>false];
	}

	if(file_exists($query->row()->videoid )){
		unlink($query->row()->videoid);
	}

	$this->db->where("id",$id);
	$this->db->delete("video_lectures");
	$this->checkDBError();
	if($this->db->affected_rows()>0)
		return ["message"=>"Notes Deleted Successfully","status"=>true];
	return ["message"=>"No Rows Affected","status"=>false];
}




}
?>