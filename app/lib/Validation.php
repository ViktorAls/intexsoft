<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 24.12.2018
	 * Time: 19:21
	 */
	
	namespace app\lib;
	
	
	abstract class Validation
	{
		/**
		 * @param integer $value
		 * @param array $options
		 * @return bool
		 */
		public static function range($value, array $options)
		{
			if ($value >= $options['min'] && $value <= $options['max']) {
				return true;
			} else {
				return false;
			}
		}
		
		/**
		 * @param string $value
		 * @return bool
		 */
		public static function required ($value){
			if (!empty($value)){
				return true;
			}else {
				return false;
			}
		}
		
		/**
		 * @param string $value
		 * @return bool
		 */
		public static function number($value)
		{
			if (ctype_digit($value)) {
				return true;
			} else {
				return false;
			}
		}
		
		/**
		 * @param $date
		 * @param string $format
		 * @return bool
		 */
		public static function date($date,$format='Y-m-d')
		{
			if ($date < date($format)) {
				return true;
			} else {
				return false;
			}
		}

	}