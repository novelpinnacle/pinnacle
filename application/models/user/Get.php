<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get extends CI_Model {

	public function getData($tablename){
		$query=$this->db->get($tablename);
		return $query->result();
	}

	public function getMyAttedance(){
		$query=$this->db->query("select date(datetime) as date,GROUP_CONCAT(concat('<div class=tm>',date_format(datetime,'%l:%i:%s %p'),'</div>') SEPARATOR '') as attendance from erp_attendance where userid=$_SESSION[userid] group by date(datetime)");
		return $query->result();
	}
	public function getSessions(){
		$query=$this->db->query("select * from session_table order by id desc");
		return $query->result();
	}
	public function printStudents($data){
		extract($data);

		$sql="select st.*,date_format(st.dob,'%d-%b-%Y') as dob,ifnull(c.course,'') as course,ifnull(b.batch,'') as batch,if(l.bioid=0,'',l.bioid) as bioid from erp_students st left join erp_courses c on st.course=c.id left join erp_batches b on st.batch=b.id left join login l on l.id=st.sid  ";

		$whereAdded=false;
		if(!empty(trim($rollno))){
			$sql.=" where st.rollno='$rollno'";
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
		$rs=$query->result();
		if(empty($rs)){
			die(json_encode(["message"=>"No Records Found","status"=>false]));
		}
		die(json_encode($rs));
	}

	
	public function getStudentById($sid){
		$query=$this->db->query("select st.*,login.password,if(login.bioid=0,'',login.bioid) as bioid from erp_students st inner join login on login.id=st.sid where st.sid='$sid'");
		return $query->row();
	}



	public function getReportTemplates(){
		$query=$this->db->query("select * from report_template");
		return $query->result();
	}
	public function getTeachers(){
		$query=$this->db->query("select erp_teachers.tid,erp_teachers.name from erp_teachers");
		return $query->result();
	}
	public function getProfile(){
		$query=$this->db->query("select erp_users.*,login.role from erp_users inner join login on login.id=erp_users.cid where erp_users.cid=$_SESSION[userid]");
		return $query->row();
	}

	public function getPermissions(){
		$query=$this->db->query("select per_name,status from permissions where user_id=$_SESSION[userid]");
		return $query->result();
	}

	public function getAllFacultyNames(){
		$query=$this->db->query("select name,tid as id from erp_teachers union select name,cid as id from erp_users");
		return $query->result();
	}

	public function getAdmissionEnquiries($id=""){
		$append=empty($id)?'':" and rae.id=$id";
		$query=$this->db->query("select rae.*,ec.course as fullcourse,et.name as tname,eu.name as uname,date_format(rae.enquirydate,'%d-%b-%Y') as edate,(select date_format(followdate,'%d-%b-%Y') as followdate from rec_admission_enquiries_dates where aeid=rae.id order by id desc limit 0,1) as lastdate,(select date_format(nextdate,'%d-%b-%Y') as nextdate from rec_admission_enquiries_dates where aeid=rae.id order by id desc limit 0,1) as nextdate,(select GROUP_CONCAT(response,'~',date_format(followdate,'%d-%b-%Y'),'~',date_format(nextdate,'%d-%b-%Y') order by id desc SEPARATOR '#' ) from rec_admission_enquiries_dates where aeid=rae.id ) as resp from rec_admission_enquiries rae left join erp_courses ec on ec.id=rae.course left join erp_teachers et on et.tid=rae.assignedto left join erp_users eu on eu.cid=rae.assignedto where rae.status=1 $append order by rae.id DESC limit 4");
		return $query->result();
	}

	public function getAdmissionEnquiriesBySearch($data){
		extract($data);
		$append="";
		$whereAdded=false;
		if(isset($enquirydate) && !empty($enquirydate)){
			$append=" where rae.enquirydate='$enquirydate' ";
			$whereAdded=true;
		}
		if(isset($source) && !empty($source)){
			if($whereAdded){
				$append.=" and rae.source='$source' ";
			}
			else{
				$append.=" where rae.source='$source'";
				$whereAdded=true;
			}
		}
		if(isset($status) && !empty($status)){

			if($whereAdded){
				$append.=" and rae.status=$status ";
			}
			else{
				$append.=" where rae.status=$status";
				$whereAdded=true;
			}
		}

		$query=$this->db->query("select rae.*,ec.course as fullcourse,et.name as tname,eu.name as uname,date_format(rae.enquirydate,'%d-%b-%Y') as edate,(select date_format(followdate,'%d-%b-%Y') as followdate from rec_admission_enquiries_dates where aeid=rae.id order by id desc limit 0,1) as lastdate,(select date_format(nextdate,'%d-%b-%Y') as nextdate from rec_admission_enquiries_dates where aeid=rae.id order by id desc limit 0,1) as nextdate,(select GROUP_CONCAT(response,'~',date_format(followdate,'%d-%b-%Y'),'~',date_format(nextdate,'%d-%b-%Y') order by id desc SEPARATOR '#') from rec_admission_enquiries_dates where aeid=rae.id ) as resp from rec_admission_enquiries rae left join erp_courses ec on ec.id=rae.course left join erp_teachers et on et.tid=rae.assignedto left join erp_users eu on eu.cid=rae.assignedto $append order by rae.id DESC");
			$rs=$query->result();
			return ["table"=>$rs];
	}


	public function getCourses(){
		$query=$this->db->query("select ec.course,ec.id from erp_courses ec where ec.sessionId=3");
		return $query->result();
	}

	public function printBatchesByCourseId($cid){
		$query=$this->db->query("select eb.batch,eb.id from erp_batches eb where cid=$cid");
		$rs=$query->result();
		foreach ($rs as $v) {
			echo "<option value='$v->id'>$v->batch</option>";
		}
	}
	public function getAllBatches(){
		$query = $this->db->query("select id,batch from erp_batches");
		$rs=$query->result();
		return $rs;
	}

	public function printExamsByBatchId($bid){
		$query=$this->db->query("select * from erp_exams where bid=$bid ");
		$rs=$query->result();
		foreach ($rs as $v) {
			echo "<option value='$v->id'>$v->examname</option>";
		}
	}
	
	public function printExamsStatusByBatchId($bid){
		$sql="select examname,id,sms_status from erp_exams where bid=$bid";
		$query=$this->db->query($sql);
		$rs=$query->result();
		echo "<table  class='sc-table'>";
		echo "<tr><th>Exam Name</th><th>Report Status</th></tr>";
		
		foreach ($rs as $v) {
			$viewbtn="<button onclick='viewReport($v->id)' class='btn btn-primary'><i class='fa fa-eye'></i></button>";
			$sendbtn="<a href='".base_url()."user/preparemessage/$v->id' value='Send Now' class='btn btn-primary'><i class='fa fa-send'></i></a>";

			$status=[0=>"Not Sent $sendbtn",1=>"SMS Sent $sendbtn $viewbtn",2=>"Email Sent $sendbtn $viewbtn",3=>"Email &amp; SMS $viewbtn"];

			echo "<tr><td>$v->examname</td><td>".$status[$v->sms_status]."</td></tr>";
		}
		echo "</table>";
	}
	public function printSMSReportByEid($eid){
		$query="select *,date_format(timestamp,'%e-%b-%y %h:%i:%s %p') as smsdate,date_format(examdate,'%e-%b-%y') as examdate from sms_report where eid=$eid order by id desc";
		$rs=$this->db->query($query)->result();
		echo "<div style='max-height:86vh;overflow-y:auto'>";
		echo "<table class='sc-table'>";
		echo "<tr><th>Sid</th><th>Mobile</th><th>Message</th><th>Status</th><th>SMS Date</th><th>Exam Date</th></tr>";
		foreach ($rs as $v) {
			$status="";
			if(stripos($v->api_status,"err")==false){
				$status="Sent";
			}else{
				$status=$v->api_status;
			}
			echo "<tr><td>$v->sid</td><td>$v->number</td><td>$v->msg</td><td>$status</td><td>$v->smsdate</td><td>$v->examdate</td></tr>";
		
		}
		echo "</table>";
		echo "</div>";

	}


	public function printChaptersBySubjectId($subid){
		$query=$this->db->query("select id,chapter from erp_subject_chapter where subjectid=$subid");
		$rs=$query->result();
		foreach($rs as $v) {
			echo "<option value='$v->id'>$v->chapter</option>";
		}
	}

	public function printSubjectsByBatchId($bid){
		$query=$this->db->query("select es.subject,es.id from erp_subjects es where es.bid=$bid");
		$rs=$query->result();
		foreach ($rs as $v) {
			echo "<option value='$v->id'>$v->subject</option>";
		}
	}

	function getAllChapters(){
		$query=$this->db->query("select es.subject,ec.course,eb.batch,group_concat('<div class=chapters>',esc.chapter,'<i class=\"fa fa-remove\" onclick=\"deleteChapter(',esc.id,',this.parentElement)\" ></i> </div>' separator '') as chapter,esc.id from erp_subject_chapter esc inner join erp_subjects es on es.id=esc.subjectid left join erp_courses ec on ec.id=es.cid left join erp_batches eb on eb.id=es.bid group by esc.subjectid ");
		return $query->result();
	}

		
	public function getStudentsByCB($cid,$bid){
		$query=$this->db->query("select sid,rollno,name from erp_students where course=$cid and batch=$bid ");
		return $query->result();
	}

	public function getStudentAttendanceByID($sid){
		$query=$this->db->query("select date(datetime) as date,GROUP_CONCAT(concat('<div class=tm>',date_format(datetime,'%l:%i:%s %p'),'</div>') SEPARATOR '') as attendance from erp_attendance where userid=$sid group by date(datetime)");
		return $query->result();
	}

	public function getStudentAttendanceByDate($data){
		extract($data);
		$query=$this->db->query("select * from erp_attendance where userid=$sid and date(datetime)='$date'");
		return $query->result();
	}

	public function getMyAttendanceByDate($data){
		extract($data);
		$query=$this->db->query("select date_format(datetime,'%d-%b-%Y %h:%i:%s%p') as fdate from erp_attendance where userid=$_SESSION[userid] and date(datetime)='$date'");
		return $query->result();
	}

	public function printStudentAttendanceBySubject($sid,$studentid){
		$query=$this->db->query("select esa.*,date_format(esa.date,'%d-%m-%Y') as date,es.subject from erp_studentattendance esa  inner join erp_subjects es on es.id=esa.sid where esa.studentid='$studentid' and esa.sid=$sid order by esa.date desc ");
		$rs=$query->result();
		echo "<table class='sc-table'>";
		echo "<tr><th>Subject</th><th>Date</th><th>Status</th></tr>";
		$statusarr=[0=>"Absent",1=>"Present","2"=>"On Leave",3=>"N/A",4=>"Holiday"];
		foreach ($rs as $v) {
			echo "<tr><td>$v->subject</td><td>$v->date</td><td>".$statusarr[$v->status]."</td></tr>";
		}
		echo "</table>";
	}



	public function getPostedNoticeboard(){

		$sql="select en.*,date_format(en.datetime,'%d-%m-%Y') as date,group_concat(erp_courses.course,' ' ,eb.batch) as courses from erp_noticeboard en inner join erp_noticeboard_cb encb on encb.nid=en.id inner join erp_courses on erp_courses.id=encb.cid inner join erp_batches eb on eb.id=encb.bid where en.uploadby=$_SESSION[userid] group by en.id  order by en.id desc";

		$query=$this->db->query($sql);
		$result=$query->result();
		return $result;
	}

	public function getNoticeboardById($nid){
		$query=$this->db->query("select * from erp_noticeboard where id=$nid");
		return $query->row();
	}

	public function getNoticeboardCB($nid){
		$query=$this->db->query("select concat(ec.course,' ',eb.batch) as courses,encb.id from erp_noticeboard_cb encb inner join erp_courses ec on ec.id=encb.cid inner join erp_batches eb on eb.id=encb.bid where encb.nid=$nid");
		return $query->result();
	}

	public function getExams(){
		$query=$this->db->query("select ex.examname,ex.examcode,ex.id,ex.category,ec.course,eb.batch,group_concat(es.subject order by erp_exam_subjects.id asc) as subjects from erp_exams ex inner join erp_courses ec on ec.id=ex.cid inner join erp_batches eb on eb.id=ex.bid left join erp_exam_subjects on erp_exam_subjects.eid=ex.id left join erp_subjects es on es.id=erp_exam_subjects.sid group by ex.id ");
		return $query->result();
	}

	public function printSubjectsForExam($eid){
		$query=$this->db->query("select es.subject,es.id from erp_subjects es inner join erp_exam_subjects exs on es.id=exs.sid where exs.eid=$eid ");
		foreach ($query->result() as $v) {
			echo "<option value='$v->id'>$v->subject</option>";
		}
	}
		public function printSubjectsForExamByCB($eid){
		$query=$this->db->query("select es.subject,es.id from erp_subjects es inner join erp_exams ex on es.cid=ex.cid and es.bid=ex.bid where ex.id=$eid ");
		foreach ($query->result() as $v) {
			echo "<option value='$v->id'>$v->subject</option>";
		}
	}
	public function refreshExams($permissions){
		$exams=$this->getExams();
		echo "<table class='sc-table'>
			<tr><th>Exam Name</th><th>Exam Code</th><th>Category</th><th>Course Batch</th><th>Subjects</th>";
			 if($permissions["exam_edit"]==1) { echo "<th>Edit</th>"; }
			 if($permissions["exam_del"]==1) { echo "<th>Delete</th>";}
			echo "</tr>";
		
				$arr=["2"=>"Subjective","1"=>"Objective"];
				foreach ($exams as $v) {
					echo "<tr><td>$v->examname</td><td>$v->examcode</td><td>".$arr[$v->category]."</td><td>$v->course $v->batch</td><td>$v->subjects</td>";
					if($permissions["exam_edit"]==1) {
					echo "<td><a href='".base_url()."user/editexam/$v->id'><i class='fa fa-pencil'></i></a></td>";
					}
					if($permissions["exam_del"]==1) {
					echo "<td><i class='fa fa-remove ' onclick=\"showDelete($v->id,this)\"></i></td>";
					}
					echo "</tr>";
				}
			
		echo "</table>";
	}

	public function getExamById($id){
		$query=$this->db->query("select ex.examname,ex.examdate,ex.cid,ex.bid,ex.sms_status,ex.id,ex.category,ec.course,eb.batch from erp_exams ex inner join erp_courses ec on ec.id=ex.cid inner join erp_batches eb on eb.id=ex.bid left join erp_exam_subjects on erp_exam_subjects.eid=ex.id left join erp_subjects es on es.id=erp_exam_subjects.sid  where ex.id=$id ");
			return $query->row();
	}
	public function getSubjectsByExam($eid){
		$query=$this->db->query("select es.subject,es.id,exs.passmarks,exs.totalmarks,exs.id from erp_subjects es inner join erp_exam_subjects exs on es.id=exs.sid where exs.eid=$eid ");
		return $query->result();
	}

	public function getSubjectsListByExamId($eid){
		$query=$this->db->query("SELECT DISTINCT subject FROM `erp_subjects` inner join erp_exam_marks on erp_subjects.id=erp_exam_marks.subjectid where erp_exam_marks.eid=$eid");
		$rs= $query->result();
		$subjects=[];
		foreach ($rs as $v) {
			$subjects[]=strtolower($v->subject);
		}
		return $subjects;
	}

	public function printStudentsForExam($data){
		extract($data);

		$this->db->where(["eid"=>$eid]);
		$qu=$this->db->get("erp_exam_marks");
		if($qu->row()){
			die("<div class='alert alert-info'>Marks Already Inserted</div>");
		}

		$query=$this->db->query("select es.name,es.sid,es.rollno,ex.category from erp_students es inner join erp_exams ex on es.course=ex.cid and es.batch=ex.bid where ex.id=$eid");
		
		$rs=$query->result();

		if(empty($rs)){
			die("<div class='alert alert-danger'>No Records Found</div>");
		}

		$category=$rs[0]->category;

		$query=$this->db->query("select exs.sid,es.subject from erp_exam_subjects exs inner join erp_subjects es on es.id=exs.sid where exs.eid=$eid");
		$subjects=$query->result();

		if($category=="1"){
			echo "<form id='examform'>";
			echo "<table class='sc-table'>";
			echo "<tr><th>Absent?</th><th>Name</th><th>Roll No.</th>";
			foreach ($subjects as $v) {
				echo "<th>$v->subject </th>";
			}
			echo "</tr>";
			foreach ($rs as $v) {
				echo "<tr><td><input class='check' type='checkbox' onclick=\"toggleInput('class_$v->sid',this)\" name='ck-$v->sid' ></td><td>$v->name</td><td>$v->rollno</td>";

			
			foreach ($subjects as $s) {
				echo "<td><input type=number  name='marks-$v->sid[]' class='w3-input w3-border class_$v->sid' placeholder='Marks' required> <input type=number name='correct-$v->sid[]' class='w3-input w3-border class_$v->sid' placeholder='Correct' required> <input type=number name='wrong-$v->sid[]' class='w3-input w3-border class_$v->sid' placeholder='Wrong' required></td>";
			}
			
			}
			echo "<tr><td></td><td><input type='button' value='Upload Marks' class='fancy-btn small-btn' onclick=\"uploadMarks()\"></td><td colspan='".(count($subjects)+1)."'></td></tr>";
			echo "</table>";
			echo "</form>";

		}

		if($category=="2"){
			echo "<form id='examform'>";
			echo "<table class='sc-table'>";
			echo "<tr><th>Absent?</th><th>Name</th><th>Roll No.</th>";
			foreach ($subjects as $v) {
				echo "<th>$v->subject Marks</th>";
			}
			echo "</tr>";
			foreach ($rs as $v) {
				echo "<tr><td><input type='checkbox' onclick=\"toggleInput('c_$v->sid',this)\" name='ck-$v->sid' ></td><td>$v->name</td><td>$v->rollno</td>";
				foreach ($subjects as $s) {
					echo "<td><input type=number name='marks-$v->sid[]' required class='c_$v->sid w3-input w3-border fullwidth'></td>";
				}
				echo "</tr>";
			}
			echo "<tr><td></td><td><input type='button' value='Upload Marks' class='fancy-btn small-btn' onclick=\"uploadMarks()\"></td><td colspan='".(count($subjects)+1)."'></td></tr>";
			echo "</table>";
			echo "</form>";

		}
		

	}

public function getRank($eid,$subjectid,$marks){


	$query=$this->db->query("select exm.marks from erp_exam_marks exm where exm.eid=$eid and exm.subjectid=$subjectid order by exm.studentid ");

	$result=$query->result();

	foreach($result as $v) {
		$rank[]=$v->marks;
	}		
	rsort($rank);

	for($i=0;$i<count($rank);$i++){
		if($rank[$i]==$marks){
			return $i+1;
		}
	}
}

public function getOverAllRank($eid,$marks){
	$query=$this->db->query("select sum(marks) as marks,studentid from erp_exam_marks where eid=$eid group by studentid");
	$res=$query->result();

	foreach ($res as $v) {
		$arr[]=$v->marks;
	}
	rsort($arr);
	for($i=0;$i<count($arr);$i++){
		if($arr[$i]==$marks){
			return $i+1;
		}
	}
}

public function printExamMarks($data){
	extract($data);
	$this->load->library("ranks");
	$query=$this->db->query("select esub.subject,es.name,es.sid,es.rollno,ex.examname,ex.category,exm.id,exm.marks,exm.correct,exm.wrong,exm.attendance,exm.subjectid,exs.passmarks,exs.totalmarks from erp_exam_marks exm inner join erp_exams ex on ex.id=exm.eid inner join erp_subjects esub on esub.id=exm.subjectid inner join erp_students es on es.sid=exm.studentid inner join erp_exam_subjects exs on exs.eid=exm.eid and exs.sid=exm.subjectid where exm.eid=$eid  order by exm.studentid,exm.subjectid");
	$result=$query->result();
	if(empty($result)){
		die("No Records Found");
	}
	$category=$result[0]->category;
	if($category==1){
		echo "<table class='sc-table'>";
		echo "<tr><th>Name</th><th>Roll No.</th><th>Subject</th><th>Status</th><th>Marks</th><th>Pass Marks</th><th>Total Marks</th><th>Correct</th><th>Wrong</th><th>Rank</th></	tr>";
		$totalmarks=$totalpassmarks=$totaltotalmarks=0;
		$i=0;
		foreach ($result as $v) {
			$status="<span class='w3-text-green'>Pass</span>";
			if($v->marks < $v->passmarks){
				$status="<span class='w3-text-green'>Fail</span>";
			}	
			$rank=$this->ranks->getRank($eid,$v->subjectid,$v->marks);
			$color='';

			
			$totalmarks+=$v->marks;
			$totalpassmarks+=$v->passmarks;
			$totaltotalmarks+=$v->totalmarks;

			if($v->attendance==0){
				$v->marks="--";
				$status="--";
				$v->correct="--";
				$v->wrong='--';
				$rank='--';	
				$v->passmarks="--";
				$v->totalmarks="--";
				$color='red';
			}

			echo "<tr><td style='color:$color'>$v->name</td><td>$v->rollno</td><td>$v->subject</td><td>$status</td><td contenteditable onblur=\"updateMarks($v->id,this.innerHTML,'marks')\" >$v->marks</td><td>$v->passmarks</td><td>$v->totalmarks</td><td contenteditable onblur=\"updateMarks($v->id,this.innerHTML,'correct')\">$v->correct</td><td contenteditable onblur=\"updateMarks($v->id,this.innerHTML,'wrong')\">$v->wrong</td><td>$rank</td></tr>";
			$overallrank=$this->ranks->getOverAllRank($eid,$totalmarks);

			if(isset($result[$i+1])){
				if($result[$i+1]->rollno!=$v->rollno){
					echo "<tr><td colspan=4><b>Total</b></td><td><b>$totalmarks</b></td><td><b>$totalpassmarks</b></td><td><b>$totaltotalmarks</b></td><td></td><td></td><td><b>$overallrank</b></td></tr>";
						$totalmarks=$totalpassmarks=$totaltotalmarks=0;
				}
			}
			else{
				if($v->attendance==0){
					$overallrank="--";
					$totalmarks="--";
					$totalpassmarks="--";
					$totaltotalmarks="--";
				}
				echo "<tr><td colspan=4><b>Total</b></td><td><b>$totalmarks</b></td><td><b>$totalpassmarks</b></td><td><b>$totaltotalmarks</b></td><td></td><td></td><td><b>$overallrank</b></td></tr>";
			}
			$i++;
		}
		echo "</table>";
	}
	if($category==2){
		echo "<table class='sc-table'>";
		echo "<tr><th>Name</th><th>Roll No.</th><th>Subject</th><th>Status</th><th>Marks</th><th>Pass Marks</th><th>Total Marks</th><th>Rank</th></	tr>";
		$totalmarks=$totalpassmarks=$totaltotalmarks=0;
		$i=0;
		foreach ($result as $v) {
			$status="<span class='w3-text-green'>Pass</span>";
			if($v->marks < $v->passmarks){
				$status="<span class='w3-text-green'>Fail</span>";
			}	
			$rank=$this->ranks->getRank($eid,$v->subjectid,$v->marks);
			$totalmarks+=$v->marks;
			$totalpassmarks+=$v->passmarks;
			$totaltotalmarks+=$v->totalmarks;
			$color='';
			if($v->attendance==0){
				$v->marks="--";
				$status="--";
				$rank='--';	
				$v->passmarks="--";
				$v->totalmarks="--";
				$color='red';
			}
			echo "<tr><td style='color:$color'>$v->name</td><td>$v->rollno</td><td>$v->subject</td><td>$status</td><td contenteditable onblur=\"updateMarks($v->id,this.innerHTML,'marks')\">$v->marks</td><td>$v->passmarks</td><td>$v->totalmarks</td><td>$rank</td></tr>";
			
			$overallrank=$this->getOverAllRank($eid,$totalmarks);

			if(isset($result[$i+1])){
				if($result[$i+1]->rollno!=$v->rollno){					
					
					echo "<tr><td colspan=4><b>Total</b></td><td><b>$totalmarks</b></td><td><b>$totalpassmarks</b></td><td><b>$totaltotalmarks</b></td><td><b>$overallrank</b></td></tr>";
						$totalmarks=$totalpassmarks=$totaltotalmarks=0;
				}
			}
			else{
				if($v->attendance==0){
					$overallrank="--";
					$totalmarks="--";
					$totalpassmarks="--";
					$totaltotalmarks="--";
				}
				echo "<tr><td colspan=4><b>Total</b></td><td><b>$totalmarks</b></td><td><b>$totalpassmarks</b></td><td><b>$totaltotalmarks</b></td><td><b>$overallrank</b></td></tr>";
			}
			$i++;
		}
		echo "</table>";
	}
}


public function getAssignments($ass_del){
		$del="";
		if($ass_del==1){
			$del="<td><i class=\"fa fa-remove\" onclick=\"showDelete2(',eacbs.id,',this)\"></i></td>";
		}
		$query=$this->db->query("select ea.title,ea.id,ea.path, date_format(ea.datetime,'%d-%m-%y') as datetime, group_concat('<tr><td>',eb.batch,'</td><td>',es.subject,'</td>$del</tr>' SEPARATOR '') as cbs from erp_assignments ea left join erp_assignments_cbs eacbs on eacbs.aid=ea.id left join erp_batches eb on eb.id=eacbs.bid left join erp_subjects es on es.id=eacbs.sid where ea.uploadby=$_SESSION[userid] group by ea.id order by ea.id desc");
		return $query->result();
	}

public function getAssignmentById($id){
	$query=$this->db->query("select ea.* from erp_assignments ea where ea.id=$id");
	return $query->row();
}


public function getTimeSlots(){
	$str="";
	for($i=8;$i<=20;$i++){
		for($j=0;$j<=55;$j+=15){
			$h=$i;
			$m=$j;
			if($m<10){$m="0$m";}
			if($h<10){$h="0$h";}
			$str.="<option>$h:$m</option>";
		}
	}
	return $str;

}

	function getCourseBatch(){
		$query=$this->db->query("select ec.course,eb.batch,eb.id from erp_courses ec inner join erp_batches eb on eb.cid=ec.id order by ec.course asc , eb.batch asc");
		return $query->result();
	}


	function getTeachersAndUsers(){
		$query=$this->db->query("select name,tid as id from erp_teachers union select name,cid as id from erp_users where cid!=$_SESSION[userid]");
		return $query->result();
	}

	function getAllForChatByName($name){
		$sql="select es.name,es.rollno,es.sid as id,concat(ec.course,' -') as course,eb.batch from erp_students es inner join erp_courses ec on ec.id=es.course inner join erp_batches eb on eb.id=es.batch where es.name like '%$name%' or es.rollno = '$name' union select name,'' as rollno,tid as id,'' as course ,'' as batch from erp_teachers where name like '%$name%' union select name,'' as rollno,cid as id,'' as course ,'' as batch from erp_users where name like '%$name%' and cid!=$_SESSION[userid]";
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

	public function getPostedHomework(){

		$sql="SELECT esub.subject,esc.chapter,eh.id,date_format(eh.datetime,'%d-%b-%Y %h:%i:%s%p') as datetime,group_concat(ehl.lectureno,'-',ehl.exercise,'-',ehl.questions,'-',ehl.id separator '=') as data from erp_homework eh left join erp_homework_lectures ehl on ehl.homeworkid=eh.id left join erp_subjects esub on esub.id=eh.subjectid left join erp_subject_chapter esc on esc.id=eh.chapterid where eh.uploadby=$_SESSION[userid] group by eh.id";

		$query=$this->db->query($sql);
		$result=$query->result();
		return $result;
	}

	public function getHomeworkById($id){
		$query=$this->db->query("select * from erp_homework where id=$id");
		return $query->row();
	}


}



?>