<?php
namespace application\controllers;

use application\core\Controller;

class AccountController extends Controller
{
    /**
     * AccountController constructor.
     * @param $route
     */
    public function __construct($route)
    {
        parent::__construct($route);
        $this->view->layout = 'account';
    }

    public function registrationAction()
    {
        if (!empty($_POST)) {
            if (!$this->model->registrationValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            } elseif ($this->model->checkEmailExists($_POST['email'])) {
                $this->view->message('error', 'Этот Email уже используется');
            } elseif (!$this->model->checkLoginExists($_POST['login'])) {
                $this->view->message('error', $this->model->error);
            } elseif (!count($this->model->error)) {
                $this->model->registerNewUser($_POST);
                $this->view->message('success', 'Вы успешно зарегестрированны! Вам на почту отправленно письмо. Пройдите по ссылке в письме для активации на сайте');
            }
        }
        $this->view->render('Регистрация');
    }

    public function loginAction()
    {
        if (!empty($_POST)) {
            if (!$this->model->loginValidate($_POST['login'], $_POST['password'])) {
                $this->view->message('error', $this->model->error);
            } elseif (!$this->model->checkData($_POST['login'], $_POST['password'])) {
                $this->view->message('error', 'Логин или пароль указан неверно!');
            } elseif (!$this->model->checkStatus('login', $_POST['login'])) {
                $this->view->message('error', $this->model->error);
            }
            $this->model->login($_POST['login']);
            $this->view->location('account/profile');
        }
        $this->view->render('Авторизация');
    }

    public function activateAction()
    {
        if (!$this->model->checkToken($this->route['token'])) {
            $this->view->redirect('account/login');
        }
        $this->model->activateUser($this->route['token']);
        $this->view->render('Активация');
    }

    public function recoveryAction()
    {
        if (!empty($_POST)) {
            if (!$this->model->registrationValidate($_POST['email'])) {
                $this->view->message('error', 'Пользователь не найден!');
            } elseif (!$this->model->checkEmailExists($_POST['email'])) {
                $this->view->message('error', $this->model->error);
            } elseif (!$this->model->checkStatus('email', $_POST['email'])) {
                $this->view->message('error', $this->model->error);
            }
            $this->view->recovery($_POST);
            $this->view->message('success', 'Запрос на восстановление пароля отпрален на Email');
        }
        $this->view->render('Востановление пароля');
    }

    public function resetAction()
    {
        if (!$this->model->checkToken($this->route['token'])) {
            $this->view->redirect('account/login');
        }
        $password = $this->model->reset($this->route['token']);
        $vars = [
            'password' => $password,
        ];
        $this->view->render('Пароль сброшен', $vars);
    }

    public function profileAction()
    {
        if (!empty($_POST)) {
            if (!$this->model->correctEmail($_POST['email'])) {
                $this->view->message('error', $this->model->error);
            }
            $id = $this->model->checkEmailExists($_POST['email']);
            if ($id and $id != $_SESSION['account']['id']) {
                $this->view->message('error', 'Этот Email уже используется');
            }
            if (!empty($_POST['password']) and !$this->model->correctPass($_POST['password'])) {
                $this->view->message('error', $this->model->error);
            }
            $this->model->saveProfile($_POST);
            $this->view->message('success', 'Сохранено');
        }
        $this->view->render('Профиль пользователя');
    }

    public function logoutAction()
    {
        unset($_SESSION['account']);
        $this->view->redirect('');
    }
}
