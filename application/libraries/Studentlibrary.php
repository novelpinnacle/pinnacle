<?php
class Studentlibrary
{
    private $CI;
 
    function __construct()
    {
        $this->CI = get_instance();
    }
 	
 	public function getSubjectMarks($eid){
 		$sql="SELECT exm.eid,exs.totalmarks,esub.subject,exm.studentid,exm.subjectid,exm.marks,exm.correct,exm.wrong from erp_exam_marks exm inner join erp_subjects esub on esub.id=exm.subjectid inner join erp_exam_subjects exs on exs.sid=exm.subjectid where exm.studentid='$_SESSION[userid]' and exm.eid=$eid group by exm.subjectid";
 		$query=$this->CI->db->query($sql);
 		$result=$query->result();
 		return $result;

 	}
}

?>