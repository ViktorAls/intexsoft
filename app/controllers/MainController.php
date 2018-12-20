<?php
	
	namespace app\controllers;
	
	use app\core\BaseController;
	use app\lib\User;
	
	class MainController extends BaseController
	{
		public function before()
		{
			return [
				'index' => ['gust', 'admin', 'user'],
				'test' => ['gust']
			];
		}
		
		public function indexAction()
		{
			
			$this->views->render('Главная страница');
		}
		
		public function loginAction()
		{
			if (empty($_SESSION['role']) || $_SESSION['role'] == 'gust') {
				if (!empty($_POST['name']) || !empty($_POST['password'])) {
					$user = new User($_POST['name'], $_POST['password']);
					if (!$user->Login()) {
						$this->views->render('Не главаня страница', ['error' => 'Не верный логин/пароль.']);
					} else {
						header("Location:/");
					}
				}
				$this->views->render('Не главаня страница');
			} else {
				header("Location:/");
			}
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