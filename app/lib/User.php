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
		
		public function __construct($name, $password)
		{
			$this->db = new Db();
			$this->setName($name);
			$this->setPassword($password);
		}
		
		public function Login()
		{
			if ($this->findUser() != 'gust') {
				$user = $this->findUser();
				$_SESSION['role'] = $user['role'];
				$_SESSION['idUser'] = $user['id'];
				return true;
			} else {
				return false;
			}
		}
		
		public static function logout()
		{
			if (!empty($_SESSION)) {
				unset($_SESSION['idUser']);
				unset($_SESSION['role']);
			}
		}
		
		
		public function findUser()
		{
			$user = $this->db->execute('SELECT * FROM user where name = ? and password = ? LIMIT 1', [$this->name, $this->password]);
			if (!$user) {
				return 'gust';
			} else {
				$idUser = key($user);
				return ['role'=>array_shift($user)['role'],'id'=>$idUser];
			}
		}
		
		
		public function setName($name)
		{
			$name = strip_tags($name);
			$name = htmlentities($name, ENT_QUOTES, "UTF-8");
			$this->name = htmlspecialchars($name, ENT_QUOTES);
		}
		
		public function setPassword($password)
		{
			$password = strip_tags($password);
			$password = htmlentities($password, ENT_QUOTES, "UTF-8");
			$this->password = md5(htmlspecialchars($password, ENT_QUOTES));
		}
	}