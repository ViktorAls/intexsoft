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
		const id_user = 'id_user';
		const organizations_id = 'organizations_id';
		
		public static function tableName()
		{
			return 'workers';
		}
		
		
		public function workerOrganizations($id){
			$id = (int)$id;
			$query = "SELECT ".Organization::tableName().".*,WorkerOrganization.rate FROM (".Organization::tableName()." JOIN WorkerOrganization USING (".Organization::id.")) JOIN ".self::tableName()." USING (".self::id.") where ".self::tableName().".".self::id_user." = ".$id;
			return $this->db->execute($query);
		}
		
		public function save( array $array, array $id){
			if($this->db->update(self::tableName(),$array,$id)){
				return false;
			} else {
				return false;
			}
		}
		
	}