<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 19.12.2018
	 * Time: 21:33
	 */
	
	namespace app\lib;
	
	
	use app\core\View;
	
	class Error
	{
		const ERROR = [
			'301' => ['title' => 'Moved Permanently', 'message' => 'Документ или страница были перемещены на другой адрес навсегда.'],
			'302' => ['title' => 'Found', 'message' => 'Документ временно перенесен на другой адрес.'],
			'304' => ['title' => 'Not Modified', 'message' => 'Дата последнего обновления Last-Modified старее, чем в запросе с заголовком If-Modified-Since.'],
			'403' => ['title' => 'Forbidden', 'message' => 'Отказано в доступе. <br><a href="/main/logout">Выход</a>  / <a href="/main/login">Вход</a>'],
			'404' => ['title' => 'Not Found', 'message' => 'По данному URL ничего не найдено — документ не существует.'],
			'410' => ['title' => 'Gone', 'message' => 'Документ был окончательно удален и более недоступен.'],
			'451' => ['title' => 'Unavailable For Legal Reasons', 'message' => 'Доступ к серверу закрыт из-за его запрета на государственном уровне или по решению суда в случае нарушения авторских прав.'],
			'500' => ['title' => 'Internal Server Error', 'message' => 'Внутренняя ошибка сервера.'],
			'503' => ['title' => 'Service Unavailable', 'message' => 'Сервер временно не может обрабатывать запросы по техническим причинам.'],
			'504' => ['title' => 'Gateway Timeout', 'message' => 'Шлюз не отвечает.'],
		
		];
		
		/**
		 * @param integer $code
		 * @param null/string $title
		 * @param null/string $message
		 */
		public static function run($code,$title=null,$message = null)
		{
			$vib = new View(['action' => 'error', 'controller' => 'main']);
		
			return $vib->render('Ошибка', self::getError($code,$title,$message));
		}
		
		/**
		 * @param integer $code
		 * @param null/string $title
		 * @param null/string $message
		 * @return array
		 */
		private static function getError($code,$title = null,$message = null)
		{
			if (empty($message)) {
				if (array_key_exists($code, self::ERROR)) {
					$bodyError = ['code' => $code,
						'message' => self::ERROR[$code]['message'],
						'title' => self::ERROR[$code]['title']];
				} else {
					$bodyError = ['code' => $code,
						'message' => 'Произошла неопознанная ошибка, мы постараемся исправить ее в ближайшее время',
						'title' => 'ERROR'];
				}
			} else {
				$bodyError = ['code' => $code,
					'message' => $message,
					'title' => $title];
			}
			return $bodyError;
		}
	}