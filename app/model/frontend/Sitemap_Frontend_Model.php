<?php
/**
 * Класс Sitemap_Frontend_Model для формирования карты сайта, взаимодействует
 * с базой данных, общедоступная часть сайта
 */
class Sitemap_Frontend_Model extends Frontend_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Функция возвращает массив всех элементов карты сайта в виде дерева
     */
    public function getSitemap() {
        // получаем все элементы карты сайта
        $query = "SELECT
                      `id`, `capurl`, `name`, `parent`
                  FROM
                      `sitemap`
                  WHERE
                      1
                  ORDER BY
                      `sortorder`";
        $data = $this->database->fetchAll($query);
        // добавляем в массив URL ссылок на страницы
        foreach($data as $key => $value) {
            $data[$key]['url'] =  $this->getURL($value['capurl']);
        }
        // строим дерево
        $tree = $this->makeTree($data);
        return $tree;
    }

    /**
     * Функция возвращает хлебные крошки: путь от главной страницы до конкретного
     * элемента карты сайта
     */
    protected function getBreadcrumbs($capurl) {

        $query = "SELECT
                      `parent`
                  FROM
                      `sitemap`
                  WHERE
                      `capurl` = :capurl";
        $parent = $this->database->fetchOne($query, array('capurl' => $capurl));
        $path = array();
        if ($parent) {
            $query = "SELECT
                          `id`, `capurl`, `name`, `parent`
                      FROM
                          `sitemap`
                      WHERE
                          `id` = :id";
            $result = $this->database->fetch($query, array('id' => $parent));
            $path[] = array('url' => $this->getURL($result['capurl']), 'name' => $result['name']);
            if ($result['parent']) {
                $query = "SELECT
                              `id`, `capurl`, `name`, `parent`
                          FROM
                              `sitemap`
                          WHERE
                              `id` = :id";
                $res = $this->database->fetch($query, array('id' => $result['parent']));
                $path[] = array('url' => $this->getURL($res['capurl']), 'name' => $res['name']);
            }
        }
        $path[] = array('url' => $this->getURL('frontend/index/index'), 'name' => 'Главная');
        $path = array_reverse($path);

        return $path;

    }

}
