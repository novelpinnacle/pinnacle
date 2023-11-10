<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
public function index()
{
	$this->load->view("admin/header",["page"=>"landing"]);
	$this->load->view("admin/landing");
	$this->load->view("admin/footer");
}
	
}
?>