<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Save extends CI_Model {

	private function getReturnStatus($status,$msg){
		if($status){$class='w3-text-green';}else{$class='w3-text-red';}
		return ["status"=>$status,"message"=>"<div class='text-center $class'><b>$msg</b></div>"];
	}

	public function updateLectureStatus($id){
		$query=$this->db->query("select id,data from lectures_completed where studentid=$_SESSION[userid]");
		if(empty($query->row())){
			$this->db->insert("lectures_completed",["studentid"=>$_SESSION['userid'],"data"=>"$id"]);
		}
		else{
			$str=$query->row()->data;
			$arr=explode(",",$str);
			if(in_array($id, $arr)){
				$temp=[];
				foreach($arr as $a){
					if($a==$id)continue;
						$temp[]=$a;
				}
				$str=join($temp,",");
				$this->db->where("studentid",$_SESSION["userid"]);
				$this->db->update("lectures_completed",["data"=>$str]);	
			}
			else{
				$conc=$query->row()->data==""?"concat(data,'$id')":"concat(data,',','$id')";
				$this->db->query("update lectures_completed set data=$conc where studentid=$_SESSION[userid]");
			}
		}
		
	}
}
?>