<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 18.12.2018
	 * Time: 23:54
	 */
	
	namespace app\core;
	
	
	use app\lib\Error;
    use app\lib\Session;

    abstract class BaseController
	{
        /**
         * @var array
         */
		public $route;
        /**
         * @var View
         */
		protected $views;

        /**
         * BaseController constructor.
         * @param $route
         * @throws Error
         */
		public function __construct($route)
		{
			$this->route = $route;
			if (!$this->Access()) {
                throw new Error('Доступ запрещён',403);
			}
			$this->views = new View($route);
		}
		
		/**
		 * @return bool
		 */
		public function Access()
		{
			$access = true;
			if (method_exists($this, 'before')) {
				$role = $this->before();
				if (!Session::isNotNull('role')) {
				    Session::set('role','gust');
				}
				if (array_key_exists($this->route['action'], $role)) {
					if (!in_array( Session::get('role'), $role[$this->route['action']])) {
						$access = false;
					}
				}
			}
			return $access;
		}
		
	}