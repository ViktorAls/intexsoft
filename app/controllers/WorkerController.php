<?php
	
	namespace app\controllers;
	
	
	use app\core\BaseController;
	use app\core\models\UserModel;
	
	class WorkerController extends BaseController
	{
		public function before()
		{
			return [
				'information' => ['user'],
			];
		}
		
		public function informationAction(){

			$new = new UserModel();
			
			$this->views->render('Попадёт только работник');
		}
	}