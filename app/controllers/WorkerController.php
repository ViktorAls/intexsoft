<?php
	
	namespace app\controllers;
	
	
	use app\core\BaseController;
	
	class WorkerController extends BaseController
	{
		public function before()
		{
			return [
				'information' => ['user'],
			];
		}
		
		public function informationAction(){
			$this->views->render('Попадёт только работник');
		}
	}