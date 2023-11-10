<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Model {

	private function getReturnStatus($status,$msg){
		if($status){$class='w3-text-green';}else{$class='w3-text-red';}
		return ["status"=>$status,"message"=>"<div class='text-center $class'><b>$msg</b></div>"];
	}

	private function checkDBError(){
		if($this->db->error()["message"]!=""){
			die(json_encode(["status"=>false,"message"=>$this->db->error()["message"]]));
		}
	}

	function updateSession($session){
		$query=$this->db->query("select id from session_active where userid=$_SESSION[userid]");
		$this->checkDBError();
		if($query->row()){
			$this->db->query("update session_active set sessionid=$session where userid=$_SESSION[userid]");
			$this->checkDBError();
			if($this->db->affected_rows()>0){
				return $this->getReturnStatus(true,"Session Changed Successfully");
			}
			else{
				return $this->getReturnStatus(false,"No Rows Updated");
			}
		}
		else{
			if($this->db->insert("session_active",["sessionid"=>$session,"userid"=>$_SESSION["userid"]])){
				return $this->getReturnStatus(true,"Session Changed Successfully");
			}
			$this->checkDBError();
		}
	}

}
?>