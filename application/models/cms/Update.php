<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Model {

	public function __construct(){
		if(isset($_FILES["image"]["name"])){
			$filename=str_replace("'", "", $_FILES["image"]["name"]);
			$filename=str_replace('"', "", $filename);
			$_FILES["image"]["name"]=$filename;
		}
	}

	public function getRenamedImage($img){
	    $directory=dirname($img)."/";
	    $file=basename($img);
	    $pos=strrpos($file,".");
	    $filename= substr($file,0,$pos)."-". rand(10000,999999);
	    $extension=substr($file, $pos);
	    return $directory.$filename.$extension;
	}

public function toggleSections($section){
	$this->db->where("section",$section);
	$query=$this->db->get("cms_toggle");
	$rs=$query->row();
	$status=$rs->status;
	if($status==0){
		$status=1;
	}
	else{
		$status=0;
	}
	$this->db->where("section",$section);
	$this->db->update("cms_toggle",["status"=>$status]);
}

public function slideshow($data){
extract($data);
	$target_dir = "uploads/slideshow/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);
   	
   	if(!empty($_FILES["image"]["name"])){

		$check = getimagesize($_FILES["image"]["tmp_name"]);
	    if($check == false) {
	        return ["message"=>"<span class='w3-text-red'>File is not an image</span>","status"=>"failed","newimg"=>""];
	    }

	    if (file_exists($target_file)) {
	   		$target_file=$this->getRenamedImage($target_file);
		}

		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			
			 $CI =& get_instance();
			 $CI->load->model("admin/cms/get");
			 $old=$this->get->getslideshowbyid($sid);
			 $oldfile=$old->image;
			 if(file_exists($oldfile)){unlink($oldfile);}
			 $data["image"]=$target_file;
			 return $this->updateSlideshowData($data);

	    } else {
	       return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed","newimg"=>""];
	    }


	}else{
		return $this->updateSlideshowData($data);
	}
}
	public function updateSlideshowData($data){
		$this->db->where("id",$data["sid"]);
		unset($data["sid"]);
		$this->db->update("cms_slideshow",$data);
		$newimg="";
		if(isset($data["image"])){$newimg=$data["image"];}
		return ["message"=>"<span class='w3-text-green'>Slideshow Updated Successfully</span>","status"=>"ok","newimg"=>$newimg];
	}



public function topper($data){
extract($data);
	$target_dir = "uploads/toppers/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);
   	
   	if(!empty($_FILES["image"]["name"])){

		$check = getimagesize($_FILES["image"]["tmp_name"]);
	    if($check == false) {
	        return ["message"=>"<span class='w3-text-red'>File is not an image</span>","status"=>"failed","newimg"=>""];
	    }

	    if (file_exists($target_file)) {
	    	$target_file=$this->getRenamedImage($target_file);
		}

		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			
			 $CI =& get_instance();
			 $CI->load->model("admin/cms/get");
			 $old=$this->get->gettopperbyid($tid);
			 $oldfile=$old->image;
			 if(file_exists($oldfile)){unlink($oldfile);}
			 $data["image"]=$target_file;
			 return $this->updateTopperData($data);

	    } else {
	       return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed","newimg"=>""];
	    }


	}else{
		return $this->updateTopperData($data);
	}
}
	public function updateTopperData($data){
		$this->db->where("id",$data["tid"]);
		unset($data["tid"]);
		$this->db->update("cms_toppers",$data);
		$newimg="";
		if(isset($data["image"])){$newimg=$data["image"];}
		return ["message"=>"<span class='w3-text-green'>Topper Updated Successfully</span>","status"=>"ok","newimg"=>$newimg];
	}

