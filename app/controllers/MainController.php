<?php

	namespace app\controllers;
	
	
	use app\core\BaseController;
	use app\lib\User;
	
	class MainController extends BaseController
	{
		public function before(){
		  return [
		  	'index'=>['admin'],
			  'test'=>['user']
		  ];
		}
		
		public function indexAction(){
			
			$this->views->render('Главная страница');
		}
		
		public function testAction(){
			if (empty($_SERVER['role'])){
			$user = new User('admin','admin');
		    $user->Login();}
			$this->views->render('Не главаня страница');
		}
		
		public function logoutAction(){
			User::logout();
			$this->views->render('Не главаня страница');
		}
	}