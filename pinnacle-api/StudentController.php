<?php
require_once("SimpleRest.php");
require_once("Student.php");

class StudentController extends SimpleRest {

	private $conn;

	public function __construct($conn){
		$this->conn=$conn;
	}

	public function getProfile($id) {
		$student = new Student($this->conn);
		$rawData = $student->getProfile($id);


		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = array('error' => 'Not Found');		
		} else {
			$statusCode = 200;
		}

		$this->setHttpHeaders("application/json", $statusCode);
		echo $this->encodeJson($rawData);
	}

	public function getNoticeboards($id) {
		$student = new Student($this->conn);
		$rawData = $student->getNoticeboards($id);

		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = array('error' => 'Not Found');		
		} else {
			$statusCode = 200;
		}

		$this->setHttpHeaders("application/json", $statusCode);
		echo $this->encodeJson($rawData);
	}

	public function getExams($id) {
		$student = new Student($this->conn);
		$rawData = $student->getExams($id);

		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = array('error' => 'Not Found');		
		} else {
			$statusCode = 200;
		}

		$this->setHttpHeaders("application/json", $statusCode);
		echo $this->encodeJson($rawData);
	}

	public function getAssignments($id) {
		$student = new Student($this->conn);
		$rawData = $student->getAssignments($id);

		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = array('error' => 'Not Found');		
		} else {
			$statusCode = 200;
		}

		$this->setHttpHeaders("application/json", $statusCode);
		echo $this->encodeJson($rawData);
	}

	public function getVideoLectures() {
		$student = new Student($this->conn);
		$rawData = $student->getVideoLectures($_GET['id']);

		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = array('error' => 'Not Found');		
		} else {
			$statusCode = 200;
		}

		$this->setHttpHeaders("application/json", $statusCode);
		echo $this->encodeJson($rawData);
	}

	public function getTimetable($date,$id) {
		$student = new Student($this->conn);
		$rawData = $student->getTimetable($date,$id);

		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = array('error' => 'Not Found');		
		} else {
			$statusCode = 200;
		}

		$this->setHttpHeaders("application/json", $statusCode);
		echo $this->encodeJson($rawData);
	}

	public function getTimetableData($date,$id) {
		$student = new Student($this->conn);
		$rawData = $student->getTimetableData($date,$id);

		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = array('error' => 'Not Found');		
		} else {
			$statusCode = 200;
		}

		$this->setHttpHeaders("application/json", $statusCode);
		echo $this->encodeJson($rawData);
	}


	public function getAttendance($date,$id) {
		$student = new Student($this->conn);
		$rawData = $student->getAttendance($date,$id);

		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = array('error' => 'Not Found');		
		} else {
			$statusCode = 200;
		}

		$this->setHttpHeaders("application/json", $statusCode);
		echo $this->encodeJson($rawData);
	}

	public function getAttendanceData($date,$id) {
		$student = new Student($this->conn);
		$rawData = $student->getAttendanceData($date,$id);

		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = array('error' => 'Not Found');		
		} else {
			$statusCode = 200;
		}

		$this->setHttpHeaders("application/json", $statusCode);
		echo $this->encodeJson($rawData);
	}

	public function getSMS($id) {
		$student = new Student($this->conn);
		$rawData = $student->getSMS($id);

		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = array('error' => 'Not Found');		
		} else {
			$statusCode = 200;
		}

		$this->setHttpHeaders("application/json", $statusCode);
		echo $this->encodeJson($rawData);
	}

	public function getHomework($id) {
		$student = new Student($this->conn);
		$rawData = $student->getHomework($id);

		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = array('error' => 'Not Found');		
		} else {
			$statusCode = 200;
		}

		$this->setHttpHeaders("application/json", $statusCode);
		echo $this->encodeJson($rawData);
	}

	public function postVideoLectures() {
		$student = new Student($this->conn);
		$rawData = $student->postVideoLectures();

		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = array('error' => 'Not Found');		
		} else {
			$statusCode = 200;
		}

		$this->setHttpHeaders("application/json", $statusCode);
		echo $this->encodeJson($rawData);
	}

	public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;		
	}

	public function getData(){
		$putfp = fopen('php://input', 'r');
		$putdata = '';
		while($data = fread($putfp, 1024))
		    $putdata .= $data;
		fclose($putfp);
		parse_str($putdata,$put);
		return $put;
	}

	
}
?>