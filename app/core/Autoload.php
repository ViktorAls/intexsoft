<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 18.12.2018
	 * Time: 21:27
	 */
	
	namespace app\core;
	
	
	class Autoload
	{
		
		public static function register(){
			spl_autoload_register(function ($class){
				$path = str_replace('\\','/',$class.'.php');
				if (file_exists($path)){
					include $path;
				}
			});
		}
		
	}
	
	Autoload::register();