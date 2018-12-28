<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 23.12.2018
	 * Time: 18:33
	 */
	
	namespace app\controllers;
	
	
	use app\core\BaseController;
	use app\lib\Error;
	use app\models\Organization;
	use app\models\worker;
	
	class AdminController extends BaseController
	{
		/**
		 * @return array
		 * Права доступа
		 */
		public function before()
		{
			return [
				'organization' => ['admin'],
				'worker' => ['admin'],
				'view' => ['admin'],
				'delete' => ['admin'],
			];
		}
		
		/**
		 * Просмотр всех организаций
		 */
		public function organizationAction()
		{
			$organization = new Organization();
			$this->views->render('Организации', ['organization' => $organization->all()]);
		}
		
		/**
		 * Просмотр отдельной организации и её работников
		 */
		public function viewAction()
		{
			if (!empty($_GET['id'])) {
				$organization = new Organization();
				$workers = $organization->workersOrganization($_GET['id']);
				$infOrganization = $organization->one([Organization::id=>$_GET['id']]);
				if (empty($infOrganization)){
					Error::run('404');
				}
				$this->views->render('Просмотреть всю организацию',['infOrganization'=>$infOrganization,'workers'=>$workers]);
			} else {
				Error::run('423','Locked','Отстутствует обязательный параметр id ');
			}
		}
		/**
		 * Удалить организацию
		 */
		public function deleteAction()
		{
			$or = new Organization();
			$or->deleteRelatedData();
			header("Location: " . $_SERVER['HTTP_REFERER']);
		}
		
		/**
		 * Просмотр работника
		 */
		public function workerViewAction()
		{
			if (!empty($_GET['id'])) {
				$worker = new worker();
				$user = $worker->one([worker::id => $_GET['id']]);
				$user = array_shift($user);
				if (!empty($user)) {
					$organization = $worker->workerOrganizations([worker::id => $_GET['id']]);
					$this->views->render('Личные данные работника', ['user' => $user, 'organization' => $organization]);
				} else {
					Error::run('404');
				}
			}else {
				Error::run('423', 'Locked', 'Отстутствует обязательный параметр id ');
			}
		}
		
		
		public  function  WorkerDeleteAction (){
		
		}
	}
	