<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller {

public function __construct()	{
		parent::__construct();
		if(!$this->isLoggedIn()){
			header("location:".base_url()."login/loginform");
			die("Session Expired");
		}
		$this->load->helper("is_active");
		$this->load->model("cms/save","savecms");
		$this->load->model("cms/get","getcms");
		$this->load->model("cms/delete","deletecms");
		$this->load->model("cms/update","updatecms");
}
public function isLoggedIn(){
	if(!isset($_SESSION["username"]) || $_SESSION["role"]!="admin"){
		return false;
	}
	else{
		return true;
	}
}
	public function togglesections(){
		$section=$_POST["section"];
		echo $this->updatecms->toggleSections($section);
	}
	public function index()
	{
		$slideshow=$this->getcms->slideshow();
		$status=$this->getcms->getToggle("slideshow");
		$this->load->view("cms/header",["page"=>"slideshow"]);
		$this->load->view("cms/slideshow",["slideshow"=>$slideshow,"status"=>$status]);
		$this->load->view("cms/footer");
	}
	public function refreshslideshow(){
		$this->getcms->printslideshow();
	}
	public function uploadslideshow(){
		echo json_encode($this->savecms->slideshow($_POST));
	}
	public function deleteslideshow(){
		$this->deletecms->slideshow($_POST["sid"]);
	}
	public function editslideshow($id){
		$slideshow=$this->getcms->getslideshowbyid($id);
		$this->load->view("cms/header",["page"=>"slideshow"]);
		$this->load->view("cms/editslideshow",["slideshow"=>$slideshow]);
		$this->load->view("cms/footer");
	}
	public function updateslideshow(){
		echo json_encode($this->updatecms->slideshow($_POST));
	}
	public function toppers(){
		$toppers=$this->getcms->topper();
		$status=$this->getcms->getToggle("toppers");
		$this->load->view("cms/header",["page"=>"toppers"]);
		$this->load->view("cms/toppers",["toppers"=>$toppers,"status"=>$status]);
		$this->load->view("cms/footer");
	}
	public function uploadtopper(){
		echo json_encode($this->savecms->topper($_POST));
	}
	public function refreshtopper(){
		$this->getcms->printtoppers();
	}
	public function deletetopper(){
		$this->deletecms->topper($_POST["tid"]);
	}
	public function edittopper($id){
		$topper=$this->getcms->gettopperbyid($id);
		$this->load->view("cms/header",["page"=>"toppers"]);
		$this->load->view("cms/edittopper",["topper"=>$topper]);
		$this->load->view("cms/footer");
	}
	public function updatetopper(){
		echo json_encode($this->updatecms->topper($_POST));
	}
	public function resultsjunior(){
		$resultsjunior=$this->getcms->resultjunior();
		$status=$this->getcms->getToggle("resultsjunior");
		$this->load->view("cms/header",["page"=>"resultsjunior"]);
		$this->load->view("cms/resultsjunior",["resultsjunior"=>$resultsjunior,"status"=>$status]);
		$this->load->view("cms/footer");
	}
	public function uploadresultsjunior(){
		echo json_encode($this->savecms->resultjunior($_POST));
	}
	public function refreshresultsjunior(){
		$this->getcms->printresultsjunior();
	}
	public function deleteresultsjunior(){
		$this->deletecms->resultjunior($_POST["tid"]);
	}
	public function editresultsjunior($id){
		$resultjunior=$this->getcms->getresultjuniorbyid($id);
		$this->load->view("cms/header",["page"=>"resultsjunior"]);
		$this->load->view("cms/editresultsjunior",["resultjunior"=>$resultjunior]);
		$this->load->view("cms/footer");
	}
	public function updateresultsjunior(){
		echo json_encode($this->updatecms->resultjunior($_POST));
	}
	public function resultssenior(){
		$resultssenior=$this->getcms->resultsenior();
		$status=$this->getcms->getToggle("resultssenior");
		$this->load->view("cms/header",["page"=>"resultssenior"]);
		$this->load->view("cms/resultssenior",["resultssenior"=>$resultssenior,"status"=>$status]);
		$this->load->view("cms/footer");
	}
	public function uploadresultssenior(){
		echo json_encode($this->savecms->resultsenior($_POST));
	}
	public function refreshresultssenior(){
		$this->getcms->printresultssenior();
	}
	public function deleteresultssenior(){
		$this->deletecms->resultsenior($_POST["tid"]);
	}
	public function editresultssenior($id){
		$resultsenior=$this->getcms->getresultseniorbyid($id);
		$this->load->view("cms/header",["page"=>"resultssenior"]);
		$this->load->view("cms/editresultssenior",["resultsenior"=>$resultsenior]);
		$this->load->view("cms/footer");
	}
	public function updateresultssenior(){
		echo json_encode($this->updatecms->resultsenior($_POST));
	}
		public function resultscbse(){
		$resultscbse=$this->getcms->resultcbse();
		$status=$this->getcms->getToggle("resultscbse");
		$this->load->view("cms/header",["page"=>"resultscbse"]);
		$this->load->view("cms/resultscbse",["resultscbse"=>$resultscbse,"status"=>$status]);
		$this->load->view("cms/footer");
	}
	public function uploadresultscbse(){
		echo json_encode($this->savecms->resultcbse($_POST));
	}
	public function refreshresultscbse(){
		$this->getcms->printresultscbse();
	}
	public function deleteresultscbse(){
		$this->deletecms->resultcbse($_POST["tid"]);
	}
	public function editresultscbse($id){
		$resultcbse=$this->getcms->getresultcbsebyid($id);
		$this->load->view("cms/header",["page"=>"resultscbse"]);
		$this->load->view("cms/editresultscbse",["resultcbse"=>$resultcbse]);
		$this->load->view("cms/footer");
	}
	public function updateresultscbse(){
		echo json_encode($this->updatecms->resultcbse($_POST));
	}
	public function features(){
		$features=$this->getcms->feature();
		$status=$this->getcms->getToggle("features");
		$this->load->view("cms/header",["page"=>"features"]);
		$this->load->view("cms/features",["features"=>$features,"status"=>$status]);
		$this->load->view("cms/footer");
	}
	public function uploadfeature(){
		echo json_encode($this->savecms->feature($_POST));
	}
	public function refreshfeature(){
		$this->getcms->printfeatures();
	}
	public function deletefeature(){
		$this->deletecms->feature($_POST["fid"]);
	}
	public function editfeature($id){
		$feature=$this->getcms->getfeaturebyid($id);
		$this->load->view("cms/header",["page"=>"features"]);
		$this->load->view("cms/editfeature",["feature"=>$feature]);
		$this->load->view("cms/footer");
	}
	public function updatefeature(){
		echo json_encode($this->updatecms->feature($_POST));
	}
	public function showcase(){
		$showcase=$this->getcms->showcase();
		$status=$this->getcms->getToggle("showcase");
		$this->load->view("cms/header",["page"=>"showcase"]);
		$this->load->view("cms/showcase",["showcase"=>$showcase,"status"=>$status]);
		$this->load->view("cms/footer");
	}
	public function createshowcase(){
		echo json_encode($this->savecms->createShowcase($_POST));
	}
	public function teachers(){
		$teachers=$this->getcms->teacher();
		$status=$this->getcms->getToggle("teachers");
		$this->load->view("cms/header",["page"=>"teachers"]);
		$this->load->view("cms/teachers",["teachers"=>$teachers,"status"=>$status]);
		$this->load->view("cms/footer");
	}
	public function uploadteacher(){
		echo json_encode($this->savecms->teacher($_POST));
	}
	public function refreshteacher(){
		$this->getcms->printteachers();
	}
	public function deleteteacher(){
		$this->deletecms->teacher($_POST["tid"]);
	}
	public function editteacher($id){
		$teacher=$this->getcms->getteacherbyid($id);
		$this->load->view("cms/header",["page"=>"teachers"]);
		$this->load->view("cms/editteacher",["teacher"=>$teacher]);
		$this->load->view("cms/footer");
	}
	public function updateteacher(){
		echo json_encode($this->updatecms->teacher($_POST));
	}
	public function testimonials(){
		$testimonials=$this->getcms->testimonial();
		$status=$this->getcms->getToggle("testimonials");
		$this->load->view("cms/header",["page"=>"testimonials"]);
		$this->load->view("cms/testimonials",["testimonials"=>$testimonials,"status"=>$status]);
		$this->load->view("cms/footer");
	}
	public function uploadtestimonial(){
		echo json_encode($this->savecms->testimonial($_POST));
	}
	public function refreshtestimonial(){
		$this->getcms->printtestimonials();
	}
	public function deletetestimonial(){
		$this->deletecms->testimonial($_POST["tid"]);
	}
	public function edittestimonial($id){
		$testimonial=$this->getcms->gettestimonialbyid($id);
		$this->load->view("cms/header",["page"=>"testimonials"]);
		$this->load->view("cms/edittestimonial",["testimonial"=>$testimonial]);
		$this->load->view("cms/footer");
	}
	public function updatetestimonial(){
		echo json_encode($this->updatecms->testimonial($_POST));
	}
	public function events(){
		$events=$this->getcms->event();
		$status=$this->getcms->getToggle("events");
		$this->load->view("cms/header",["page"=>"events"]);
		$this->load->view("cms/events",["events"=>$events,"status"=>$status]);
		$this->load->view("cms/footer");
	}
	public function uploadevent(){
		echo json_encode($this->savecms->event($_POST));
	}
	public function refreshevent(){
		$this->getcms->printevents();
	}
	public function deleteevent(){
		$this->deletecms->event($_POST["eid"]);
	}
	public function editevent($id){
		$event=$this->getcms->geteventbyid($id);
		$this->load->view("cms/header",["page"=>"events"]);
		$this->load->view("cms/editevent",["event"=>$event]);
		$this->load->view("cms/footer");
	}
	public function updateevent(){
		echo json_encode($this->updatecms->event($_POST));
	}
	public function news(){
		$news=$this->getcms->news();
		$status=$this->getcms->getToggle("news");
		$this->load->view("cms/header",["page"=>"news"]);
		$this->load->view("cms/news",["news"=>$news,"status"=>$status]);
		$this->load->view("cms/footer");
	}
	public function uploadnews(){
		echo json_encode($this->savecms->news($_POST));
	}
	public function refreshnews(){
		$this->getcms->printnews();
	}
	public function deletenews(){
		$this->deletecms->news($_POST["eid"]);
	}
	public function editnews($id){
		$news=$this->getcms->getnewsbyid($id);
		$this->load->view("cms/header",["page"=>"news"]);
		$this->load->view("cms/editnews",["news"=>$news]);
		$this->load->view("cms/footer");
	}
	public function updatenews(){
		echo json_encode($this->updatecms->news($_POST));
	}
	public function faqs(){
		$faqs=$this->getcms->faqs();
		$this->load->view("cms/header",["page"=>"faqs"]);
		$this->load->view("cms/faqs",["faqs"=>$faqs]);
		$this->load->view("cms/footer");
	}
	public function uploadfaqs(){
		echo json_encode($this->savecms->faqs($_POST));
	}
	public function refreshfaqs(){
		$this->getcms->printfaqs();
	}
	public function deletefaqs(){
		$this->deletecms->faqs($_POST["fid"]);
	}
	public function editfaqs($id){
		$faqs=$this->getcms->getfaqsbyid($id);
		$this->load->view("cms/header",["page"=>"faqs"]);
		$this->load->view("cms/editfaqs",["faqs"=>$faqs]);
		$this->load->view("cms/footer");
	}
	public function updatefaqs(){
		echo json_encode($this->updatecms->faqs($_POST));
	}
	public function images(){
		$images=$this->getcms->images();
		$this->load->view("cms/header",["page"=>"images"]);
		$this->load->view("cms/images",["images"=>$images]);
		$this->load->view("cms/footer");
	}
	public function uploadimages(){
	echo json_encode($this->savecms->images($_POST));
	}
	public function refreshimages(){
		$this->getcms->printimages();
	}
	public function deleteimages(){
		$this->deletecms->images($_POST["iid"]);
	}
	public function videos(){
		$videos=$this->getcms->videos();
		$this->load->view("cms/header",["page"=>"videos"]);
		$this->load->view("cms/videos",["videos"=>$videos]);
		$this->load->view("cms/footer");
	}
	public function uploadvideos(){
		echo json_encode($this->savecms->videos($_POST));
	}
	public function refreshvideos(){
		$this->getcms->printvideos();
	}
	public function deletevideos(){
		$this->deletecms->videos($_POST["vid"]);
	}
	public function resizeimage(){
		$image="uploads/slideshow/slider-bg3.jpg";
		$this->updatecms->resizeImage($image);
	}

}