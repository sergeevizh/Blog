<?php
/**
 * Класс Index_Frontend_Model для показа главной страницы сайта,
 * взаимодействует с базой данных, общедоступная часть сайта
 */
class Index_Frontend_Model extends Frontend_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Функция возвращает массив трех последних постов блога
     */
    public function getLastPosts() {

        $query = "SELECT
                      `id`, `name`, `excerpt`,
                      DATE_FORMAT(`added`, '%d.%m.%Y') AS `date`,
                      DATE_FORMAT(`added`, '%H:%i:%s') AS `time`
                  FROM
                      `blog_posts`
                  WHERE
                      1
                  ORDER BY
                      `added` DESC
                  LIMIT
                      3";
        $posts = $this->database->fetchAll($query);
        /*
         * добавляем в массив постов блога информацию об URL записи, картинки
         */
        foreach($posts as $key => $value) {
            // URL записи (поста) блога
            $posts[$key]['url']['item'] = $this->getURL('frontend/blog/post/id/' . $value['id']);
            // URL превьюшки записи (поста) блога
            if (is_file('files/blog/thumb/' . $value['id'] . '.jpg')) {
                $posts[$key]['url']['image'] = $this->config->site->url . 'files/blog/thumb/' . $value['id'] . '.jpg';
            } else {
                $posts[$key]['url']['image'] = $this->config->site->url . 'files/blog/thumb/default.jpg';
            }
        }
        return $posts;

    }

    /**
     * Функция возвращает массив трех последних опубликованных статей
     */
    public function getLastArticles() {

        $query = "SELECT
                      `id`, `name`, `excerpt`,
                      DATE_FORMAT(`added`, '%d.%m.%Y') AS `date`,
                      DATE_FORMAT(`added`, '%H:%i:%s') AS `time`
                  FROM
                      `article_items`
                  WHERE
                      1
                  ORDER BY
                      `added` DESC
                  LIMIT
                      3";
        $articles = $this->database->fetchAll($query);
        /*
         * добавляем в массив постов блога информацию об URL статьи, картинки
         */
        foreach($articles as $key => $value) {
            // URL статьи
            $articles[$key]['url']['item'] = $this->getURL('frontend/article/item/id/' . $value['id']);
            // URL превьюшки
            if (is_file('files/article/thumb/' . $value['id'] . '.jpg')) {
                $articles[$key]['url']['image'] = $this->config->site->url . 'files/article/thumb/' . $value['id'] . '.jpg';
            } else {
                $articles[$key]['url']['image'] = $this->config->site->url . 'files/article/thumb/default.jpg';
            }
        }
        return $articles;

    }

}
