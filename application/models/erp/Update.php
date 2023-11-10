<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Model {

	public function __construct(){
		if(isset($_FILES["image"]["name"])){
			$filename=str_replace("'", "", $_FILES["image"]["name"]);
			$filename=str_replace('"', "", $filename);
			$_FILES["image"]["name"]=$filename;
		}
	}

	private function getReturnStatus($status,$msg){
		if($status){$class='w3-text-green';}else{$class='w3-text-red';}
		return ["status"=>$status,"message"=>"<div class='text-center $class'><b>$msg</b></div>"];
	}

	private function checkDBError(){
		if($this->db->error()["message"]!=""){
			die(json_encode(["status"=>false,"message"=>$this->db->error()["message"]]));
		}
	}

	public function updateStudentStatus($sid,$status){
		$this->db->where("sid",$sid);
		$this->db->update("erp_students",["active"=>$status]);
		$this->checkDBError();
		if($this->db->affected_rows()>0){
			return $this->getReturnStatus(true,"Student Status Updated Successfully");
		}
		return$this->getReturnStatus(false,"No Rows Affected");
	}

	public function sortVideoNotes($arr){
		$arr=explode(",", $arr);
		$affected=0;
		$i=0;
		foreach ($arr as $v) {
			$id=explode("-",$v)[0];
			$orderno=explode("-", $v)[1];
			$this->db->where("id",$id);
			$this->db->update("video_lectures_cbs",["orderno"=>$orderno]);
			$affected+=$this->db->affected_rows();
			$this->checkDBError();
			$i++;
		}
		if($affected>0)
			return $this->getReturnStatus(true,"Sorted Successfully");
		return $this->getReturnStatus(false,"No Rows Affected");
	}

	public function getRenamedImage($img){
	    $directory=dirname($img)."/";
	    $file=basename($img);
	    $pos=strrpos($file,".");
	    $filename= substr($file,0,$pos)."-". rand(10000,999999);
	    $extension=substr($file, $pos);
	    return $directory.$filename.$extension;
	}

	public function permission($per_name,$user_id){

		$this->db->query("update permissions set status=IF(status=1,0,1) where user_id='$user_id' and per_name='$per_name'");
		$this->checkDBError();
	}

	public function updateCourse($data){
		extract($data);
		unset($data["cid"]);
		$this->db->where("id",$cid);
		$this->db->update("erp_courses",$data);

		$this->checkDBError();

		if( $this->db->affected_rows() > 0){
			return $this->getReturnStatus(true,"Course Updated Successfully");
		}
		else{
			return$this->getReturnStatus(false,"No Rows Affected");
		}
	}

	public function updateBatch($data){
		extract($data);
		unset($data["cid"]);
		$this->db->where("id",$cid);
		$this->db->update("erp_batches",$data);

		$this->checkDBError();

		if( $this->db->affected_rows() > 0){
			return $this->getReturnStatus(true,"Batch Updated Successfully");
		}
		else{
			return $this->getReturnStatus(false,"No Rows Affected");
		}
	}

	public function updateSubject($data){
		extract($data);
		unset($data["cid"]);
		$this->db->where("id",$cid);
		$this->db->update("erp_subjects",$data);

		$this->checkDBError();

		if( $this->db->affected_rows() > 0){
			return $this->getReturnStatus(true,"Subject Updated Successfully");
		}
		else{
			return $this->getReturnStatus(false,"No Rows Affected");
		}
	}


public function student($data){
	extract($data);
	$target_dir = "uploads/students/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);
   	
   	if(!empty($_FILES["image"]["name"])){

		$check = getimagesize($_FILES["image"]["tmp_name"]);
	    if($check == false) {
	        return $this->getReturnStatus(false,"File is not an image");
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
	       return $this->getReturnStatus(false,"Sorry, there was an error uploading your file");
	    }


	}else{
		return $this->updateStudentData($data);
	}
}
	public function updateStudentData($data){
		$affected=0;
		$data["bioid"]=empty(trim($data["bioid"]))?0:$data["bioid"];
		if(!empty($data["bioid"])){
			$this->db->where("id",$data["sid"]);
			$this->db->update("login",["bioid"=>$data["bioid"],"username"=>$data["rollno"] ]);
			$this->checkDBError();
			$affected+=$this->db->affected_rows();
		}

		$date=date_create($data["dob"]);
		$password= date_format($date,"dmY");

		$this->db->trans_start();

		$this->db->where("id",$data["sid"]);
		$this->db->update("login",["password"=>$password,"username"=>$data["rollno"]]);
		$this->checkDBError();
		$affected+=$this->db->affected_rows();

		$this->db->where("sid",$data["sid"]);
		unset($data["sid"]);
		unset($data["bioid"]);
		$this->db->update("erp_students",$data);
		$this->checkDBError();
		$affected+=$this->db->affected_rows();

		if($this->db->trans_complete()){
			if($affected>0){
				return $this->getReturnStatus(true,"Student Updated Successfully");
			}
			return $this->getReturnStatus(false,"No rows affected");
		}
		return $this->getReturnStatus(false,"Error occured while updating data");
	}


	public function teacher($data){
	extract($data);
	$target_dir = "uploads/teachers/";

	$target_file = $target_dir . basename($_FILES["image"]["name"]);
   	
   	if(!empty($_FILES["image"]["name"])){

		$check = getimagesize($_FILES["image"]["tmp_name"]);
	    if($check == false) {
	        return$this->getReturnStatus(false,"File is not an image");
	    }

	    if (file_exists($target_file)) {
	    	$target_file=$this->getRenamedImage($target_file);
		}

		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			
			 $CI =& get_instance();
			 $CI->load->model("admin/erp/get");
			 $old=$this->get->getTeacherById($tid);
			 $oldfile=$old->image;
			 if(file_exists($oldfile)){unlink($oldfile);}
			 $data["image"]=$target_file;
			 return $this->updateTeacherData($data);

	    } else {
	       return $this->getReturnStatus(false,"Sorry, there was an error uploading your file");
	    }

	}else{
		return $this->updateTeacherData($data);
	}
}
	public function updateTeacherData($data){
		$affected=0;
		$this->db->trans_start();
		$data["bioid"]=empty(trim($data["bioid"]))?0:$data["bioid"];
		if(!empty($data["bioid"])){
			$this->db->where("id",$data["tid"]);
			$this->db->update("login",["bioid"=>$data["bioid"]]);
			$this->checkDBError();
			$affected+=$this->db->affected_rows();
		}

		$this->db->where("tid",$data["tid"]);
		unset($data["tid"]);
		unset($data["bioid"]);
		$this->db->update("erp_teachers",$data);
		$this->checkDBError();

		$affected+=$this->db->affected_rows();

		if($this->db->trans_complete()){
			if($affected>0){
				return $this->getReturnStatus(true,"Teacher Updated Successfully");
			}
			return $this->getReturnStatus(false,"No rows affected");
		}
		return $this->getReturnStatus(false,"Error occured while updating data");
	}


	public function user($data){
	extract($data);
	$target_dir = "uploads/users/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);
   	
   	if(!empty($_FILES["image"]["name"])){

		$check = getimagesize($_FILES["image"]["tmp_name"]);
	    if($check == false) {
	        return $this->getReturnStatus(false,"File is not an image");
	    }

	    if (file_exists($target_file)) {
	    	$target_file=$this->getRenamedImage($target_file);
		}

		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			
			 $CI =& get_instance();
			 $CI->load->model("admin/erp/get");
			 $old=$this->get->getUserById($cid);
			 $oldfile=$old->image;
			 if(file_exists($oldfile)){unlink($oldfile);}
			 $data["image"]=$target_file;
			 return $this->updateUserData($data);

	    } else {
	       return $this->getReturnStatus(false,"Sorry, there was an error uploading your file");
	    }


	}else{
		return $this->updateuserData($data);
	}
}
	public function updateUserData($data){
		$affected=0;
		$this->db->trans_start();
		$data["bioid"]=empty(trim($data["bioid"]))?0:$data["bioid"];
		if(!empty($data["bioid"])){
			$this->db->where("id",$data["cid"]);
			$this->db->update("login",["bioid"=>$data["bioid"]]);
			$this->checkDBError();
			$affected+=$this->db->affected_rows();
		}

		$this->db->where("cid",$data["cid"]);
		unset($data["cid"]);
		unset($data["bioid"]);
		$this->db->update("erp_users",$data);
		$this->checkDBError();
		$affected+=$this->db->affected_rows();
		if($this->db->trans_complete()){
			if($affected>0)
				return $this->getReturnStatus(true,"User Updated Successfully");
			return $this->getReturnStatus(false,"No Rows Affected");
		}
		return $this->getReturnStatus(false,"Error occured while updating data");
	}

	public function updateNoticeboard($data){
		extract($data);
		unset($data["nid"]);
		$this->db->where("id",$nid);
		$this->db->update("erp_noticeboard",$data);
		$this->checkDBError();
		if($this->db->affected_rows()>0)
			return $this->getReturnStatus(true,"Noticeboard Updated Successfully");
		return $this->getReturnStatus(false,"No Rows Affected");
	}

	public function giveResponse($data){
		extract($data);
		unset($data["cid"]);
		$this->db->where("id",$cid);
		$this->db->update("erp_complaints",$data);
		return $this->getReturnStatus(true,"Response Given Successfully");
	}

