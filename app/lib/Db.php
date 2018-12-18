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
		
		public $pdo;
		
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
		
		public function execute($query, array $params=null)
		{
			
			if(is_null($params)){
				$stmt = $this->pdo->query($query);
				return $stmt->fetchAll();
			}
			$stmt = $this->pdo->prepare($query);
			$stmt->execute($params);
			return $stmt->fetchAll();
			
		}
	}