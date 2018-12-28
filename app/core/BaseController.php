<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 18.12.2018
	 * Time: 23:54
	 */
	
	namespace app\core;
	
	
	use app\lib\Error;
	
	abstract class BaseController
	{
		public $route;
		protected $views;
		
		public function __construct($route)
		{
			$this->route = $route;
			if (!$this->Access()) {
				Error::run(403);
			}
			$this->views = new View($route);
		}
		
		public function Access()
		{
			if (method_exists($this, 'before')) {
				$role = $this->before();
				if (empty($_SESSION['role'])) {
					$_SESSION['role'] = 'gust';
				}
				if (array_key_exists($this->route['action'], $role)) {
					if (in_array($_SESSION['role'], $role[$this->route['action']])) {
						$access = true;
					} else {
						$access = false;
					}
				} else {
					$access = true;
				}
			} else {
				$access = true;
			}
			
			return $access;
		}
		
	}