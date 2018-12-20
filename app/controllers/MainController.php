<?php

	namespace app\controllers;
	
	
	use app\core\BaseController;
	use app\lib\User;
	
	class MainController extends BaseController
	{
		public function before(){
		  return [
		  	'index'=>['gust','admin','user'],
			  'test'=>['gust']
		  ];
		}
		
		public function indexAction(){
			
			$this->views->render('Главная страница');
		}
		
		public function loginAction(){
			if ( empty($_SESSION['role']) || $_SESSION['role']=='gust'){
				$user = new User('admin','admin');
			    $user->Login();
				$this->views->render('Не главаня страница');
			} else {
				header("Location:/");
			}
		}
		
		public function logoutAction(){
			User::logout();
			$this->views->render('Не главаня страница');
		}
	}