<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 28.12.2018
	 * Time: 17:13
	 */
	
	namespace app\lib;
	
	
	use app\models\Organization;
	use app\models\worker;
	use app\models\WorkerOrganization;
	
	class XmlOrganization
	{
<<<<<<< HEAD
=======
		// основная функция для проверки загруженного файла и сохранении его
>>>>>>> master
		public function file($xml)
		{
			$uploadDir = 'uploads';
			if ($xml['type'] == 'text/xml') {
				if ($xml['error'] == UPLOAD_ERR_OK) {
					$name = uniqid('xml_') . basename($xml["name"]);
					move_uploaded_file($xml["tmp_name"], "$uploadDir/$name");
					$xml = simplexml_load_file($uploadDir . '/' . $name);
					if (!isset($xml->org[0])) {
						$result = ['type' => 'error', 'message' => 'Не найдены данные для заполнения. Выбирите другой файл'];
					} else {
						$this->treatment($xml);
						$result = ['type' => 'success', 'message' => 'Все прошло успешно.'];
					}
				} else {
					$result = ['type' => 'error', 'message' => 'Ошибка загрузки файла'];
				}
			} else {
				$result = ['type' => 'error', 'message' => 'Не верный формат файла.'];
			}
<<<<<<< HEAD
			$_SESSION[$result['type']] = $result['message'];
=======
			$_SESSION[$result['type']]= $result['message'];
>>>>>>> master
			header("Location: " . $_SERVER['HTTP_REFERER']);
		}
		
		/**
		 * @param $xml
		 * Принимает xml файл  обходим каждую ветку, если есть организация она не сохраниться.
		 * Проверяем рабочих, если есть рабочий, то найти его id проверить не работает ли он в организации если нет, то добавить
		 * Есть рабочего нету,добавить, найти id и отправить на работу )
		 */
		public function treatment($xml)
		{
			$db = new Db();
			$organ = new Organization();
			foreach ($xml->org as $organization) {
				$saveOrganization = $this->convertToArray($organization);
				$organ->save($saveOrganization);
				$idOrganization = key($db->findOne(Organization::tableName(), '=', [Organization::ogrn => $saveOrganization[Organization::ogrn]]));
				foreach ($organization as $key => $user) {
					$user = $this->convertToArray($user);
<<<<<<< HEAD
					$workerBD = $db->findOne(worker::tableName(), '=', [worker::inn => $user['inn']]);
=======
					$workerBD = $db->findOne(worker::tableName(), '=', [worker::inn=>$user['inn']]);
>>>>>>> master
					if (!empty($workerBD)) {
						$idWorker = key($workerBD);
						$worker = $db->whereAnd(WorkerOrganization::tableName(), [
							WorkerOrganization::organization_id => $idOrganization,
							WorkerOrganization::id_worker => $idWorker
						]);
						if (empty($worker)) {
<<<<<<< HEAD
							$this->saveConn($idWorker, $idOrganization, $user['rate']);
						}
					} else {
						$worker = new worker();
						$rate = $user['rate'];
						unset($user['rate']);
						$worker->save($user);
						$workerBD = $db->findOne(worker::tableName(), '=', [worker::inn => $user['inn']]);
						$idWorker = $workerBD[worker::id];
						$this->saveConn($idWorker, $idOrganization, $rate);
=======
							$this->saveConn($idWorker,$idOrganization,$user['rate']);
						}
					} else {
						$worker = new worker();
						unset($user['rate']);
						$worker->save($user);
						$workerBD = $db->findOne(worker::tableName(), '=', [worker::inn=>$user['inn']]);
						$idWorker = $workerBD[worker::id];
						$this->saveConn($idWorker,$idOrganization,$user['rate']);
>>>>>>> master
					}
				}
			}
		}
		
<<<<<<< HEAD
		public function convertToArray($xml)
		{
=======
		public function convertToArray($xml){
>>>>>>> master
			$json = json_encode($xml->attributes());
			return reset(json_decode($json, true));
		}
		
<<<<<<< HEAD
		public function saveConn($idWorker, $idOrganization, $rate)
		{
=======
		public function saveConn($idWorker,$idOrganization,$rate){
>>>>>>> master
			$WorkerOrganization = new WorkerOrganization();
			$WorkerOrganization->save([WorkerOrganization::id_worker => $idWorker,
				WorkerOrganization::organization_id => $idOrganization,
				WorkerOrganization::rate => $rate
			]);
		}
	}