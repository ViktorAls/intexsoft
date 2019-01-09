<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 19.12.2018
	 * Time: 0:02
	 */
	
	namespace app\core;

    /**
     * Class View
     * @package app\core
     */
	class View
	{
        /**
         * @var array $route
         */
		public $route;

		/**
         * @var string $route
         */
		public $path;

        /**
         * @var string $layout
         */
		public $layout = 'default';

        /**
         * View constructor.
         * @param $route
         */
		public function __construct( array $route)
		{
			$this->route = $route;
			$this->path = $route['controller'] . '/' . $route['action'];
		}
		
		/**
		 * @param $title
		 * @param array $items
		 * @return mixed
		 */
		public function render($title, $items = [])
		{
			ob_start();
			require 'app/views/' . $this->path . '.php';
			$content = ob_get_clean();
			return require_once 'app/views/layout/' . $this->layout . '.php';
			
		}
	}