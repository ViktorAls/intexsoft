<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 19.12.2018
	 * Time: 0:02
	 */
	
	namespace app\core;
	
	
	class View
	{
		public $route;
		public $path;
		public $layout = 'default';
		
		public function __construct($route)
		{
			$this->route = $route;
			$this->path = $route['controller'] . '/' . $route['action'];
		}
		
		public function render($title, $items = [])
		{
			ob_start();
			require 'app/views/' . $this->path . '.php';
			$content = ob_get_clean();
			require 'app/views/layout/' . $this->layout . '.php';
			exit();
		}
	}