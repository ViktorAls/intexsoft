<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 29.12.2018
	 * Time: 12:49
	 */
	
	namespace app\controllers;
	
	
	use app\lib\Error;
	use app\models\Organization;
	use app\models\WorkerOrganization;
	
	class OrganizationsController extends AdminController
	{
		
		/**
		 * Просмотр всех организаций
		 */
		public function indexAction()
		{
			$organization = new Organization();
			$this->views->render('Организации', ['organization' => $organization->all()]);
		}
		
		public function updateAction()
		{
			$organizations = new Organization();
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				if ($organizations->update($_POST['organization'], [Organization::id => $_GET['id']])) {
					$result = ['type' => 'success', 'message' => 'Организация успешно обновлена'];
				} else {
					$result = ['type' => 'error', 'message' => 'При обнавлении произошла ошибка'];
				}
				$_SESSION[$result['type']] = $result['message'];
				header('Location: ' . $_SERVER['REQUEST_URI']);
			} else {
				if (!empty($_GET['id'])) {
					$id = $_GET['id'];
					$organization = $organizations->one([Organization::id => $id]);
					if ($organization) {
						$this->views->render('Обновление организации', ['organization' => $organization]);
					} else {
						Error::run('404');
						
					}
				} else {
					Error::run('423', 'Locked', 'Отстутствует обязательный параметр id ');
				}
			}
		}
		
		/**
		 * @return mixed
		 */
		public function createAction()
		{
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$organization = new Organization();
				if ($organization->save($_POST['organization'])) {
					$result = ['type' => 'success', 'message' => 'Организация успешно добавлена'];
				} else {
					$result = ['type' => 'error', 'message' => 'При сохранении произошла ошибка'];
				}
				$_SESSION[$result['type']] = $result['message'];
				header('Location: ' . $_SERVER['REQUEST_URI']);
			} else {
				return $this->views->render('Добавить новую организацию');
			}
		}
		
		
		/**
		 * Просмотр отдельной организации и её работников
		 */
		public function viewAction()
		{
			if (!empty($_GET['id'])) {
				$organization = new Organization();
				$workers = $organization->workersOrganization($_GET['id']);
				$infOrganization = $organization->one([Organization::id => $_GET['id']]);
				if (empty($infOrganization)) {
					return Error::run('404');
				}
				return $this->views->render('Просмотреть всю организацию', ['infOrganization' => $infOrganization, 'workers' => $workers]);
			} else {
				return Error::run('423', 'Locked', 'Отстутствует обязательный параметр id ');
			}
		}
		
		public function deleteAction()
		{
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				if (!empty($_GET['id'])) {
					$organization = new Organization();
					if (!empty($organization->one([Organization::id => $_GET['id']]))) {
						if (!empty($organization->delete([Organization::id => $_GET['id']]))) {
							$result = ['type' => 'success', 'message' => 'Организация успешно удалена'];
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
		
		public function refAction()
		{
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				if (!empty($_GET['organization']) || !empty($_GET['worker'])) {
					$workerOrganization = new WorkerOrganization();
					if ($workerOrganization->ref($_GET['organization'], $_GET['worker']) >= 1) {
						$result = ['type' => 'success', 'message' => 'Работник уволен'];
					} else {
						$result = ['type' => 'error', 'message' => 'Произошла ошибка'];
					}
				} else {
					return Error::run('423', 'Locked', 'Отстутствует обязательный параметр worker или organization ');
				}
				$_SESSION[$result['type']] = $result['message'];
				return header('Location: ' . $_SERVER['HTTP_REFERER']);
			} else {
				return Error::run('404');
			}
		}
		
	}