public function resultjunior($data){
extract($data);
	$target_dir = "uploads/resultsjunior/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);
   	
   	if(!empty($_FILES["image"]["name"])){

		$check = getimagesize($_FILES["image"]["tmp_name"]);
	    if($check == false) {
	        return ["message"=>"<span class='w3-text-red'>File is not an image</span>","status"=>"failed","newimg"=>""];
	    }

	    if (file_exists($target_file)) {
	    	$target_file=$this->getRenamedImage($target_file);
		}

		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			
			 $CI =& get_instance();
			 $CI->load->model("admin/cms/get");
			 $old=$this->get->getresultjuniorbyid($tid);
			 $oldfile=$old->image;
			 if(file_exists($oldfile)){unlink($oldfile);}
			 $data["image"]=$target_file;
			 return $this->updateresultsjuniorData($data);

	    } else {
	       return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed","newimg"=>""];
	    }


	}else{
		return $this->updateresultsjuniorData($data);
	}
}
	public function updateresultsjuniorData($data){
		$this->db->where("id",$data["tid"]);
		unset($data["tid"]);
		$this->db->update("cms_results_junior",$data);
		$newimg="";
		if(isset($data["image"])){$newimg=$data["image"];}
		return ["message"=>"<span class='w3-text-green'>Junior Topper Updated Successfully</span>","status"=>"ok","newimg"=>$newimg];
	}
public function resultsenior($data){
extract($data);
	$target_dir = "uploads/resultssenior/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);
   	
   	if(!empty($_FILES["image"]["name"])){

		$check = getimagesize($_FILES["image"]["tmp_name"]);
	    if($check == false) {
	        return ["message"=>"<span class='w3-text-red'>File is not an image</span>","status"=>"failed","newimg"=>""];
	    }

	    if (file_exists($target_file)) {
	    	$target_file=$this->getRenamedImage($target_file);
		}

		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			
			 $CI =& get_instance();
			 $CI->load->model("admin/cms/get");
			 $old=$this->get->getresultseniorbyid($tid);
			 $oldfile=$old->image;
			 if(file_exists($oldfile)){unlink($oldfile);}
			 $data["image"]=$target_file;
			 return $this->updateresultsseniorData($data);

	    } else {
	       return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed","newimg"=>""];
	    }


	}else{
		return $this->updateresultsseniorData($data);
	}
}
	public function updateresultsseniorData($data){
		$this->db->where("id",$data["tid"]);
		unset($data["tid"]);
		$this->db->update("cms_results_senior",$data);
		$newimg="";
		if(isset($data["image"])){$newimg=$data["image"];}
		return ["message"=>"<span class='w3-text-green'>Senior Topper Updated Successfully</span>","status"=>"ok","newimg"=>$newimg];
	}
