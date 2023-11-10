<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Records extends CI_Model {
public function getimagesgallery(){
$query=$this->db->query("select * from cms_images group by category");
return $query->result();
}

public function getimagesgallerybycategory($category){
$query=$this->db->query("select * from cms_images where category='$category' ");
return $query->result();
}
public function getVideoGallery(){
$query=$this->db->query("select * from cms_videos");
return $query->result();
}

public function getSlideshow(){
$query=$this->db->query("select * from cms_slideshow order by id desc");
$rs=$query->result();
return $rs;	
}
public function getToppers(){
$query=$this->db->query("select * from cms_toppers order by id desc");
$rs=$query->result();
return $rs;	
}
public function getresultsjunior(){
$query=$this->db->query("select * from cms_results where category='junior' order by id desc");
$rs=$query->result();
return $rs;	
}
public function getresultssenior(){
$query=$this->db->query("select * from cms_results where category='senior' order by id desc");
$rs=$query->result();
return $rs;
}
public function getresultscbse(){
$query=$this->db->query("select * from cms_results where category='cbse' order by id desc");
$rs=$query->result();
return $rs;	
}
public function getFeatures(){
$query=$this->db->query("select * from cms_features order by id desc");
$rs=$query->result();
return $rs;	
}
public function getShowCase(){
$query=$this->db->query("select * from cms_showcase order by id desc");
$rs=$query->row();
return $rs;	
}
public function getFaculty(){
$query=$this->db->query("select * from cms_teachers order by id");
$rs=$query->result();
return $rs;	
}
public function getTestimonials($category="s"){
$query=$this->db->query("select * from cms_testimonials where category='$category' order by id desc");
$rs=$query->result();
return $rs;	
}
public function getEvents(){
$query=$this->db->query("select *,substr(description,1,100) as description,date_format(datetime,'%d-%m-%y') as dat,date_format(datetime,'%h:%i:%s%p') as tim from cms_events order by id desc");
$rs=$query->result();
return $rs;	
}
public function getEventSingle($id){
$query=$this->db->query("select *,date_format(datetime,'%d-%m-%y') as dat,date_format(datetime,'%h:%i:%s%p') as tim from cms_events where id=\"$id\"");
$rs=$query->row();
return $rs;	
}


public function getNews(){
$query=$this->db->query("select *,substr(description,1,100) as description,date_format(datetime,'%d-%m-%y') as dat,date_format(datetime,'%h:%i:%s%p') as tim,date_format(datetime,'%d') as d,date_format(datetime,'%M') as m from cms_news order by id desc");
$rs=$query->result();
return $rs;	
}
public function getNewsSingle($id){
$query=$this->db->query("select *,date_format(datetime,'%d-%m-%y') as dat,date_format(datetime,'%h:%i:%s%p') as tim from cms_news where id=\"$id\"");
$rs=$query->row();
return $rs;	
}


public function getRecentNews(){
$query=$this->db->query("select *,substr(description,1,30) as description from cms_news order by id desc limit 3");
$rs=$query->result();
return $rs;	
}

public function printBatchesByCourseId($cid){
	$query=$this->db->query("select eb.batch,eb.batchId from erp_batches eb where courseId=$cid");
	$rs=$query->result();
	foreach ($rs as $v) {
		echo "<option value='$v->batchId'>$v->batch</option>";
	}
}

}
?>