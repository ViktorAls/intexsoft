<?php

	namespace app\controllers;
	
	
	use app\core\Controller;
	
	class MainController extends Controller
	{
		
		public function indexAction(){
             $_SESSION['name']=4;
              var_dump($_SESSION);
			$this->views->render('Главная страница');
		}
		
		
		public function testAction(){
			$_SESSION['name']=4;
			$this->views->render('Не главаня страница');
		}
		
	}