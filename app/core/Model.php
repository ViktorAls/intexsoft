<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 23.12.2018
	 * Time: 20:59
	 */
	
	namespace app\core;
	
	use app\lib\Db;
	use app\lib\Validation;
	
	abstract class Model
	{
		
		abstract static public function tableName();
		
		protected $db;
		
		public function __construct()
		{
			$this->db = new Db();
		}
		
		public function all()
		{
			return $this->db->findAll($this->tableName());
		}
		
		public function one(array $id)
		{
			return $this->db->findOne($this->tableName(), '=', $id);
		}
		
		public function delete($id){
			return $this->db->findOne($this->tableName(), '=', $id);
		}
		
		/**
		 * @param array $array - ключ = поле, значение = на что менем
		 * @param array $id - запись которую меняем
		 * @return bool
		 * Неоходим для обновления данных в базу
		 */
		public function update(array $array, array $id)
		{
			if ($this->validation($array)){
<<<<<<< HEAD
				if ($this->db->update(self::tableName(), $array, $id)) {
=======
				if ($this->db->update($this->tableName(), $array, $id)) {
>>>>>>> master
					$answer = true;
				} else {
					$answer = false;
				}
			} else {
				$answer = false;
			}
			return $answer;
		}
		
		public function save(array $value){
			if ($this->validation($value)) {
				if ($this->db->save($this->tableName(), $value)) {
					$answer = true;
				} else {
					
					$answer = false;
				}
			} else {
				$answer = false;
			}
			return $answer;
			
		}
		
		/**
		 * @param $array - массив ключ:поле, значение - то, что валидируем
		 * @return bool = если все гуд, то true
		 */
		public function validation($array)
		{
			if (method_exists($this, 'rule')) {
				$answer = true;
				$rules =$this->validFieldValues($array);
				
				if (!empty($rules)) {
					foreach ($rules as $key => $value){
						foreach ($value[0] as $keys => $item){
							if (array_key_exists($keys,$array)){
								$method = $value[1][0];
<<<<<<< HEAD
								if (empty($value[1][1])){
=======
								$params= $value[1][1];
								if (empty($params)){
>>>>>>> master
									if (!Validation::$method($item)){
										$answer = false;
										break 2;
									}
								} else {
<<<<<<< HEAD
									$params= $value[1][1];
									if (!Validation::$method($item,$params)){
										
=======
									if (!Validation::$method($item,$params)){
>>>>>>> master
										$answer = false;
										break 2;
									}
								}
							}
						}
					}
				} else {
					$answer = true;
				}
			} else {
				$answer = true;
			}
			return $answer;
		}
		
		/**
		 * @param $array - массив значений для валидацииц
		 * @return array - исправленный массив
		 *  Беру массив правел для валидации и
		 *  заменяю ключ в массиве правел на значения из
		 *  массива который пришел для сохранения.
		 */
		public function validFieldValues($array)
		{
			$rules = $this->rule();
			foreach ($rules as $key => $values){
				foreach ($values[0] as $i => $value){
					if (array_key_exists($value,$array)){
					 $rules[$key][0][$value] = $array[$value];
					}
					unset($rules[$key][0][$i]);
				}
			}
			return $rules;
		}
		
	}