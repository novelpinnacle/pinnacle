<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once "razorpay-php/Razorpay.php";
use Razorpay\Api\Api;


class Home extends CI_Controller {


	private $key = "rzp_live_p0hXyWubGOMq6I";
	private	$secret = "cBJw3gzBaYtCgcjQfo9ASNdQ";

	public $regstudents=true;

	public function __construct()	{
		parent::__construct();
		$this->load->model("records");
		$this->load->model("erp/get");
		$this->regstudents=$this->get->getToggle("regstudents");
		$this->load->library('form_validation');
	}
	
	public function sendsmstonew(){
	  $this->load->library("sms");
	    $query=$this->db->query("select es.name,es.phone,es.fmobile,es.rollno,l.username,l.password from erp_students es inner join login l on l.id=es.studentId inner join erp_students_cbs es_cbs on es_cbs.studentId=es.studentId where es_cbs.batchId=37 or es_cbs.batchId=38 order by es.rollno");
	       $result= $query->result();
	       foreach($result as $r){
	           $mobile = $r->phone?$r->phone:$r->fmobile;
	           $sms 
="
Dear $r->name,
Your registration at Pinnacle Educare is successful.
Your username is $r->username and password is $r->password.
You can login at https://www.pinnacloeducare.com/test";
	       echo "
	            <pre>$sms</pre>
	       ";
	    //$this->sms->sendSMS($mobile,$sms);
	}
}


