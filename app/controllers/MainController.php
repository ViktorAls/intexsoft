<?php

	namespace app\controllers;
	
	
	use app\core\Controller;
	use app\lib\User;
	
	class MainController extends Controller
	{
		public function before(){
		  return [
		  	'user'=>['index'],
			'admin'=>['test','index'],
		  ];
		}
		
		public function indexAction(){
             $_SESSION['name']=4;
			$this->views->render('Главная страница');
		}
		
		
		public function testAction(){
			
			$user = new User('admin','dfdf');
			echo '<pre>';
		echo	print_r($user->findUser());
			echo '</pre>';
			$this->views->render('Не главаня страница');
		}
		
	}