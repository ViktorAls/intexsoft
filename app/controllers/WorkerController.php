<?php
	
	namespace app\controllers;
	
	
	use app\core\BaseController;
	use app\lib\Error;
    use app\lib\Request;
    use app\lib\Session;
    use app\models\worker;
	
	class WorkerController extends BaseController
	{
		public function before()
		{
			return [
				'information' => ['user'],
			];
		}


        /**
         * @return mixed
         * @throws Error
         */
        public function informationAction()
		{
			$worker = new worker();
			$user = $worker->one([worker::id_user => $_SESSION['idUser']]);
			$id = key($user);
			$user = array_shift($user);
			if (!empty($user)) {
				if (Request::getNotNull('worker')) {
					$worker->update(Request::post('worker'), [worker::id => $id]);
					return header("Refresh:0");
				}
				$organization = $worker->workerOrganizations([worker::id_user =>Session::get('idUser')]);
				return $this->views->render('Личные данные работника', ['user' => $user, 'organization' => $organization]);
			} else {
                throw new Error('Страница не найдена',404);
			}
		}
	}