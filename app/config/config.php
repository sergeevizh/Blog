<?php
/**
 * Настройки приложения: логин-пароль для соединения с сервером БД,
 * логин и пароль администратора сайта, настройки кэширования, правила
 * маршрутизации, настройки CDN, мета-теги, подключаемые js и css-файлы,
 * постраничный вывод товаров, постов блога и т.п.
 */
defined('ZCMS') or die('Access denied');

// соединение с базой данных
require 'app/config/database.php';
// правила маршрутизации
require 'app/config/routing.php';
// содержимое title, мета-теги keywords и description
require 'app/config/meta.php';
// CSS файлы, подключаемые к странице
require 'app/config/css.php';
// JavaScript файлы, подключаемые к странице
require 'app/config/js.php';
// постраничная навигация
require 'app/config/pager.php';

$config = array(
    'site' => array(
        'url'   => '//www.host12.ru/', /* //server.com/ или http://server.com/ или https://server.com/ */
        'name'  => 'Записки программиста',
        'email' => 'tokmakov.e@mail.ru', // с этого e-mail будет отправляться почта
        'theme' => 'view/tinko', // путь к папке с темой
    ),
    'admin' => array( // логин, пароль и e-mail администратора сайта
        'name'     => 'admin',
        'password' => 'tsjukmte',
        'email'    => 'tokmakov.e@mail.ru'
    ),
    'error' => array(
        'debug'    => true,                      // должен быть true на этапе разработки
        'write'    => true,                      // записывать сообщения об ошибках в журнал?
        'file'     => 'error.log.txt',           // файл журнала ошибок
        'sendmail' => false,                     // отправлять сообщения об ошибках на почту администратору?
    ),
    'message' => array( // информационные сообщения для пользователей
        // общее сообщение об ошибке, которое должно отображаться
        // вместо подробной информации (если debug равно false)
        'error'    => 'Произошла ошибка, сообщение об ошибке отправлено администратору.',
    ),

    'database'  => $database,                    // см. файл app/config/database.php
    'sef'       => $routing,                     // см. файл app/config/routing.php
    'meta'      => $meta,                        // см. файл app/config/meta.php
    'css'       => $css,                         // см. файл app/config/css.php
    'js'        => $js,                          // см. файл app/config/js.php
    'pager'     => $pager,                       // см. файл app/config/pager.php
);

unset(
    $database,
    $routing,
    $meta,
    $css,
    $js,
    $pager
);
