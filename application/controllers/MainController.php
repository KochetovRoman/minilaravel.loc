<?php
namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;
use application\models\Admin;

class MainController extends Controller
{
    public function indexAction()
    {
        $this->view->render('Главная страница');
    }

    public function aboutAction()
    {
        $this->view->render('Обо мне');
    }

    public function contactAction()
    {
        if (!empty($_POST)) {
            if (!$this->model->contactValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }

            mail('titanium.rrr@gmail.com', 'Сообщение от '.$_POST['name'].'|Email: '.$_POST['email'].'| Текст сообщения: '.$_POST['message']);
            $this->view->message('success', 'Сообщение отправлено Администратору');
        }
        $this->view->render('Контакты');
    }

    public function postAction()
    {
        $pagination = new Pagination($this->route, $this->model->postsCount());
        $vars = [
            'pagination' => $pagination->get(),
            'list'       => $this->model->postsList($this->route),
        ];
        $this->view->render('Посты', $vars);
    }

    public function postitemAction()
    {
        $adminModel = new Admin();
        if (!$adminModel->isPostExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        $vars = [
            'data' => $adminModel->postData($this->route['id'])[0],
        ];
        $this->view->render('Пост', $vars);
    }

    public function portfolioAction()
    {
        $this->view->render('Портфолио');
    }
}