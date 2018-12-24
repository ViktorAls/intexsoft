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

		abstract public static function tableName();
		protected $db;
		
		public function __construct()
		{
			$this->db = new Db();
		}
		
		public function all(){
			return $this->db->findAll($this->tableName());
		}
		
	}