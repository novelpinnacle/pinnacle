<?php
require_once("LoginController.php");
require_once("StudentController.php");
require_once("db.php");

$service = "";
if(isset($_GET["service"])){
	$service = $_GET["service"];
}



if($service!="Login"){
	if(!isset($_REQUEST["token"])){
		die(json_encode(["error"=>"Token Not Provided"]));
	}
	$token=base64_decode($_REQUEST["token"]);
	$token=explode("PINNACLE", $token)[1];
	if(201*($_REQUEST["id"]*404)!=$token){
		//die(json_encode(["error"=>"Invalid Token"]));
	}
}

$method=strtolower($_SERVER["REQUEST_METHOD"]);
switch($service){

	case "Login":
		$logincontroller = new LoginController($conn);
		if(!method_exists($logincontroller, "$method$service")){
			header("HTTP/1.1 404 Invalid Resource");
			exit;
		}
		call_user_func_array(array($logincontroller,$method.$service),array($_GET["username"],$_GET["password"]));
	break;

	case "Profile":

		$StudentController = new StudentController($conn);
		if(!method_exists($StudentController, "$method$service")){
			header("HTTP/1.1 404 Invalid Resource");
			exit;
		}
		call_user_func_array(array($StudentController,$method.$service),[$_GET["id"]]);
	break;

	case "Noticeboards":

		$StudentController = new StudentController($conn);
		if(!method_exists($StudentController, "$method$service")){
			header("HTTP/1.1 404 Invalid Resource");
			exit;
		}
		call_user_func_array(array($StudentController,$method.$service),[$_GET["id"]]);
	break;

	case "Exams":

		$StudentController = new StudentController($conn);
		if(!method_exists($StudentController, "$method$service")){
			header("HTTP/1.1 404 Invalid Resource");
			exit;
		}
		call_user_func_array(array($StudentController,$method.$service),[$_GET["id"]]);
	break;

	case "Assignments":

		$StudentController = new StudentController($conn);
		if(!method_exists($StudentController, "$method$service")){
			header("HTTP/1.1 404 Invalid Resource");
			exit;
		}
		call_user_func_array(array($StudentController,$method.$service),[$_GET["id"]]);
	break;

	case "VideoLectures":

		$StudentController = new StudentController($conn);
		if(!method_exists($StudentController, "$method$service")){
			header("HTTP/1.1 404 Invalid Resource");
			exit;
		}
		call_user_func_array(array($StudentController,$method.$service),[]);
	break;

	case "Timetable":

		$StudentController = new StudentController($conn);
		if(!method_exists($StudentController, "$method$service")){
			header("HTTP/1.1 404 Invalid Resource");
			exit;
		}
		call_user_func_array(array($StudentController,$method.$service),[$_GET["date"],$_GET["id"]]);
	break;

	case "TimetableData":

		$StudentController = new StudentController($conn);
		if(!method_exists($StudentController, "$method$service")){
			header("HTTP/1.1 404 Invalid Resource");
			exit;
		}
		call_user_func_array(array($StudentController,$method.$service),[$_GET["date"],$_GET["id"]]);
	break;

	case "Attendance":

		$StudentController = new StudentController($conn);
		if(!method_exists($StudentController, "$method$service")){
			header("HTTP/1.1 404 Invalid Resource");
			exit;
		}
		call_user_func_array(array($StudentController,$method.$service),[$_GET["date"],$_GET["id"]]);
	break;

	case "AttendanceData":

		$StudentController = new StudentController($conn);
		if(!method_exists($StudentController, "$method$service")){
			header("HTTP/1.1 404 Invalid Resource");
			exit;
		}
		call_user_func_array(array($StudentController,$method.$service),[$_GET["date"],$_GET["id"]]);
	break;


	case "SMS":
		$StudentController = new StudentController($conn);
		if(!method_exists($StudentController, "$method$service")){
			header("HTTP/1.1 404 Invalid Resource");
			exit;
		}
		call_user_func_array(array($StudentController,$method.$service),[$_GET["id"]]);
	break;

	case "Homework":

		$StudentController = new StudentController($conn);
		if(!method_exists($StudentController, "$method$service")){
			header("HTTP/1.1 404 Invalid Resource");
			exit;
		}
		call_user_func_array(array($StudentController,$method.$service),[$_GET["id"]]);
	break;
}

?>