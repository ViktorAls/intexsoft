<?php

	namespace app\controllers;
	
	
	use app\core\BaseController;
	use app\lib\User;
	
	class MainController extends BaseController
	{
		public function before(){
		  return [
		  	'index'=>['admin','user'],
		  ];
		}
		
		public function indexAction(){
			var_dump($_SESSION);
			$this->views->render('Главная страница');
		}
		
		public function testAction(){
			$user = new User('admin','admin');
		    $user->Login();
		    var_dump($_SESSION);
			$this->views->render('Не главаня страница');
		}
		
		public function logoutAction(){
			User::logout();
			$this->views->render('Не главаня страница');
		}
	}