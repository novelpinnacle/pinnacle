<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

	public function index()
	{

		$this->load->model("loginmodel");
		$login=$this->loginmodel->verifyLogin($_POST);
		if($login){
			$_SESSION['username']=$login->username;
			$_SESSION['role']=$login->role;
			$_SESSION['userid']=$login->id;

			$token=$this->getToken($_POST["username"],$_POST["password"],$login->role);
			setcookie("token",$token,time()+(86400*30),"/",null,null,true);

			if(isset($_POST["remember"])){
				setcookie("username",$login->username,time()+(86400*30),"/");
				setcookie("role",$login->role,time()+(86400*30),"/");
				setcookie("userid",$login->id,time()+(86400*30),"/");
			}

			$roles_urls=["coordinator"=>"user","librarien"=>"user","receptionist"=>"user","teacher"=>"teacher","student"=>"student","admin"=>"admin"];

			header("location:".base_url().$roles_urls[$login->role]);
		
		}
		else{
		$this->loginform("<span style='color:red;font-size:16px;padding:10px;background:#fff;font-weight:500;border-radius:7px;'>Username or Password was wrong</span>");
		}
	}

	private function getToken($username,$password,$role){
		$ch = curl_init("https://www.pinnacloeducare.com/exam/login/gettoken/".$username."/".$password."/".$role);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$curl_scraped_page = curl_exec($ch);
		curl_close($ch);
		return $curl_scraped_page;
	}

	public function loginform($status=""){
		if(isset($_COOKIE["username"]) && isset($_COOKIE["userid"]) && isset($_COOKIE["role"])){
			$_SESSION=$_COOKIE;
		}
		if(isset($_SESSION["username"]) && isset($_SESSION["userid"]) && isset($_SESSION["role"])){
			$roles_urls=["coordinator"=>"user","librarien"=>"user","receptionist"=>"user","teacher"=>"teacher","student"=>"student","admin"=>"admin"];

			header("location:".base_url().$roles_urls[$_SESSION["role"]]);
		}
		$this->load->view("loginform",["status"=>$status]);
	}

	public function logout(){
		session_destroy();
		if (isset($_SERVER['HTTP_COOKIE'])) {
		    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
		    foreach($cookies as $cookie) {
		        $parts = explode('=', $cookie);
		        $name = trim($parts[0]);
		        setcookie($name, '', time()-1000);
		        setcookie($name, '', time()-1000, '/');
		    }
		}

		header("location:".base_url());
	}
}
