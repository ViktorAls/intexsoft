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
		}
	}