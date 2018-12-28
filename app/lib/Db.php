<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 19.12.2018
	 * Time: 0:38
	 */
	
	namespace app\lib;
	
	
	use PDO;
	
	class Db
	{
		
		protected $pdo;
		
		public function __construct()
		{
			$settings = $this->getPDOSettings();
			$this->pdo = new \PDO($settings['dsn'], $settings['user'], $settings['pass'], null);
		}
		
		protected function getPDOSettings()
		{
			$config = include 'app\config\Db.php';
			$result['dsn'] = "{$config['type']}:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
			$result['user'] = $config['user'];
			$result['pass'] = $config['pass'];
			return $result;
		}
		
		public function execute($query, array $params = null)
		{
			if (is_null($params)) {
				$stmt = $this->pdo->query($query);
				return $stmt->fetchAll(PDO::FETCH_UNIQUE);
			}
			$stmt = $this->pdo->prepare($query);
			$stmt->execute($params);
			return $stmt->fetchAll(PDO::FETCH_UNIQUE);
		}
		
		public function findAll($table)
		{
			$query = 'SELECT * FROM ' . $table;
			return $this->execute($query);
		}
		
		public function findOne($table, $sign, array $id)
		{
			$query = 'SELECT * FROM ' . $table . ' WHERE ' . key($id) . ' ' . $sign . ' ' . reset($id) . ' limit 1';
			return $this->execute($query);
		}
		
		
		/**
		 * @param $id = ключ: название поля, значение =  что изменяем.
		 * @param $table - название табилци
		 * @param array $value - ключ: куда вставлять, элемент - значение.
		 * @return bool
		 */
		public function update($table, array $value, array $id){
			$key = array_keys($value);
			$keys = null;
			foreach ($key as $item){
				$keys .= $item.'=:'.$item.', ';
			}
			$keys = substr($keys,0,-2);
			$sql = "UPDATE ".$table." SET ".$keys." WHERE ".key($id)."='".reset($id)."'";
			$stmt= $this->pdo->prepare($sql);
			if ($stmt->execute($value)){
				return true;
			}else {
				return false;
			}
		}
		
		public function deleteALL ($tableName){
			$count = $this->pdo->exec("DELETE FROM ".$tableName);
			return $count;
		}
		
		public function delete ($tableName,$sign, array $id){
			$count = $this->pdo->exec("DELETE FROM ".$tableName.' where '.key($id).' '.$sign.' '.reset($id));
			return $count;
		}
	}