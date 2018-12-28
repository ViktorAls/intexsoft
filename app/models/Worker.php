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
		const firstname = 'firstname';
		const middlename = 'middlename';
		const lastname = 'lastname';
		const inn = 'inn';
		const snils = 'snils';
		const birthday = 'birthday';
		
		public static function tableName()
		{
			return 'workers';
		}
		
		
		public function rule (){
			
			return [
				[['firstname','middlename','lastname','inn','snils'],['required']],
				[['snils','inn'],['number']],
				[['birthday'],['date']]
			];
		}
		
		/**
		 * @param $id
		 * @return array
		 * Выводит все организации для работника, попути хватая 1,75 ставки.
		 */
		public function workerOrganizations($id)
		{
			$id = (int)$id;
			$query = "SELECT " . Organization::tableName() . ".*,WorkerOrganization.rate FROM (" . Organization::tableName() . " JOIN WorkerOrganization USING (" . Organization::id . ")) JOIN " . self::tableName() . " USING (" . self::id . ") where " . self::tableName() . "." . self::id_user . " = " . $id;
			return $this->db->execute($query);
		}
		
		
		public function update(array $array, array $id)
		{
			if ($this->validation($array)){
				if ($this->db->update(self::tableName(), $array, $id)) {
					return true;
				} else {
					return false;
				}
			}
		}
		
		
		
	}