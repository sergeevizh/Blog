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
                      `b`.`parent` AS `parent`,
                      IFNULL((SELECT `e`.`id` FROM `blog_categories` `e` WHERE `e`.`id` = `b`.`parent`), 0) AS `root_id`,
                      IFNULL((SELECT `f`.`name` FROM `blog_categories` `f` WHERE `f`.`id` = `b`.`parent`), '') AS `root_name`,
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
                foreach ($ids as $k => $v) {
                    $posts[$key]['tags'][] = array(
                        'id'   => $v,
                        'name' => $names[$k],
                        'url'  => $this->getURL('frontend/blog/tag/id/' . $v)
                    );
                }
                unset($posts[$key]['tag_ids'], $posts[$key]['tag_names']);
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
                      `b`.`id` AS `ctg_id`, `b`.`name` AS `ctg_name`,
                      `b`.`parent` AS `parent`,
                      IFNULL((SELECT `e`.`id` FROM `blog_categories` `e` WHERE `e`.`id` = `b`.`parent`), 0) AS `root_id`,
                      IFNULL((SELECT `f`.`name` FROM `blog_categories` `f` WHERE `f`.`id` = `b`.`parent`), '') AS `root_name`,
                      GROUP_CONCAT(`d`.`id` ORDER BY `d`.`name`, `d`.`id` SEPARATOR '¤') AS `tag_ids`,
                      GROUP_CONCAT(`d`.`name` ORDER BY `d`.`name`, `d`.`id` SEPARATOR '¤') AS `tag_names`
                  FROM
                      `blog_posts` `a`
                      INNER JOIN `blog_categories` `b` ON `a`.`category` = `b`.`id`
                      LEFT JOIN `blog_post_tag` `c` ON `a`.`id` = `c`.`post_id`
                      LEFT JOIN `blog_tags` `d` ON `c`.`tag_id` = `d`.`id`

                  WHERE
                      `a`.`category` = :id
                  GROUP BY
                      1, 2, 3, 4, 5, 6, 7
                  ORDER BY
                      `a`.`added` DESC
                  LIMIT " . $start . ", " . $this->config->pager->frontend->blog->perpage;
        $posts = $this->database->fetchAll($query, array('id' => $id));
        /*
         * добавляем в массив постов блога информацию об URL записи (поста), картинки,
         * категории и корнево категории
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
                foreach ($ids as $k => $v) {
                    $posts[$key]['tags'][] = array(
                        'id'   => $v,
                        'name' => $names[$k],
                        'url'  => $this->getURL('frontend/blog/tag/id/' . $v)
                    );
                }
                unset($posts[$key]['tag_ids'], $posts[$key]['tag_names']);
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
                      `b`.`id` AS `ctg_id`, `b`.`name` AS `ctg_name`,
                      `b`.`parent` AS `parent`,
                      GROUP_CONCAT(`d`.`id` ORDER BY `d`.`name`, `d`.`id` SEPARATOR '¤') AS `tag_ids`,
                      GROUP_CONCAT(`d`.`name` ORDER BY `d`.`name`, `d`.`id` SEPARATOR '¤') AS `tag_names`
                  FROM
                      `blog_posts` `a`
                      INNER JOIN `blog_categories` `b` ON `a`.`category` = `b`.`id`
                      LEFT JOIN `blog_post_tag` `c` ON `a`.`id` = `c`.`post_id`
                      LEFT JOIN `blog_tags` `d` ON `c`.`tag_id` = `d`.`id`
                  WHERE
                      `a`.`id` = :id
                  GROUP BY
                      1, 2, 3, 4, 5, 6, 7, 8, 9, 10";
        $post = $this->database->fetch($query, array('id' => $id));
        // получаем корневую категорию поста
        if ($post['parent']) {
            $query = "SELECT
                          `id`, `name`
                      FROM
                          `blog_categories`
                      WHERE
                          `id` = :parent";
            $parent = $this->database->fetch($query, array('parent' => $post['parent']));
            $post['root_id'] = $parent['id'];
            $post['root_name'] = $parent['name'];
        }
        // получаем теги поста
        $post['tags'] = array();
        if (!empty($post['tag_ids'])) {
            $ids = explode('¤', $post['tag_ids']);
            $names = explode('¤', $post['tag_names']);
            foreach ($ids as $k => $v) {
                $post['tags'][] = array(
                    'id'   => $v,
                    'name' => $names[$k],
                    'url'  => $this->getURL('frontend/blog/tag/id/' . $v)
                );
            }
            unset($post['tag_ids'], $post['tag_names']);
        }
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
                      `name`, `parent`, `description`, `keywords`
                  FROM
                      `blog_categories`
                  WHERE
                      `id` = :id";
        $category = $this->database->fetch($query, array('id' => $id));
        // получаем родительскую категорию
        if ($category['parent']) {
            $query = "SELECT
                          `id`, `name`
                      FROM
                          `blog_categories`
                      WHERE
                          `id` = :parent";
            $parent = $this->database->fetch($query, array('parent' => $category['parent']));
            $category['root_id'] = $parent['id'];
            $category['root_name'] = $parent['name'];
        }
        return $category;
    }

}