<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 24.12.2018
	 * Time: 12:24
	 */
	
	namespace app\models;
	
	
	use app\core\Model;
	use app\lib\Validation;
	
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
		
		
		public function workerOrganizations($id)
		{
			$id = (int)$id;
			$query = "SELECT " . Organization::tableName() . ".*,WorkerOrganization.rate FROM (" . Organization::tableName() . " JOIN WorkerOrganization USING (" . Organization::id . ")) JOIN " . self::tableName() . " USING (" . self::id . ") where " . self::tableName() . "." . self::id_user . " = " . $id;
			return $this->db->execute($query);
		}
		
		public function update(array $array, array $id)
		{
			
			$this->Validation($array);
			if ($this->db->update(self::tableName(), $array, $id)) {
				return false;
			} else {
				return false;
			}
		}
		
		public function Validation($array)
		{
			if ($array[self::firstname] == '' || $array[self::middlename] == '' || $array[self::lastname] == '' || $array[self::inn] == '' || $array[self::snils] == '') {
				$_SESSION['error']['null'] = ['Поля не должны быть пустыми.'];
			} else if (Validation::Date($array[self::birthday])) {
				$_SESSION['error']['date'] = ['Дата не может быть больше текущей.'];
			} else if (!is_int($array[self::inn]) || !is_int($array[self::snils])) {
				$_SESSION['error']['number'] = ['СНИЛС и ИНН должны быть целыми числами.'];
			}
			if (Validation::Unique(worker::tableName(), [worker::inn => $array[worker::inn]]) || Validation::Unique(worker::tableName(), [worker::snils => $array[worker::snils]])) {
				$_SESSION['error']['unique'] = ['СНИЛС и ИНН должны быть уникальными.'];
			}
			echo '<pre>';
			var_dump($_SESSION['error']);
			echo '</pre>';
		}
		
		
	}