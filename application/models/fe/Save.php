<?php

class Save extends CI_Model
{

	public function saveptqe($data)
	{
		$this->db->trans_start();
		$date = date_create($data["dob"]);
		$password = date_format($date, "dmY");
		$batchId = $data["batchId"];
		$username = $this->getPTQEUsername($batchId);        
		$this->db->insert("login", ["username" => $username, "password" => $password, "role" => "student", "bioid" => 0]);
		$sid = $this->db->insert_id();
		$data["studentId"] = $sid;
		$data["active"] = 1;
		$data["rollno"]=$username;
		$courseId = 45;
		unset($data["batchId"]);
		unset($data["declaration"]);
		$this->db->insert("erp_students", $data);
        
        $this->db->insert("erp_students_cbs",["studentId"=>$sid, "batchId"=>$batchId, "courseId"=>$courseId, "sessionId"=>5, "active" => 1]);
		
		$success = $this->db->trans_complete();
//        $this->sendEmailAfterPTQE($username,$password);
		$message="Your registration is successful. Your username is $username ";
		return ["success" => $success ,"sid"=>$sid,"username"=>$username,"message"=>$message];
	}

	
	public function savePSAT($data)
	{
		$this->db->trans_start();
		$date = date_create($data["dob"]);
		$password = date_format($date, "dmY");
		$batchId = $data["batchId"];
		unset($data["batchId"]);
		$username = $this->getPSATUsername($batchId);

		$this->db->insert("login", ["username" => $username, "password" => $password, "role" => "student", "bioid" => 0]);
		$sid = $this->db->insert_id();
		$data["studentId"] = $sid;
		$data["active"] = 3;
		$data["rollno"]=$username;
		$this->db->insert("erp_students", $data);
	
        $courseId = 28;
        $this->db->insert("erp_students_cbs",["studentId"=>$sid, "batchId"=>$batchId, "courseId"=>$courseId, "sessionId"=>3, "active" => 1]);
		
		$success = $this->db->trans_complete();

        $message="Your registration is successful. Your username is <b>$username</b> and password is <b>$password</b>";
		return ["success" => $success ,"sid"=>$sid,"message"=>$message];
	}

    private function getPSATUsername($batchId){
        $batchNo = ($batchId==57)?"07":(($batchId==58)?"08":($batchId==59?"09":10));
		$rs = $this->db->query("select username from login where username like('27$batchNo%') order by username desc limit 1");
		if(!$rs->row()){
		   
		   return "27$batchNo"."101";
		}
		return $rs->row()->username+1;
	}

    private function getPTQEUsername($batchId){
		if($batchId==88){
			$batchNo="06";
		}
		if($batchId==89){
			$batchNo="07";
		}
		if($batchId==90){
			$batchNo="08";
		}
		if($batchId==91){
			$batchNo="09";
		}
		if($batchId==92){
			$batchNo="10";
		}
		if($batchId==93){
			$batchNo="11";
		}
		if($batchId==94){
			$batchNo="11";
		}

		$rs = $this->db->query("select username from login where username like('$batchNo"."50%') order by username desc limit 1");
		if(!$rs->row()){
		   return "$batchNo"."500001";
		}
		if($batchId == "88" || $batchId == "89" || $batchId == "90" || $batchId == "91"){
		$rollnowithout0 = $rs->row()->username+1;
		return "0"."$rollnowithout0";
		}
		else {
			return $rs->row()->username+1;
		}
	}

	private function getNTSEUsername(){
		$rs = $this->db->query("select username from login where username like('2021%') order by username desc limit 1");
		if(!$rs->row()){
		    return 202110001;
		}
		return $rs->row()->username+1;
	}
	
	public function saveNTSE($data)
	{
		$this->db->trans_start();
		$date = date_create($data["dob"]);
		$password = date_format($date, "dmY");
		$username = $this->getNTSEUsername();
    
		$_SESSION["NTSE_USERNAME"] = $username;
		$_SESSION["NTSE_PASSWORD"] = $password;

		$this->db->insert("login", ["username" => $username, "password" => $password, "role" => "student", "bioid" => 0]);
		$sid = $this->db->insert_id();
		$data["studentId"] = $sid;
		$data["active"] = 3;
		$data["rollno"]=$username;
		$this->db->insert("erp_students", $data);
		
        $batchId = 51; 
        $courseId = 26;
        $this->db->insert("erp_students_cbs",["studentId"=>$sid, "batchId"=>$batchId, "courseId"=>$courseId, "sessionId"=>3, "active" => 1]);
		
		$success = $this->db->trans_complete();

        $message="Your registration is successful. Your username is <b>$username</b> and password is <b>$password</b>.<br><span style=color:red> Please make the payment of Rs.499 to activate the account. Without activating you will not be able to login into your account</span>";
        $this->sendEmailAfterNTSE($username,$password);
		return ["success" => $success ,"sid"=>$sid,"message"=>$message];
	}

	public function sendEmailAfterPTQE($username,$password){
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
				<p><b>PTQE 2024</b> is a specially designed initiative to encourage young talent with rewards & Scholarships 
				worth Crores and a chance to be nurtured for future goals.</p>
				<p>You can access all the information related to PTQE-2024 exam such as syllabus, sample papers
				 on the following url https://www.pinnacloeducare.com/ptqe-2024/</p>
				<p>Your roll no for PTQE2024 is</p>
				Roll No: <b>PTQE$username</b><br>
				
				<p>For any type of query please whatsapp us  at +91-8248918528</p>  
				<p>Regards,</p>
				<p>Pinnacle Educare</p>
			</body>
		</html>";

		$this->sendemail->sendEmail($student->email,"Confirmation of registration for PTQE_2024 with Pinnacle Educare",$message);
		    //	$this->load->library("sms");
		    //	$smsMessage = "Your registration for NTSE is successful. Your username is $username and password is $password. You can login at https://www.pinnacloeducare.com/test";
			//		$response=$this->sms->sendSMS($student->phone,$smsMessage);
	}

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
		    //	$this->load->library("sms");
		    //	$smsMessage = "Your registration for NTSE is successful. Your username is $username and password is $password. You can login at https://www.pinnacloeducare.com/test";
			//		$response=$this->sms->sendSMS($student->phone,$smsMessage);
	}
	
	public function randomPassword()
	{
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
}
