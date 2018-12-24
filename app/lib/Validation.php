<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 24.12.2018
	 * Time: 19:21
	 */
	
	namespace app\lib;
	
	
	class Validation
	{
		public static function Range($value,$options){
			$options = [
				'options' => [
					'min_range' => $options[0],
					'max_range' => $options[1],
				]
			];
			
			if (filter_var($value, FILTER_VALIDATE_FLOAT, $options) != FALSE) {
				return true;
			} else {
				return false;
			}
		}
	}