<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get extends CI_Model {
	public $fy;
	public $sessionid;
	public $timestamp="";
	function __construct(){
		$this->load->helper("get_fy");
		$this->fy=get_fy();
		$query=$this->db->query("select sessionid from session_active where userid=$_SESSION[userid]");
		if($query->row()){
			$this->sessionid=$query->row()->sessionid;
		}else{
			$query=$this->db->query("select id from session_table where session='$this->fy'");
			$this->sessionid=$query->row()->id;
		}	
		date_default_timezone_set("Asia/Calcutta");
		$this->timestamp=date("Y-m-d H:i:s",time());
	}
	
	public function getSessions(){
		$query=$this->db->query("select * from session_table order by id desc");
		return $query->result();
	}

	function getActiveSession(){
		$query=$this->db->query("select sessionid from session_active where userid=$_SESSION[userid]");
		$session=$query->row();
		return $session;
	}

	public function getProfile(){
		$sql="select st.session as fy,es.*,date_format(es.dob,'%d-%b-%Y') as dob,ec.course as coursename,eb.batch as batchname from erp_students es left join erp_courses ec on ec.id=es.course left join erp_batches eb on eb.id=es.batch left join session_table st on st.id=es.session where es.sid=$_SESSION[userid]";
		$query=$this->db->query($sql);
		return $query->row();
	}

	public function getMyAttedance(){
		$query=$this->db->query("select date(datetime) as date,GROUP_CONCAT(concat('<div class=tm>',date_format(datetime,'%l:%i:%s %p'),'</div>') SEPARATOR '') as attendance from erp_attendance where userid=$_SESSION[userid] group by date(datetime)");
		return $query->result();
	}
	
	public function getAttendanceByDate($data){
		extract($data);
		$query=$this->db->query("select date_format(datetime,'%d-%b-%Y %h:%i:%s%p') as fdate from erp_attendance where userid=$_SESSION[userid] and date(datetime)='$date'");
		return $query->result();
	}
	
	public function Noticeboard(){
		$query=$this->db->query("select en.content,date_format(en.datetime,'%d-%b-%Y %h:%i:%s%p') as datetime,et.name,eu.name as uname from erp_noticeboard en inner join erp_noticeboard_cb encb on encb.nid=en.id inner join erp_students es on encb.cid=es.course and encb.bid=es.batch left join erp_teachers et on et.tid=en.uploadby left join erp_users eu on eu.cid=en.uploadby where es.sid='$_SESSION[userid]' and en.session='$this->sessionid' group by encb.nid order by en.id desc ");
		return $query->result();
	}
	
	public function Assignments(){
		$query=$this->db->query("select ea.title,ea.path,date_format(ea.datetime,'%d-%b-%Y %h:%i:%s %p') as datetime,ea.uploadby,et.name,eu.name as uname,group_concat(es.subject) as subject from erp_assignments ea inner join erp_assignments_cbs eacbs on eacbs.aid=ea.id inner join erp_subjects es on es.id=eacbs.sid left join erp_teachers et on et.tid=ea.uploadby left join erp_users eu on eu.cid=ea.uploadby inner join erp_students est on eacbs.bid=est.batch where est.sid=$_SESSION[userid] and ea.session=$this->sessionid group by ea.id order by ea.id desc ");
		return $query->result();
	}
	
	public function getHomework(){
		$bid=$this->getProfile()->batch;
		$query=$this->db->query("SELECT esub.subject,esc.chapter,eh.id,ehl.id as innerid,date_format(eh.datetime,'%d-%b-%Y %h:%i:%s%p') as datetime,group_concat(ehl.lectureno,'-',ehl.exercise,'-',ehl.questions separator '=') as data from erp_homework eh inner join erp_homework_lectures ehl on ehl.homeworkid=eh.id left join erp_subjects esub on esub.id=eh.subjectid left join erp_subject_chapter esc on esc.id=eh.chapterid where eh.batchid=$bid and eh.session=$this->sessionid group by eh.id");
		return $query->result();
	}
	
	
	public function getTimeTables(){
		$query=$this->db->query("select et.date,GROUP_CONCAT(ec.course,'-',eb.batch order by time(et.from_time) ASC SEPARATOR '<div class=line></div>') as cb,et.from_time,et.to_time from erp_timetable et inner join erp_courses ec on ec.id=et.cid inner join erp_batches eb on eb.id=et.bid inner join erp_students es on es.course=et.cid and es.batch=et.bid where es.sid='$_SESSION[userid]' GROUP by et.date");
		return $query->result();
	}



function getScheduleDetailsByDate($date){
		$query=$this->db->query("select etr.name ,esub.subject, et.from_time,et.to_time,date_format(et.date,'%d-%m-%Y') as datef,time_format(from_time,'%h:%i %p') as printfrom,time_format(to_time,'%h:%i %p') as printto,et.date,ec.course,eb.batch from erp_timetable et inner join erp_courses ec on ec.id=et.cid inner join erp_batches eb on eb.id=et.bid inner join erp_students es on es.course=et.cid and es.batch=et.bid inner join erp_subjects esub on esub.id=et.subjectid inner join erp_teachers etr on etr.tid=et.tid where et.date='$date' and es.sid=$_SESSION[userid] ");
		return $query->result();
	}

	function SMS(){
		$query=$this->db->query("select sr.*,date_format(sr.timestamp,'%e-%b-%y %h:%i:%s %p') as smsdate,date_format(sr.examdate,'%e-%b-%y') as examdate,erp_exams.examname from sms_report sr inner join erp_exams on erp_exams.id=sr.eid where sr.sid='$_SESSION[userid]' and sr.session=$this->sessionid order by id desc");
		$rs=$query->result();
		return $rs;
	}

	function getExamsForDashboard(){
		$sql="select group_concat(esub.subject) as subject, ex.examname,ex.category,ex.id as exam_id,sum(exm.marks) as marks,sum(exm.correct) as correct,sum(exm.wrong) as wrong ,exm.attendance,sum(exs.totalmarks) as totalmarks from erp_exams ex inner join erp_exam_marks exm on ex.id=exm.eid inner join erp_exam_subjects exs on exs.eid=exm.eid and exs.sid=exm.subjectid inner join erp_subjects esub on esub.id=exm.subjectid where exm.studentid=$_SESSION[userid] and ex.session=$this->sessionid group by exm.eid";
		$query=$this->db->query($sql);
		$result=$query->result();
		return $result;
	}
	
	function getVideoLecturesBySubject($subjectid,$id){
		$sql="select vl.title,vl.id,vl.downloadable as dw,vl.videoid,es.subject,vl.type,lc.data as completed from video_lectures vl inner join video_lectures_cbs vlcbs on vlcbs.vl_id=vl.id left join erp_subjects es on es.id=vlcbs.subjectid left join lectures_completed lc on lc.studentid=$_SESSION[userid] where vlcbs.subjectid=$subjectid and vlcbs.fromtime<='$this->timestamp' and vlcbs.totime>'$this->timestamp' order by vlcbs.orderno asc";
		$query=$this->db->query($sql);
		return $query->result();
	}	

	function getLectureSubjects(){
		$query=$this->db->query("select distinct subject,subjectid,vl.id from video_lectures vl inner join video_lectures_cbs vlcbs on vlcbs.vl_id=vl.id inner join erp_subjects on vlcbs.subjectid = erp_subjects.id inner join erp_students es on vlcbs.courseid=es.course and vlcbs.batchid=es.batch and vlcbs.fromtime<='$this->timestamp' and vlcbs.totime>'$this->timestamp' where es.sid=$_SESSION[userid]");
		$rs= $query->result();
		$data=[];
		foreach ($rs as $v) {
			$data[$v->subject]=$this->getVideoLecturesBySubject($v->subjectid,$v->id);
		}
		return $data;	
	}

	function getTeachersAndUsers(){
		$query=$this->db->query("select et.name,et.tid as id from erp_teachers et left join erp_assignedsubjects eas on et.tid=eas.tid left join erp_assignedcb eacb on et.tid=eacb.tid left join erp_students es on eas.bid=es.batch or eacb.bid=es.batch where es.sid=$_SESSION[userid] union select eu.name,eu.cid as id from erp_users eu");
		return $query->result();
	}

	 function getLatestLectures(){
	 	$query=$this->db->query("select vl.title,vl.videoid,vl.type,esub.subject from video_lectures vl inner join video_lectures_cbs vlc on vlc.vl_id=vl.id inner join erp_subjects esub on esub.id=vlc.subjectid inner join erp_students es on es.batch=vlc.batchid where es.sid=$_SESSION[userid] and date(vl.datetime)=date('$this->timestamp')");
	 	return $query->result();
	 }
}
?>
