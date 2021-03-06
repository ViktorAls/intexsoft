<?php
	
	namespace app\core;
	
	use app\lib\Error;
	
	class Router
	{
        /**
         * @var array
         */
		protected $routes = [];
        /**
         * @var array
         */
		protected $params = [];
		
		public function __construct()
		{
			$arr = require_once 'app/config/routes.php';
			foreach ($arr as $key => $val) {
				$this->add($key, $val);
			}
		}
		
		/**
		 * @param $route
		 * @param $params
		 */
		public function add($route, $params)
		{
			$route = '#^' . $route . '$#';
			$this->routes[$route] = $params;
		}
		
		/**
		 * @return bool
		 */
		public function match()
		{
			$flag = false;
			$url = trim($_SERVER['REQUEST_URI'], '/');
			If (strpbrk($url, ' ?')) {
				$url = stristr($url, '?', true);
			}
			
			foreach ($this->routes as $route => $params) {
				if (preg_match($route, $url, $matches)) {
					$this->params = $params;
					$flag = true;
				}
			}
			return $flag;
		}
		
		/**
		 * @return mixed
		 */
		public function run()
		{
			if ($this->match()) {
				$path = 'app\controllers\\' . ucfirst($this->params['controller']) . 'Controller';
				if (class_exists($path)) {
					$action = $this->params['action'] . 'Action';
					if (method_exists($path, $action)) {
						$controller = new $path($this->params);
						try {
                            return $controller->$action();
                        }catch (Error $e){
                             return $e->run();
                        }
					}
				}
			}
//			return Error::run(56,'Контроллер или action не найдены');
		}
	}
	