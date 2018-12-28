<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 23.12.2018
	 * Time: 18:33
	 */
	
	namespace app\controllers;
	
	
	use app\core\BaseController;
	use app\models\Organization;
	
	class AdminController extends BaseController
	{
		
		public function before()
		{
			return [
				'organization' => ['admin'],
				'worker'=>['admin'],
				'view'=>['admin'],
			];
		}
		
		public function organizationAction()
		{
			$organization = new Organization();
		  $this->views->render('Организации',['organization'=>$organization->all()]);
		}
		
		public function viewAction()
		{
			$this->views->render('Просмотреть всю организацию');
		}
		
		public function workerAction()
		{
			$this->views->render('Просмотреть рабочего');
		}
	}
	