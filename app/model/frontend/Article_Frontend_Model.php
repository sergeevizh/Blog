<?php
/**
 * Класс Article_Frontend_Model для работы со статьями, взаимодействует
 * с базой данных, общедоступная часть сайта
 */
class Article_Frontend_Model extends Frontend_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Возвращает массив всех статей (во всех категориях)
     */
    public function getAllArticles($start = 0) {

        $query = "SELECT
                      `a`.`id` AS `id`, `a`.`name` AS `name`, `a`.`excerpt` AS `excerpt`,
                      DATE_FORMAT(`a`.`added`, '%d.%m.%Y') AS `date`,
                      DATE_FORMAT(`a`.`added`, '%H:%i:%s') AS `time`,
                      `b`.`id` AS `ctg_id`, `b`.`name` AS `ctg_name`
                  FROM
                      `article_items` `a` INNER JOIN `article_categories` `b`
                      ON `a`.`category` = `b`.`id`
                  WHERE
                      1
                  ORDER BY
                      `a`.`added` DESC
                  LIMIT
                      :start, :limit";
        $articles = $this->database->fetchAll(
            $query,
            array(
                'start' => $start,
                'limit' => $this->config->pager->frontend->article->perpage
            )
        );

        // добавляем в массив статей информацию об URL статьи, картинки, категории
        foreach($articles as $key => $value) {
            $articles[$key]['url']['item'] = $this->getURL('frontend/article/item/id/' . $value['id']);
            if (is_file('files/article/' . $value['id'] . '/' . $value['id'] . '.jpg')) {
                $articles[$key]['url']['image'] = $this->config->site->url . 'files/article/' . $value['id'] . '/' . $value['id'] . '.jpg';
            } else {
                $articles[$key]['url']['image'] = $this->config->site->url . 'files/article/default.jpg';
            }
            $articles[$key]['url']['category'] = $this->getURL('frontend/article/category/id/' . $value['ctg_id']);
        }

        return $articles;

    }

    /**
     * Возвращает общее количество статей (во всех категориях)
     */
    public function getCountAllArticles() {
        $query = "SELECT COUNT(*) FROM `article_items` WHERE 1";
        return $this->database->fetchOne($query);
    }

    /**
     * Возвращает массив статей категории с уникальным идентификатором $id
     */
    public function getCategoryArticles($id, $start) {

        $query = "SELECT
                      `a`.`id` AS `id`, `a`.`name` AS `name`, `a`.`excerpt` AS `excerpt`,
                      DATE_FORMAT(`a`.`added`, '%d.%m.%Y') AS `date`,
                      DATE_FORMAT(`a`.`added`, '%H:%i:%s') AS `time`,
                      `b`.`id` AS `ctg_id`, `b`.`name` AS `ctg_name`
                  FROM
                      `article_items` `a` INNER JOIN `article_categories` `b` ON `a`.`category` = `b`.`id`
                  WHERE
                      `a`.`category` = :id
                  ORDER BY
                      `a`.`added` DESC
                  LIMIT
                      :start, :limit";
        $articles = $this->database->fetchAll(
            $query,
            array(
                'id'    => $id,
                'start' => $start,
                'limit' => $this->config->pager->frontend->article->perpage
            )
        );

        // добавляем в массив статей информацию об URL статьи, картинки, категории
        foreach($articles as $key => $value) {
            $articles[$key]['url']['item'] = $this->getURL('frontend/article/item/id/' . $value['id']);
            if (is_file('files/article/thumb/' . $value['id'] . '.jpg')) {
                $articles[$key]['url']['image'] = $this->config->site->url . 'files/article/thumb/' . $value['id'] . '.jpg';
            } else {
                $articles[$key]['url']['image'] = $this->config->site->url . 'files/article/thumb/default.jpg';
            }
        }

        return $articles;

    }

    /**
     * Возвращает количество статей в категории с уникальным идентификатором $id
     */
    public function getCountCategoryArticles($id) {
        $query = "SELECT
                      COUNT(*)
                  FROM
                      `article_items`
                  WHERE
                      `category` = :id";
        return $this->database->fetchOne($query, array('id' => $id));
    }

    /**
     * Возвращает информацию о статье с уникальным идентификатором $id
     */
    protected function getArticle($id) {

        $query = "SELECT
                      `a`.`name` AS `name`, `a`.`keywords` AS `keywords`, `a`.`description` AS `description`,
                      `a`.`excerpt` AS `excerpt`, `a`.`body` AS `body`,
                      DATE_FORMAT(`a`.`added`, '%d.%m.%Y') AS `date`,
                      DATE_FORMAT(`a`.`added`, '%H:%i:%s') AS `time`,
                      `b`.`id` AS `ctg_id`, `b`.`name` AS `ctg_name`
                  FROM
                      `article_items` `a` INNER JOIN `article_categories` `b` ON `a`.`category` = `b`.`id`
                  WHERE
                      `a`.`id` = :id";
        return $this->database->fetch($query, array('id' => $id));

    }

    /**
     * Возвращает массив всех категорий статей
     */
    public function getCategories() {

        $query = "SELECT
                      `id`, `name`
                  FROM
                      `article_categories`
                  WHERE
                      1
                  ORDER BY
                      `sortorder`";
        $categories = $this->database->fetchAll($query);
        // добавляем в массив информацию об URL категорий
        foreach($categories as $key => $value) {
            $categories[$key]['url'] = $this->getURL('frontend/article/category/id/' . $value['id']);
        }

        return $categories;

    }

    /**
     * Возвращает информацию о категории с уникальным идентификатором $id
     */
    public function getCategory($id) {

        $query = "SELECT
                      `name`, `description`, `keywords`
                  FROM
                      `article_categories`
                  WHERE
                      `id` = :id";
        return $this->database->fetch($query, array('id' => $id));

    }

}