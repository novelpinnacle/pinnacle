<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Savecommon extends CI_Model {
	public $timestamp="";
	public function __construct(){
		date_default_timezone_set("Asia/Calcutta");
		$this->timestamp=date("Y-m-d H:i:s",time());
	}

	private function getReturnStatus($status,$msg){
		if($status){$class='w3-text-green';}else{$class='w3-text-red';}
		return ["status"=>$status,"message"=>"<div class='text-center $class'><b>$msg</b></div>"];
	}

	private function checkDBError(){
		if($this->db->error()["message"]!=""){
			die(json_encode(["status"=>false,"message"=>"<div class='text-center w3-text-red'><b>".$this->db->error()["message"]."</b></div>"]));
		}
	}

	function submitSendSMS($data){
		$this->load->library("sms");
		$phone="phone";

		if($data["to"]=="student"){
			$phone="phone";
		}
		if($data["to"]=="parent"){
			$phone="fmobile";
		}
		if($data["to"]=="both"){
			$phone="concat(phone,',',fmobile) as phone";
		}

		$query=$this->db->query("select $phone from erp_students where sid=$data[receipient] union select phone from erp_teachers where tid=$data[receipient] union select phone from erp_users where cid=$data[receipient] ");
		$mobile=$query->row()->phone;

		$response=$this->sms->sendSMS($mobile,$data["message"]);

		$api_status="";
		if(strpos($response,"SMS-SHOOT-ID")!==FALSE){
			$api_status=explode("/", $response)[0];
		}
		else{
			$api_status=$response;
		}

		if($api_status=="SMS-SHOOT-ID"){
			$this->db->insert("text_messages",["datetime"=>$this->timestamp,"message"=>$data["message"],"sender"=>$_SESSION["userid"],"batchid"=>"0"]);
			$id=$this->db->insert_id();
			$this->db->insert("text_messages_recipients",["tmid"=>$id,"userid"=>$data["receipient"],"sms_status"=>$api_status]);
			return $this->getReturnStatus(true,"SMS Sent Successfully".$response);
		}
	}

	function sendGroupSMS($data){
		$this->load->library("sms");
		$phone="phone";

		if($data["to"]=="student"){
			$phone="phone";
		}
		elseif($data["to"]=="parent"){
			$phone="fmobile";
		}
		elseif($data["to"]=="both"){
			$phone="concat(phone,',',fmobile) as phone";
		}
		$this->db->insert("text_messages",["datetime"=>$this->timestamp,"message"=>$data["message"],"sender"=>$_SESSION["userid"],"batchid"=>$data["receipient"]]);
		$id=$this->db->insert_id();	

		$query=$this->db->query("select $phone ,sid from erp_students where batch=$data[receipient]");

		foreach ($query->result() as $v) {
			$response=$this->sms->sendSMS($v->phone,$data["message"]);

			$api_status="";
			if(strpos($response,"SMS-SHOOT-ID")!==FALSE){
				$api_status=explode("/", $response)[0];
			}
			else{
				$api_status=$response;
			}

			if($api_status=="SMS-SHOOT-ID"){
				$this->db->insert("text_messages_recipients",["tmid"=>$id,"userid"=>$v->sid,"sms_status"=>$api_status]);
			}
		}		
		return $this->getReturnStatus(true,"SMS Sent Successfully");
			
	}

	function sendChat($data){
		$this->db->insert("chat",["datetime"=>$this->timestamp,"message"=>$data["message"],"sender"=>$_SESSION['userid'],"batchid"=>0 ]);
		$id=$this->db->insert_id();
		$this->db->insert("chat_recipients",["chatid"=>$id,"userid"=>$data["receipient"]]);
		return $this->getReturnStatus(true,"Message Sent Successfully");
	}

	function sendGroupChat($data){
		$this->db->insert("chat",["datetime"=>$this->timestamp,"message"=>$data["message"],"sender"=>$_SESSION['userid'],"batchid"=>$data["receipient"]]);
		$id=$this->db->insert_id();
		

		$query=$this->db->query("select sid from erp_students where batch=$data[receipient]");
		foreach ($query->result() as $v) {
			$this->db->insert("chat_recipients",["chatid"=>$id,"userid"=>$v->sid]);		
		}
		return $this->getReturnStatus(true,"Message Sent Successfully");

	}

}
?>