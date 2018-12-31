<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 28.12.2018
	 * Time: 23:40
	 */
	
	namespace app\models;
	
	
	use app\core\Model;
	
	class WorkerOrganization extends Model
	{
		
		const id = 'id';
		const id_worker = 'id_worker';
		const organization_id = 'organization_id';
		const rate = 'rate';
		
		public static function tableName()
		{
			return 'WorkerOrganization';
		}
		
		
		public function rule (){
			
			return [
				[['rate'],['range',['min'=>1,'max'=>1.75]]],
			];
		}
		
		public function ref($IdOrganization, $IdWorker){
			return 	$this->db->ref("DELETE FROM ".self::tableName().' where '.self::organization_id.' = '.$IdOrganization." AND ".self::id_worker.' = '.$IdWorker);
		}
		
	}