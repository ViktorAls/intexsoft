<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 18.12.2018
	 * Time: 23:54
	 */
	
	namespace app\core;
	
	
	abstract class Controller
	{
		public $route;
		public $views;
		
		public function __construct($route)
		{
			$this->route = $route;
			$this->views = new View($route);
			if($this->Access()){
				echo 'Доступ есть';
			}
			else{
				echo 'Доступ запрещен';
			}
		}
		
		public function Access()
		{
			if (method_exists($this, 'before')) {
				$role = $this->before();
				if ( array_key_exists($this->route['action'],$role)) {
					if (in_array($_SESSION['role'],$role[$this->route['action']])){
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