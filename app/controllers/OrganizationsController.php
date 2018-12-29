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
				if($organizations->update($_POST['organization'], [Organization::id => $_GET['id']])){
					$result = ['type' => 'success', 'message' => 'Организация успешно обновлена'];
				} else {
					$result = ['type' => 'error', 'message' => 'При обнавлении произошла ошибка'];
				}
				$_SESSION[$result['type']]= $result['message'];
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
		
		public function createAction(){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$organization = new Organization();
				if($organization->save($_POST['organization'])){
					$result = ['type' => 'success', 'message' => 'Организация успешно добавлена'];
				} else {
					$result = ['type' => 'error', 'message' => 'При сохранении произошла ошибка'];
				}
				$_SESSION[$result['type']]= $result['message'];
				header('Location: ' . $_SERVER['REQUEST_URI']);
			} else {
				$this->views->render('Добавить новую организацию');
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
					Error::run('404');
				}
				$this->views->render('Просмотреть всю организацию', ['infOrganization' => $infOrganization, 'workers' => $workers]);
			} else {
				Error::run('423', 'Locked', 'Отстутствует обязательный параметр id ');
			}
		}
		
		public function deleteAction()
		{
		
		}
	}