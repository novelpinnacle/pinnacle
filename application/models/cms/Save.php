<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Save extends CI_Model {

public $timestamp="";
 

public function __construct(){
  if(isset($_FILES["image"]["name"])){
    $filename=str_replace("'", "", $_FILES["image"]["name"]);
    $filename=str_replace('"', "", $filename);
    $_FILES["image"]["name"]=$filename;
  }
    date_default_timezone_set("Asia/Calcutta");
    $this->timestamp=date("Y-m-d H:i:s",time());
}

public function getRenamedImage($img){
    $directory=dirname($img)."/";
    $file=basename($img);
    $pos=strrpos($file,".");
    $filename= substr($file,0,$pos)."-". rand(10000,999999);


    $extension=substr($file, $pos);
    return $directory.$filename.$extension;
}

public function slideshow($data){
	
	$target_dir = "uploads/slideshow/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);
   	
  if(empty($_FILES["image"]["name"])){
		return ["message"=>"<span class='w3-text-red'>Please Choose Image</span>","status"=>"failed"];
	}
	$check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check == false) {
        return ["message"=>"<span class='w3-text-red'>File is not an image</span>","status"=>"failed"];
    }

    if (file_exists($target_file)) {
        $target_file=$this->getRenamedImage($target_file);
	  } 

	if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
		$data["image"]=$target_file;
		$this->db->insert("cms_slideshow",$data);

        return ["message"=>"<span class='w3-text-green'>File Uploaded Successfully</span>","status"=>"ok"];
    } else {
       return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed"];
    }
}

public function topper($data){
  
  $target_dir = "uploads/toppers/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
    
  if(empty($_FILES["image"]["name"])){
    return ["message"=>"<span class='w3-text-red'>Please Choose Image</span>","status"=>"failed"];
  }
  $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check == false) {
        return ["message"=>"<span class='w3-text-red'>File is not an image</span>","status"=>"failed"];
    }

  if (file_exists($target_file)) {
    $target_file=$this->getRenamedImage($target_file);
  }

  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $data["image"]=$target_file;
    $this->db->insert("cms_toppers",$data);

        return ["message"=>"<span class='w3-text-green'>Details Uploaded Successfully</span>","status"=>"ok"];
    } else {
       return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed"];
    }
}
public function resultjunior($data){
  
  $target_dir = "uploads/resultsjunior/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
    
  if(empty($_FILES["image"]["name"])){
    return ["message"=>"<span class='w3-text-red'>Please Choose Image</span>","status"=>"failed"];
  }
  $check = getimagesize($_FILES["image"]["tmp_name"]);
  if($check == false) {
      return ["message"=>"<span class='w3-text-red'>File is not an image</span>","status"=>"failed"];
  }

  if (file_exists($target_file)) {
    $target_file=$this->getRenamedImage($target_file);
  }

  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $data["image"]=$target_file;
    $this->db->insert("cms_results_junior",$data);

        return ["message"=>"<span class='w3-text-green'>Details Uploaded Successfully</span>","status"=>"ok"];
    } else {
       return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed"];
    }
}
public function resultsenior($data){
  
  $target_dir = "uploads/resultssenior/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
    
  if(empty($_FILES["image"]["name"])){
    return ["message"=>"<span class='w3-text-red'>Please Choose Image</span>","status"=>"failed"];
  }
  $check = getimagesize($_FILES["image"]["tmp_name"]);
  if($check == false) {
      return ["message"=>"<span class='w3-text-red'>File is not an image</span>","status"=>"failed"];
  }

  if (file_exists($target_file)) {
    $target_file=$this->getRenamedImage($target_file);
  }

  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $data["image"]=$target_file;
    $this->db->insert("cms_results_senior",$data);

        return ["message"=>"<span class='w3-text-green'>Details Uploaded Successfully</span>","status"=>"ok"];
    } else {
       return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed"];
    }
}
public function resultcbse($data){
  
  $target_dir = "uploads/resultscbse/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
    
    if(empty($_FILES["image"]["name"])){
    return ["message"=>"<span class='w3-text-red'>Please Choose Image</span>","status"=>"failed"];
  }
  $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check == false) {
        return ["message"=>"<span class='w3-text-red'>File is not an image</span>","status"=>"failed"];
    }

  if (file_exists($target_file)) {
    $target_file=$this->getRenamedImage($target_file);
  }

  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $data["image"]=$target_file;
    $this->db->insert("cms_results_cbse",$data);

        return ["message"=>"<span class='w3-text-green'>Details Uploaded Successfully</span>","status"=>"ok"];
    } else {
       return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed"];
    }
}


