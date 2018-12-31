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
		
		/**
		 * @param array $id -['поле'=>'значение'];
		 * @return array
		 */
		public function one(array $id)
		{
			return $this->db->findOne($this->tableName(), '=', $id);
		}
		
		/**
		 * @param array $id - ['поле'=>'значение'];
		 * @return bool
		 */
		public function delete( array $id){
			return $this->db->delete($this->tableName(), '=', $id);
		}
		
		/**
		 * @param array $array   ключ = поле в  базе, значение = то что мы в него сохраняем
		 * @param array $id - ['поле'=>'значение'];
		 * @return bool
		 */
		public function update(array $array, array $id)
		{
			$array = $this->neutralize($array);
			if ($this->validation($array)){
				if ($this->db->update($this->tableName(), $array, $id)) {
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
		 * @param array $value   ключ = поле в  базе, значение = то что мы в него сохраняем
		 * @return bool
		 */
		public function save(array $value){
			$value = $this->neutralize($value);
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
								$params= $value[1][1];
								if (empty($params)){
									if (!Validation::$method($item)){
										$answer = false;
										break 2;
									}
								} else {
									if (!Validation::$method($item,$params)){
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
		 *  Беру массив правел и
		 *  заменяю ключи  на значения из
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
		
		public function setNeutralizeValue($value)
		{
			$value = strip_tags($value);
			$value = htmlentities($value, ENT_QUOTES, "UTF-8");
			return htmlspecialchars($value, ENT_QUOTES);
		}
		
		public function neutralize($array){
			foreach ($array as $key => $item ){
				$array[$key]=$this->setNeutralizeValue($item);
			}
			return $array;
		}
		
	}