<?php

	namespace app\controllers;
	
	
	use app\core\Controller;
	
	class MainController extends Controller
	{
		
		public function indexAction(){

			$this->views->render('Главная страница');
		}
	}