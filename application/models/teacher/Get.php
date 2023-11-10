<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get extends CI_Model {

	public function getAssignedCoursesAndBatches(){
		$sql="SELECT eb.id as bid,eb.batch,ec.id,ec.course from erp_assignedcb eacb inner join erp_courses ec on ec.id=eacb.cid inner join erp_batches eb on eb.id=eacb.bid where eacb.tid=$_SESSION[userid]";
		$query=$this->db->query($sql);
		return $query->result();
	}

	public function getAssignedCoursesAndBatchesOfSubjects(){
		$sql="select distinct eb.id as bid,eb.batch,ec.id as id,ec.course from erp_assignedsubjects eas inner join erp_courses ec on ec.id=eas.cid inner join erp_batches eb on eb.id=eas.bid where eas.tid=$_SESSION[userid]";
		$query=$this->db->query($sql);
		return $query->result();
	}

	public function getAssignedCourses(){
		$query=$this->db->query("select ec.id,ec.course from erp_courses ec where ec.id in(select cid from erp_assignedcb where tid='$_SESSION[userid]' ) ");
		return $query->result();
	}
	public function getAssignedCoursesOfSubjects(){
		$query=$this->db->query("select distinct ec.id,ec.course from erp_courses ec where ec.id in(select distinct cid from erp_assignedsubjects where tid='$_SESSION[userid]' ) ");
		return $query->result();
	}
	public function printAssignedBatches($cid){
		$query=$this->db->query("select eb.batch,eb.id from erp_batches eb where eb.id in(select bid from erp_assignedcb where cid=$cid and tid='$_SESSION[userid]' union select bid from erp_assignedsubjects where cid=$cid and tid='$_SESSION[userid]' ) ");
		$rs=$query->result();
		foreach ($rs as $v) {
			echo "<option value='$v->id'>$v->batch</option>";
		}
	}

	public function getAssignedBatchesOfSubjects(){
		$query=$this->db->query("select distinct eb.batch,eb.id from erp_batches eb inner join erp_assignedsubjects eas on eas.bid=eb.id where eas.tid=$_SESSION[userid]");
		$rs=$query->result();
		return $rs;
	}

	public function printAssignedSubjects($bid){
		$query=$this->db->query("select es.subject,es.id from erp_subjects es where es.id in(select sid from erp_assignedsubjects where bid=$bid and tid='$_SESSION[userid]' ) ");
		$rs=$query->result();
		foreach ($rs as $v) {
			echo "<option value='$v->id'>$v->subject</option>";
		}
	}

	public function printChaptersBySubjectId($subid){
		$query=$this->db->query("select id,chapter from erp_subject_chapter where subjectid=$subid");
		$rs=$query->result();
		foreach($rs as $v) {
			echo "<option value='$v->id'>$v->chapter</option>";
		}
	}

	public function getData($tablename){
		$query=$this->db->get($tablename);
		return $query->result();
	}

	public function getProfile(){
		$query=$this->db->query("select *,date_format(dob,'%d-%b-%Y') as dob from erp_teachers where tid=$_SESSION[userid]");
		return $query->row();
	}

	function getAllChapters(){
		$query=$this->db->query("select es.subject,ec.course,eb.batch,group_concat('<div class=chapters>',esc.chapter,'<i class=\"fa fa-remove\" onclick=\"deleteChapter(',esc.id,',this.parentElement)\" ></i> </div>' separator '') as chapter,esc.id from erp_subject_chapter esc inner join erp_subjects es on es.id=esc.subjectid left join erp_courses ec on ec.id=es.cid left join erp_batches eb on eb.id=es.bid group by esc.subjectid ");
		return $query->result();
	}

	public function getAdmissionTasks(){
		$query=$this->db->query("SELECT rae.name,rae.childname,rae.academicyear,rae.phone,raed.response,ec.course FROM `rec_admission_enquiries` rae inner join rec_admission_enquiries_dates raed on raed.aeid=rae.id inner join erp_courses ec on ec.id=rae.course where raed.nextdate=curdate() and rae.assignedto='$_SESSION[username]'");
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



	public function getMyAttedance(){
		$query=$this->db->query("select date(datetime) as date,GROUP_CONCAT(concat('<div class=tm>',date_format(datetime,'%l:%i:%s %p'),'</div>')  SEPARATOR '') as attendance from erp_attendance where userid=$_SESSION[userid] group by date(datetime)");
		return $query->result();
	
	}
	public function getTimeTables(){
		$query=$this->db->query("select et.date,GROUP_CONCAT(ec.course,'-',eb.batch order by time(et.from_time) ASC SEPARATOR '<div class=line></div>') as cb,et.from_time,et.to_time from erp_timetable et inner join erp_courses ec on ec.id=et.cid inner join erp_batches eb on eb.id=et.bid where et.tid=$_SESSION[userid] GROUP by et.date");
		return $query->result();
	}

	public function getScheduleDetailsByDate($date){
		$query=$this->db->query("select esub.subject, et.from_time,et.to_time,date_format(et.date,'%d-%m-%Y') as datef,time_format(from_time,'%h:%i %p') as printfrom,time_format(to_time,'%h:%i %p') as printto,et.date,ec.course,eb.batch from erp_timetable et inner join erp_courses ec on ec.id=et.cid inner join erp_batches eb on eb.id=et.bid inner join erp_subjects esub on esub.id=et.subjectid where et.date='$date' and et.tid=$_SESSION[userid]");
		return $query->result();
	}

	public function getPostedNoticeboard(){

		$sql="select en.*,date_format(en.datetime,'%d-%m-%Y') as date,group_concat(erp_courses.course,' ' ,eb.batch) as courses from erp_noticeboard en inner join erp_noticeboard_cb encb on encb.nid=en.id inner join erp_courses on erp_courses.id=encb.cid inner join erp_batches eb on eb.id=encb.bid where en.uploadby='$_SESSION[userid]' group by en.id  order by en.id desc";

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

	public function getExams(){
		$query=$this->db->query("select ex.examname,ex.id,ex.category,ec.course,eb.batch,group_concat(es.subject order by erp_exam_subjects.id asc) as subjects from erp_exams ex inner join erp_courses ec on ec.id=ex.cid inner join erp_batches eb on eb.id=ex.bid left join erp_exam_subjects on erp_exam_subjects.eid=ex.id left join erp_subjects es on es.id=erp_exam_subjects.sid  where ex.createdby='$_SESSION[userid]' group by ex.id ");
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
	public function refreshExams(){
		$exams=$this->getExams();
		echo "<table class='sc-table'>
		<tr><th>Exam Name</th><th>Category</th><th>Course Batch</th><th>Subjects</th><th>Edit</th><th>Delete</th></tr>";
		$arr=["2"=>"Subjective","1"=>"Objective"];
		foreach ($exams as $v) {
			echo "<tr><td>$v->examname</td><td>".$arr[$v->category]."</td><td>$v->course $v->batch</td><td>$v->subjects</td><td><a href='".base_url()."teacher/editexam/$v->id'><i class='fa fa-pencil'></i></a></td><td><i class='fa fa-remove ' onclick=\"showDelete($v->id,this)\"></i></td></tr>";
		}
		
		echo "</table>"; 
	}

	public function getExamById($id){
		$query=$this->db->query("select ex.examname,ex.id,ex.category,ec.course,eb.batch from erp_exams ex inner join erp_courses ec on ec.id=ex.cid inner join erp_batches eb on eb.id=ex.bid left join erp_exam_subjects on erp_exam_subjects.eid=ex.id left join erp_subjects es on es.id=erp_exam_subjects.sid  where ex.createdby=$_SESSION[userid] and ex.id=$id ");
			return $query->row();
	}
	public function getSubjectsByExam($eid){
		$query=$this->db->query("select es.subject,es.id,exs.passmarks,exs.totalmarks,exs.id from erp_subjects es inner join erp_exam_subjects exs on es.id=exs.sid where exs.eid=$eid ");
		return $query->result();
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


	public function printExamMarks($data){
		$this->load->library("ranks");
	extract($data);
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

				

				$totalmarks+=$v->marks;
				$totalpassmarks+=$v->passmarks;
				$totaltotalmarks+=$v->totalmarks;

				$color='';
				if($v->attendance==0){
					$v->marks="--";
					$status="Absent";
					$v->correct="--";
					$v->wrong='--';
					$rank='--';	
					$v->passmarks="--";
					$v->totalmarks="--";
					$color='red';
				}
				
				echo "<tr><td style='color:$color'>$v->name</td><td>$v->rollno</td><td>$v->subject</td><td>$status</td><td contenteditable onblur=\"updateMarks($v->id,this.innerHTML,'marks')\" >$v->marks</td><td>$v->passmarks</td><td>$v->totalmarks</td><td contenteditable onblur=\"updateMarks($v->id,this.innerHTML,'correct')\">$v->correct</td><td contenteditable onblur=\"updateMarks($v->id,this.innerHTML,'wrong')\">$v->wrong</td><td>$rank</td></tr>";


				$overallrank=$this->ranks->getOverAllRank($eid,$totalmarks);
				if($v->attendance==0){
					$overallrank="--";
					$totalmarks="--";
					$totalpassmarks="--";
					$totaltotalmarks="--";
				}

				if(isset($result[$i+1])){
					if($result[$i+1]->rollno!=$v->rollno){
						echo "<tr><td colspan=4><b>Total</b></td><td><b>$totalmarks</b></td><td><b>$totalpassmarks</b></td><td><b>$totaltotalmarks</b></td><td></td><td></td><td><b>$overallrank</b></td></tr>";
						$totalmarks=$totalpassmarks=$totaltotalmarks=0;
					}
				}
				else{
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
					$color='red';
				}


				echo "<tr><td style='color:$color'>$v->name</td><td>$v->rollno</td><td>$v->subject</td><td>$status</td><td contenteditable onblur=\"updateMarks($v->id,this.innerHTML,'marks')\">$v->marks</td><td>$v->passmarks</td><td>$v->totalmarks</td><td>$rank</td></tr>";


				$overallrank=$this->ranks->getOverAllRank($eid,$totalmarks);

				if(isset($result[$i+1])){
					if($result[$i+1]->rollno!=$v->rollno){
						echo "<tr><td colspan=4><b>Total</b></td><td><b>$totalmarks</b></td><td><b>$totalpassmarks</b></td><td><b>$totaltotalmarks</b></td><td><b>$overallrank</b></td></tr>";
						$totalmarks=$totalpassmarks=$totaltotalmarks=0;
					}
				}
				else{
					echo "<tr><td colspan=4><b>Total</b></td><td><b>$totalmarks</b></td><td><b>$totalpassmarks</b></td><td><b>$totaltotalmarks</b></td><td><b>$overallrank</b></td></tr>";
				}

				$i++;
			}

			echo "</table>";
		}

	}

	public function getAssignments(){
		$query=$this->db->query("select ea.title,ea.id,ea.path, date_format(ea.datetime,'%d-%m-%y') as datetime, group_concat('<tr><td>',eb.batch,'</td><td>',es.subject,'</td><td><i class=\"fa fa-remove\" onclick=\"showDelete2(',eacbs.id,',this)\"></i></td></tr>' SEPARATOR '') as cbs from erp_assignments ea left join erp_assignments_cbs eacbs on eacbs.aid=ea.id left join erp_batches eb on eb.id=eacbs.bid left join erp_subjects es on es.id=eacbs.sid where ea.uploadby=$_SESSION[userid] group by ea.id order by ea.id desc");
		return $query->result();
	}
	public function getAssignmentById($id){
		$query=$this->db->query("select ea.* from erp_assignments ea where ea.id=$id");
		return $query->row();
	}

	public function printStudentsByCB($data){
		extract($data);
		$query=$this->db->query("select es.name,es.sid from erp_students es where es.course=$cid and es.batch=$bid ");
		foreach ($query->result() as $v) {
			echo "<option value='$v->sid'>$v->name</option>";
		}
	}

	function getTeachersAndUsers(){
		$query=$this->db->query("select name,tid as id from erp_teachers where tid!=$_SESSION[userid] union select name,cid as id from erp_users");
		return $query->result();
	}

	function searchLectures($data,$type){
		extract($data);
		$sql=" ";
		$whereAdded=false;

		if(!empty($bid)){
			$sql.=" where vlcbs.batchid=$bid ";
			$whereAdded=true;
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

		$query=$this->db->query("select vlcbs.id as vlcbsid,vl.downloadable as dw,vl.type,vl.title,vl.id,vl.videoid,group_concat('<tr><td>',ec.course,'</td><td>',eb.batch,'</td><td>',es.subject,'</td></tr>' SEPARATOR '') as cbs from video_lectures vl left join video_lectures_cbs vlcbs on vlcbs.vl_id=vl.id left join erp_subjects es on es.id=vlcbs.subjectid left join erp_courses ec on ec.id=vlcbs.courseid left join erp_batches eb on eb.id=vlcbs.batchid $sql group by vl.id");
		$data = $query->result();  
		echo count($data)." Records Found";
		echo "<tr><th>Title</th><th>Course,Batch,Subject</th><th>Action</th></tr>";
		
		$func=$type=="pdf"?"editlecturenotes":"editvideolecture";

		foreach ($data as $v) {

			echo "<tr><td>$v->title</td><td><table class='sc-table'><tr><th>Course</th><th>Batch</th><th>Subject</th></tr>$v->cbs</table></td><td><button onclick=".'"'."showLecture('$v->videoid','".base64_encode($v->title)."',$v->dw)".'"'." class='btn btn-default btn-sm'><i class='fa fa-eye'></i></button></td></tr>";
		}

	}

}
?>