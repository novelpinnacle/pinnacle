<?php
require_once("SimpleRest.php");
require_once("Login.php");

class LoginController extends SimpleRest {

	private $conn;

	public function __construct($conn){
		$this->conn=$conn;
	}

	public function getLogin($username,$password) {
		$login = new login($this->conn);
		$rawData = $login->getLogin($username,$password);


		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = array('error' => 'Username Or Password was wrong!');		
		} else {
			$statusCode = 200;
			$token=base64_encode("PINNACLE".(201)*($rawData['id']*404));
			$rawData["token"]=$token;
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