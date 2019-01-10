<?php

namespace app\controllers;

use app\core\BaseController;
use app\lib\Error;
use app\lib\Request;
use app\lib\Session;
use app\models\Organization;
use app\models\User;
use Exception;

class MainController extends BaseController
{
    public function before()
    {
        return [
            'index' => ['gust', 'admin', 'user'],
            'login' => ['gust'],
            'logout' => ['admin', 'user'],
        ];
    }

    /**
     * @return mixed
     */
    public function indexAction()
    {
        $organization = new Organization();
        if (!empty(Request::get('search'))) {
            return $this->views->render('Главная страница', ['organization' => $organization->Like($_GET['search'])]);
        } else {
            return $this->views->render('Все организации', ['organization' => $organization->all()]);
        }

    }

    public function loginAction()
    {
        if (!Session::isNotNull('role') || Session::get('role') == 'gust') {
            if (!empty(Request::post('name')) || !empty(Request::post('password'))) {
                $user = new User(Request::post('name'), Request::post('password'));
                if (!$user->Login()) {
                    return $this->views->render('Авторизация', ['error' => 'Не верный логин/пароль.']);
                } else {
                    return header("Location:/");
                }
            } else {
                return $this->views->render('Авторизация');
            }
        } else {
            return header("Location:/");
        }
    }

    public function organizationAction()
    {
        return $this->views->render('Просмотр информации о организации');
    }

    public function logoutAction()
    {
        if (Session::isNotNull('role') || Session::get('role') != 'gust') {
            User::logout();
        }
        header("Location:/");
    }
}