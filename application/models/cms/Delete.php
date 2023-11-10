<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete extends CI_Model {

public function slideshow($id){
$query=$this->db->query("select * from cms_slideshow where id=$id");
$rs=$query->row();
if($rs){
	if(file_exists($rs->image)){
		unlink($rs->image);
	}
	$this->db->where("id",$id);
	$this->db->delete("cms_slideshow");
}
}

public function topper($id){
$query=$this->db->query("select * from cms_toppers where id=$id");
$rs=$query->row();
if($rs){
	if(file_exists($rs->image)){
		unlink($rs->image);
	}
	$this->db->where("id",$id);
	$this->db->delete("cms_toppers");
}
}
public function resultjunior($id){
$query=$this->db->query("select * from cms_results_junior where id=$id");
$rs=$query->row();
if($rs){
	if(file_exists($rs->image)){
		unlink($rs->image);
	}
	$this->db->where("id",$id);
	$this->db->delete("cms_results_junior");
}
}
public function resultsenior($id){
$query=$this->db->query("select * from cms_results_senior where id=$id");
$rs=$query->row();
if($rs){
	if(file_exists($rs->image)){
		unlink($rs->image);
	}
	$this->db->where("id",$id);
	$this->db->delete("cms_results_senior");
}
}
public function resultcbse($id){
$query=$this->db->query("select * from cms_results_cbse where id=$id");
$rs=$query->row();
if($rs){
	if(file_exists($rs->image)){
		unlink($rs->image);
	}
	$this->db->where("id",$id);
	$this->db->delete("cms_results_cbse");
}
}
public function feature($id){
$query=$this->db->query("select * from cms_features where id=$id");
$rs=$query->row();
if($rs){
	if(file_exists($rs->image)){
		unlink($rs->image);
	}
		$this->db->where("id",$id);
		$this->db->delete("cms_features");
}
}


public function teacher($id){
$query=$this->db->query("select * from cms_teachers where id=$id");
$rs=$query->row();
if($rs){
	if(file_exists($rs->image)){
		unlink($rs->image);
	}
	$this->db->where("id",$id);
	$this->db->delete("cms_teachers");
}
}


public function testimonial($id){
$query=$this->db->query("select * from cms_testimonials where id=$id");
$rs=$query->row();
if($rs){
	if(file_exists($rs->image)){
		unlink($rs->image);
	}
		$this->db->where("id",$id);
		$this->db->delete("cms_testimonials");
}
}

public function event($id){
$query=$this->db->query("select * from cms_events where id=$id");
$rs=$query->row();
if($rs){
	if(file_exists($rs->image)){
		unlink($rs->image);
	}
	$this->db->where("id",$id);
	$this->db->delete("cms_events");
}
}

public function news($id){
$query=$this->db->query("select * from cms_news where id=$id");
$rs=$query->row();
if($rs){
	if(file_exists($rs->image)){
		unlink($rs->image);
	}
	$this->db->where("id",$id);
	$this->db->delete("cms_news");
}
}

public function faqs($id){
	$this->db->where('id',$id);
	$this->db->delete("cms_faqs");
}

public function images($id){
$query=$this->db->query("select * from cms_images where id=$id");
$rs=$query->row();
if($rs){
	if(file_exists($rs->image)){
		unlink($rs->image);
	}
	$this->db->where("id",$id);
	$this->db->delete("cms_images");
}
}
public function videos($id){
$this->db->where('id',$id);
$this->db->delete("cms_videos");
}


}
?>