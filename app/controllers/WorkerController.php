<?php
	
	namespace app\controllers;
	
	
	use app\core\BaseController;
	use app\lib\Db;
	
	class WorkerController extends BaseController
	{
		public function before()
		{
			return [
				'information' => ['user'],
			];
		}
		
		public function informationAction(){
			$organization= new Db();
			var_dump($organization->innerJoin('organizations','worker','id','id_organization'));
			$this->views->render('Попадёт только работник');
		}
	}