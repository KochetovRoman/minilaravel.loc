<?php
namespace application\models;

use application\core\Model;
//use Imagick;

class Admin extends Model
{
    public $error;

    /**
     * Проверка логина и пароля администратора
     * @param $post
     * @return bool
     */
    public function loginValidate($post)
    {
        $config = require 'application/config/admin.php';
        if ($config['login'] != $post['login'] || $config['password'] != $post['password']) {
            $this->error = 'Логин или пароль введен не верно';
            return false;
        }
        return true;
    }

    /**
     * Проверка формы добавление поста
     * @param $post
     * @param $type
     * @return bool
     */
    public function postValidate($post, $type)
    {
        $nameLen = iconv_strlen($post['title']);
        $descriptionLen = iconv_strlen($post['description']);
        $textLen = iconv_strlen($post['text']);
        if ($nameLen < 2 or $nameLen > 100) {
            $this->error = 'Название должно содержать от 2 до 100 символов';
            return false;
        } elseif ($descriptionLen < 2 or $descriptionLen > 100) {
            $this->error = 'Описание должно содержать от 2 до 100 символов';
            return false;
        } elseif ($textLen < 3 or $textLen > 5000) {
            $this->error = 'Текст должен содержать от 3 до 500 символов';
            return false;
        }
        if (empty($_FILES['img']['tmp_name']) and $type == 'add') {
                $this->error = 'Изображение не выбрано';
                return false;
            }
        return true;
    }

    /**
     * Добавление поста в БД
     * @param $post
     * @return string
     */
    public function postAdd($post)
    {
        $params = [
            'id'          => '',
            'title'       => $post['title'],
            'description' => $post['description'],
            'text'        => $post['text'],
            'pubdate'     => date("Y-m-d H:i:s"),
        ];
        $this->db->query('INSERT INTO posts VALUE (:id, :title, :description, :text, :pubdate)', $params);
        return $this->db->lastInsertId();
    }

    /**
     * Редактирование поста
     * @param $post
     * @param $id
     */
    public function postEdit($post, $id)
    {
        $params = [
            'id'          => $id,
            'title'       => $post['title'],
            'description' => $post['description'],
            'text'        => $post['text'],
            'pubdate'     => date("Y-m-d H:i:s"),

        ];
        $this->db->query('UPDATE posts SET title = :title, description = :description, text = :text, pubdate = :pubdate WHERE id = :id', $params);
    }

    /**
     * Перемещение картинки поста в нужную папку
     * @param $path
     * @param $id
     */
    public function postUploadImage($path, $id)
    {/*
        $img = new Imagick($path);
        $img->cropThumbnailImage(600, 600);
        $img->setImageCompressionQuality(80);
        $img->writeImage('public/materials/'.$id.'.jpg');*/
        move_uploaded_file($path, 'public/materials/'.$id.'.jpg');
    }

    /**
     *
     * @param $id
     * @return mixed
     */
    public function isPostExists($id) {
        $params = [
            'id' => $id,
        ];
        return $this->db->column('SELECT id FROM posts WHERE id = :id', $params);
    }

    /**
     * Удаление поста из БД
     * @param $id
     */
    public function postDelete($id) {
        $params = [
            'id' => $id,
        ];
        $this->db->query('DELETE FROM posts WHERE id = :id', $params);
        unlink('public/materials/'.$id.'.jpg');
    }

    /**
     * Выборка поста
     * @param $id
     * @return array
     */
    public function postData($id) {
        $params = [
            'id' => $id,
        ];
        return $this->db->row('SELECT * FROM posts WHERE id = :id', $params);
    }
}