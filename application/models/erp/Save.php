<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Save extends CI_Model {
	
	public $session;// Session Year Like 2020-2021
	public $sessionid;//id like 1 or 2
	public $timestamp="";

	public function __construct(){
		if(isset($_FILES["image"]["name"])){
			$filename=str_replace("'", "", $_FILES["image"]["name"]);
			$filename=str_replace('"', "", $filename);
			$_FILES["image"]["name"]=$filename;
		}
		$this->load->helper("get_fy");
		$session=get_fy();
		$query=$this->db->query("select id from session_table where session='$session'");
		$this->sessionid=$query->row()->id;

		date_default_timezone_set("Asia/Calcutta");
		$this->timestamp=date("Y-m-d H:i:s",time());

	}

	private function checkDBError(){
		if($this->db->error()["message"]!=""){
			die(json_encode(["status"=>false,"message"=>"<div class='text-center w3-text-red'><b>".$this->db->error()["message"]."</b></div>"]));
		}
	}


	public function getRenamedImage($img){
	    $directory=dirname($img)."/";
	    $file=basename($img);
	    $pos=strrpos($file,".");
	    $filename= substr($file,0,$pos)."-". rand(10000,999999);
	    $extension=substr($file, $pos);
	    return $directory.$filename.$extension;
	}


	private function getReturnStatus($status,$msg){
		if($status){$class='w3-text-green';}else{$class='w3-text-red';}
		return ["status"=>$status,"message"=>"<div class='text-center $class'><b>$msg</b></div>"];
	}

public function saveCourse($data){

	if(!preg_match("/^[a-zA-Z-0-9 ]+$/", $data["course"])){
		return $this->getReturnStatus(false,"Please Enter Valid Name");
	}

	if($this->db->insert("erp_courses",$data)){
		return $this->getReturnStatus(true,"Course Created Successfully");
	}
	else{
		return $this->getReturnStatus(false,$this->db->error()["message"]);
	}
}

public function saveBatch($data){

	if(!preg_match("/^[a-zA-Z0-9- ]+$/", $data["batch"])){
		return $this->getReturnStatus(false,"Please Enter Valid Name");
	}

	if($this->db->insert("erp_batches",$data)){
		return $this->getReturnStatus(true,"Batch Created Successfully");
	}
	else{
		return $this->getReturnStatus(false,$this->db->error()["message"]);
	}
}

	
public function saveSubject($data){
	extract($data);
	$errors="a";
	foreach ($data["subject"] as $v) {
		if(!preg_match("/^[a-zA-Z0-9 ]+$/", $v)){continue;}
		$this->db->insert("erp_subjects",["cid"=>$cid,"bid"=>$bid,"subject"=>$v]);
	}

	if($this->db->error()["message"]==""){
		return $this->getReturnStatus(true,"Subject Created Successfully");	
	}
	else{
		return $this->getReturnStatus(false,$this->db->error()["message"]);	
	}
}


public function saveStudent($data){
	$target_dir = "uploads/students/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);
	
	if(filter_var($data["rollno"], FILTER_VALIDATE_INT) === false){
		 return $this->getReturnStatus(false,"Rollno format is invalid");
	}
	
	$query=$this->db->query("select rollno from erp_students where rollno='$data[rollno]'");
	$rs=$query->row();
	if($rs){
		 return $this->getReturnStatus(false,"Rollno already Exists");
	}

   	if(!empty($_FILES["image"]["name"])){
		$check = getimagesize($_FILES["image"]["tmp_name"]);
	    if($check == false) {
	        return $this->getReturnStatus(false,"File is not an image");
	    }

	    if (file_exists($target_file)) {
	   		$target_file=$this->getRenamedImage($target_file);
		}

		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			$data["image"]=$target_file;
			$success=$this->insertStudentData($data);
	        $date=date_create($data["dob"]);
			$password= date_format($date,"dmY");

			if($success){
				return $this->getReturnStatus(true,"Student Added Successfully<br>Username is $data[rollno] and Password is $password");
	   		} 
	   		return $this->getReturnStatus(false,"Some Error Occur While Inserting Data In Database");
	    } else {
	       return $this->getReturnStatus(false,"Sorry, there was an error uploading your file.");
	    }
	}
	else{
		$data["image"]="no";
		$success=$this->insertStudentData($data);
	 	$date=date_create($data["dob"]);
		$password= date_format($date,"dmY");
		if($success){
			return $this->getReturnStatus(true,"Student Added Successfully<br>Username is $data[rollno] and Password is $password");
		}
		return $this->getReturnStatus(false,"Some Error Occur While Inserting Data In Database");
	}
}


