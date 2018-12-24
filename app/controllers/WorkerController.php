<?php
	
	namespace app\controllers;
	
	
	use app\core\BaseController;
	use app\lib\Error;
	use app\lib\Validation;
	use app\models\worker;
	
	class WorkerController extends BaseController
	{
		public function before()
		{
			return [
				'information' => ['user'],
			];
		}
		
		public function informationAction(){
			$worker = new worker();
			$user = $worker->one([worker::id_user=>$_SESSION['idUser']]);
			if (!empty($user)){
				$organization = $worker->workerOrganizations($_SESSION['idUser']);
				$this->views->render('Личные данные работника',['user'=>$user,'organization'=>$organization]);
			} else {
				Error::run('404');
			}
		}
	}