<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 24.12.2018
	 * Time: 12:22
	 */
	
	namespace app\models;
	
	
	use app\core\Model;
	
	class Organization extends Model
	{

		const displayName = 'displayName';
		const ogrn ='ogrn';
		const oktmo ='oktmo';
		const id = 'organization_id';
		
		public static function tableName()
		{
			return 'organizations';
		}
		
		public function Like ($var){
			$query = "SELECT * FROM ".self::tableName()." WHERE ". self::ogrn ." LIKE ? OR ". self::displayName ." LIKE ? OR ". self::oktmo ." LIKE ? ";
			return $this->db->execute($query,["%$var%","%$var%","%$var%"]);
		}
		
		public  function allInformation (){
		
			$query = "SELECT count( ".Worker::tableName().".".worker::id." ) as workers, ".self::tableName().".* FROM (".self::tableName()." JOIN WorkerOrganization USING (".self::id.")) JOIN ".worker::tableName()." USING (".worker::id.") GROUP BY ".self::tableName().".".self::id;
			return	$this->db->execute($query);
		}
	}