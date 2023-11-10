<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get extends CI_Model {

public function slideshow(){
$query=$this->db->query("select * from cms_slideshow order by id desc");
return $query->result();
}
public function getslideshowbyid($id){
$query=$this->db->query("select * from cms_slideshow where id=$id");
return $query->row();
}

public function printslideshow(){
	echo "<table class='sc-table'>
						<tr><th>Image</th><th>Title</th><th>Description</th><th>Button 1</th><th>Button 2</th><th>Edit</th><th>Delete</th></tr>";
				 foreach ($this->slideshow() as $v) {
					echo "<tr><td style='width:100px;padding:2px'><img src='".base_url()."$v->image' class='thumbnail-img'></td><td>$v->title</td><td>$v->description</td><td>$v->b1name</td><td>$v->b2name</td><td><a href='".base_url()."cms/editslideshow/$v->id'><i class='fa fa-pencil'></i></a></td><td><i class='fa fa-close' onclick='deleteSlideshow($v->id,this)'></i></td></tr>";
				} 
echo "</table>";
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


public function topper(){
$query=$this->db->query("select * from cms_toppers order by id desc");
return $query->result();
}
public function gettopperbyid($id){
$query=$this->db->query("select * from cms_toppers where id=$id");
return $query->row();
}
public function printtoppers(){
	echo "<table class='sc-table'>
						<tr><th>Image</th><th>Name</th><th>Class Details</th><th>Marks</th><th>Edit</th><th>Delete</th></tr>";
				 foreach ($this->topper() as $v) {
					echo "<tr><td style='width:100px;padding:2px'><img src='".base_url()."$v->image' class='thumbnail-img'></td><td>$v->name</td><td>$v->classdetails</td><td>$v->marks</td><td><a href='".base_url()."cms/edittopper/$v->id'><i class='fa fa-pencil'></i></a></td><td><i class='fa fa-close' onclick='deleteTopper($v->id,this)'></i></td></tr>";
				} 
echo "</table>";
}
public function resultjunior(){
$query=$this->db->query("select * from cms_results where category='junior' order by id desc");
return $query->result();
}
public function getresultjuniorbyid($id){
$query=$this->db->query("select * from cms_results where id=$id");
return $query->row();
}
public function printresultsjunior(){
	echo "<table class='sc-table'>
						<tr><th>Image</th><th>Name</th><th>Class Details</th><th>Marks</th><th>Edit</th><th>Delete</th></tr>";
				 foreach ($this->resultjunior() as $v) {
					echo "<tr><td style='width:100px;padding:2px'><img src='".base_url()."$v->image' class='thumbnail-img'></td><td>$v->name</td><td>$v->classdetails</td><td>$v->marks</td><td><a href='".base_url()."cms/editresultjunior/$v->id'><i class='fa fa-pencil'></i></a></td><td><i class='fa fa-close' onclick='deleteResultsJunior($v->id,this)'></i></td></tr>";
				} 
echo "</table>";
}
public function resultsenior(){
$query=$this->db->query("select * from cms_results where category='senior' order by id desc");
return $query->result();
}
public function getresultseniorbyid($id){
$query=$this->db->query("select * from cms_results_senior where id=$id");
return $query->row();
}
public function printresultssenior(){
	echo "<table class='sc-table'>
						<tr><th>Image</th><th>Name</th><th>Class Details</th><th>Marks</th><th>Edit</th><th>Delete</th></tr>";
				 foreach ($this->resultsenior() as $v) {
					echo "<tr><td style='width:100px;padding:2px'><img src='".base_url()."$v->image' class='thumbnail-img'></td><td>$v->name</td><td>$v->classdetails</td><td>$v->marks</td><td><a href='".base_url()."cms/editresultsenior/$v->id'><i class='fa fa-pencil'></i></a></td><td><i class='fa fa-close' onclick='deleteResultsSenior($v->id,this)'></i></td></tr>";
				} 
echo "</table>";
}
public function resultcbse(){
$query=$this->db->query("select * from cms_results where category='cbse' order by id desc");
return $query->result();
}
public function getresultcbsebyid($id){
$query=$this->db->query("select * from cms_results_cbse where id=$id");
return $query->row();
}
public function printresultscbse(){
	echo "<table class='sc-table'>
						<tr><th>Image</th><th>Name</th><th>Class Details</th><th>Marks</th><th>Edit</th><th>Delete</th></tr>";
				 foreach ($this->resultcbse() as $v) {
					echo "<tr><td style='width:100px;padding:2px'><img src='".base_url()."$v->image' class='thumbnail-img'></td><td>$v->name</td><td>$v->classdetails</td><td>$v->marks</td><td><a href='".base_url()."cms/editresultcbse/$v->id'><i class='fa fa-pencil'></i></a></td><td><i class='fa fa-close' onclick='deleteResultsCbse($v->id,this)'></i></td></tr>";
				} 
echo "</table>";
}
public function feature(){
$query=$this->db->query("select * from cms_features order by id desc");
return $query->result();
}
public function getfeaturebyid($id){
$query=$this->db->query("select * from cms_features where id=$id");
return $query->row();
}
public function printfeatures(){
	echo "<table class='sc-table'>
						<tr><th>Image</th><th>Title</th><th>Description</th><th>Edit</th><th>Delete</th></tr>";
				 foreach ($this->feature() as $v) {
					echo "<tr><td style='width:100px;padding:2px'><img src='".base_url()."$v->image' class='thumbnail-img'></td><td>$v->title</td><td>$v->description</td><td><a href='".base_url()."cms/editfeature/$v->id'><i class='fa fa-pencil'></i></a></td><td><i class='fa fa-close' onclick='deletefeature($v->id,this)'></i></td></tr>";
				} 
echo "</table>";
}


public function showcase(){
	$query=$this->db->query("select * from cms_showcase");
	return $query->row();
}

public function teacher(){
$query=$this->db->query("select * from cms_teachers order by id desc");
return $query->result();
}
public function getteacherbyid($id){
$query=$this->db->query("select * from cms_teachers where id=$id");
return $query->row();
}
public function printteachers(){
	echo "<table class='sc-table'>
						<tr><th>Image</th><th>Name</th><th>Designation</th><th>Description</th><th>Edit</th><th>Delete</th></tr>";
				 foreach ($this->teacher() as $v) {
					echo "<tr><td style='width:100px;padding:2px'><img src='".base_url()."$v->image' class='thumbnail-img'></td><td>$v->name</td><td>$v->designation</td><td>$v->description</td><td><a href='".base_url()."cms/editteacher/$v->id'><i class='fa fa-pencil'></i></a></td><td><i class='fa fa-close' onclick='deleteTeacher($v->id,this)'></i></td></tr>";
				} 
echo "</table>";
}

public function testimonial(){
$query=$this->db->query("select * from cms_testimonials order by id desc");
return $query->result();
}
public function gettestimonialbyid($id){
$query=$this->db->query("select * from cms_testimonials where id=$id");
return $query->row();
}
public function printtestimonials(){
	echo "<table class='sc-table'>
						<tr><th>Image</th><th>Name</th><th>Description</th><th>Category</th><th>Edit</th><th>Delete</th></tr>";
				 foreach ($this->testimonial() as $v) {
				 	if($v->category=="s"){$category="Student";}else{$category="Parent";}
					echo "<tr><td style='width:100px;padding:2px'><img src='".base_url()."$v->image' class='thumbnail-img'></td><td>$v->name</td><td>$v->description</td><td>$category</td><td><a href='".base_url()."cms/edittestimonial/$v->id'><i class='fa fa-pencil'></i></a></td><td><i class='fa fa-close' onclick='deleteTestimonial($v->id,this)'></i></td></tr>";
				} 
echo "</table>";
}

public function event(){
$query=$this->db->query("select *,substr(description,1,20) as description,date_format(datetime,'%d-%m-%y %h:%i:%s%p') as datetime from cms_events order by id desc");
return $query->result();
}
public function geteventbyid($id){
$query=$this->db->query("select * from cms_events where id=$id");
return $query->row();
}
public function printevents(){
	echo "<table class='sc-table'>
						<tr><th>Image</th><th>Title</th><th>Description</th><th>Date</th><th>Edit</th><th>Delete</th></tr>";
				 foreach ($this->event() as $v) {
					echo "<tr><td style='width:100px;padding:2px'><img src='".base_url()."$v->image' class='thumbnail-img'></td><td>$v->title</td><td>$v->description</td><td>$v->datetime</td><td><a href='".base_url()."cms/editevent/$v->id'><i class='fa fa-pencil'></i></a></td><td><i class='fa fa-close' onclick='deleteEvent($v->id,this)'></i></td></tr>";
				} 
echo "</table>";
}


public function news(){
$query=$this->db->query("select *,substr(description,1,20) as description,date_format(datetime,'%d-%m-%y %h:%i:%s%p') as datetime  from cms_news order by id desc");
return $query->result();
}
public function getnewsbyid($id){
$query=$this->db->query("select * from cms_news where id=$id");
return $query->row();
}
public function printnews(){
	echo "<table class='sc-table'>
						<tr><th>Image</th><th>Title</th><th>Description</th><th>Date</th><th>Edit</th><th>Delete</th></tr>";
				 foreach ($this->news() as $v) {
					echo "<tr><td style='width:100px;padding:2px'><img src='".base_url()."$v->image' class='thumbnail-img'></td><td>$v->title</td><td>$v->description</td><td>$v->datetime</td><td><a href='".base_url()."cms/editnews/$v->id'><i class='fa fa-pencil'></i></a></td><td><i class='fa fa-close' onclick='deletenews($v->id,this)'></i></td></tr>";
				} 
echo "</table>";
}

public function faqs(){
$query=$this->db->query("select *,substr(answer,1,20) as answer from cms_faqs order by id desc");
return $query->result();
}
public function getfaqsbyid($id){
$query=$this->db->query("select * from cms_faqs where id=$id");
return $query->row();
}
public function printfaqs(){
	echo "<table class='sc-table'>
						<tr><th>Question</th><th>Answer</th><th>Edit</th><th>Delete</th></tr>";
				 foreach ($this->faqs() as $v) {
					echo "<tr><td>$v->question</td><td>$v->answer</td><td><a href='".base_url()."cms/editfaqs/$v->id'><i class='fa fa-pencil'></i></a></td><td><i class='fa fa-close' onclick='deletefaqs($v->id,this)'></i></td></tr>";
				} 
echo "</table>";
}


public function images(){
$query=$this->db->query("select * from cms_images order by id desc");
return $query->result();
}
public function getimagesbyid($id){
$query=$this->db->query("select * from cms_images where id=$id");
return $query->row();
}

public function printimages(){
	echo "<table class='sc-table'>
						<tr><th>Image</th><th>Category</th><th>Delete</th></tr>";
				 foreach ($this->images() as $v) {
					echo "<tr><td style='width:100px;padding:2px'><img src='".base_url()."$v->image' class='thumbnail-img'></td><td>$v->category</td><td><i class='fa fa-close' onclick='deleteImage($v->id,this)'></i></td></tr>";
				} 
echo "</table>";
}



public function videos(){
$query=$this->db->query("select * from cms_videos order by id desc");
return $query->result();
}
public function getvideosbyid($id){
$query=$this->db->query("select * from cms_videos where id=$id");
return $query->row();
}
public function printvideos(){
	echo "<table class='sc-table'>
						<tr><th>Title</th><th>Link</th><th>Delete</th></tr>";
				 foreach ($this->videos() as $v) {
					echo "<tr><td>$v->title</td><td>$v->link</td><td><i class='fa fa-close' onclick='deleteVideo($v->id,this)'></i></td></tr>";
				} 
echo "</table>";
}

}
?>