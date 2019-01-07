<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 29.12.2018
	 * Time: 12:48
	 */
	
	namespace app\controllers;
	
	
	use app\lib\Error;
	use app\models\Worker;
	
	class WorkersController extends AdminController
	{
		
		/**
		 * @return mixed
		 */
		public function viewAction()
		{
			if (!empty($_GET['id'])) {
				$worker = new worker();
				$user = $worker->one([worker::id => $_GET['id']]);
				$user = array_shift($user);
				if (!empty($user)) {
					$organizations = $worker->workerOrganizations([worker::id => $_GET['id']]);
					return $this->views->render('Личные данные работника', ['user' => $user, 'organizations' => $organizations]);
				} else {
					return Error::run('404');
				}
			} else {
				return Error::run('423', 'Locked', 'Отстутствует обязательный параметр id ');
			}
		}
		
		/**
		 * @return mixed
		 */
		public function indexAction()
		{
			$worker = new worker();
			$user = $worker->all();
			return $this->views->render('Все люди', ['user' => $user]);
		}
		
		/**
		 * @return mixed|void
		 */
		public function createAction()
		{
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$worker = new worker();
				if ($worker->save($_POST['worker'])) {
					$result = ['type' => 'success', 'message' => 'Работник успешно добавлен'];
				} else {
					$result = ['type' => 'error', 'message' => 'При сохранении произошла ошибка'];
				}
				$_SESSION[$result['type']] = $result['message'];
				return header('Location: ' . $_SERVER['REQUEST_URI']);
			} else {
				return $this->views->render('Добавить новую организацию');
			}
		}
		
		/**
		 * @return mixed|void
		 */
		public function updateAction()
		{
			$worker = new worker();
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				if ($worker->update($_POST['worker'], [worker::id => $_GET['id']])) {
					$result = ['type' => 'success', 'message' => 'Работник успешно обновлен'];
				} else {
					$result = ['type' => 'error', 'message' => 'При обнавлении произошла ошибка'];
				}
				$_SESSION[$result['type']] = $result['message'];
				return header('Location: ' . $_SERVER['REQUEST_URI']);
			} else {
				if (!empty($_GET['id'])) {
					$id = $_GET['id'];
					$worker = $worker->one([worker::id => $id]);
					if ($worker) {
						return $this->views->render('Обновление рабочего', ['worker' => $worker]);
					} else {
						return Error::run('404');
					}
				} else {
					return Error::run('423', 'Locked', 'Отстутствует обязательный параметр id ');
				}
			}
		}
		
		/**
		 * @return mixed|void
		 */
		public function deleteAction()
		{
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				if (!empty($_GET['id'])) {
					$worker = new worker();
					if (!empty($worker->one([worker::id => $_GET['id']]))) {
						if (!empty($worker->delete([worker::id => $_GET['id']]))) {
							$result = ['type' => 'success', 'message' => 'Работник успешно удален'];
						} else {
							$result = ['type' => 'error', 'message' => 'При удалении произошла ошибка'];
						}
					} else {
						return Error::run('404');
					}
				} else {
					return Error::run('423', 'Locked', 'Отстутствует обязательный параметр id ');
				}
				$_SESSION[$result['type']] = $result['message'];
				return header('Location: ' . $_SERVER['HTTP_REFERER']);
			} else {
				return Error::run('404');
			}
		}
	}