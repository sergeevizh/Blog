<?php
/**
 * Класс Page_Frontend_Model для показа страниц сайта,
 * взаимодействует с базой данных, общедоступная часть сайта
 */
class Page_Frontend_Model extends Frontend_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Возвращает информацию о странице с уникальным идентификатором $id
     */
    public function getPage($id) {
        $query = "SELECT
                      `name`, `title`, `description`, `keywords`, `parent`, `body`
                  FROM
                      `pages`
                  WHERE
                      `id` = :id";
        return $this->database->fetch($query, array('id' => $id));
    }

}
