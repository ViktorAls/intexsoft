<?php
/**
 * Created by PhpStorm.
 * User: vipvi_mc4
 * Date: 29.12.2018
 * Time: 12:48
 */

namespace app\controllers;


use app\lib\Error;
use app\lib\Request;
use app\lib\Session;
use app\models\Worker;

class WorkersController extends AdminController
{

    /**
     * @return mixed
     * @throws Error
     */
    public function viewAction()
    {
        if (Request::getNotNull('id')) {
            $worker = new worker();
            $user = $worker->one([worker::id => Request::get('id')]);
            $user = array_shift($user);
            if (!empty($user)) {
                $organizations = $worker->workerOrganizations([worker::id => Request::get('id')]);
                return $this->views->render('Личные данные работника', ['user' => $user, 'organizations' => $organizations]);
            } else {
                throw new Error('Страница не найдена', 404);
            }
        } else {
            throw new Error('Отсутствует обязательный парметр id', 423);
        }
    }

    /**
     * @return mixed
     */
    public function indexAction()
    {
        $worker = new worker();
        $user = $worker->all();
        return $this->views->render('Все люди', ['user' => $user]);
    }

    /**
     * @return mixed
     */
    public function createAction()
    {
        if (Request::isPost()) {
            $worker = new worker();
            if ($worker->save(Request::post('worker'))) {
                $result = ['type' => 'success', 'message' => 'Работник успешно добавлен'];
            } else {
                $result = ['type' => 'error', 'message' => 'При сохранении произошла ошибка'];
            }
            Session::set($result['type'], $result['message']);
            return header('Location: ' . $_SERVER['REQUEST_URI']);
        } else {
            return $this->views->render('Добавить новую организацию');
        }
    }

    /**
     * @return mixed
     * @throws Error
     */
    public function updateAction()
    {
        $worker = new worker();
        if (Request::isPost()) {
            if ($worker->update(Request::post('worker'), [worker::id => Request::get('id')])) {
                $result = ['type' => 'success', 'message' => 'Работник успешно обновлен'];
            } else {
                $result = ['type' => 'error', 'message' => 'При обнавлении произошла ошибка'];
            }
            Session::set($result['type'], $result['message']);
            return header('Location: ' . $_SERVER['REQUEST_URI']);
        } else {
            if (Request::getNotNull('id')) {
                $id = Request::get('id');
                $worker = $worker->one([worker::id => $id]);
                if ($worker) {
                    return $this->views->render('Обновление рабочего', ['worker' => $worker]);
                } else {
                    throw new Error('Страница не найдена', 404);
                }
            } else {
                throw new Error('Отсутствует обязательный парметр id', 423);
            }
        }
    }

    /**
     * @return mixed
     * @throws Error
     */
    public function deleteAction()
    {
        if (Request::isPost()) {
            if (Request::getNotNull('id')) {
                $worker = new worker();
                if (!empty($worker->one([worker::id => $_GET['id']]))) {
                    if (!empty($worker->delete([worker::id => $_GET['id']]))) {
                        $result = ['type' => 'success', 'message' => 'Работник успешно удален'];
                    } else {
                        $result = ['type' => 'error', 'message' => 'При удалении произошла ошибка'];
                    }
                } else {
                    throw new Error('Страница не найдена', 423);
                }
            } else {
                throw new Error('Отсутствует обязательный парметр id', 423);
            }
            Session::set($result['type'], $result['message']);
            return header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            throw new Error('Страница не найдена', 404);
        }
    }
}