public function resultcbse($data){
extract($data);
	$target_dir = "uploads/resultscbse/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);
   	
   	if(!empty($_FILES["image"]["name"])){

		$check = getimagesize($_FILES["image"]["tmp_name"]);
	    if($check == false) {
	        return ["message"=>"<span class='w3-text-red'>File is not an image</span>","status"=>"failed","newimg"=>""];
	    }

	    if (file_exists($target_file)) {
	    	$target_file=$this->getRenamedImage($target_file);
		}

		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			
			 $CI =& get_instance();
			 $CI->load->model("admin/cms/get");
			 $old=$this->get->getresultcbsebyid($tid);
			 $oldfile=$old->image;
			 if(file_exists($oldfile)){unlink($oldfile);}
			 $data["image"]=$target_file;
			 return $this->updateresultscbseData($data);

	    } else {
	       return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed","newimg"=>""];
	    }


	}else{
		return $this->updateresultscbseData($data);
	}
}
	public function updateresultscbseData($data){
		$this->db->where("id",$data["tid"]);
		unset($data["tid"]);
		$this->db->update("cms_results_cbse",$data);
		$newimg="";
		if(isset($data["image"])){$newimg=$data["image"];}
		return ["message"=>"<span class='w3-text-green'>CBSE Topper Updated Successfully</span>","status"=>"ok","newimg"=>$newimg];
	}
	public function feature($data){
extract($data);
	$target_dir = "uploads/features/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);
   	
   	if(!empty($_FILES["image"]["name"])){

		$check = getimagesize($_FILES["image"]["tmp_name"]);
	    if($check == false) {
	        return ["message"=>"<span class='w3-text-red'>File is not an image</span>","status"=>"failed","newimg"=>""];
	    }

	    if (file_exists($target_file)) {
	    	$target_file=$this->getRenamedImage($target_file);
		}

		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			
			 $CI =& get_instance();
			 $CI->load->model("admin/cms/get");
			 $old=$this->get->getfeaturebyid($fid);
			 $oldfile=$old->image;
			 if(file_exists($oldfile)){unlink($oldfile);}
			 $data["image"]=$target_file;
			 return $this->updatefeatureData($data);

	    } else {
	       return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed","newimg"=>""];
	    }


	}else{
		return $this->updatefeatureData($data);
	}
}
	public function updatefeatureData($data){
		$this->db->where("id",$data["fid"]);
		unset($data["fid"]);
		$this->db->update("cms_features",$data);
		$newimg="";
		if(isset($data["image"])){$newimg=$data["image"];}
		return ["message"=>"<span class='w3-text-green'>Feature Updated Successfully</span>","status"=>"ok","newimg"=>$newimg];
	}



	public function teacher($data){
extract($data);
	$target_dir = "uploads/teachers/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);
   	
   	if(!empty($_FILES["image"]["name"])){

		$check = getimagesize($_FILES["image"]["tmp_name"]);
	    if($check == false) {
	        return ["message"=>"<span class='w3-text-red'>File is not an image</span>","status"=>"failed","newimg"=>""];
	    }

	    if (file_exists($target_file)) {
	    	$target_file=$this->getRenamedImage($target_file);
		}

		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			
			 $CI =& get_instance();
			 $CI->load->model("admin/cms/get");
			 $old=$this->get->getteacherbyid($tid);
			 $oldfile=$old->image;
			 if(file_exists($oldfile)){unlink($oldfile);}
			 $data["image"]=$target_file;
			 return $this->updateteacherData($data);

	    } else {
	       return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed","newimg"=>""];
	    }


	}else{
		return $this->updateteacherData($data);
	}
}
	public function updateteacherData($data){
		$this->db->where("id",$data["tid"]);
		unset($data["tid"]);
		$this->db->update("cms_teachers",$data);
		$newimg="";
		if(isset($data["image"])){$newimg=$data["image"];}
		return ["message"=>"<span class='w3-text-green'>Teacher Updated Successfully</span>","status"=>"ok","newimg"=>$newimg];
	}

	public function testimonial($data){
extract($data);
	$target_dir = "uploads/testimonials/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);
   	
   	if(!empty($_FILES["image"]["name"])){

		$check = getimagesize($_FILES["image"]["tmp_name"]);
	    if($check == false) {
	        return ["message"=>"<span class='w3-text-red'>File is not an image</span>","status"=>"failed","newimg"=>""];
	    }

	    if (file_exists($target_file)) {
	    	$target_file=$this->getRenamedImage($target_file);
		}

		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			
			 $CI =& get_instance();
			 $CI->load->model("admin/cms/get");
			 $old=$this->get->gettestimonialbyid($tid);
			 $oldfile=$old->image;
			 if(file_exists($oldfile)){unlink($oldfile);}
			 $data["image"]=$target_file;
			 return $this->updatetestimonialData($data);

	    } else {
	       return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed","newimg"=>""];
	    }


	}else{
		return $this->updatetestimonialData($data);
	}
}
	public function updatetestimonialData($data){
		$this->db->where("id",$data["tid"]);
		unset($data["tid"]);
		$this->db->update("cms_testimonials",$data);
		$newimg="";
		if(isset($data["image"])){$newimg=$data["image"];}
		return ["message"=>"<span class='w3-text-green'>Testimonial Updated Successfully</span>","status"=>"ok","newimg"=>$newimg];
	}


