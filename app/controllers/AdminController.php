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
	use app\lib\XmlOrganization;
	
	
	class AdminController extends BaseController
	{
		/**
		 * @return array
		 * Права доступа
		 */
		public function before()
		{
			return [
				'index' => ['admin'],
				'view' => ['admin'],
				'update' => ['admin'],
				'create' => ['admin'],
				'delete' => ['admin'],
				'xml' => ['admin'],
			
			];
		}
		
		/**
		 * Загрузка xml для обработки
		 */
		/**
		 * @return mixed
		 */
		public function XmlAction()
		{
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$xml = new XmlOrganization;
				$xml->file($_FILES['file']);
			} else {
				return Error::run('404');
			}
		}
		
	}
	