public function updateAttendance($data){
		$affected=0;
		foreach ($data as $key => $value) {
			if($key=="newentry" || $key=="userid"){continue;}

			if(empty(trim($value))){
				$this->db->where("id",explode("_", $key)[1]);
				$this->db->delete("erp_attendance");
				$this->checkDBError();
				$affected+=$this->db->affected_rows();
				continue;
			}

			$this->db->where("id",explode("_", $key)[1]);
			$this->db->update("erp_attendance",["datetime"=>$value]);
			$this->checkDBError();
			$affected+=$this->db->affected_rows();
		}

		if(date_create_from_format("Y-m-d H:i:s",$_POST["newentry"])!=false){
			if($this->db->insert("erp_attendance",["userid"=>$data["userid"],"datetime"=>$data["newentry"	] ]))
			$affected+=1;
			$this->checkDBError();
		}
		if($affected>0)
			return $this->getReturnStatus(true,"Attendance Updated Successfully");
		return $this->getReturnStatus(false,"No Rows Affected");

	}

	public function updateVideoLecture($data){
		$this->db->where("id",$data["id"]);
		unset($data["id"]);
		$this->db->update("video_lectures",$data);
		$this->checkDBError();
		if($this->db->affected_rows()>0)
			return $this->getReturnStatus(true,"Updated Successfully");
		return $this->getReturnStatus(false,"No Rows Affected");
	}

	public function addCBSInLectures($data){
		for($i=0;$i<count($data["courseid"]);$i++){
			$this->db->insert("video_lectures_cbs",["vl_id"=>$data["id"],"courseid"=>$data["courseid"][$i],"batchid"=>$data["batchid"][$i],"subjectid"=>$data["subjectid"][$i],"fromtime"=>$data["fromtime"][$i],"totime"=>$data["totime"][$i]]);
			$this->checkDBError();
		}
		return $this->getReturnStatus(true,"Added Successfully");
	}

	function updateLectureCBSFT($data){
		extract($data);
		$this->db->where("id",$id);
		$this->db->update("video_lectures_cbs",["courseid"=>$cid,"batchid"=>$bid,"subjectid"=>$sid,"fromtime"=>$fromtime,"totime"=>$totime]);
		$this->checkDBError();
		if($this->db->affected_rows()>0)
			return $this->getReturnStatus(true,"Updated Successfully");
		return $this->getReturnStatus(false,"No Rows Affected");
	}

	public function updateLectureFile($data){
		$target_dir = "uploads/notes/";
		$target_file = $target_dir . basename($_FILES["file"]["name"]);

		if(!empty($_FILES["file"]["name"])){
			if (file_exists($target_file)) {
		    	$target_file=$this->getRenamedImage($target_file);
			}
			
			$query=$this->db->query("select videoid from video_lectures where id='$data[id]'");
			$this->checkDBError();
			if(!$query->row()){
				return $this->getReturnStatus(false,"Note with id $data[id] not found");
			}
			$path=$query->row()->videoid;



			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				$this->db->where("id",$data["id"]);
				$this->db->update("video_lectures",["videoid"=>$target_file]);
				$this->checkDBError();
				if($this->db->affected_rows()>0){
					if(file_exists($path)){
						unlink($path);
					}
					return $this->getReturnStatus(true,"Notes File Updated Successfully");
				}
				else{
					return $this->getReturnStatus(false,"No Rows Affected");
				}
			}
			else{
				return $this->getReturnStatus(false,"Error While Uploading File");
			}
		}	
		else{
			return $this->getReturnStatus(false,"Please Choose File");
		}
	}


}
?>