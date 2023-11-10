<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get extends CI_Model {
	public $sessionid;
	function __construct(){
		$this->load->helper("get_fy");
		$fy=get_fy();	
		$query=$this->db->query("select id from session_table where session='$fy'");
		$this->sessionid=$query->row()->id;
	}

	private function checkDBError(){
		if($this->db->error()["message"]!=""){
			die(json_encode(["status"=>false,"message"=>"<div class='text-center w3-text-red'><b>".$this->db->error()["message"]."</b></div>"]));
		}	
	}

	public function getToggle($section){
		$this->db->where("section",$section);
		$query=$this->db->get("cms_toggle");
		if(isset($query->row()->status)){
			return $query->row()->status;
		}
		else{
			return 0;
		}
	}

	function getDashBoardCount(){
		$query=$this->db->query("select count(sid) as cnt from erp_students where session='$this->sessionid' and active=1 ");
		$students=$query->row()->cnt;

		$query=$this->db->query("select count(tid) as cnt from erp_teachers");
		$teachers=$query->row()->cnt;

		$query=$this->db->query("select count(cid) as cnt from erp_users");
		$staff=$query->row()->cnt;

		$query=$this->db->query("select count(id) as cnt from contact_queries");
		$contact=$query->row()->cnt;

		$query=$this->db->query("select count(id) as cnt from video_lectures where type='video'");
		$video=$query->row()->cnt;

		$query=$this->db->query("select count(id) as cnt from video_lectures where type='pdf'");
		$notes=$query->row()->cnt;
		

		return ["students"=>$students,"teachers"=>$teachers,"staff"=>$staff,"contact"=>$contact,"videos"=>$video,"notes"=>$notes];
	}

	public function getSessions(){
		$query=$this->db->query("select * from session_table order by id desc");
		return $query->result();
	}

	public function getLectureById($id){
		$query=$this->db->query("select * from video_lectures where id=$id");
		return $query->row();
	}
	public function getLectureCBSFT($id){
		$query=$this->db->query("select * from video_lectures_cbs where vl_id=$id");
		return $query->result();
	}

	public function getVideoLectures($type='video'){
		$query=$this->db->query("select vlcbs.id as vlcbsid,vl.title,vl.id,vl.videoid,group_concat('<tr><td>',ec.course,'</td><td>',eb.batch,'</td><td>',es.subject,'</td><td><i class=\"fa fa-remove\" onclick=\"deleteCBS(',vlcbs.id,',this)\"></i></td></tr>' SEPARATOR '') as cbs from video_lectures vl left join video_lectures_cbs vlcbs on vlcbs.vl_id=vl.id left join erp_subjects es on es.id=vlcbs.subjectid left join erp_courses ec on ec.id=vlcbs.courseid left join erp_batches eb on eb.id=vlcbs.batchid where vl.type='$type' group by vl.id");
		return $query->result();  
	}

	public function getVideosAndNotes($data){
		extract($data);
		$query=$this->db->query("select vl.title,vlcbs.id,vl.type from video_lectures vl inner join video_lectures_cbs vlcbs on vlcbs.vl_id=vl.id where vlcbs.courseid='$cid' and vlcbs.batchid='$bid' and vlcbs.subjectid='$subjectid' order by vlcbs.orderno asc");
		$this->checkDBError();
		return ["data"=>$query->result(),"status"=>true];  		
	}

	public function searchLectures($data,$type){
		extract($data);
		$sql=" ";
		$whereAdded=false;
		if(!empty($cid)){
			$sql.=" where vlcbs.courseid=$cid ";
			$whereAdded=true;
		}
		if(!empty($bid)){
			if($whereAdded){
				$sql.=" and vlcbs.batchid=$bid ";
			}
			else{
				$sql.=" where vlcbs.batchid=$bid ";
				$whereAdded=true;
			}
		}

		if(!empty($sid)){
			if($whereAdded){
				$sql.=" and vlcbs.subjectid=$sid ";
			}
			else{
				$sql.=" where vlcbs.subjectid=$sid ";
				$whereAdded=true;
			}
		}

		if($whereAdded){
			$sql.=" and vl.type='$type' ";
		}else{
			$sql.=" where vl.type='$type'";
		}

		$query=$this->db->query("select vlcbs.id as vlcbsid,vl.downloadable as dw,vl.type,vl.title,vlcbs.fromtime,vlcbs.totime,vl.id,vl.videoid,group_concat('<tr><td>',ec.course,'</td><td>',eb.batch,'</td><td>',es.subject,'</td><td>',vlcbs.fromtime,'</td><td>',vlcbs.totime,'</td><td><button class=\"btn btn-default btn-sm\"><i class=\"fa fa-remove\" onclick=\"deleteCBS(',vlcbs.id,',this)\"></i></button></td></tr>' SEPARATOR '') as cbs from video_lectures vl left join video_lectures_cbs vlcbs on vlcbs.vl_id=vl.id left join erp_subjects es on es.id=vlcbs.subjectid left join erp_courses ec on ec.id=vlcbs.courseid left join erp_batches eb on eb.id=vlcbs.batchid $sql group by vl.id");
		$data = $query->result();  
		echo count($data)." Records Found";
		echo "<tr><th>Title</th><th>Course,Batch,Subject</th><th>Action</th></tr>";
		
		$func=$type=="pdf"?"editlecturenotes":"editvideolecture";

		foreach ($data as $v) {

			echo "<tr><td>$v->title</td><td><table class='sc-table'><tr><th>Course</th><th>Batch</th><th>Subject</th><th>From</th><th>To</th><th>Delete</th></tr>$v->cbs</table></td><td><button onclick=".'"'."showLecture('$v->videoid','".base64_encode($v->title)."',$v->dw)".'"'." class='btn btn-default btn-sm'><i class='fa fa-eye'></i></button> <a class='btn btn-default btn-sm' href='".base_url()."$v->videoid'><i class='fa fa-download'></i></a> <a class='btn btn-default btn-sm' href='".base_url()."erp/$func/$v->id'><i class='fa fa-pencil'></i></a> <button class='btn btn-default btn-sm' onclick='deleteVideo($v->id,this)' ><i class='fa fa-remove' ></i></button></td></tr>";
		}

	}

	public function getAttendanceByID($id){
		$query=$this->db->query("select date(datetime) as date,GROUP_CONCAT(concat('<div class=tm>',date_format(datetime,'%l:%i:%s %p'),'</div>') SEPARATOR '') as attendance from erp_attendance where userid='$id' group by date(datetime)");
		return $query->result();
	}

	public function getAttendanceByDate($data){
		extract($data);
		$query=$this->db->query("select * from erp_attendance where userid=$id and date(datetime)='$date'");
		return $query->result();
	}

	public function getData($tablename){
		$query=$this->db->get($tablename);
		return $query->result();
	}
	public function printCourse(){
		$courses=$this->getData('erp_courses');
		include 'erp_common/courses.php';
	}

	public function getUserPermissions($user_id){
		$query=$this->db->query("select per_name,status from permissions where user_id='$user_id'");
		return $query->result();
	}

	public function getDataById($table,$id){
		$this->db->where("id",$id);
		return $this->db->get($table)->row();
	}

	public function getBatches(){
		$query=$this->db->query("select eb.*,ec.course from erp_batches eb inner join erp_courses ec on eb.cid=ec.id order by ec.course,eb.batch");
		return $query->result();
	}
	public function printBatch(){
		$batches=$this->getBatches();
		include 'erp_common/batches.php';
	}
	public function printBatchesByCourse($cid){
		$this->db->where("cid",$cid);
		$query=$this->db->get("erp_batches");
		$data=$query->result();
		foreach ($data as $v) {
			echo "<option value='$v->id'>$v->batch</option>";
		}
	}
	public function printSubjectsByCB($cid,$bid){
		$this->db->where(["cid"=>$cid,"bid"=>$bid]);
		$query=$this->db->get("erp_subjects");
		$data=$query->result();
		foreach ($data as $v) {
			echo "<option value='$v->id'>$v->subject</option>";
		}
	}
	public function getSubjects(){
		$query=$this->db->query("select erp_courses.course,erp_courses.id as cid,erp_batches.*,erp_batches.id as bid from erp_courses inner join erp_batches on erp_courses.id=erp_batches.cid order by erp_courses.course,erp_batches.batch ");
		return $query->result();
	}
	public function getSubjectsByCourseBatch($cid,$bid){
		$query=$this->db->query("select * from erp_subjects where cid=$cid and bid=$bid order by subject");
		return $query->result();
	}


	public function getStudentById($sid){
		$query=$this->db->query("select st.*,login.password,if(login.bioid=0,'',login.bioid) as bioid from erp_students st inner join login on login.id=st.sid where st.sid='$sid'");
		return $query->row();
	}
	public function getTeacherById($tid){
		$query=$this->db->query("select t.*,if(login.bioid=0,'',login.bioid) as bioid from erp_teachers t left join login on login.id=t.tid where t.tid='$tid'");
		return $query->row();
	}
	public function getUserById($cid){
		$query=$this->db->query("select t.*,if(login.bioid=0,'',login.bioid) as bioid from erp_users t left join login on login.id=t.cid where t.cid='$cid'");
		return $query->row();
	}
	public function getAllTeachers(){
		$query=$this->db->get("erp_teachers");
		return $query->result();
	}
	public function getAllUsers(){
		$query=$this->db->get("erp_users");
		return $query->result();
	}
	public function getNoticeboardById($nid){
		$query=$this->db->query("select * from erp_noticeboard where id=$nid");
		return $query->row();
	}

	public function getStudentsByCB($cid,$bid){
		$query=$this->db->query("select sid,rollno,name from erp_students where course='$cid' and batch='$bid' ");
		$this->checkDBError();
		return ["data"=>$query->result(),"status"=>true];
	}

	public function printStudents($data){
		extract($data);

		$sql="select st.*,date_format(st.dob,'%d-%b-%Y') as dob,ifnull(c.course,'') as course,ifnull(b.batch,'') as batch,if(l.bioid=0,'',l.bioid) as bioid from erp_students st left join erp_courses c on st.course=c.id left join erp_batches b on st.batch=b.id left join login l on l.id=st.sid ";

		$whereAdded=false;
		if(!empty(trim($rollno))){
			$sql.=" where st.rollno='$rollno' ";
			$whereAdded=true;
		}
		if(!empty(trim($name))){
			if($whereAdded){
				$sql.=" and st.name like '%$name%' ";
			}
			else{
				$sql.=" where st.name like '%$name%'";
				$whereAdded=true;
			}
		}
	
	if(!empty(trim($course))){
			if($whereAdded){
				$sql.=" and st.course='$course'";
			}
			else{
				$sql.=" where st.course='$course'";
				$whereAdded=true;
			}
		}
		if(!empty(trim($batch))){
			if($whereAdded){
				$sql.=" and st.batch='$batch'";
			}
			else{
				$sql.=" where st.batch='$batch'";
			}
		}


		$query=$this->db->query($sql);
		$this->checkDBError();
		$rs=$query->result();
		if(empty($rs)){
			die(json_encode(["message"=>"No Records Found","status"=>false]));
		}
		die(json_encode($rs));

	}



	public function printTeachers($data){
		extract($data);
		$sql="select t.* from erp_teachers t ";

		$whereAdded=false;
		// if(!empty(trim($tid))){
		// 	$sql.=" where t.tid='$tid' ";
		// 	$whereAdded=true;
		// }
		if(!empty(trim($name))){
			if($whereAdded){
				$sql.=" and t.name like '%$name%' ";
			}
			else{
				$sql.=" where t.name like '%$name%'";
				$whereAdded=true;
			}
		}
	
	if(!empty(trim($course))){
			if($whereAdded){
				$sql.=" and t.tid in (select tid from erp_assignedcb where cid='$course') ";
			}
			else{
				$sql.=" where t.tid in (select tid from erp_assignedcb where cid='$course') ";
				$whereAdded=true;
			}
		}
		if(!empty(trim($batch))){
			if($whereAdded){
				$sql.=" and t.tid in (select tid from erp_assignedcb where bid='$batch') ";
			}
			else{
				$sql.=" where t.tid in (select tid from erp_assignedcb where bid='$batch') ";
			}
		}


		$query=$this->db->query($sql);
		$this->checkDBError();
		$rs=$query->result();
		if(empty($rs)){
			die(json_encode(["message"=>"No Records Found","status"=>false]));
		}

		die(json_encode($rs));
	}

	public function getAssignedCB(){
		$query=$this->db->query("select t.name,t.tid,ec.course,eb.batch,acb.id from erp_teachers t inner join erp_assignedcb acb on t.tid=acb.tid inner join erp_courses ec on ec.id=acb.cid inner join erp_batches eb on eb.id=acb.bid ");
		return $query->result();
	}
	public function printAssignCB(){
		$assignedcb=$this->getAssignedCB();
		include 'erp_common/assignedcb.php';
	}
	public function getAssignedSubjects(){
		$query=$this->db->query("select t.name,t.tid,ec.course,eb.batch,esub.subject,asub.id from erp_teachers t inner join erp_assignedsubjects asub on t.tid=asub.tid inner join erp_courses ec on ec.id=asub.cid inner join erp_batches eb on eb.id=asub.bid inner join erp_subjects esub on esub.id=asub.sid");
		return $query->result();	
	}
	public function printAssignSub(){
		$assignedsubjects=$this->getAssignedSubjects();
		include 'erp_common/assignedsubjects.php';
	}



	public function printUsers($data){
		extract($data);
		$sql="select c.* from erp_users c ";

		$whereAdded=false;
		if(!empty(trim($name))){
			if($whereAdded){
				$sql.=" and c.name like '%$name%' ";
			}
			else{
				$sql.=" where c.name like '%$name%'";
				$whereAdded=true;
			}
		}
	
		$query=$this->db->query($sql);
		$this->checkDBError();
		$rs=$query->result();
		if(empty($rs)){
			die(json_encode(["message"=>"No Records Found","status"=>false]));
		}
		die(json_encode($rs));
	}
public function getAllPostedNoticeboard(){
	$query=$this->db->query("select en.id,en.content,en.uploadby as namem,date_format(en.datetime,'%d-%b-%y %h:%i:%s%p') as date,erp_teachers.name as name1,erp_users.name as name2 from erp_noticeboard en left join erp_teachers on erp_teachers.tid=en.uploadby left join erp_users on erp_users.cid=en.uploadby order by en.id desc");
	return $query->result();	
}

public function getTeacherComplaints(){
	$query=$this->db->query("select et.name,et.email,et.phone,etc.*,date_format(etc.datetime,'%d-%m-%y %h:%i:%s') as date,date_format(etc.responsetime,'%d-%m-%y %h:%i:%s') as rtime from erp_complaints etc inner join erp_teachers et on et.tid=etc.requestedby");
	return $query->result();
}

public function getStudentComplaints($role){
	$append="";
	if($role=="teacher"){$append=" where etc.requestedto='$_SESSION[username]'";}
	$query=$this->db->query("select ec.course,eb.batch,es.name,et.name as tname,es.email,es.phone,etc.*,date_format(etc.datetime,'%d-%m-%y %h:%i:%s') as date,date_format(etc.responsetime,'%d-%m-%y %h:%i:%s') as rtime from erp_complaints etc inner join erp_students es on es.sid=etc.requestedby inner join erp_courses ec on ec.id=es.course  inner join erp_batches eb on eb.id=es.batch left join erp_teachers et on et.tid=etc.requestedto $append");
	return $query->result();
}


public function getContactQueries(){
	$query=$this->db->query("select *,date_format(datetime,'%d-%M-%y %h:%i:%s%p') as date from contact_queries order by id desc");
	return $query->result();
}


	public function getCourses(){
		$query=$this->db->query("select ec.course,ec.courseId from erp_courses ec where ec.sessionId=3");
		return $query->result();
	}

function getCourseBatch(){
	$query=$this->db->query("select ec.course,eb.batch,eb.id from erp_courses ec inner join erp_batches eb on eb.cid=ec.id order by ec.course asc , eb.batch asc");
	return $query->result();
}

function getLiveChatsOfAll(){
	$query=$this->db->query("select es.name,es.rollno,ec.course,eb.batch,es.sid,count(cr.status) as cnt from erp_students es inner join chat c on c.sender=es.sid inner JOIN chat_recipients cr on cr.chatid=c.id inner join erp_courses ec on ec.id=es.course inner join erp_batches eb on eb.id=es.batch where cr.status=0  and cr.userid=$_SESSION[userid] group by es.sid");
	$rs=$query->result();
	if(empty($rs)){
		
	}
	foreach ($rs as $v) {
		echo "<div data-sid='$v->sid' class='chat-thumb' onclick='openChat($v->sid,\"$v->name [$v->course - $v->batch]\")'>$v->name <div class='chat-cb' onclick='event.stopPropagation();this.parentElement.click()'> $v->course - $v->batch </div> <div class='chat-roll' onclick='event.stopPropagation();this.parentElement.click()'>$v->rollno</div> <div class='chat-count'>$v->cnt</div> </div>";
	}

	$query=$this->db->query("select et.name,et.tid as id,count(cr.status) as cnt from erp_teachers et inner join chat c on c.sender=et.tid inner JOIN chat_recipients cr on cr.chatid=c.id where cr.status=0 and cr.userid=$_SESSION[userid] group by et.tid union select eu.name,eu.cid as id,count(cr.status) as cnt from erp_users eu inner join chat c on c.sender=eu.cid inner JOIN chat_recipients cr on cr.chatid=c.id where cr.status=0 and cr.userid=$_SESSION[userid] group by eu.cid ");
	$rs2=$query->result();
	if(empty($rs2) && empty($rs)){
		echo "no";
	}
	
	foreach ($rs2 as $v) {
		echo "<div data-sid='$v->id' class='chat-thumb ut' onclick='openChat($v->id,\"$v->name\")'>$v->name <div class='chat-count'>$v->cnt</div> </div>";
	}

}

function getTeachersAndUsers(){
	$query=$this->db->query("select name,tid as id from erp_teachers union select name,cid as id from erp_users");
	return $query->result();
}

	function getAllForChatByName($name){
		$sql="select es.name,es.rollno,es.sid as id,concat(ec.course,' -') as course,eb.batch from erp_students es inner join erp_courses ec on ec.id=es.course inner join erp_batches eb on eb.id=es.batch where es.name like '%$name%' or es.rollno = '$name' union select name,'' as rollno,tid as id,'' as course ,'' as batch from erp_teachers where name like '%$name%' union select name,'' as rollno,cid as id,'' as course ,'' as batch from erp_users where name like '%$name%'";
		$query=$this->db->query($sql);
		if(count($query->result())==0){
			echo "no";
		}
		foreach ($query->result() as $v) {
			$cb="";
			if($v->course!=null){
				$cb="[$v->course $v->batch]";
			}
			echo "<div data-sid='$v->id' class='chat-thumb' onclick='openChat($v->id,\"$v->name $cb\")'>$v->name<div class='chat-cb' onclick='event.stopPropagation();this.parentElement.click()'> $v->course $v->batch </div> <div class='chat-roll' onclick='event.stopPropagation();this.parentElement.click()'>$v->rollno</div> </div>";
		}


	}


	function printDashboardInfo($type,$category){
		if($type=='student-count'){
			$query=$this->db->query("select count(es.sid) as cnt,ec.course,eb.batch from erp_students es inner join erp_batches eb on eb.id=es.batch inner join erp_courses ec on ec.id=es.course where es.active=1 GROUP by es.batch");
			$rs=$query->result();
			echo json_encode($rs);
		}
		if($type=="video-count"){
			$query=$this->db->query("select count(vlc.id) as cnt,ec.course,eb.batch,esub.subject from video_lectures_cbs vlc inner join erp_courses ec on ec.id=vlc.courseid inner join erp_batches eb on eb.id=vlc.batchid inner join erp_subjects esub on esub.id=vlc.subjectid inner join video_lectures on video_lectures.id=vlc.vl_id where video_lectures.type='$category' group by vlc.subjectid");
			$rs=$query->result();
			echo json_encode($rs);
		}
	}

	function printFinishedLecturesByBatch($bid){
		$query=$this->db->query("select esub.subject,esub.id,count(vlc.id) as cnt from erp_subjects esub left join video_lectures_cbs vlc on vlc.subjectid=esub.id where esub.bid=$bid group by esub.id");
		$subjects=$query->result();
		
		$sub_vlid=[];
		foreach($subjects as $sb){
			$query=$this->db->query("select vl_id from video_lectures_cbs where subjectid=$sb->id");
			$rs=$query->result();
			$sub_vlid[$sb->id]=$rs;
		}

		echo "<table class='sc-table'>";
		echo "<tr><th>Name</th><th>Roll No.</th>";
		foreach ($subjects as $v) {
			echo "<th>$v->subject ($v->cnt)</th>";
		}
		echo "</tr>";

		$query=$this->db->query("select es.sid,es.name,es.rollno,lc.data from erp_students es left join  lectures_completed lc on lc.studentid=es.sid where es.batch=$bid");
		$students=$query->result();
		foreach ($students as $v) {
			echo "<tr><td>$v->name</td><td>$v->rollno</td>";
			foreach ($subjects as $s) {
				//echo "<td>".$this->getCountBySubject($v->data,$s->id,$sub_vlid)."</td>";
				if($s->cnt>0){
					$percentage=($this->getCountBySubject($v->data,$s->id,$sub_vlid)/$s->cnt)*100;
				}
				else{
					$percentage=0;
				}
				echo "<td>";
				echo  "<div class='progress' style='top:10px;position:relative'>
					    <div class='progress-bar' style='width:$percentage%'>".$this->getCountBySubject($v->data,$s->id,$sub_vlid)."
					    </div>
					  </div>";
				echo "</td>";
			}
			echo "</tr>";
		}
		echo "</table>";

	}

	 private function getCountBySubject($data,$sid,$sub_vlid){
		$count=0;
		$sdata=explode(",", $data);
		 foreach ($sub_vlid[$sid] as $v) {
			if(in_array($v->vl_id,  $sdata )){
	 			$count++;
	 		}
		 }
		return $count;
	 }

	 function getWorkshops(){
	 	$query=$this->db->query('select * from workshop order by id desc');
	 	return $query->result();
	 }


	function getWorkshopUpdates($date){
		date_default_timezone_set("Asia/Calcutta");
		$today=date("Y-m-d",time());
		if($date==""){
			$append="datetime='$today'";
		}
		else{
			$append="datetime='$date'";
		}
		$query=$this->db->query("select image,main,date_format(datetime,'%d %M') as datetime from workshop_updates where $append or datetime='2020-06-18' order by main desc");
		return $query->result();
	}

	function getWorkshopDates(){
		date_default_timezone_set("Asia/Calcutta");
		$today=date("Y-m-d",time());
		$query = $this->db->query("select datetime,date_format(datetime,'%d %M') showdate from workshop_updates where datetime!='$today' group by datetime");
		return $query->result();
	}

}
?>