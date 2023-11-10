<?php

class fe extends CI_Controller {
	public function __construct()	{
		parent::__construct();
		$this->load->helper("is_active");
		$this->load->model("fe/save","savefe");
		// $this->load->model("fe/get","getfe");
		// $this->load->model("fe/delete","deletefe");
		// $this->load->model("fe/update","updatefe");
	}
	public function saveadmission(){
	echo json_encode($this->savefe->saveferegistry($_POST));
	}
	
	public function saveptqe(){
		$this->load->library('form_validation');
		$this->load->helper('security'); 

		if(date_create_from_format("Y-m-d",$_POST["dob"])===false){
			die(json_encode(["status"=>false,"message"=>"Date Format was wrong.[YYYY-mm-dd] is Allowed"]));
		}

		$this->form_validation->set_rules('name', 'Name', 'required|regex_match[/^[a-zA-Z]+([\s][a-zA-Z]+)*$/]');
		$this->form_validation->set_rules('fname', 'Father Name', 'required|regex_match[/^[a-zA-Z]+([\s][a-zA-Z]+)*$/]');
		$this->form_validation->set_rules('city', 'City', 'required|regex_match[/^[a-zA-Z]+([\s][a-zA-Z]+)*$/]');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		$this->form_validation->set_rules('phone', 'Student Mobile', 'regex_match[/^([0-9]{1,5})?([7-9][0-9]{9})$/]');
		$this->form_validation->set_rules('fmobile', 'Father Mobile', 'required|regex_match[/^([0-9]{1,5})?([7-9][0-9]{9})$/]');
		$this->form_validation->set_rules('address', 'Address', 'xss_clean|required');
	    $message=null;
	    if($this->form_validation->run() == true){
			echo json_encode($this->savefe->saveptqe($_POST));
		}else{
			die(json_encode(["message"=>validation_errors(),"status"=>false]));
		}

	}

	public function savepsat(){
		$this->load->library('form_validation');
		$this->load->helper('security'); 

		if(date_create_from_format("Y-m-d",$_POST["dob"])===false){
			die(json_encode(["status"=>false,"message"=>"Date Format was wrong.[YYYY-mm-dd] is Allowed"]));
		}

		$this->form_validation->set_rules('name', 'Name', 'required|regex_match[/^[a-zA-Z]+([\s][a-zA-Z]+)*$/]');
		$this->form_validation->set_rules('fname', 'Father Name', 'required|regex_match[/^[a-zA-Z]+([\s][a-zA-Z]+)*$/]');
		$this->form_validation->set_rules('city', 'City', 'required|regex_match[/^[a-zA-Z]+([\s][a-zA-Z]+)*$/]');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		$this->form_validation->set_rules('phone', 'Student Mobile', 'regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('fmobile', 'Father Mobile', 'required|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('address', 'Address', 'xss_clean|required');
	    $message=null;
	    if($this->form_validation->run() == true){
			echo json_encode($this->savefe->savepsat($_POST));
		}else{
			die(json_encode(["message"=>validation_errors(),"status"=>false]));
		}
		
	}
}
?>