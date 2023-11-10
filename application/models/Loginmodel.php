<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Loginmodel extends CI_Model{
	public function verifylogin($data){
		$username=$data['username'];
		$password=$data['password'];
		$this->db->where(["username"=>$username,"password"=>$password]);
		$query=$this->db->get("login");
		return $query->row();
	}

}
?>