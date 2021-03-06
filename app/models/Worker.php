<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 24.12.2018
	 * Time: 12:24
	 */
	
	namespace app\models;
	
	
	use app\core\Model;
	
	class Worker extends Model
	{
		
		const id = 'id_worker';
		const id_user = 'id_user';
		const firstname = 'firstname';
		const middlename = 'middlename';
		const lastname = 'lastname';
		const inn = 'inn';
		const snils = 'snils';
		const birthday = 'birthday';

        /**
         * @return string
         */
		public static function tableName()
		{
			return 'workers';
		}

        /**
         * @return array
         */
		public function rule (){
			
			return [
				[['firstname','middlename','lastname','inn','snils'],['required']],
				[['snils','inn'],['number']],
			];
		}
		
		/**
		 * @param $id
		 * @return array
		 * Выводит все организации для работника, попути хватая 1,75 ставки.
		 */
		public function workerOrganizations(array $id)
		{
			$query = "SELECT " . Organization::tableName() . ".*,".WorkerOrganization::tableName().".".WorkerOrganization::rate." FROM (" . Organization::tableName() . " JOIN ".WorkerOrganization::tableName()." USING (" . Organization::id . ")) JOIN " . self::tableName() . " USING (" . self::id . ") where " . self::tableName() . "." . key($id).' = '.reset($id);
			return $this->db->execute($query);
		}

        /**
         * @param array $id
         * @return bool
         */
		public function delete(array $id)
		{
			$this->db->delete(WorkerOrganization::tableName(),'=',[WorkerOrganization::id_worker => reset($id)]);
			return parent::delete($id);
		}
	}