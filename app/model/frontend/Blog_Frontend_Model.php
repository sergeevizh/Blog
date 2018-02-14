<?php
/**
 * Класс Blog_Frontend_Model для работы с блогом, взаимодействует
 * с базой данных, общедоступная часть сайта
 */
class Blog_Frontend_Model extends Frontend_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Возвращает массив всех записей (постов) блога
     */
    public function getAllPosts($start = 0) {
        $query = "SELECT
                      `a`.`id` AS `id`, `a`.`name` AS `name`,
                      `a`.`excerpt` AS `excerpt`,
                      DATE_FORMAT(`a`.`added`, '%d.%m.%Y') AS `date`,
                      DATE_FORMAT(`a`.`added`, '%H:%i:%s') AS `time`,
                      `b`.`id` AS `ctg_id`, `b`.`name` AS `ctg_name`,
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
                  LIMIT " . $start . ", " . $this->config->pager->frontend->blog->perpage;
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
            // URL категории записи (поста)
            $posts[$key]['url']['category'] = $this->getURL('frontend/blog/category/id/' . $value['ctg_id']);
            // теги блога
            $posts[$key]['tags'] = array();
            if (!empty($posts[$key]['tag_ids'])) {
                $ids = explode('¤', $posts[$key]['tag_ids']);
                $names = explode('¤', $posts[$key]['tag_names']);
                foreach ($ids as $k => $v) {
                    $posts[$key]['tags'][] = array(
                        'id'   => $v,
                        'name' => $names[$k],
                        'url'  => $this->getURL('frontend/blog/tag/id/' . $v)
                    );
                }
            }
        }
        return $posts;
    }

    /**
     * Возвращает общее количество записей (постов) блога (во всех категориях)
     */
    public function getCountAllPosts() {
        $query = "SELECT COUNT(*) FROM `blog_posts` WHERE 1";
        return $this->database->fetchOne($query);
    }

    /**
     * Возвращает массив записей (постов) категории с уникальным идентификатором $id
     */
    public function getCategoryPosts($id, $start) {
        $query = "SELECT
                      `a`.`id` AS `id`, `a`.`name` AS `name`, `a`.`excerpt` AS `excerpt`,
                      DATE_FORMAT(`a`.`added`, '%d.%m.%Y') AS `date`,
                      DATE_FORMAT(`a`.`added`, '%H:%i:%s') AS `time`,
                      `b`.`id` AS `ctg_id`, `b`.`name` AS `ctg_name`
                  FROM
                      `blog_posts` `a` INNER JOIN `blog_categories` `b` ON `a`.`category` = `b`.`id`
                  WHERE
                      `a`.`category` = :id
                  ORDER BY
                      `a`.`added` DESC
                  LIMIT " . $start . ", " . $this->config->pager->frontend->blog->perpage;
        $posts = $this->database->fetchAll($query, array('id' => $id));
        /*
         * добавляем в массив постов блога информацию об URL записи (поста), картинки
         */
        $host = $this->config->site->url;
        foreach($posts as $key => $value) {
            // URL записи (поста) блога
            $posts[$key]['url']['post'] = $this->getURL('frontend/blog/post/id/' . $value['id']);
            // URL превьюшки записи (поста) блога
            if (is_file('files/blog/thumb/' . $value['id'] . '.jpg')) {
                $posts[$key]['url']['image'] = $host . 'files/blog/thumb/' . $value['id'] . '.jpg';
            } else {
                $posts[$key]['url']['image'] = $host . 'files/blog/thumb/default.jpg';
            }
        }
        return $posts;
    }

    /**
     * Возвращает количество новостей в категории с уникальным идентификатором $id
     */
    public function getCountCategoryPosts($id) {
        $query = "SELECT
                      COUNT(*)
                  FROM
                      `blog_posts`
                  WHERE
                      `category` = :id";
        return $this->database->fetchOne($query, array('id' => $id));
    }

    /**
     * Возвращает информацию о записи блога с уникальным идентификатором $id
     */
    public function getPost($id) {
        $query = "SELECT
                      `a`.`name` AS `name`, `a`.`keywords` AS `keywords`,
                      `a`.`description` AS `description`,
                      `a`.`excerpt` AS `excerpt`, `a`.`body` AS `body`,
                      DATE_FORMAT(`a`.`added`, '%d.%m.%Y') AS `date`,
                      DATE_FORMAT(`a`.`added`, '%H:%i:%s') AS `time`,
                      `b`.`id` AS `ctg_id`, `b`.`name` AS `ctg_name`
                  FROM
                      `blog_posts` `a` INNER JOIN `blog_categories` `b` ON `a`.`category` = `b`.`id`
                  WHERE
                      `a`.`id` = :id";
        $post = $this->database->fetch($query, array('id' => $id));
        // подсвечиваем код
        $post['body'] = $this->highlightCodeBlocks($post['body']);
        return $post;
    }

    /**
     * Возвращает массив всех категорий блога
     */
    public function getCategories() {
        $query = "SELECT
                      `id`, `name`
                  FROM
                      `blog_categories`
                  WHERE
                      1
                  ORDER BY
                      `sortorder`";
        $categories = $this->database->fetchAll($query);
        // добавляем в массив информацию об URL категорий
        foreach($categories as $key => $value) {
            $categories[$key]['url'] = $this->getURL('frontend/blog/category/id/' . $value['id']);
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
                      `blog_categories`
                  WHERE
                      `id` = :id";
        return $this->database->fetch($query, array('id' => $id));
    }

}