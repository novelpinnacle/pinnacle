<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Getcommon extends CI_Model {

	function getSMS($userid){

		$query=$this->db->query("select  date_format(tm.datetime,'%d-%b-%Y %h:%i:%s%p') as date,tm.message,tm.sender from text_messages tm inner join text_messages_recipients tmr on tmr.tmid=tm.id where (tm.sender=$_SESSION[userid] and tmr.userid=$userid) or (tm.sender=$userid and tmr.userid=$_SESSION[userid]) order by tm.id desc");
		$rs=$query->result();
		foreach ($rs as $v) {
			$class='rec-sms';
			if($v->sender==$_SESSION['userid']){
				$class='sent-sms';
			}
			echo "<div class='$class'>$v->message <span>$v->date</span></div>";
		}
	}

	function getGroupSMS($batchid){

		$query=$this->db->query("select  date_format(tm.datetime,'%d-%b-%Y %h:%i:%s%p') as date,tm.message,tm.sender from text_messages tm where tm.batchid=$batchid and tm.sender=$_SESSION[userid] order by tm.id desc");
		$rs=$query->result();
		foreach ($rs as $v) {
			$class='rec-sms';
			if($v->sender==$_SESSION['userid']){
				$class='sent-sms';
			}
			echo "<div class='$class'>$v->message <span>$v->date</span></div>";
		}
	}


	 function getChats($userid){
		$query=$this->db->query("update chat_recipients set status=1 where userid=$_SESSION[userid] and chatid in(select id from chat where sender=$userid)");
		$query=$this->db->query("select distinct c.id,date_format(c.datetime,'%d-%b-%Y %h:%i:%s%p') as date,c.message,c.sender from chat c inner join chat_recipients cr on cr.chatid=c.id where (c.sender=$_SESSION[userid] and cr.userid=$userid) or (c.sender=$userid and cr.userid=$_SESSION[userid]) order by c.id desc");
		$rs=$query->result();
		foreach ($rs as $v) {
			$class='rec-sms';
			if($v->sender==$_SESSION['userid']){
				$class='sent-sms';
			}
			echo "<div class='$class'>$v->message <span>$v->date</span></div>";
		}
	}

	function getGroupChats($batchid){
		$query=$this->db->query("select date_format(datetime,'%d-%b-%Y %h:%i:%s%p') as date,message,sender from chat where batchid=$batchid and sender=$_SESSION[userid] order by id desc");
		$rs=$query->result();
		foreach ($rs as $v) {
			$class='rec-sms';
			if($v->sender==$_SESSION['userid']){
				$class='sent-sms';
			}
			echo "<div class='$class'>$v->message <span>$v->date</span></div>";
		}
	}

	function getLiveChatsCount($sids){
		$sids=explode(",", $sids);
		$ids="";
		foreach ($sids as $sid) {
			$ids.="'$sid',";
		}
		$ids=rtrim($ids,",");
		$query=$this->db->query("SELECT c.sender,count(cr.userid) as cnt from chat_recipients cr inner join chat c on cr.chatid=c.id where c.sender in ($ids) and cr.status=0 and cr.userid=$_SESSION[userid] group by c.sender");
		return $query->result();
	}


	function getLiveChatsOfAll(){
		$query=$this->db->query("select es.name,es.rollno,ec.course,eb.batch,es.sid,count(cr.status) as cnt from erp_students es inner join chat c on c.sender=es.sid inner JOIN chat_recipients cr on cr.chatid=c.id inner join erp_courses ec on ec.id=es.course inner join erp_batches eb on eb.id=es.batch where cr.status=0 and cr.userid=$_SESSION[userid] group by es.sid");
		$rs=$query->result();
		if(empty($rs)){
			
		}
		foreach ($rs as $v) {
			echo "<div data-sid='$v->sid' class='chat-thumb' onclick='openChat($v->sid,\"$v->name [$v->course - $v->batch]\")'>$v->name <div class='chat-cb' onclick='event.stopPropagation();this.parentElement.click()'> $v->course - $v->batch </div> <div class='chat-roll' onclick='event.stopPropagation();this.parentElement.click()'>$v->rollno</div> <div class='chat-count'>$v->cnt</div> </div>";
		}

		$query=$this->db->query("select et.name,et.tid as id,count(cr.status) as cnt from erp_teachers et inner join chat c on c.sender=et.tid inner JOIN chat_recipients cr on cr.chatid=c.id where cr.status=0 and cr.userid=$_SESSION[userid] group by et.tid union select eu.name,eu.cid as id,count(cr.status) as cnt from erp_users eu inner join chat c on c.sender=eu.cid inner JOIN chat_recipients cr on cr.chatid=c.id where cr.status=0 and cr.userid=$_SESSION[userid] group by eu.cid union  select 'Admin' as name,lg.id as id,count(cr.status) as cnt from login lg inner join chat c on c.sender=lg.id inner join chat_recipients cr on cr.chatid=c.id where cr.status=0 and cr.userid=$_SESSION[userid] and lg.username='pinnacle' group by lg.id ");
		$rs2=$query->result();
		if(empty($rs2) && empty($rs)){
			echo "no";
		}
		
		foreach ($rs2 as $v) {
			echo "<div data-sid='$v->id' class='chat-thumb ut' onclick='openChat($v->id,\"$v->name\")'>$v->name <div class='chat-count'>$v->cnt</div> </div>";
		}

	}

	function getStudentsByBatch($bid){
		$query=$this->db->query("select es.sid,es.rollno,es.phone,es.fmobile,es.name,ec.course,eb.batch from erp_students es inner join erp_courses ec on ec.id=es.course inner join erp_batches eb on eb.id=es.batch where es.batch='$bid'");
		foreach ($query->result() as $v) {
			echo "<div data-sid='$v->sid' class='chat-thumb' onclick='openChat($v->sid,\"$v->name [$v->course - $v->batch]\",\"$v->phone\",\"$v->fmobile\")'>$v->name <div class='chat-cb' onclick='event.stopPropagation();this.parentElement.click()'> $v->course - $v->batch </div> <div class='chat-roll' onclick='event.stopPropagation();this.parentElement.click()'>$v->rollno</div> </div>";
		}
	}

}
?>