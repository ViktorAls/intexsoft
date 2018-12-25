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
		
		public function informationAction()
		{
			$worker = new worker();
			$user = $worker->one([worker::id_user => $_SESSION['idUser']]);
			$id = key($user);
			$user = array_shift($user);
			if (!empty($user)) {
				if (!empty($_POST['worker'])){
					if ($worker->save($_POST['worker'],[worker::id=>$id])) {
						header("Refresh:0");
					} else {
						header("Refresh:0");
					}
				}
				$organization = $worker->workerOrganizations($_SESSION['idUser']);
				$this->views->render('Личные данные работника', ['user' => $user, 'organization' => $organization]);
			} else {
				Error::run('404');
			}
		}
	}