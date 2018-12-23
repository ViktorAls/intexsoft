<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 23.12.2018
	 * Time: 20:59
	 */
	
	namespace app\core;
	use app\lib\Db;
	
	abstract class Model
	{
		protected $tableName;
		
		public function __construct()
		{
			$a = ['name','surname'];
			$db = new Db();
			$db->execute('SHOW COLUMNS FROM '.$this->tableName);
			foreach ($a as $item) {
				$this->{$item};
			}
		}
        
	}