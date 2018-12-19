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
		public $user = 'admin';
		
		public function __construct($route)
		{
			$this->route = $route;
			$this->views = new View($route);
			if($this->Access()){echo 'Доступ есть';}else{echo 'Доступ запрещен';}
		}
		
		public function Access()
		{
			if (method_exists($this, 'before')) {
				$role = $this->before();
				if ( array_key_exists($this->user,$role)==1 && count($role[$this->user]) !=0  ) {
					if (in_array($this->route['action'],$role[$this->user])){
						return true;
					} else {
						return false;
					}
				}
			} return false;
		}
	
	}