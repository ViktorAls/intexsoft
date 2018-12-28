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
					}
					$_SESSION['success'] = 'Рабочии успешно добавленны';
					header("Location: " . $_SERVER['HTTP_REFERER']);
				} else {
					$_SESSION['error'] = 'Произошла ошибка загрузки файла';
					header("Location: " . $_SERVER['HTTP_REFERER']);
				}
			} else {
				$_SESSION['error'] = 'Произошла ошибка загрузки файлов';
				header("Location: " . $_SERVER['HTTP_REFERER']);
			}
		}
		
		public function treatment($xml)
		{
			$db = new Db();
			$organ = new Organization();
			foreach ($xml->org as $organization) {
				$saveOrganization = $this->convertToArray($organization->attributes());
				$organ->save($saveOrganization);
				$idOrganization = key($db->findOne(Organization::tableName(), '=', [Organization::ogrn => $saveOrganization[Organization::ogrn]]));
				foreach ($organization as $key => $user) {
					$user = $this->convertToArray($user->attributes());
					$workerBD = $db->findOne(worker::tableName(), '=', [worker::inn=>$user['inn']]);
					if (!empty($workerBD)) {
						$idWorker = key($workerBD);
						var_dump($idWorker);
						$worker = $db->whereAnd(WorkerOrganization::tableName(), [
							WorkerOrganization::organization_id => $idOrganization,
							WorkerOrganization::id_worker => $idWorker
						]);
						if (empty($worker)) {
							$this->saveConn($idWorker,$idOrganization,$user['rate']);
						}
					} else {
						$worker = new worker();
						$worker->save($user);
						$workerBD = $db->findOne(worker::tableName(), '=', [worker::inn=>$user['inn']]);
						$idWorker = $workerBD[worker::id];
						$this->saveConn($idWorker,$idOrganization,$user['rate']);
					}
				}
			}
		}
		
		public function convertToArray($xml){
			$json = json_encode($xml->attributes());
			return reset(json_decode($json, true));
		}
		
		public function saveConn($idWorker,$idOrganization,$rate){
			$WorkerOrganization = new WorkerOrganization();
			$WorkerOrganization->save([WorkerOrganization::id_worker => $idWorker,
				WorkerOrganization::organization_id => $idOrganization,
				WorkerOrganization::rate => $rate
			]);
		}
	}