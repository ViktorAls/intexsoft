<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 20.12.2018
	 * Time: 0:40
	 */
	
	namespace app\lib\interf;
	
	
	interface ErrorInterface
	{
		public static function run($code,$title,$message);
		
	}