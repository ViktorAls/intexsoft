<?php

	namespace app\controllers;
	
	
	use app\core\Controller;
	
	class MainController extends Controller
	{
		
		public function indexAction(){
   
			$this->views->render('Главная страница');
		}
		
		
		public function testAction(){
			$this->views->render('Не главаня страница');
		}
		
	}