public function insertStudentData($data){
	$this->db->trans_start();

	$date=date_create($data["dob"]);

	$password= date_format($date,"dmY");

	$data["bioid"]=empty(trim($data["bioid"]))?0:$data["bioid"];

	$this->db->insert("login",["username"=>$data["rollno"],"password"=>$password,"role"=>"student","bioid"=>$data["bioid"]]);
	unset($data["bioid"]);

	if($this->db->error()["message"]!=""){
		die(json_encode($this->getReturnStatus(false,$this->db->error()["message"])));
	}

	$data["sid"]=$this->db->insert_id();

	$this->db->insert("erp_students",$data);

	if($this->db->error()["message"]!=""){
		die(json_encode($this->getReturnStatus(false,$this->db->error()["message"])));
	}

	return $this->db->trans_complete();
}



public function saveTeacher($data){
	$target_dir = "uploads/teachers/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);
	$query=$this->db->query("select * from login where username='$data[tid]'");
	$rs=$query->row();
	if($rs){
		 return $this->getReturnStatus(false,"Teacher Id already Exists");
	}

   	if(!empty($_FILES["image"]["name"])){
	
	$check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check == false) {
        return $this->getReturnStatus(false,"File is not an image");
    }

    if (file_exists($target_file)) {
   		$target_file=$this->getRenamedImage($target_file);
	}

	if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
		$data["image"]=$target_file;
		if($this->insertTeacherData($data))
       		 return $this->getReturnStatus(true,"Teacher Added Successfully");

       	return $this->getReturnStatus(false,"Some Error Occur While Inserting Data In Database");
    } else {
       return $this->getReturnStatus(false,"Sorry, there was an error uploading your file");
    }

	}
	else{
		$data["image"]="no";
		if($this->insertTeacherData($data))
		 	return $this->getReturnStatus(true,"Teacher Added Successfully");

		return $this->getReturnStatus(false,"Some Error Occur While Inserting Data In Database");
	}
}


public function insertTeacherData($data){
	$this->db->trans_start();

	$data["bioid"]=empty(trim($data["bioid"]))?0:$data["bioid"];
	$this->db->insert("login",["username"=>$data["tid"],"password"=>$data["password"],"role"=>"teacher","bioid"=>$data["bioid"] ]);
		unset($data["password"]);
		unset($data["bioid"]);

	if($this->db->error()["message"]!=""){
		die(json_encode($this->getReturnStatus(false,$this->db->error()["message"])));
	}

	$lastid=$this->db->insert_id();
	$data["tid"]=$lastid;
	$this->db->insert("erp_teachers",$data);

	if($this->db->error()["message"]!=""){
		die(json_encode($this->getReturnStatus(false,$this->db->error()["message"])));
	}

	return $this->db->trans_complete();
}

public function assigncb($data){

	$this->db->where($data);
	$query=$this->db->get("erp_assignedcb");
	$this->checkDBError();
	if($query->row()){
		return $this->getReturnStatus(false,"Course and  Batch Already Assigned");
	}

	if($this->db->insert("erp_assignedcb",$data))
	 	return $this->getReturnStatus(true,"Course and  Batch Assigned Successfully");
	 $this->checkDBError();

}

public function assignsubject($data){
	$this->db->where($data);
	$query=$this->db->get("erp_assignedsubjects");
	$this->checkDBError();
	if($query->row()){
		return $this->getReturnStatus(false,"Subject Already Assigned");
	}
	if($this->db->insert("erp_assignedsubjects",$data))
		 return $this->getReturnStatus(true,"Subject Assigned Successfully");
	$this->checkDBError();
}

