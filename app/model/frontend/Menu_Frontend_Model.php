<?php
/**
 * Класс Menu_Frontend_Model для вывода главного меню сайта,
 * взаимодействует с базой данных, общедоступная часть сайта
 */
class Menu_Frontend_Model extends Frontend_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Функция возвращает массив всех пунктов меню в виде дерева
     */
    public function getMenu() {
        // получаем все пункты меню
        $query = "SELECT
                      `id`, `name`, `url`, `parent`
                  FROM
                      `menu`
                  WHERE
                      1
                  ORDER BY
                      `sortorder`";
        $data = $this->database->fetchAll($query);
        // заменяем виртуальные адреса вида frontend/page/id/7 на SEF (ЧПУ)
        foreach ($data as $key => $value) {
            $data[$key]['url'] = $this->getURL($value['url']);
        }
        // строим дерево
        $tree = $this->makeTree($data);
        return $tree;
    }

}
