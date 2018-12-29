<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 29.12.2018
	 * Time: 12:48
	 */
	
	namespace app\controllers;
	
	
	use app\lib\Error;
	use app\models\worker;
	
	class WorkersController extends AdminController
	{
		
		/**
		 * Просмотр работника
		 */
		public function viewAction()
		{
			if (!empty($_GET['id'])) {
				$worker = new worker();
				$user = $worker->one([worker::id => $_GET['id']]);
				$user = array_shift($user);
				if (!empty($user)) {
					$organizations = $worker->workerOrganizations([worker::id => $_GET['id']]);
					$this->views->render('Личные данные работника', ['user' => $user, 'organizations' => $organizations]);
				} else {
					Error::run('404');
				}
			}else {
				Error::run('423', 'Locked', 'Отстутствует обязательный параметр id ');
			}
		}
		
		public function indexAction()
		{
			$worker = new worker();
			$user = $worker->all();
			$this->views->render('Все люди', ['user' => $user]);
			
		}
		public function createAction()
		{
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$worker = new worker();
				if($worker->save($_POST['worker'])){
					$result = ['type' => 'success', 'message' => 'Работник успешно добавлен'];
				} else {
					$result = ['type' => 'error', 'message' => 'При сохранении произошла ошибка'];
				}
				$_SESSION[$result['type']]= $result['message'];
				header('Location: ' . $_SERVER['REQUEST_URI']);
			} else {
				$this->views->render('Добавить новую организацию');
			}
		}
		
		public function updateAction()
		{
			$worker = new worker();
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				if($worker->update($_POST['worker'], [worker::id => $_GET['id']])){
					$result = ['type' => 'success', 'message' => 'Работник успешно обновлен'];
				} else {
					$result = ['type' => 'error', 'message' => 'При обнавлении произошла ошибка'];
				}
				$_SESSION[$result['type']]= $result['message'];
				header('Location: ' . $_SERVER['REQUEST_URI']);
			} else {
				if (!empty($_GET['id'])) {
					$id = $_GET['id'];
					$worker = $worker->one([worker::id => $id]);
					if ($worker) {
						$this->views->render('Обновление рабочего', ['worker' => $worker]);
					} else {
						Error::run('404');
						
					}
				} else {
					Error::run('423', 'Locked', 'Отстутствует обязательный параметр id ');
				}
			}
		}
	}