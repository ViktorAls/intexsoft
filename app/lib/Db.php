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
		
		/**
		 * @var Db;
		 */
		private static $instance;

        /**
         * Db constructor.
         */
		public function __construct()
		{
			$settings = $this->getPDOSettings();
			$this->pdo = new \PDO($settings['dsn'], $settings['user'], $settings['pass'], null);
		}
		
		/**
		 * @return Db
		 */
		public static function getInstance()
		{
			if (null === self::$instance)
			{
				self::$instance = new self();
			}
			return self::$instance;
		}

        /**
         * @return mixed
         */
		protected function getPDOSettings()
		{
			$config = include 'app/config/Db.php';
			$result['dsn'] = "{$config['type']}:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
			$result['user'] = $config['user'];
			$result['pass'] = $config['pass'];
			return $result;
		}

        /**
         * @param string $query
         * @param array|null $params
         * @return array
         */
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

        /**
         * @param string $table
         * @return array
         */
		public function findAll($table)
		{
			$query = 'SELECT * FROM ' . $table;
			return $this->execute($query);
		}

        /**
         * @param string $table
         * @param string $sign
         * @param array $id
         * @return array
         */
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

        /**
         * @param string $table
         * @param array $value
         * @return bool
         */
		public function save($table, array $value){
			$key = array_keys($value);
			$fields = implode(',',$key);
			$fieldsParams = ":".implode(', :',$key);
			$stmt = $this->pdo->prepare("INSERT INTO ".$table."(".$fields.") VALUES(".$fieldsParams.")");
			if ($stmt->execute($value)){
				return true;
			}else {
				return false;
			}
		}
		
		/**
		 * @params string $tableName
		 * @return int
		 */
		public function deleteALL ($tableName){
			$count = $this->pdo->exec("DELETE FROM ".$tableName);
			return $count;
		}
		
		/**
		 * @param string $tableName
		 * @param string $sign
		 * @param array $id
		 * @return int
		 */
		public function delete ($tableName,$sign, array $id){
			$count = $this->pdo->exec("DELETE FROM ".$tableName.' where '.key($id).' '.$sign.' '.reset($id));
			return $count;
		}
		
		/**
		 * @param string $table
		 * @param array $array
		 * @return array
		 */
		public function whereAnd($table,array $array){
			$key = array_keys($array);
			$query = 'SELECT * FROM ' . $table.' WHERE '.$key[0].' = '.$array[$key[0]].' AND '.$key[1].' = '.$array[$key[1]];
			return $this->execute($query);
		}
		
		/**
		 * @param $value
		 * @return int
		 */
		public function ref ($value){
			$count = $this->pdo->exec($value);
			return $count;
		}
	}