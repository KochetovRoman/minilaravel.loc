<?php
namespace application\models;

use application\core\Model;

class Main extends Model
{
    public $error;

    /**
     * Валидация формы обратной связи
     * @param $post
     * @return bool
     */
    public function contactValidate($post)
    {
        $nameLen = iconv_strlen($post['name']);
        $textLen = iconv_strlen($post['message']);
        if ($nameLen < 2 or $nameLen > 20) {
            $this->error = 'Имя должно содержать от 2 до 20 символов';
            return false;
        } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error = 'Email указан не верно';
            return false;
        } elseif ($textLen < 3 or $textLen > 500) {
            $this->error = 'Сообщение должно содержать от 3 до 500 символов';
            return false;
        }
        return true;
    }

    /**
     * Количество постов в БД
     * @return mixed
     */
    public function postsCount()
    {
        return $this->db->column('SELECT COUNT(id) FROM posts');
    }

    /**
     * Список постов на одной странице
     * @param $route
     * @return array
     */
    public function postsList($route)
    {
        $max = 10;
        $params = [
            'max'   => $max,
            'start' => ((($route['page'] ? $route['page'] : 1) - 1)*$max),
        ];
        return $this->db->row('SELECT * FROM posts ORDER BY id DESC LIMIT :start, :max', $params);
    }
}
