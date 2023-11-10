<?php
Class Student {
	private $conn;
	public function __construct($conn){
		$this->conn=$conn;
	}
	
	private function get_fy(){
		$date=date_create(date("Y-m-d"));
		if(date_format($date,"m")>=4){
			$fy=(date_format($date,"Y"))."-".(date_format($date,"Y")+1);
		}
		else{
			$fy=(date_format($date,"Y")-1)."-". date_format($date,"Y");
		}
		return $fy;	
	}

	private function getSessionId($sid){
		$query=$this->conn->query("select sessionid from session_active where userid=98789");
		$rs=$query->fetch(PDO::FETCH_OBJ);
		if($rs){
			return $rs->sessionid;
		}else{
			$fy=$this->get_fy();
			$query=$this->conn->query("select id from session_table where session='$fy'");
			return $query->fetch(PDO::FETCH_OBJ)->id;
		}	

	}

	public function getProfile($id){
		$query=$this->conn->query("select es.*,es.batch as bid,date_format(es.dob,'%d-%b-%Y') as dob,ec.course as coursename,eb.batch as batchname from erp_students es left join erp_courses ec on ec.id=es.course left join erp_batches eb on eb.id=es.batch where es.sid=$id");
		$rs=$query->fetch(PDO::FETCH_ASSOC);
		return $rs;
	}	

	public function getNoticeboards($id){
		$sessionid=$this->getSessionId($id);
		$query=$this->conn->query("select en.content,date_format(en.datetime,'%d-%b-%Y %h:%i:%s%p') as date,ifnull(et.name,eu.name) as uploader,et.name,eu.name as uname from erp_noticeboard en inner join erp_noticeboard_cb encb on encb.nid=en.id inner join erp_students es on encb.cid=es.course and encb.bid=es.batch left join erp_teachers et on et.tid=en.uploadby left join erp_users eu on eu.cid=en.uploadby where es.sid=$id and en.session=$sessionid group by encb.nid order by en.id desc");
		$rs=$query->fetchAll(PDO::FETCH_ASSOC);
		return $rs;
	}

	public function getExams($id){
		$sessionid=$this->getSessionId($id);
		$query=$this->conn->query("select ex.examname as name,ex.category,date_format(ex.examdate,'%d-%b-%Y') as date, group_concat(esub.subject,'-',exm.marks,'-',exam_sub.totalmarks,'-',exm.correct,'-',exm.wrong) as submarks,(select sum(exm2.marks) from erp_exam_marks exm2 where exm2.studentid=exm.studentid ) as markstotal,(select sum(exs.totalmarks) from erp_exam_subjects exs where exs.eid=exm.eid ) as totaltotal from erp_exams ex inner join erp_exam_marks exm on exm.eid=ex.id INNER join erp_subjects esub on esub.id=exm.subjectid inner join erp_exam_subjects exam_sub on exam_sub.sid=exm.subjectid and exam_sub.eid=exm.eid where exm.studentid=$id and ex.session=$sessionid group by exm.eid");
		$rs=$query->fetchAll(PDO::FETCH_ASSOC);
		return $rs;
	}	

	public function getAssignments($id){
		$sessionid=$this->getSessionId($id);
		$query=$this->conn->query("select ea.title,ea.path,date_format(ea.datetime,'%d-%b-%Y %h:%i:%s%p') as date,et.name,eu.name as uname,es.subject from erp_assignments ea inner join erp_assignments_cbs eacbs on eacbs.aid=ea.id inner join erp_subjects es on es.id=eacbs.sid left join erp_teachers et on et.tid=ea.uploadby left join erp_users eu on eu.cid=ea.uploadby inner join erp_students est on eacbs.bid=est.batch where est.sid=$id and ea.session=$sessionid group by eacbs.aid order by ea.id desc ");
		$rs=$query->fetchAll(PDO::FETCH_ASSOC);
		return $rs;
	}

	public function getVideoLectures($id){
		$query=$this->conn->query("select distinct subject,subjectid,lc.data from video_lectures vl inner join video_lectures_cbs vlcbs on vlcbs.vl_id=vl.id inner join erp_subjects on vlcbs.subjectid = erp_subjects.id inner join erp_students es on vlcbs.courseid=es.course and vlcbs.batchid=es.batch left join lectures_completed lc on lc.studentid=$id where es.sid=$id");
		$rs=$query->fetchAll(PDO::FETCH_OBJ);
		$data=[];
		$data["watched"]=$rs[0]->data;
		foreach ($rs as $v) {
			$data[$v->subject]=$this->getVideoLecturesBySubject($v->subjectid);
		}
		return $data;
	}	


	public function getVideoLecturesBySubject($subjectid){
		$sql="select vl.title,vl.videoid,vl.type,vl.id,es.subject from video_lectures vl inner join video_lectures_cbs vlcbs on vlcbs.vl_id=vl.id left join erp_subjects es on es.id=vlcbs.subjectid where vlcbs.subjectid=$subjectid";
		$query=$this->conn->query($sql);
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}	

	public function getTimetable($date,$id){
		$query=$this->conn->query("select etr.name ,esub.subject, et.from_time,et.to_time,date_format(et.date,'%d-%m-%Y') as datef,time_format(from_time,'%h:%i %p') as printfrom,time_format(to_time,'%h:%i %p') as printto,et.date from erp_timetable et inner join erp_students es on es.course=et.cid and es.batch=et.bid inner join erp_subjects esub on esub.id=et.subjectid inner join erp_teachers etr on etr.tid=et.tid where et.date='$date' and es.sid=$id");
		$rs=$query->fetchAll(PDO::FETCH_ASSOC);
		return $rs;
	}

	public function getTimetableData($date,$id){
		$month=explode("-", $date)[0];
		$year=explode("-",$date)[1];
		$query=$this->conn->query("select date,count(date) as cnt from erp_timetable inner join erp_students on erp_timetable.cid=erp_students.course and erp_timetable.bid=erp_students.batch where month(date)=$month and year(date)=$year and erp_students.sid=$id group by date");
		$rs=$query->fetchAll(PDO::FETCH_ASSOC);
		return $rs;
	}

	public function getSMS($id){
		$sessionid=$this->getSessionId($id);
		$query=$this->conn->query("select sr.*,date_format(sr.timestamp,'%e-%b-%y %h:%i:%s %p') as smsdate,date_format(sr.examdate,'%e-%b-%y') as examdate,erp_exams.examname from sms_report sr left join erp_exams on erp_exams.id=sr.eid where sr.sid=$id and sr.session=$sessionid order by id desc");
		$rs=$query->fetchAll(PDO::FETCH_ASSOC);
		return $rs;
	}

	public function getAttendance($date,$id){
		$query=$this->conn->query("select date_format(et.datetime,'%e-%b-%y %h:%i:%s %p') as date from erp_attendance et where et.userid=$id and date(et.datetime)='$date'");
		$rs=$query->fetchAll(PDO::FETCH_ASSOC);
		return $rs;
	}

	public function getAttendanceData($date,$id){
		$month=explode("-", $date)[0];
		$year=explode("-",$date)[1];
		$query=$this->conn->query("select date(datetime) as datetime,count(datetime) as cnt from erp_attendance inner join erp_students on erp_attendance.userid=erp_students.sid where month(datetime)=$month and year(datetime)=$year and erp_students.sid=$id group by date(datetime)");
		$rs=$query->fetchAll(PDO::FETCH_ASSOC);
		return $rs;
	}

	public function getHomework($id){
		$bid=$this->getProfile($id)["bid"];
		$sessionid=$this->getSessionId($id);
		$query=$this->conn->query("SELECT esub.subject,esc.chapter,eh.id,ehl.id as innerid,date_format(eh.datetime,'%d-%b-%Y %h:%i:%s%p') as datetime,group_concat(ehl.lectureno,'-',ehl.exercise,'-',ehl.questions separator '=') as data from erp_homework eh inner join erp_homework_lectures ehl on ehl.homeworkid=eh.id left join erp_subjects esub on esub.id=eh.subjectid left join erp_subject_chapter esc on esc.id=eh.chapterid where eh.batchid=$bid and eh.session=$sessionid group by eh.id");
		$rs=$query->fetchAll(PDO::FETCH_ASSOC);
		return $rs;
	}

	public function postVideoLectures(){
		$data=$_POST;
		$query=$this->conn->query("select id,data from lectures_completed where studentid=$data[id]");
		$rs=$query->fetch(PDO::FETCH_OBJ);
		if(empty($rs)){
			$this->conn->query("insert into lectures_completed(studentid,data) values('$data[id]','$data[vid]')");
		}
		else{
			$str=$rs->data;
			$arr=explode(",",$str);
			if(in_array($data["vid"], $arr)){
				$temp=[];
				foreach($arr as $a){
					if($a==$data["vid"])continue;
						$temp[]=$a;
				}
				$str=join($temp,",");	
				$this->conn->query("update lectures_completed set data='$str' where studentid=$data[id]");
			}
			else{
				$conc=$rs->data==""?"concat(data,'$data[vid]')":"concat(data,',','$data[vid]')";
				$this->conn->query("update lectures_completed set data=$conc where studentid=$data[id]");
			}
		}
		return ["message"=>"Status Changed Successfully"];
	}

}
?>