<?php
	
	namespace app\controllers;
	
	use app\core\BaseController;
	use app\lib\User;
	use app\models\Organization;
	
	class MainController extends BaseController
	{
		public function before()
		{
			return [
				'index' => ['gust', 'admin', 'user'],
				'login' => ['gust'],
				'logout'=>['admin','user'],
			];
		}
		
		public function indexAction()
		{
			if (!empty($_POST['search'])){
				echo 'ujn';
			}else {
				$o = new Organization();
				var_dump($o->all());
				$this->views->render('Главная страница');
			}
		}
		
		public function loginAction()
		{
			if (empty($_SESSION['role']) || $_SESSION['role'] == 'gust') {
				if (!empty($_POST['name']) || !empty($_POST['password'])) {
					$user = new User($_POST['name'], $_POST['password']);
					if (!$user->Login()) {
						$this->views->render('Авторизация', ['error' => 'Не верный логин/пароль.']);
					} else {
						header("Location:/");
					}
				} else {
					$this->views->render('Авторизация');
				}
			} else {
				header("Location:/");
			}
		}
		
		public function organizationAction()
		{
			$this->views->render('Просмотр информации о оргонизации');
			
		}
		
		public function logoutAction()
		{
			if (!empty($_SESSION['role']) && $_SESSION['role'] != 'gust') {
				User::logout();
				header("Location:/");
			} else {
				header("Location:/");
			}
		}
	}