	public function save_ntse(){
	    $this->load->library('form_validation');
		$this->load->helper('security'); 
		$this->load->model("fe/save","savefe");

		if(date_create_from_format("Y-m-d",$_POST["dob"])===false){
			die(json_encode(["status"=>false,"message"=>"Date Format was wrong.[YYYY-mm-dd] is Allowed"]));
		}

		$this->form_validation->set_rules('name', 'Name', 'required|regex_match[/^[a-zA-Z]+([\s][a-zA-Z  ]+)*$/]');
		$this->form_validation->set_rules('fname', 'Father Name', 'required|regex_match[/^[a-zA-Z]+([\s][a-zA-Z  ]+)*$/]');
		$this->form_validation->set_rules('city', 'City', 'required|regex_match[/^[a-zA-Z]+([\s][a-zA-Z  ]+)*$/]');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		$this->form_validation->set_rules('phone', 'Student Mobile', 'regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('fmobile', 'Father Mobile', 'required|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('address', 'Address', 'xss_clean|required');
	    $message=null;
	    if($this->form_validation->run() == true){
			echo json_encode($this->savefe->saveNTSE($_POST));
		}else{
			die(json_encode(["message"=>validation_errors(),"status"=>false]));
		}
	}

    public function sendEmail(){
        
        $students = $this->db->query("SELECT es.rollno,es.name,eb.batch,es.fname,es.fmobile,es.phone,es.email FROM `erp_students` es inner join erp_students_cbs escbs on es.studentId=escbs.studentId inner join erp_batches eb on eb.batchId=escbs.batchId where escbs.batchId in (52,53,54,55) and es.studentId not in(1798,1826,1961,1942,1807) and es.active=1");
        $result =$students->result();
        $this->load->library("sendemail");
        foreach($result as $r){
            
        $message = "<html>

<head>
    <title>HTML email</title>
    <style>
        body {
            font-family: verdana;
        }

        p {
            line-height: 1.7em
        }
    </style>
</head>

<body>
<p>Dear $r->name</p>
<p>Your PTQE stage-1 slot has been scheduled on 5th September, 2021</p>
<p>Your registration number for the PTQE is $r->rollno </p>
<p><b>Venue- Pinnacle Educare, Sangrur</b></p>
<p><b>Reporting Time- 9:30 AM</b></p>
<p>Exam timings- 10:00AM -11:00AM</p>
<p>No entry will be allowed after Reporting time.</p>
<p>We wish you best of luck for the PTQE Stage-1.</p>
<p>Regards,</p>
<p>Pinnacle Educare</p>
<p>9815355955</p>
</body>

</html>";
echo $message;
        if($r->email){
            $this->sendemail->sendEmail($r->email,"Slot for PTQE Stage-1",$message);
        }
    }
}

	public function index()
	{
		$this->load->model("cms/get");
		$this->load->view('header',["page"=>"home"]);

		if($this->get->getToggle("slideshow")==1){
		$slideshow=$this->records->getSlideshow();
		$this->load->view('frontpage/slideshow',["data"=>$slideshow]);
		}
		if($this->get->getToggle("toppers")==1){
		$toppers=$this->records->getToppers();
		$this->load->view('frontpage/toppers',["data"=>$toppers]);
		}
		if($this->get->getToggle("features")==1){
		$features=$this->records->getFeatures();
		$this->load->view('frontpage/features',["data"=>$features]);
		}
		if($this->get->getToggle("showcase")==1){
		$showcase=$this->records->getShowCase();
		$this->load->view('frontpage/cta',["data"=>$showcase]);
		}
		if($this->get->getToggle("teachers")==1){
		$faculty=$this->records->getFaculty();
		$this->load->view('frontpage/faculty',["data"=>$faculty]);
		}
		if($this->get->getToggle("testimonials")==1){
		$student=$this->records->getTestimonials("s");
		$parent=$this->records->getTestimonials("p");
		$this->load->view('frontpage/testimonials',["student"=>$student,"parent"=>$parent]);
		}
		if($this->get->getToggle("events")==1){
		$events=$this->records->getEvents();
		$this->load->view('frontpage/events',["data"=>$events]);
		}
		/*$this->load->view('frontpage/funfacts');
		if($this->get->getToggle("news")==1){
		$news=$this->records->getNews();
		$this->load->view('frontpage/news',["data"=>$news]);
		}
		*/
		$this->load->view('footer',["frontpage"=>true]);	
	}
	public function pages($page){

		$prepend="";
		switch ($page) {
			case 'faqs':
				$prepend="Frequently Asked Questions";
				break;
			case 'privacypolicy':
			    $prepend= "Privacy Policy";
			    break;
			case 'refundandcancellation':
			    $prepend= "Refund and Cancellation";
			    break;
			case 'termsandcondition':
			    $prepend= "Terms and Conditions";
			    break;
			case 'contact':
				$prepend="Contact & Address";
			default:
				# code...
				break;
		}

		$title=$prepend. " - Pinnaclo Educare Institute, Sangrur";

		$this->load->view('header',["page"=>$page,"title"=>$title]);
		$this->load->view('pages/'.$page);
		$this->load->view('footer');	
	}

	private function getOrderId(){
		
		$api = new Api($this->key,$this->secret);

		$order = $api->order->create(array(
			"receipt"  => rand(10000,99999). 'ORD',
			"amount"   => 49900,
			"currency" => "INR"
		));
		return $order->id;
	}
	
	private function getPTQEOrderId(){
		
		$api = new Api($this->key,$this->secret);

		$order = $api->order->create(array(
			"receipt"  => rand(10000,99999). 'ORD',
			"amount"   => 20000,
			"currency" => "INR"
		));
		return $order->id;
	}
	
	private function getDummyOrderId(){
		
		$api = new Api($this->key,$this->secret);

		$order = $api->order->create(array(
			"receipt"  => rand(10000,99999). 'ORD',
			"amount"   => 100,
			"currency" => "INR"
		));
		return $order->id;
	}
	
	public function dummy(){
	    $orderId= $this->getDummyOrderId();
	    $title="Dummy - Pinnaclo Educare Institute, Sangrur";

		$this->load->view('header',["page"=>"ptqe","title"=>$title]);
		$this->load->view('pages/dummy',["order_data" => ["order_id"=>$orderId,"key"=>$this->key,"secret"=>$this->secret],]);
		$this->load->view('footer');
	}

    public function payment($a,$b){
        $data = $_POST;
        $data = json_encode($data);
        $this->db->insert("demo",["name"=>"data is $data"]);
    }

	public function ptqe($page){
        $orderId="";
		$prepend="";
		
		
		switch ($page) {
			case 'ptqe2023':
					$prepend='PTQE 2024';
				break;
//			case 'how-register-ptqe-2022':
//				$prepend="Register For PTQE 2022";
//				break;
//			case 'ptqe-sample-papers':
//				$prepend="PTQE Sample Papers";
//				break;
			case 'ptqe23-result':
					$prepend='PTQE-23 Result';
				break;
			case 'register-for-ptqe-2023';
					$prepend = "Register For PTQE 2024";
				break;
			case 'ptqe-success':
					$prepend='PTQE Admit card';
				break;
		}

		$title=$prepend. " - Pinnaclo Educare Institute, Sangrur";

		$this->load->view('header',["page"=>"ptqe","title"=>$title]);
		if($page == 'ptqe-success'){
			$sid = $_GET["sid"];
			$studentData = $this->db->query("select * from erp_students where studentId=$sid")->row();
			$batchId = $this->db->query("select batchId from erp_students_cbs where studentId =$sid")->row();
			$this->load->view("pages/ptqe-success",["name"=>$studentData->name,"rollno"=>$studentData->rollno,"fname"=>$studentData->fname,"school"=>$studentData->school,"batchId"=>$batchId->batchId]);
		}
		else {
		$this->load->view('pages/'.$page,["order_data" => ["order_id"=>$orderId,"key"=>$this->key,"secret"=>$this->secret]]);
		}
		$this->load->view('footer');	
	}
	
	public function ntse($page){
		$orderId = "";
		$prepend="";
		
		$title = $prepend. " - Pinnaclo Educare Institute, Sangrur";
    
        $orderId = $this->getOrderId();
		$_SESSION["order_id"] = $orderId;
    
		$this->load->view('header',["page"=>"ntse","title"=>$title]);
		$this->load->view('pages/'.$page,["order_data" => ["order_id"=>$orderId,"key"=>$this->key,"secret"=>$this->secret]]);
		$this->load->view('footer');	
	}
	
	public function psat($page){
    	$orderId = "";
		$prepend="";
		switch ($page) {
			case 'about-psat-2021':
					$prepend='PSAT 2021';
				break;
			case 'how-register-psat-2021':
				$prepend="Register For PSAT 2021";
				break;
			case 'psat-sample-papers':
				$prepend="PSAT Sample Papers";
				break;
			case 'register-for-psat-2021';
				$prepend = "Register For PSAT 2021";
				break;
		}

		$title=$prepend. " - Pinnaclo Educare Institute, Sangrur";

		$this->load->view('header',["page"=>"psat","title"=>$title]);
		$this->load->view('pages/'.$page);
		$this->load->view('footer');	
	}


	public function updateStudentPaymentDetails() {
		
		$sid = $_POST["sid"];
		$razorOrderId = $_POST["order_id"];
		$razorPayemntId = $_POST["payment_id"];
		$razorSignature = $_POST["signature"];
		
		$string = $_SESSION["order_id"]."|".$razorPayemntId;
		$mySignature =  hash_hmac('sha256', $string, $this->secret);

		if($mySignature == $razorSignature) {
			$this->db->query("update erp_students set active = 1 where studentId = $sid");
			$this->db->insert("ptqe_payments",["student_id"=>$sid,"order_id"=>$razorOrderId,"payment_id"=>$razorPayemntId]);

			echo json_encode(["status"=>true,"message" => "Your Payment is successful and your account is activated."]);
		}
		else{
			echo json_encode(["status"=>false,"message"=>"Payment was failed"]);
		}
	}
	
/*	public function updatePTQEStudentPaymentDetails() {
		
		$razorOrderId = $_POST["razorpay_order_id"];
		$razorPayemntId = $_POST["razorpay_payment_id"];
		$razorSignature = $_POST["razorpay_signature"];
		
		$student = $this->db->query("select student_id from ptqe_payments where order_id='$razorOrderId'")->row();
		$studentData = $this->db->query("select * from erp_students where studentId=$student->student_id")->row();
    	$batchId = $this->db->query("select batchId from erp_students_cbs where studentId =$student->student_id")->row();
		$string = $_SESSION["order_id"]."|".$razorPayemntId;
		$mySignature =  hash_hmac('sha256', $string, $this->secret);

		if($mySignature == $razorSignature) {
			$this->db->query("update erp_students set active = 1 where studentId = $student->student_id");
			$this->load->view("pages/ptqe-success",["name"=>$studentData->name,"rollno"=>$studentData->rollno,"fname"=>$studentData->fname,"school"=>$studentData->school,"batchId"=>$batchId->batchId]);
		}
		else{
			echo json_encode(["status"=>false,"message"=>"Payment was failed"]);
		}
	}
*/

    public function sendEmailAfterNTSE($username,$password){
        
    $student = $this->db->query("SELECT * FROM erp_students where studentId = (select id from login where username = $username )")->row();
    $this->load->library("sendemail");
    $message = "<html>

<head>
    <title>HTML email</title>
    <style>
        body {
            font-family: verdana;
        }

        p {
            line-height: 1.7em
        }
    </style>
</head>

<body>
    <p>Dear $student->name,</p>
    <p>Welcome to Pinnacle Educare online NTSE classes.</p> 
    <p>Your account has been activated. </p>
    <p>To login click on the following URL https://www.pinnacloeducare.com/test/</p>
    Username: <b>$username</b><br>
    password: <b> $password</b>
    <p>For any type of query please whatsapp us  at+91-8248918528</p>  
    <p>Regards,</p>
    <p>Pinnacle Educare</p>
</body>

</html>";

$this->sendemail->sendEmail($student->email,"Confirmation of registration with Pinnacle Educare",$message);
       // $this->load->library("sms");
        //$smsMessage = "Your registration for PTQE2021 is successful. Your username is $username and password is $password. You can login at https://www.pinnacloeducare.com/test\n Thanks & regards\n Pinnacle Educare";
		//$response=$this->sms->sendSMS($student->phone,$smsMessage);
    echo "$message";
    }
    

	public function event_single($id){
		$this->load->view('header',["page"=>""]);
		$single=$this->records->getEventSingle($id);
		$this->load->view('pages/event-single',["data"=>$single]);
		$this->load->view('footer');
	}
	public function blog_single($id){
		$this->load->view('header',["page"=>""]);
		$single=$this->records->getNewsSingle($id);
		$this->load->view('pages/blog_single',["data"=>$single]);
		$this->load->view('footer');
	}
	public function gallery($type){
		$this->load->view("header",["page"=>"gallery"]);
		if($type=="images"){
			$images=$this->records->getimagesgallery();
			$this->load->view("pages/$type");
		}
		if($type=="videos"){
		$videos=$this->records->getVideoGallery();
			$this->load->view("pages/$type",["videos"=>$videos]);
		}
		
		$this->load->view('footer');
	}

	public function gallery_images($category){
		$this->load->view("header",["page"=>"gallery"]);
		$this->load->model("records");
		$images=$this->records->getimagesgallerybycategory(urldecode($category));
		$this->load->view("pages/category-images",["images"=>$images]);	
		$this->load->view('footer');	
	}

	public function about($page){
		$prepend="";
		switch($page){
			case "vision" :
				$prepend="Our Vision";
				break;
			case "aimsandres" :
				$prepend="Aims &amp; Responsibility";
				break;
			case "faculty" :
				$prepend = "Our Faculty";
				break;
			case "whypinnacle" :
				$prepend="Why Pinnaclo";
				break;
			case "testimonials" :
				$prepend="Testimonials";
				break;

		}

		$title=$prepend." - Pinnaclo Educare Institute, Sangrur";

		$this->load->view("header",["page"=>"about_us","title"=>$title]);
		if("$page" == "faculty"){
			$faculty=$this->records->getFaculty();
			$this->load->view('pages/faculty',["data"=>$faculty]);	
		}else if("$page" == "testimonials"){
			$student=$this->records->getTestimonials("s");
			$parent=$this->records->getTestimonials("p");
			$this->load->view('pages/testimonials',["student"=>$student,"parent"=>$parent]);
			}
		else
		{
		$this->load->view("pages/$page");
		}
		$this->load->view('footer');
	}
	public function resultsec($page){
		$prepend="";
		switch($page){
			case "resultsj":
				$prepend="Result of Juniors";
				break;
			case "resultss":
				$prepend="Result of Seniors";
				break;

		}
		$title=$prepend." - Pinnaclo Educare Institute, Sangrur";

		$this->load->view("header",["page"=>"resultsec","title"=>$title]);
		if("$page" == "resultsj"){
			$resultsjunior=$this->records->getresultsjunior();
			$this->load->view('pages/resultsj',["data"=>$resultsjunior]);	
		}
		if("$page" == "resultss"){
			$resultssenior=$this->records->getresultssenior();
			$this->load->view('pages/resultss',["data"=>$resultssenior]);	
		}
		if("$page" == "resultscbse"){
			$resultscbse=$this->records->getresultscbse();
			$this->load->view('pages/resultscbse',["data"=>$resultscbse]);	
		}
		$this->load->view('footer');
	}
	public function ourcourses(){
		$title="Our Courses - Pinnaclo Educare Institute, Sangrur";
		$this->load->view("header",["page"=>"ourcourses","title"=>$title]);
		$this->load->view('ourcourses/ourcourse');
		$this->load->view('footer');
	}
	public function courses($page){
		$this->load->view("ourcourses/".$page);
	}

	public function admission($page){
		$prepend="";
		switch($page){
			case "process":
				$prepend="Admission Process";
				break;
			case "samplepapers":
				$prepend="Sample Papers";
				break;
			case "register":
				$prepend="Register";
				break;
				
		}
		$title=$prepend." - Pinnaclo Educare Institute, Sangrur";

		$this->load->view("header",["page"=>"admission","title"=>$title]);
		$this->load->view('admission/'.$page);
		$this->load->view('footer');
	}

	public function results(){
		$this->load->view("header",["page"=>"results"]);
		$this->load->view("pages/results");
		$this->load->view('footer');			
	}

	public function savecontact(){
		$this->load->library('form_validation');
		$this->load->helper('security'); 

		$this->form_validation->set_rules('name', 'Name', 'required|regex_match[/^[a-zA-Z]+([\s][a-zA-Z]+)*$/]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'required|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('message', 'Message', 'xss_clean|required');
	     $message=null;
	     if($this->form_validation->run() == true){
	     	$this->load->model("cms/save");
	     	$message=$this->save->saveContact($_POST)["message"];
	     	$this->session->set_flashdata("status",$message);
	    	header("location:".base_url()."contact-us");
	     }
	    
		
		$this->load->view('header',["page"=>"contact"]);
		$this->load->view('pages/contact');
		$this->load->view('footer');
	        
	}

	public function register(){
		if($this->regstudents==false){
			header("HTTP/1.1 401 Unauthorized");
			exit;
		}
		$this->load->view('header',["page"=>"studentcorner"]);
		$this->load->model("user/get");
		$courses=$this->get->getCourses();
		$this->load->view('pages/addstudent',["courses"=>$courses]);
		$this->load->view('footer');
	}

	public function saveStudent(){
		if($this->regstudents==false){
			header("HTTP/1.1 401 Unauthorized");
			exit;
		}

		$this->load->library('form_validation');
		$this->load->helper('security'); 

		$this->form_validation->set_rules('name', 'Name', 'required|regex_match[/^[a-zA-Z]+([\s][a-zA-Z]+)*$/]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('fname', 'Father Name', 'required|regex_match[/^[a-zA-Z]+([\s][a-zA-Z]+)*$/]');
		$this->form_validation->set_rules('fmobile', 'Father Phone', 'required|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('phone', 'Student Phone', 'regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('rollno', 'Roll No', 'required|regex_match[/^[0-9]*$/]');
		$this->form_validation->set_rules('gender', 'Gender', 'required|regex_match[/^[a-zA-Z]*$/]');
		$this->form_validation->set_rules('city', 'City', 'required|regex_match[/^[a-zA-Z]+([\s][a-zA-Z]+)*$/]');
		$this->form_validation->set_rules('address', 'Address', 'required|xss_clean');


		if(date_create_from_format("Y-m-d",$_POST["dob"])===false){
			die(json_encode(["status"=>false,"message"=>"Date Format was wrong.[YYYY-mm-dd] is Allowed"]));
		}

		if($this->form_validation->run() == true ){
			$this->load->model("user/save");
			$_POST["active"]=0;
			echo json_encode($this->save->saveStudent($_POST));
		}else{
			echo json_encode(["status"=>false,"message"=>validation_errors()]);
		}
		
	}
	public function getbatchesbycourseid(){
		$this->records->printBatchesByCourseId($_POST['cid']);
	}

	function workshop(){
		$this->load->view('header',["page"=>"workshop"]);
		$this->load->view('pages/workshop');
		$this->load->view('footer');
	}

	function saveworkshop(){
		$this->load->library('form_validation');
		$this->load->helper('security'); 
		$this->form_validation->set_rules('name', 'Name', 'required|regex_match[/^[a-zA-Z]+([\s][a-zA-Z]+)*$/]');
		$this->form_validation->set_rules('fname', 'Father Name', 'required|regex_match[/^[a-zA-Z]+([\s][a-zA-Z]+)*$/]');
		$this->form_validation->set_rules('city', 'City', 'required|regex_match[/^[a-zA-Z]+([\s][a-zA-Z]+)*$/]');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		$this->form_validation->set_rules('class', 'Class', 'required');
		$this->form_validation->set_rules('school', 'School', 'required');
		$this->form_validation->set_rules('phone', 'Student Mobile', 'regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('fmobile', 'Father Mobile', 'required|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('address', 'Address', 'xss_clean|required');
	    $message=null;
	    if($this->form_validation->run() == true){
	    	$this->load->model("erp/save");
			echo json_encode($this->save->saveWorkshop($_POST));
		}else{
			die(json_encode(["message"=>validation_errors(),"status"=>false]));
		}
	}

	function workshop_updates($date=""){
		$this->load->view('header',["page"=>"workshop"]);
		$images=$this->get->getWorkshopUpdates($date);
		$dates=$this->get->getWorkshopDates();
		$this->load->view('pages/workshop_updates',["images"=>$images,"dates"=>$dates]);
		$this->load->view('footer');
	}
	function workshop_about(){
		$this->load->view("header",["page"=>"workshop"]);
		$this->load->view('pages/workshop_about');
		$this->load->view('footer');
	}

}