public function saveUser($data){
	$target_dir = "uploads/users/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);
	$query=$this->db->query("select * from login where username='$data[cid]'");
	$rs=$query->row();
	if($rs){
		 return $this->getReturnStatus(false,"User Id already Exists");
	}

   	if(!empty($_FILES["image"]["name"])){
	
	$check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check == false) {
        return $this->getReturnStatus(false,"File is not an image");
    }

    if (file_exists($target_file)) {
    	$target_file=$this->getRenamedImage($target_file);
	}

	if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
		$data["image"]=$target_file;
		if($this->insertUserData($data))
	        return $this->getReturnStatus(true,"User Added Successfully");
	    return $this->getReturnStatus(false,"Some Error Occur While Inserting Data In Database");
    } else {
       return $this->getReturnStatus(false,"Sorry, there was an error uploading your file");
    }

	}
	else{
	$data["image"]="no";
		if($this->insertUserData($data))
			return $this->getReturnStatus(true,"User Added Successfully");
		return $this->getReturnStatus(false,"Some Error Occur While Inserting Data In Database");
	}
}


public function insertUserData($data){
	$this->db->trans_start();
	$data["bioid"]=empty(trim($data["bioid"]))?0:$data["bioid"];
	$this->db->insert("login",["username"=>$data["cid"],"password"=>$data["password"],"role"=>$data["role"],"bioid"=>$data["bioid"]]);
	$this->checkDBError();
	unset($data["password"]);
	unset($data["bioid"]);
	unset($data["role"]);
	$id=$this->db->insert_id();
	$data["cid"]=$id;
	$this->db->insert("erp_users",$data);
	$this->checkDBError();

	$permissions="INSERT INTO permissions (user_id, per_name,status) VALUES
		('$data[cid]', 'att_new', 0),
		('$data[cid]', 'att_see', 0),
		('$data[cid]', 'att_edit', 0),
		('$data[cid]', 'nb_new', 0),
		('$data[cid]', 'nb_see', 0),
		('$data[cid]', 'nb_edit', 0),
		('$data[cid]', 'nb_del', 0),
		('$data[cid]', 'tt_new', 0),
		('$data[cid]', 'tt_see', 0),
		('$data[cid]', 'tt_del', 0),
		('$data[cid]', 'exam_new', 0),
		('$data[cid]', 'exam_edit', 0),
		('$data[cid]', 'exam_see', 0),
		('$data[cid]', 'exam_del', 0),
		('$data[cid]', 'exam_sms', 0),
		('$data[cid]', 'exam_ins', 0),
		('$data[cid]', 'marks_see', 0),
		('$data[cid]', 'ass_new', 0),
		('$data[cid]', 'ass_see', 0),
		('$data[cid]', 'ass_edit', 0),
		('$data[cid]', 'ass_del', 0);
	";
	$this->db->query($permissions);
	$this->checkDBError();

	return $this->db->trans_complete();
}


public function saveNoticeboard($data){
	$this->db->trans_start();
	$data["uploadby"]=$_SESSION["userid"];
	$data["session"]=$this->sessionid;
	$this->db->insert("erp_noticeboard",$data);
	$this->checkDBError();
	$nid=$this->db->insert_id();

	$query=$this->db->get("erp_batches");
	foreach ($query->result() as $v) {
		$this->db->insert("erp_noticeboard_cb",["nid"=>$nid,"cid"=>$v->cid,"bid"=>$v->id]);
		$this->checkDBError();
	}
	
	if($this->db->trans_complete())
		return $this->getReturnStatus(true,"Noticeboard Created Successfully");
	return $this->getReturnStatus(false,"Some Error Occur While Inserting Data In Database");
}

function getOrderNoByCBS($cid,$bid,$sid){
	$query=$this->db->query("select orderno from video_lectures_cbs where courseid=$cid and batchid=$bid and subjectid=$sid order by id desc limit 1");
	$this->checkDBError();
	if($query->row()){
		return $query->row()->orderno+1;
	}
	return 1;
}

