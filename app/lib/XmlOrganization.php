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
						$this->obrabotka($xml);
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
		
		public function obrabotka($xml)
		{
			$db = new Db();
			$organ = new Organization();
			foreach ($xml->org as $organization) {
				$jsonOrgan = json_encode($organization->attributes());
				$saveOrganization = reset(json_decode($jsonOrgan, true));
				$organ->save($saveOrganization);
				$idOrganization = key($db->findOne(Organization::tableName(), '=', [Organization::ogrn => $saveOrganization[Organization::ogrn]]));
				foreach ($organization as $key => $user) {
					$jsonWorker = json_encode($user->attributes());
					$user = reset(json_decode($jsonWorker, true));
					$workerBD = $db->findOne(worker::tableName(), '=', [worker::inn=>$user['inn']]);
					if (!empty($workerBD)) {
						$idWorker = key($workerBD);
						$worker = $db->whereAnd(WorkerOrganization::tableName(), [
							WorkerOrganization::organization_id => $idOrganization,
							WorkerOrganization::id_worker => $idWorker
						]);
						if (empty($worker)) {
							$WorkerOrganization = new WorkerOrganization();
							$WorkerOrganization->save([WorkerOrganization::id_worker => $idWorker,
								WorkerOrganization::organization_id => $idOrganization,
								WorkerOrganization::rate => $user['rate']
							]);
						}
					} else {
						$worker = new worker();
						$worker->save($user);
						$workerBD = $db->findOne(worker::tableName(), '=', [worker::inn=>$user['inn']]);
						$idWorker = $workerBD[worker::id];
						$WorkerOrganization = new WorkerOrganization();
						$WorkerOrganization->save([WorkerOrganization::id_worker => $idWorker,
							WorkerOrganization::organization_id => $idOrganization,
							WorkerOrganization::rate => $user['rate']
						]);
					}
				}
			}
		}
		
	}