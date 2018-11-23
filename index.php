<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ZCMS', true);

session_start();

// автоматическая загрузка классов
require 'app/include/autoload.php';
// настройки приложения
require 'app/config/config.php';
// инициализация настроек
Config::init($config);
unset($config);

try {
    // экземпляр класса роутера
    $router = Router::getInstance();
    /*
     * Получаем имя класса контроллера, например Index_Page_Frontend_Controller. Если
     * класс контроллера не найден, работает контроллер Index_Notfound_Frontend_Controller
     * или Index_Notfound_Backend_Controller
     */
    $controller = $router->getControllerClassName();
    // параметры, передаваемые контроллеру
    $params = $router->getParams();
    // создаем экземпляр класса контроллера
    $page = new $controller($params);
    // формируем страницу
    $page->request();
    if ($page->isNotFoundRecord()) {
        /*
         * Функция Base_Controller::isNotFoundRecord() возвращает true, если какому-либо
         * контроллеру, например Index_Page_Frontend_Controller, были переданы некорректные
         * параметры. Пример: frontend/page/index/id/12345, но страницы с уникальным id=12345
         * нет в таблице `pages` базы данных. Это возможно, если страница (новость, товар)
         * была удалена или пользователь ошибся при вводе URL страницы. См. комментариии в
         * начале класса Base_Controller
         */
        $router->setNotFound();
        // работет контроллер Index_Notfound_Frontend_Controller
        // или Index_Notfound_Backend_Controller
        $controller = $router->getControllerClassName();
        $page = new $controller();
        $page->request();
    }
} catch (Exception $e) { // если произошла какая-то ошибка
    $page = new ErrorPage($e);
    die();
}
// отправляем заголовки
$page->sendHeaders();
// выводим сформированную страницу в браузер
echo $page->getPageContent();
