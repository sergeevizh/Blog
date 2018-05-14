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
                      `a`.`id` AS `id`, `a`.`name` AS `name`,
                      `a`.`excerpt` AS `excerpt`,
                      DATE_FORMAT(`a`.`added`, '%d.%m.%Y') AS `date`,
                      DATE_FORMAT(`a`.`added`, '%H:%i:%s') AS `time`,
                      `b`.`id` AS `ctg_id`, `b`.`name` AS `ctg_name`,
                      `b`.`parent` AS `parent`,
                      (SELECT `e`.`id` FROM `blog_categories` `e` WHERE `e`.`id` = `b`.`parent`) AS `root_id`,
                      (SELECT `f`.`name` FROM `blog_categories` `f` WHERE `f`.`id` = `b`.`parent`) AS `root_name`,
                      GROUP_CONCAT(`d`.`id` ORDER BY `d`.`name`, `d`.`id` SEPARATOR '¤') AS `tag_ids`,
                      GROUP_CONCAT(`d`.`name` ORDER BY `d`.`name`, `d`.`id` SEPARATOR '¤') AS `tag_names`
                  FROM
                      `blog_posts` `a`
                      INNER JOIN `blog_categories` `b` ON `a`.`category` = `b`.`id`
                      LEFT JOIN `blog_post_tag` `c` ON `a`.`id` = `c`.`post_id`
                      LEFT JOIN `blog_tags` `d` ON `c`.`tag_id` = `d`.`id`
                  WHERE
                      1
                  GROUP BY
                      1, 2, 3, 4, 5, 6, 7
                  ORDER BY
                      `a`.`added` DESC
                  LIMIT
                      5";
        $posts = $this->database->fetchAll($query);
        // добавляем в массив постов блога информацию об URL поста, картинки, категории
        $host = $this->config->site->url;
        foreach($posts as $key => $value) {
            // URL записи (поста) блога
            $posts[$key]['url']['post'] = $this->getURL('frontend/blog/post/id/' . $value['id']);
            // URL превьюшки записи (поста)
            if (is_file('files/blog/thumb/' . $value['id'] . '.jpg')) {
                $posts[$key]['url']['image'] = $host . 'files/blog/thumb/' . $value['id'] . '.jpg';
            } else {
                $posts[$key]['url']['image'] = $host . 'files/blog/thumb/default.jpg';
            }
            // URL категории поста
            $posts[$key]['url']['category'] = $this->getURL('frontend/blog/category/id/' . $value['ctg_id']);
            // URL корневой категории поста
            if (!empty($posts[$key]['parent'])) {
                $posts[$key]['url']['root'] = $this->getURL('frontend/blog/category/id/' . $value['root_id']);
                unset($posts[$key]['parent']);
            } else {
                unset($posts[$key]['parent'], $posts[$key]['root_id'], $posts[$key]['root_name']);
            }
            // теги для каждого поста
            $posts[$key]['tags'] = array();
            if (!empty($posts[$key]['tag_ids'])) {
                $ids = explode('¤', $posts[$key]['tag_ids']);
                $names = explode('¤', $posts[$key]['tag_names']);
                $i = 0;
                foreach ($ids as $k => $v) {
                    $short = (iconv_strlen($names[$k]) > 15) ? iconv_substr($names[$k], 0, 14) . '…' : $names[$k];
                    $posts[$key]['tags'][] = array(
                        'id'    => $v,
                        'name'  => $names[$k],
                        'short' => $short,
                        'url'   => $this->getURL('frontend/blog/tags/ids/' . $v)
                    );
                    $i++;
                    if ($i > 4) break;
                }
                unset($posts[$key]['tag_ids'], $posts[$key]['tag_names']);
            }
        }

        return $posts;

    }

    /**
     * Функция возвращает массив трех последних опубликованных статей
     */
    public function getLastArticles() {

        $query = "SELECT
                      `a`.`id` AS `id`, `a`.`name` AS `name`,
                      `a`.`excerpt` AS `excerpt`,
                      DATE_FORMAT(`a`.`added`, '%d.%m.%Y') AS `date`,
                      DATE_FORMAT(`a`.`added`, '%H:%i:%s') AS `time`,
                      `b`.`id` AS `ctg_id`, `b`.`name` AS `ctg_name`,
                      `b`.`parent` AS `parent`,
                      (SELECT `c`.`id` FROM `article_categories` `c` WHERE `c`.`id` = `b`.`parent`) AS `root_id`,
                      (SELECT `d`.`name` FROM `article_categories` `d` WHERE `d`.`id` = `b`.`parent`) AS `root_name`
                  FROM
                      `article_items` `a`
                      INNER JOIN `article_categories` `b` ON `a`.`category` = `b`.`id`
                  WHERE
                      1
                  ORDER BY
                      `a`.`added` DESC
                  LIMIT
                      5";

        $articles = $this->database->fetchAll($query);

        // добавляем в массив статей информацию об URL статьи, картинки, категории
        foreach($articles as $key => $value) {
            $articles[$key]['url']['item'] = $this->getURL('frontend/article/item/id/' . $value['id']);
            if (is_file('files/article/thumb/' . $value['id'] . '.jpg')) {
                $articles[$key]['url']['image'] = $this->config->site->url . 'files/article/thumb/' . $value['id'] . '.jpg';
            } else {
                $articles[$key]['url']['image'] = $this->config->site->url . 'files/article/thumb/default.jpg';
            }
            // URL категории статьи
            $articles[$key]['url']['category'] = $this->getURL('frontend/article/category/id/' . $value['ctg_id']);
            // URL корневой категории статьи
            if (!empty($articles[$key]['parent'])) {
                $articles[$key]['url']['root'] = $this->getURL('frontend/blog/category/id/' . $value['root_id']);
                unset($articles[$key]['parent']);
            } else {
                unset($articles[$key]['parent'], $articles[$key]['root_id'], $articles[$key]['root_name']);
            }
        }

        return $articles;

    }

}
