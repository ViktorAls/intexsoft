<?php
	
	namespace app\controllers;
	
	use app\core\BaseController;
	use app\models\Organization;
	use app\models\User;
	
	class MainController extends BaseController
	{
		public function before()
		{
			return [
				'index' => ['gust', 'admin', 'user'],
				'login' => ['gust'],
				'logout' => ['admin', 'user'],
			];
		}
		
		/**
		 * @return mixed
		 */
		public function indexAction()
		{
			$organization = new Organization();
			if (!empty($_GET['search'])) {
				return $this->views->render('Главная страница', ['organization' => $organization->Like($_GET['search'])]);
			} else {
				return $this->views->render('Все организации', ['organization' => $organization->all()]);
			}
			
		}
		
		public function loginAction()
		{
			if (empty($_SESSION['role']) || $_SESSION['role'] == 'gust') {
				if (!empty($_POST['name']) || !empty($_POST['password'])) {
					$user = new User($_POST['name'], $_POST['password']);
					if (!$user->Login()) {
						return $this->views->render('Авторизация', ['error' => 'Не верный логин/пароль.']);
					} else {
						return header("Location:/");
					}
				} else {
					return $this->views->render('Авторизация');
				}
			} else {
				return header("Location:/");
			}
		}
		
		public function organizationAction()
		{
		 return	$this->views->render('Просмотр информации о организации');
		}
		
		public function logoutAction()
		{
			if (!empty($_SESSION['role']) && $_SESSION['role'] != 'gust') {
				User::logout();
			}
			header("Location:/");
		}
	}