public function event($data){
extract($data);
	$target_dir = "uploads/events/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);
   	  $target_file=urldecode($target_file);	
   	
   	if(!empty($_FILES["image"]["name"])){

		$check = getimagesize($_FILES["image"]["tmp_name"]);
	    if($check == false) {
	        return ["message"=>"<span class='w3-text-red'>File is not an image</span>","status"=>"failed","newimg"=>""];
	    }

	    if (file_exists($target_file)) {
	    	$target_file=$this->getRenamedImage($target_file);
		}

		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			
			 $CI =& get_instance();
			 $CI->load->model("admin/cms/get");
			 $old=$this->get->geteventbyid($eid);
			 $oldfile=$old->image;
			 if(file_exists($oldfile)){unlink($oldfile);}
			 $data["image"]=$target_file;
			 return $this->updateeventData($data);

	    } else {
	       return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed","newimg"=>""];
	    }


	}else{
		return $this->updateeventData($data);
	}
}
	public function updateeventData($data){
		$this->db->where("id",$data["eid"]);
		unset($data["eid"]);
		$this->db->update("cms_events",$data);
		$newimg="";
		if(isset($data["image"])){$newimg=$data["image"];}
		return ["message"=>"<span class='w3-text-green'>Event Updated Successfully</span>","status"=>"ok","newimg"=>$newimg];
	}



public function news($data){
extract($data);
	$target_dir = "uploads/news/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);
   	 $target_file=urldecode($target_file);	

   	if(!empty($_FILES["image"]["name"])){

		$check = getimagesize($_FILES["image"]["tmp_name"]);
	    if($check == false) {
	        return ["message"=>"<span class='w3-text-red'>File is not an image</span>","status"=>"failed","newimg"=>""];
	    }

	    if (file_exists($target_file)) {
	    	$target_file=$this->getRenamedImage($target_file);
		}

		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			
			 $CI =& get_instance();
			 $CI->load->model("admin/cms/get");
			 $old=$this->get->getnewsbyid($eid);
			 $oldfile=$old->image;
			 if(file_exists($oldfile)){unlink($oldfile);}
			 $data["image"]=$target_file;
			 return $this->updatenewsData($data);

	    } else {
	       return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed","newimg"=>""];
	    }

	}else{
		return $this->updatenewsData($data);
	}
}
	public function updatenewsData($data){
		$this->db->where("id",$data["eid"]);
		unset($data["eid"]);
		$this->db->update("cms_news",$data);
		$newimg="";
		if(isset($data["image"])){$newimg=$data["image"];}
		return ["message"=>"<span class='w3-text-green'>News Updated Successfully</span>","status"=>"ok","newimg"=>$newimg];
	}

	public function faqs($data){
		$this->db->where("id",$data["id"]);
		if($this->db->update("cms_faqs",$data)){
			return ["message"=>"<span class='w3-text-green'>FAQs Updated Successfully</span>","status"=>"ok"];
		}
		else{
			return ["message"=>"<span class='w3-text-red'>Error Occured on Server Side</span>","status"=>"failed"];
		}
	}

	function resizeImage($filename){
		header('Content-Type: image/jpeg');
		list($width, $height) = getimagesize($filename);
		$newwidth =$width*0.40;
		$newheight =$height*0.40;
		// Load
		$thumb = imagecreatetruecolor($newwidth, $newheight);

		$img_atts = pathinfo($filename);
		$type=$img_atts["extension"];
		if($type=="jpg" || $type=="jpeg"){
		$source = imagecreatefromjpeg($filename);
		}
		else if($type=="png"){
		$source = imagecreatefrompng($filename);
		}
		else if($type=="gif"){
		$source = imagecreatefromgif($filename);
		}
		// Resize
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		// Output
		$newname=$img_atts["dirname"]."/small-".$img_atts["filename"].'.'.$img_atts["extension"];
		
		if($type=="jpg" || $type=="jpeg"){
		imagejpeg($thumb,$newname);
		}
		else if($type=="png"){
		imagepng($thumb,$newname);
		}
		else if($type=="gif"){
		imagegif($thumb,$newname);
		}
	}


}
?>