public function feature($data){
  
  $target_dir = "uploads/features/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
    
    if(empty($_FILES["image"]["name"])){
    return ["message"=>"<span class='w3-text-red'>Please Choose Image</span>","status"=>"failed"];
  }
  $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check == false) {
        return ["message"=>"<span class='w3-text-red'>File is not an image</span>","status"=>"failed"];
    }

  if (file_exists($target_file)) {
    $target_file=$this->getRenamedImage($target_file);
  }

  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $data["image"]=$target_file;
    $this->db->insert("cms_features",$data);

        return ["message"=>"<span class='w3-text-green'>Details Uploaded Successfully</span>","status"=>"ok"];
    } else {
       return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed"];
    }
}


public function createShowcase($data){
extract($data);
  $target_dir = "uploads/showcase/";
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
       $old=$this->get->showcase();
      
      if($old!=null){
         $oldfile=$old->image;
         if(file_exists($oldfile)){unlink($oldfile);}       
      }
      $data["image"]=$target_file;
      return $this->updateshowcasedata($data);

      } else {
         return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed"];
      }
  }else{
    return $this->updateshowcasedata($data);
  }
}


public function updateshowcasedata($data){
 $CI =& get_instance();
 $CI->load->model("admin/cms/get","getcms");
 $showcase=$this->getcms->showcase();
  if($showcase==null){
    $this->db->insert("cms_showcase",$data);
  }
  else{
    $this->db->update("cms_showcase",$data);
  }
$newimg="";
  if(isset($data["image"])){$newimg=$data["image"];}
    return ["message"=>"<span class='w3-text-green'>Showcase Created Successfully</span>","status"=>"ok","newimg"=>$newimg];
}


public function teacher($data){
  
  $target_dir = "uploads/teachers/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
    
    if(empty($_FILES["image"]["name"])){
    return ["message"=>"<span class='w3-text-red'>Please Choose Image</span>","status"=>"failed"];
  }
  $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check == false) {
        return ["message"=>"<span class='w3-text-red'>File is not an image</span>","status"=>"failed"];
    }

  if (file_exists($target_file)) {
      $target_file=$this->getRenamedImage($target_file);
  }

  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $data["image"]=$target_file;
    $this->db->insert("cms_teachers",$data);
        return ["message"=>"<span class='w3-text-green'>Details Uploaded Successfully</span>","status"=>"ok"];
    } else {
       return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed"];
    }
}


public function testimonial($data){
  
  $target_dir = "uploads/testimonials/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
    
    if(empty($_FILES["image"]["name"])){
    return ["message"=>"<span class='w3-text-red'>Please Choose Image</span>","status"=>"failed"];
  }
  $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check == false) {
        return ["message"=>"<span class='w3-text-red'>File is not an image</span>","status"=>"failed"];
    }

  if (file_exists($target_file)) {
    $target_file=$this->getRenamedImage($target_file);
  }

  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $data["image"]=$target_file;
    $this->db->insert("cms_testimonials",$data);
        return ["message"=>"<span class='w3-text-green'>Details Uploaded Successfully</span>","status"=>"ok"];
    } else {
       return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed"];
    }
}

public function event($data){
  
  $target_dir = "uploads/events/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  $target_file=urldecode($target_file);
    
    if(empty($_FILES["image"]["name"])){
    return ["message"=>"<span class='w3-text-red'>Please Choose Image</span>","status"=>"failed"];
  }
  $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check == false) {
        return ["message"=>"<span class='w3-text-red'>File is not an image</span>","status"=>"failed"];
    }

  if (file_exists($target_file)) {
   $target_file=$this->getRenamedImage($target_file);
  }

  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $data["image"]=$target_file;
    $this->db->insert("cms_events",$data);
        return ["message"=>"<span class='w3-text-green'>Details Uploaded Successfully</span>","status"=>"ok"];
    } else {
       return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed"];
    }
}


