<?php
class Ranks
{
    private $CI;
 
    function __construct()
    {
        $this->CI = get_instance();
    }
 
    public function getRank($eid,$subjectid,$marks){
		$que="select exm.marks from erp_exam_marks exm 
		where exm.eid=$eid and exm.subjectid=$subjectid 
		order by marks desc ";
		$query=$this->CI->db->query($que);
		
		$result=$query->result();
		for($i=0;$i<count($result);$i++){
			if($result[$i]->marks==$marks){
				return $i+1;
			}
		}
	}
	
	public function getOverAllRank($eid,$marks){
		$query=$this->CI->db->query("select sum(marks) as marks 
		from erp_exam_marks where eid=$eid group by studentid
		order by marks desc");
		$arr=$query->result();
		for($i=0;$i<count($arr);$i++){
			if($arr[$i]->marks==$marks){
				return $i+1;
			}
		}
	}
}

?>