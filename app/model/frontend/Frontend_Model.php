<?php
/**
 * Абстрактный класс Frontend_Model, родительский для всех моделей
 * общедоступной части сайта
 */
abstract class Frontend_Model extends Base_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Функция возвращает абсолютный URL вида http://www.server.com/frontend/
     * controller/action/param/value принимая на вход относительный URL вида
     * frontend/controller/action/param/value. Если в настройках указано
     * использовать SEF (ЧПУ), функция возвращает абсолютный SEF URL.
     */
    public function getURL($url) {

        /*
         * Ищем совпадение URL вида Controller/Action/Params (CAP), если находим —
         * заменяем CAP на SEF (Search Engines Friendly). Пример преобразования
         * frontend/catalog/category/id/27 => http://www.host.ru/catalog/category/27
         */
        $cap2sef = $this->config->sef->cap2sef;
        foreach($cap2sef as $key => $value) {
            if (preg_match($key, $url)) {
                return $this->config->site->url . preg_replace($key, $value, $url);
            }
        }

        /*
         * Совпадений не найдено, ищем среди страниц сайта; если совпадение найдено,
         * заменяем frontend/page/index/id/123 на http://www.host.ru/about-company
         */
        if (preg_match('~frontend/page/index/id/(\d+)~', $url, $matches)) {
            $id = (int)$matches[1];
            $query = "SELECT `sefurl` FROM `pages` WHERE `id` = :id";
            $sef = $this->database->fetchOne($query, array('id' => $id));
            if (false !== $sef) {
                return $this->config->site->url . $sef;
            }

        }

        // ничего не найдено
        throw new Exception('Не найдено правило преобразования CAP->SEF для ' . $url);

    }

}