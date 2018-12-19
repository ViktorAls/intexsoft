<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 19.12.2018
	 * Time: 13:19
	 */
	
	namespace app\lib;
	
	
	class User
	{
		public $db;
		protected $name;
		protected $password;
		public function __construct($name,$password)
		{
			$this->db= new Db();
		   $this->setName($name);
		   $this->setPassword($password);
		}
		
		public function getRole(){
			if (empty($_SESSION['role'])){
				return $_SESSION['role'];
			}
		}
		
		
		private function setRole(){
		
		}
		
		public function findUser(){
		  $re =  $this->db->execute('SELECT * FROM user WHERE name = "'.$this->name.'" and WHERE password = "'.$this->password.'"');
		  if (empty($re)){
		  	return false;
		  }else {
		  return $re;
		}
		}
		
		public function setName($name){
			$name = strip_tags($name);
			$name = htmlentities($name, ENT_QUOTES, "UTF-8");
			$this->name = htmlspecialchars($name, ENT_QUOTES);
		}
		
		public function setPassword($password){
			$password = strip_tags($password);
			$password = htmlentities($password, ENT_QUOTES, "UTF-8");
			$this->password = htmlspecialchars($password, ENT_QUOTES);
		}
	}