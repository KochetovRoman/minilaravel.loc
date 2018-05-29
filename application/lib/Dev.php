<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

/**
 * Распечатка массива
 *
 * @param array $str элемент
 */
function debug($str)
{
    echo '<pre>';
    var_dump($str);
    echo '</pre>';
    exit();
}

/**
 * Обработка пробелов
 *
 * @param string $el элемент
 * @return string $el элемент
 */
function trimAll($el) {
    if(!is_array($el)) {
        $el = trim($el);
    } else {
        $el = array_map('trimAll',$el);
    }
    return $el;
}

/**
 * Обработка int
 *
 * @param string $el элемент
 * @return string $el элемент
 */
function intAll($el) {
    if (!is_array($el)) {
        $el = (int)($el);
    } else {
        $el = array_map('intAll',$el);
    }
    return $el;
}

/**
 * Обработка float
 *
 * @param string $el элемент
 * @return string $el элемент
 */
function floatAll($el) {
    if (!is_array($el)) {
        $el = (float)($el);
    } else {
        $el = array_map('floatAll',$el);
    }
    return $el;
}

/**
 * Обработка float
 *
 * @param string $el элемент
 * @return string $el элемент
 */
function hscAll($el) {
    if (!is_array($el)) {
        $el = htmlspecialchars($el);
    } else {
        $el = array_map('hc',$el);
    }
    return $el;
}

/**
 * Обработка пароля пользователя
 *
 * @param string $var
 * @return string $var
 */
function myHash($var) {
    $salt = 'qwerty';
    $salt2 = 'ytrewq';
    $var = crypt(md5($var.$salt),$salt2);
    return $var;
}

