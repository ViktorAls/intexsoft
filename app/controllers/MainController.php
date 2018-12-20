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