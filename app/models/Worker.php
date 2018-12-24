<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 24.12.2018
	 * Time: 12:24
	 */
	
	namespace app\models;
	
	
	use app\core\Model;
	
	class worker extends Model
	{
		
		const id = 'id_worker';
		const organizations_id = 'organizations_id';
		
		public static function tableName()
		{
			return 'workers';
		}
		
		
		public function workerOrganizations($id){
			$query = " SELECT * FROM".self::tableName();
			$worker = $this->db->execute($query);
			$query = "SELECT ".self::tableName().".* FROM ".self::tableName()." LEFT JOIN ".worker::tableName()." ON ".self::tableName().".".self::id." = ".worker::tableName().".".worker::organizations_id." where ".self::tableName().".".self::id;
			
		}
		
	}