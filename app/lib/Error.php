<?php
/**
 * Created by PhpStorm.
 * User: vipvi_mc4
 * Date: 19.12.2018
 * Time: 21:33
 */

namespace app\lib;


use app\core\View;
use Exception;

class Error extends Exception
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
     * @return mixed
     */
    public function run()
    {
        $code = $this->getCode();
        $title = $this->getTitle($code);
        $message = $this->getMessage();
        $vib = new View(['action' => 'error', 'controller' => 'main']);
        return $vib->render('Ошибка', ['code' => $code, 'title' => $title, 'message' => $message]);
    }

    /**
     * @param int $code
     * @return string
     */
    private function getTitle($code)
    {
        if (!empty(self::ERROR[$code])) {
            return self::ERROR[$code]['title'];
        } else {
            return 'Unidentified error';
        }

    }


}