<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 19.12.2018
	 * Time: 21:33
	 */
	
	namespace app\lib;
	
	
	use app\core\View;
	
	class Error
	{
		
		public static function run(){
			 $vib = new View(['action'=>'error','controller'=>'main']);
			 $vib->render('Ошибка');
		}
	}