public function saveVideoCourse($data){
		$this->db->trans_start();
		$this->db->insert("video_lectures",["title"=>$data["title"],"videoid"=>$data["videoid"],"type"=>'video',"datetime"=>$this->timestamp]);
		$this->checkDBError();
		$id=$this->db->insert_id();
	
		for($i=0;$i<count($data["courseid"]);$i++){
			$orderno=$this->getOrderNoByCBS($data["courseid"][$i],$data["batchid"][$i],$data["subjectid"][$i]);
			$this->db->insert("video_lectures_cbs",["vl_id"=>$id,"courseid"=>$data["courseid"][$i],"batchid"=>$data["batchid"][$i],"subjectid"=>$data["subjectid"][$i],"orderno"=>$orderno,"fromtime"=>$data["fromtime"][$i],"totime"=>$data["totime"][$i] ]);
			$this->checkDBError();
		}
		if($this->db->trans_complete()){

			$query=$this->db->query("select vlcbs.id as vlcbsid,vl.title,vl.id,vl.videoid,group_concat('<tr><td>',ec.course,'</td><td>',eb.batch,'</td><td>',es.subject,'</td><td>',vlcbs.fromtime,'</td><td>',vlcbs.totime,'</td><td><i class=\"fa fa-remove\" onclick=\"deleteCBS(',vlcbs.id,',this)\"></i></td></tr>' SEPARATOR '') as cbs from video_lectures vl left join video_lectures_cbs vlcbs on vlcbs.vl_id=vl.id left join erp_subjects es on es.id=vlcbs.subjectid left join erp_courses ec on ec.id=vlcbs.courseid left join erp_batches eb on eb.id=vlcbs.batchid where vl.id=$id group by vl.id");
			
			if($query){
				$v=$query->row();
				$data="<tr><th>Title</th><th>View</th><th>Course,Batch,Subject</th><th>Edit</th><th>Delete</th></tr>";
				$data.="<tr><td>$v->title</td><td><button onclick=".'"'."showLecture('$v->videoid','".base64_encode($v->title)."')".'"'." class='btn btn-default btn-sm'><i class='fa fa-eye'></i></button></td><td><table class='sc-table'><tr><th>Course</th><th>Batch</th><th>Subject</th><th>From</th><th>To</th><th>Delete</th></tr>$v->cbs</table></td><td><a class='btn btn-default btn-sm' href='".base_url()."erp/editvideolecture/$v->id'><i class='fa fa-pencil'></i></a></td><td><button class='btn btn-default btn-sm' onclick='deleteVideo($v->id,this)' ><i class='fa fa-remove'></i></button></td></tr>";

				return ["message"=>"<div class='w3-text-green text-center'>Data Saved Successfully</div>","data"=>$data,"status"=>true];
			}else{
				return ["message"=>"<div class='w3-text-red text-center'>Data in inserted but error while getting record from database</div>","data"=>"","status"=>true];
			}
			
		}
		return $this->getReturnStatus(false,"Some Error Occured While Inserting Data in Database");
	
}

