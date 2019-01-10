<?php
	namespace app\models;
	
	use app\core\Model;
    use app\lib\Session;

    class User extends Model
	{
		protected $name;
		protected $password;

		public static function tableName()
		{
		    return 'user';
		}

		public function __construct($name, $password)
		{
			parent::__construct();
			$this->setName($name);
			$this->setPassword($password);
		}
		
		public function Login()
		{
			if ($this->findUser() != 'gust') {
				$user = $this->findUser();
				Session::set('role',$user['role']);
                Session::set('idUser',$user['id']);
				return true;
			} else {
				return false;
			}
		}
		
		public static function logout()
		{
			if (session::isNotNull('idUser') || session::isNotNull('role')) {
			    Session::delete('idUser');
                Session::delete('role');
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