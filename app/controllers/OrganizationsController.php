<?php
/**
 * Created by PhpStorm.
 * User: vipvi_mc4
 * Date: 29.12.2018
 * Time: 12:49
 */

namespace app\controllers;


use app\lib\Error;
use app\lib\Request;
use app\lib\Session;
use app\models\Organization;
use app\models\WorkerOrganization;

class OrganizationsController extends AdminController
{

    /**
     * Просмотр всех организаций
     */
    public function indexAction()
    {
        $organization = new Organization();
        $this->views->render('Организации', ['organization' => $organization->all()]);
    }

    /**
     * @throws Error
     */
    public function updateAction()
    {
        $organizations = new Organization();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($organizations->update($_POST['organization'], [Organization::id => $_GET['id']])) {
                $result = ['type' => 'success', 'message' => 'Организация успешно обновлена'];
            } else {
                $result = ['type' => 'error', 'message' => 'При обнавлении произошла ошибка'];
            }
            Session::set($result['type'], $result['message']);
            header('Location: ' . $_SERVER['REQUEST_URI']);
        } else {
            if (!empty($_GET['id'])) {
                $id = $_GET['id'];
                $organization = $organizations->one([Organization::id => $id]);
                if ($organization) {
                    return $this->views->render('Обновление организации', ['organization' => $organization]);
                } else {
                    throw new Error('Страница не найдена ', 404);
                }
            } else {
                throw new Error('Отсутствует обязательный параметр id', 423);
            }
        }
    }

    /**
     * @return mixed
     */
    public function createAction()
    {
//		    var_dump($_POST);
        if (Request::isPost()) {
            $organization = new Organization();
            if ($organization->save($_POST['organization'])) {
                $result = ['type' => 'success', 'message' => 'Организация успешно добавлена'];
                Session::set($result['type'], $result['message']);
                return header('Location: ' . $_SERVER['REQUEST_URI']);
            } else {
                $result = ['type' => 'error', 'message' => 'При сохранении произошла ошибка'];
                Session::set($result['type'], $result['message']);
            }
        }
        return $this->views->render('Добавить новую организацию');
    }


    /**
     * Просмотр отдельной организации и её работников
     * @throws Error
     */
    public function viewAction()
    {
        if (!empty($_GET['id'])) {
            $organization = new Organization();
            $workers = $organization->workersOrganization($_GET['id']);
            $infOrganization = $organization->one([Organization::id => $_GET['id']]);
            if (empty($infOrganization)) {
                throw new Error('Страница не найдена', 404);
            }
            return $this->views->render('Просмотреть всю организацию', ['infOrganization' => $infOrganization, 'workers' => $workers]);
        } else {
            throw new Error('Отсутствует обязательный параметр id', 423);
        }
    }

    /**
     * @return mixed|void
     * @throws Error
     */
    public function deleteAction()
    {
        if (Request::isPost()) {
            if (Request::getNotNull('id')) {
                $organization = new Organization();
                if (!empty($organization->one([Organization::id => $_GET['id']]))) {
                    if (!empty($organization->delete([Organization::id => $_GET['id']]))) {
                        $result = ['type' => 'success', 'message' => 'Организация успешно удалена'];
                    } else {
                        $result = ['type' => 'error', 'message' => 'При удалении произошла ошибка'];
                    }
                } else {
                    throw new Error('Страница не найдена', 404);
                }
            } else {
                throw new Error('Отсутствует обязательный параметр id', 423);
            }
            Session::set($result['type'], $result['message']);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            throw new Error('Страница не найдена', 404);
        }
    }

    /**
     * @return mixed|void
     * @throws Error
     */
    public function refAction()
    {
        if (Request::isPost()) {
            if (!empty($_GET['organization']) || !empty($_GET['worker'])) {
                $workerOrganization = new WorkerOrganization();
                if ($workerOrganization->ref($_GET['organization'], $_GET['worker']) >= 1) {
                    $result = ['type' => 'success', 'message' => 'Работник уволен'];
                } else {
                    $result = ['type' => 'error', 'message' => 'Произошла ошибка'];
                }
            } else {
                throw new Error('Отстутствует обязательный параметр worker или organization', 423);
            }
            Session::set($result['type'], $result['message']);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            throw new Error('Страница не найдена', 404);
        }
    }

}