public function UploadLectureNotes($data){
	extract($data);
	$target_dir = "uploads/notes/";
	$target_file = $target_dir . basename($_FILES["file"]["name"]);

	if(!empty($_FILES["file"]["name"])){
		if (file_exists($target_file)) {
	    	$target_file=$this->getRenamedImage($target_file);
		}
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
			$this->db->trans_start();
			$this->db->insert("video_lectures",["title"=>$title,"videoid"=>$target_file,"type"=>"pdf","downloadable"=>$downloadable,"datetime"=>$this->timestamp]);
			$this->checkDBError();
			$id=$this->db->insert_id();
			for($i=0;$i<count($data["courseid"]);$i++){
				$orderno=$this->getOrderNoByCBS($data["courseid"][$i],$data["batchid"][$i],$data["subjectid"][$i]);
				$this->db->insert("video_lectures_cbs",["vl_id"=>$id,"courseid"=>$data["courseid"][$i],"batchid"=>$data["batchid"][$i],"subjectid"=>$data["subjectid"][$i],"orderno"=>$orderno,"fromtime"=>$data["fromtime"][$i],"totime"=>$data["totime"][$i] ]);
				$this->checkDBError();
			}

			if($this->db->trans_complete()){

				$query=$this->db->query("select vlcbs.id as vlcbsid,vl.downloadable as dw,vl.title,vl.id,vl.videoid,group_concat('<tr><td>',ec.course,'</td><td>',eb.batch,'</td><td>',es.subject,'</td><td>',vlcbs.fromtime,'</td><td>',vlcbs.totime,'</td><td><button class=\"btn btn-default btn-sm\"><i class=\"fa fa-remove\" onclick=\"deleteCBS(',vlcbs.id,',this)\"></button></i></td></tr>' SEPARATOR '') as cbs from video_lectures vl left join video_lectures_cbs vlcbs on vlcbs.vl_id=vl.id left join erp_subjects es on es.id=vlcbs.subjectid left join erp_courses ec on ec.id=vlcbs.courseid left join erp_batches eb on eb.id=vlcbs.batchid where vl.id=$id group by vl.id");
				if($query){
					$v=$query->row();

					$data = "<tr><td>$v->title</td><td><table class='sc-table'><tr><th>Course</th><th>Batch</th><th>Subject</th><th>From</th><th>To</th><th>Delete</th></tr>$v->cbs</table></td><td><button onclick=".'"'."showLecture('$v->videoid','".base64_encode($v->title)."',$v->dw)".'"'." class='btn btn-default btn-sm'><i class='fa fa-eye'></i></button> <a class='btn btn-default btn-sm' href='".base_url()."$v->videoid'><i class='fa fa-download'></i></a> <a class='btn btn-default btn-sm' href='".base_url()."erp/editlecturenotes/$v->id'><i class='fa fa-pencil'></i></a> <button class='btn btn-default btn-sm' onclick='deleteVideo($v->id,this)' ><i class='fa fa-remove' ></i></button></td></tr>";

					return ["message"=>"<div class='w3-text-green text-center'>Notes Uploaded Successfully</div>","data"=>$data,"status"=>true];
				}
				return ["message"=>"<div class='w3-text-red text-center'>Data in inserted but error while getting record from database</div>","status"=>false,"data"=>""];
			}
			return $this->getReturnStatus(false,"Some Error Occured While Inserting Data in Database");

		}
		else{
			return $this->getReturnStatus(false,"Error While Uploading File");
		}
	}	
	else{
		return $this->getReturnStatus(false,"Please Choose File");
	}
}

	
	public function lowercolumns($col){
		return strtolower($col);
	}

	public function checkColumnExists($column){
		 $file=$_FILES["file"]["tmp_name"];
		 $xlsx = SimpleXLSX::parse($file) ;
		 $row=$xlsx->rows(0);
		 $row[0]=array_map([$this,"lowercolumns"],$row[0]);
		 return in_array(strtolower($column), $row[0]);
	}

	public function getStudentsArray($column){
		 $file=$_FILES["file"]["tmp_name"];
		 $xlsx = SimpleXLSX::parse($file) ;
		 $row=$xlsx->rows(0);

		 $position=0;
		 for($i=0;$i<count($row[0]);$i++){
	 		if(strtolower($column)==strtolower($row[0][$i])){
	 			$position=$i;
	 			break;
	 		}
		 }

		 	$temp=[];
			foreach ($row as $key=>$v) {
				if($key==0){continue;}
				$temp[]=$v[$position];		
			}

			return $temp;

	}


	public function uploadSaveStudent(){

		include_once 'SimpleXLSX.php';
		$xlsx=SimpleXLSX::parse($_FILES["file"]["tmp_name"]);
		if(!$xlsx){
			return $this->getReturnStatus(false,"File Format is Invalid");
		}
		$rows=$xlsx->rows(0);

		$columnsRequired=["Name","Roll Number","Email","Phone","Father Name","Father Mobile","DOB","Gender","City","Address","Course","Batch","Session"];

		foreach ($columnsRequired as $column) {
			if(!$this->checkColumnExists($column)){
				return $this->getReturnStatus(false,"Column $column is not provided");
			}
		}

		$data=[];
		foreach ($columnsRequired as $column) {
			$data[$column]=$this->getStudentsArray($column);
		}

		for($i=0;$i<count($rows)-1;$i++){
			if($this->getSessionIDByValue($data["Session"][$i])==null){
				return $this->getReturnStatus(false,"Invalid Session Provided at Row ".($i+2));
			}
			$data["Session"][$i]=$this->getSessionIDByValue($data["Session"][$i])->id;
		}

		for($i=0;$i<count($rows)-1;$i++){
			if($this->getCourseIdByName($data["Course"][$i])==null){
				return $this->getReturnStatus(false,"Invalid Course Provided at Row ".($i+2));
			}
			$data["Course"][$i]=$this->getCourseIdByName($data["Course"][$i])->id;
		}

		for($i=0;$i<count($rows)-1;$i++){
			if($this->getBatchIdByName($data["Batch"][$i],$data["Course"][$i])==null){
				return $this->getReturnStatus(false,"Invalid Batch Provided at Row ".($i+2));
			}
			$data["Batch"][$i]=$this->getBatchIdByName($data["Batch"][$i],$data["Course"][$i])->id;
		}

		for($i=0;$i<count($rows)-1;$i++){
			if (filter_var($data["Roll Number"][$i], FILTER_VALIDATE_INT) ===false) {
				return $this->getReturnStatus(false,"Invalid Roll Number ".$data["Roll Number"][$i]." Provided at Row ".($i+2));
			}
		}

		$rolls=$this->getStudentsRollsByRolls($data["Roll Number"]);
		if(count($rolls)>0){
			$str="";
			foreach ($rolls as $r) {
				$str.="$r->rollno,";
			}
			$str=rtrim($str,",");
			return $this->getReturnStatus(false,"Students with Roll Numbers $str  Already Exists");
		}

		$rolls=array_count_values($data["Roll Number"]);

		foreach ($rolls as $key => $value) {
			if($value>1){
				return $this->getReturnStatus(false,"Roll Number $key exists $value times");
			}
		}

		for($i=0;$i<count($rows)-1;$i++){
			if(date_create($data["DOB"][$i])==false){
				return $this->getReturnStatus(false,"Invalid Date ".$data['DOB'][$i]." Provided at Row ".($i+2));
			}
		}		

		for($i=0;$i<count($rows)-1;$i++){
			$this->db->trans_start();

			$date=date_create($data["DOB"][$i]);
			$dob=date_format($date,"Y-m-d");

			$password= date_format($date,"dmY");

			$loginData=[
				"username"=>$data["Roll Number"][$i],
				"password"=>$password,
				"role"=>"student",
				"bioid"=>0
			];

			$this->db->insert("login",$loginData);

			$sid=$this->db->insert_id();


			$studentData=[
				"sid"=>$sid,
				"name"=>$data["Name"][$i],
				"email"=>$data["Email"][$i],
				"phone"=>$data["Phone"][$i],
				"fname"=>$data["Father Name"][$i],
				"fmobile"=>$data["Father Mobile"][$i],
				"city"=>$data["City"][$i],
				"address"=>$data["Address"][$i],
				"dob"=>$data["DOB"][$i],
				"course"=>$data["Course"][$i],
				"batch"=>$data["Batch"][$i],
				"gender"=>$data["Gender"][$i],
				"active"=>1,
				"rollno"=>$data["Roll Number"][$i],
				"session"=>$data["Session"][$i]		
			];

			$this->db->insert("erp_students",$studentData);

			$this->db->trans_complete();
		}

		return $this->getReturnStatus(true,(count($rows)-1)." Students Uploaded Successfully");

	}

	public function getCourseIdByName($name){
		$this->db->where("course",$name);
		$query=$this->db->get("erp_courses");
		return $query->row();
	}

	public function getBatchIdByName($name,$cid){
		$this->db->where(["batch"=>$name,"cid"=>$cid]);
		$query=$this->db->get("erp_batches");
		return $query->row();
	}

	public function getSessionIDByValue($value){
		$this->db->where(["session"=>$value]);
		$query=$this->db->get("session_table");
		return $query->row();
	}

	public function getStudentsRollsByRolls($rolls){
		$rollnos="";
		foreach ($rolls as $v) {
			$rollnos.="'$v',";
		}
		$rollnos=rtrim($rollnos,",");

		$query=$this->db->query("select rollno from erp_students where rollno in ($rollnos)");
		return $query->result();
	}

	function saveWorkshop($data){
		$this->db->insert("workshop",$data);
		$this->checkDBError();
		return ["status"=>true,"message"=>"Registration Successfully"];
	}

	function sendSMSByNumbers($data){
		$this->load->library("sms");
		$response=$this->sms->sendSMS($data["numbers"],$data["message"]);

		$api_status="";
		if(strpos($response,"SMS-SHOOT-ID")!==FALSE){
			$api_status=explode("/", $response)[0];
		}
		else{
			$api_status=$response;
		}
		if($api_status=="SMS-SHOOT-ID"){
			return $this->getReturnStatus(true,"SMS Sent Successfully");
		}
		else{
			return $this->getReturnStatus(false,$api_status);
		}
	}

	function saveWorkshopUpdates($data){
		extract($data);
		$target_dir = "uploads/workshopupdates/";
		$target_file = $target_dir . basename($_FILES["file"]["name"]);

		if(!empty($_FILES["file"]["name"])){
			
			if (file_exists($target_file)) {
		    	$target_file=$this->getRenamedImage($target_file);
			}

			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				$main=isset($data["mainimage"])?1:0;
				$this->db->insert("workshop_updates",["image"=>$target_file,"datetime"=>$data["date"],"main"=>$main]);
				$this->checkDBError();
				return $this->getReturnStatus(true,"Workshop Update Saved");
			}
		}
	}

}
?>