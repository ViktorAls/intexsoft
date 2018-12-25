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
		public static function Range($value, array $options)
		{
			
			if ($value >= $options['min'] || $value <= $options['max']) {
				return true;
			} else {
				return false;
			}
		}
		
		public static function Number($value)
		{
			
			if (is_int($value)) {
				return true;
			} else {
				return false;
			}
		}
		
		
		public static function Unique($table, array $id)
		{
			$db = new Db();
			$flag = $db->findOne($table['tableName'], '=', $id);
			if (empty($flag)) {
				return true;
			} else {
				return false;
			}
		}
		
		public static function Date($date)
		{
			if ($date > $date("Y-m-d")) {
				return false;
			} else {
				return true;
			}
		}
	}