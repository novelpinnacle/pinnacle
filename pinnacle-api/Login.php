<?php
Class Login {
	private $conn;

	public function __construct($conn){
		$this->conn=$conn;
	}
	
	public function getLogin($username,$password){
		$sql="select login.id,name,email from login inner join erp_students es on es.sid=login.id where login.username=? and login.password=? and login.role='student'";
	
		$stmt=$this->conn->prepare($sql);
		$stmt->execute([$username,$password]);
		$rs=$stmt->fetch(PDO::FETCH_ASSOC);
		return $rs;
	}	
}
?>