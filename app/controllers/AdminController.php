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
    use app\lib\Request;
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
         * @return mixed
         * @throws Error
         */
		public function XmlAction()
		{
			if (Request::isPost()) {
				$xml = new XmlOrganization;
				$xml->file($_FILES['file']);
			} else {
                throw new Error('Страница не найдена',404);
			}
		}
	}
	