public function news($data){
  
  $target_dir = "uploads/news/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  $target_file=urldecode($target_file);
    
    if(empty($_FILES["image"]["name"])){
    return ["message"=>"<span class='w3-text-red'>Please Choose Image</span>","status"=>"failed"];
  }
  $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check == false) {
        return ["message"=>"<span class='w3-text-red'>File is not an image</span>","status"=>"failed"];
    }

  if (file_exists($target_file)) {
    $target_file=$this->getRenamedImage($target_file);
  }

  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $data["image"]=$target_file;
    $this->db->insert("cms_news",$data);
        return ["message"=>"<span class='w3-text-green'>Details Uploaded Successfully</span>","status"=>"ok"];
    } else {
       return ["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed"];
    }
}

public function faqs($data){
  if($this->db->insert("cms_faqs",$data)){
    return ["message"=>"<span class='w3-text-green'>FAQs Uploaded Successfully</span>","status"=>"ok"];
  }
  else{
    return ["message"=>"<span class='w3-text-red'>Error Occured on Server Side</span>","status"=>"failed"];
  }
}





public function images($data){
    
  $target_dir = "uploads/images/";
  $return="";
  for($i=0;$i<count($_FILES["image"]["name"]);$i++){

  $target_file = $target_dir . basename($_FILES["image"]["name"][$i]);
  $target_file=urldecode($target_file);

  if(empty($_FILES["image"]["name"][$i])){
    return ["message"=>"<span class='w3-text-red'>Please Choose Image</span>","status"=>"failed"];
  }
  $check = getimagesize($_FILES["image"]["tmp_name"][$i]);
  if($check == false) {
    return ["message"=>"<span class='w3-text-red'>File is not an image</span>","status"=>"failed"];
  }
  if (file_exists($target_file)) {
    $target_file=$this->getRenamedImage($target_file);
  }
  if (move_uploaded_file($_FILES["image"]["tmp_name"][$i], $target_file)) {
    $data["image"]=$target_file;
    $this->db->insert("cms_images",$data);
    $return=["message"=>"<span class='w3-text-green'>Details Uploaded Successfully</span>","status"=>"ok"];
  } else {
    $return=["message"=>"<span class='w3-text-red'>Sorry, there was an error uploading your file.</span>","status"=>"failed"];
  }


}

return $return;

}

public function videos($data){

  if($this->db->insert("cms_videos",$data)){
    return ["message"=>"<span class='w3-text-green'>Video Uploaded Successfully</span>","status"=>"ok"];
  }
  else{
    return ["message"=>"<span class='w3-text-red'>Error Occured on Server Side</span>","status"=>"failed"];
  }
}


public function saveContact($data){
  $data["datetime"]=$this->timestamp;
  if($this->db->insert("contact_queries",$data)){
    $this->load->library("sendemail");
      $message="<html>
      <head>
      <title>HTML email</title>
      <style>
      body{
      font-family:verdana;
      }
      table{
        width:100%;
          border-collapse:collapse;
          text-align:left;
      }
      table th,table td{
        padding:10px 10px;
        border:1px solid #000;
      }
      table th{

      background:#fb0;
      color:#fff;
      }
      </style>
      </head>
      <body>
      <p>Hi, You Received a Contact Query From Pinnacle Educare Website</p>
      <table>
      <tr><th>Name</th><th>Email</th><th>Phone</th></tr>
      <tr><td>$data[name]</td><td>$data[email]</td><td><a href='tel:$data[phone]'>$data[phone]</a></td></tr>
      <tr><th colspan=3 style='text-align:left'>Message</th></tr>
      <tr><td colspan=3>$data[message]</td></tr>
      <tr>
      </table>
      </body>
      </html>";
    if(true || $this->sendemail->sendEmail("novel.pinnacle@gmail.com","New Inquiry",$message)){
      return ["message"=>"<span class='w3-text-green'>Message Submitted Successfully</span>","status"=>"ok"];
    }
  }else{
    return ["message"=>"<span class='w3-text-red'>Error Occured on Server Side</span>","status"=>"failed"];
  }
}


}

?>