<?php
namespace application\models;

use application\core\Model;
use application\lib\Mail;
use application\core\Core;

class Account extends Model
{
    public $error;

    /**
     * Валидация формы регистрации
     * string $loginLen длинна логина
     * string $passLen длинна пароля
     * @param array $post
     * @return bool
     */
    public function registrationValidate($post)
    {
        $loginLen = iconv_strlen($post['login']);
        $passLen = iconv_strlen($post['password']);
        if ($loginLen < 2 or $loginLen > 20) {
            $this->error = 'Логин должен содержать от 2 до 20 символов';
            return false;
        } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error = 'Email указан не верно';
            return false;
        } elseif ($passLen < 5 or $passLen > 50) {
            $this->error = 'Пароль должен содержать от 5 до 50 символов';
            return false;
        }
        return true;
    }

    /**
     * Валидация формы входа пользователя
     * @param string $login логин пользователя
     * @param string $password пароль пользователя
     * @return bool
     */
    public function loginValidate($login, $password)
    {
        $loginLen = iconv_strlen($login);
        $passLen = iconv_strlen($password);
        if ($loginLen < 2 or $loginLen > 20) {
            $this->error = 'Логин должен содержать от 2 до 20 символов';
            return false;
        } elseif ($passLen < 5 or $passLen > 50) {
            $this->error = 'Пароль должен содержать от 5 до 50 символов';
            return false;
        }
        return true;
    }

    /**
     * Аутентификация пользователя
     * @param string $login
     * @param string $password
     * @return bool
     */
    public function checkData($login, $password)
    {
        $params = [
            'login' => $login,
        ];
        $hash = $this->db->column('SELECT password FROM users WHERE login = :login', $params);
        if (!$hash or !password_verify($password, $hash)) {
            return false;
        }
        return true;
    }

    /**
     * Регистрация нового пользователя. Отправка письма на почту для активации
     * string $password хэшированный пароль пользователя
     * string $token токен активации
     * array $param данные пользователя
     * @param array $post
     */
    public function registerNewUser($post)
    {
        $password = password_hash($post['password'], PASSWORD_BCRYPT);
        $token = $this->createToken();
        $params = [
            'id'       => '',
            'login'    => $post['login'],
            'password' => $password,
            'email'    => $post['email'],
            'active'   => '',
            'token'    => $token,
            'status'   => '0',
        ];
        $this->db->query('INSERT INTO users VALUES (:id, :login, :password, :email, :active, :token, :status)', $params);
        Mail::$to = $_POST['email'];
        Mail::$text = 'Если вы регистрировались на сайте, то пройдите по ссылке для активации Вашего аккаунта '.Core::$DOMAIN.'/account/activate/'.$token;
        Mail::send();
    }

    /**
     * Проверка на уникальность логина
     * @param $login
     * @return bool
     */
    public function checkLoginExists($login)
    {
        $params = [
            'login' => $login,
        ];
        if($this->db->column('SELECT id FROM users WHERE login = :login', $params)) {
            $this->error = 'Этот ЛОГИН уже используется';
            return false;
        }
        return true;
    }

    /**
     * Проверка на уникальность email
     * @param $email
     * @return mixed
     */
    public function checkEmailExists($email)
    {
        $params = [
            'email' => $email,
        ];
        return $this->db->column('SELECT id FROM users WHERE email = :email', $params);
    }

    /**
     * Проверка токена
     * @param $token
     * @return mixed
     */
    public function checkToken($token)
    {
        $params = [
            'token' => $token,
        ];
        return $this->db->column('SELECT id FROM users WHERE token = :token', $params);
    }

    /**
     * Активация пользователя
     * @param $token
     * @return \PDOStatement
     */
    public function activateUser($token)
    {
        $params = [
            'token' => $token,
        ];
        return $this->db->query('UPDATE users SET status = 1, token = "" WHERE token = :token', $params);
    }

    /**
     * Генерация случайного токена
     * @return bool|string
     */
    public function createToken()
    {
        return substr(str_shuffle(str_repeat("0123456789abcdefghijklmnoprstuvwxyz", 30)), 0, 30);
    }

    /**
     * Проверка статуса пользователя
     * @param $type
     * @param $data
     * @return bool
     */
    public function checkStatus($type, $data)
    {
        $params = [
            $type => $data,
        ];
        $status = $this->db->column('SELECT status FROM users WHERE '.$type.' = :'.$type, $params);
        if ($status !=1) {
            $this->error = 'Аккаунт ожидает подтверждение по Email';
            return false;
        }
        return true;
    }

    /**
     * Запись в сессию данных пользователя
     * @param $login
     */
    public function login($login)
    {
        $params = [
            'login' => $login,
        ];
        $data = $this->db->row('SELECT * FROM users WHERE login = :login', $params);
        $_SESSION['account'] = $data[0];
    }

    /**
     * Восстановление пароля пользователя
     * @param $post
     */
    public function recovery($post)
    {
        $token = $this->createToken();
        $params = [
            'email' => $post['email'],
            'token' => $token,
        ];
        $this->db->query('UPDATE users SET token = :token WHERE email = :email', $params);
        Mail::$to   = $_POST['email'];
        Mail::$text = 'Для восстановления пароля пройдите по ссылке '.Core::$DOMAIN.'/account/reset/'.$token;
        Mail::send();
    }

    /**
     * Новый случайный пароль пользователя
     * @param $token
     * @return bool|\PDOStatement|string
     */
    public function reset($token)
    {
        $new_password = $this->createToken();
        $params = [
            'token'    => $token,
            'password' => password_hash($new_password, PASSWORD_BCRYPT),
        ];
        return $this->db->query('UPDATE users SET status = 1, token = "", password = :password WHERE token = :token', $params);
        return $new_password;
    }

    /**
     * Проверка правильного формата Email
     * @param $email
     * @return bool
     */
    public function correctEmail ($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error = 'Email указан не верно';
            return false;
        }
        return true;
    }

    /**
     * Проверка на длинну пароля
     * @param $password
     * @return bool
     */
    public function correctPass($password)
    {
        $passLen = iconv_strlen($password);
        if ($passLen < 5 or $passLen > 50) {
            $this->error = 'Пароль должен содержать от 5 до 50 символов';
            return false;
        }
        return true;
    }

    /**
     * Сохранение новых данных в профиле пользоваиеля
     * @param $post
     */
    public function saveProfile($post)
    {
        $params = [
            'id'    => $_SESSION['account']['id'],
            'email' => $post['email'],
        ];
        if (!empty($post['password'])) {
            $params['password'] = password_hash($post['password'], PASSWORD_BCRYPT);
            $sql = ', password = :password';
        } else {
            $sql = '';
        }
        foreach ($params as $key => $val) {
            $_SESSION['account'][$key] = $val;
        }
        $this->db->query('UPDATE users SET email = :email'.$sql.' WHERE id = :id', $params);
    }
}