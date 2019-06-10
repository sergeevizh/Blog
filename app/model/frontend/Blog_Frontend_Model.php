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
                      `a`.`visible` = 1
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
                $length = 0;
                foreach ($ids as $k => $v) {
                    $short = (iconv_strlen($names[$k]) > 15) ? iconv_substr($names[$k], 0, 14) . '…' : $names[$k];
                    $posts[$key]['tags'][] = array(
                        'id'    => $v,
                        'name'  => $names[$k],
                        'short' => $short,
                        'url'   => $this->getURL('frontend/blog/tags/ids/' . $v)
                    );
                    $length = $length + iconv_strlen($names[$k]);
                    if ($length > 50) break;
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
        $query = "SELECT COUNT(*) FROM `blog_posts` WHERE `visible` = 1";
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
                      `a`.`visible` = 1 AND (`a`.`category` = :id OR `a`.`category` IN
                      (SELECT `g`.`id` FROM `blog_categories` `g` WHERE `g`.`parent` = :parent))
                  GROUP BY
                      1, 2, 3, 4, 5, 6, 7, 8, 9, 10
                  ORDER BY
                      `a`.`added` DESC
                  LIMIT
                      :start, :limit";
        $posts = $this->database->fetchAll(
            $query,
            array(
                'id' => $id,
                'parent' => $id,
                'start' => $start,
                'limit' => $this->config->pager->frontend->blog->perpage,
            )
        );
        /*
         * добавляем в массив постов блога информацию об URL записи (поста), картинки,
         * категории и корневой категории
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
                $length = 0;
                foreach ($ids as $k => $v) {
                    $short = (iconv_strlen($names[$k]) > 15) ? iconv_substr($names[$k], 0, 14) . '…' : $names[$k];
                    $posts[$key]['tags'][] = array(
                        'id'    => $v,
                        'name'  => $names[$k],
                        'short' => $short,
                        'url'   => $this->getURL('frontend/blog/tags/ids/' . $v)
                    );
                    $length = $length + iconv_strlen($names[$k]);
                    if ($length > 50) break;
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
                      `blog_posts` `a`
                  WHERE
                      `a`.`visible` = 1 AND (`a`.`category` = :id OR `a`.`category` IN
                      (SELECT `b`.`id` FROM `blog_categories` `b` WHERE `b`.`parent` = :parent))";
        return $this->database->fetchOne($query, array('id' => $id, 'parent' => $id));
    }

    /**
     * Возвращает информацию о записи блога с уникальным идентификатором $id
     */
    public function getPost($id) {

        $query = "SELECT
                      `a`.`name` AS `name`, `a`.`keywords` AS `keywords`,
                      `a`.`description` AS `description`, `a`.`search` AS `search`,
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
                      `a`.`id` = :id AND `a`.`visible` = 1
                  GROUP BY
                      1, 2, 3, 4, 5, 6, 7, 8, 9, 10";
        $post = $this->database->fetch($query, array('id' => $id));
        // если пост не найден или скрыт
        if ( ! $post) {
            return false;
        }
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
                    'url'  => $this->getURL('frontend/blog/tags/ids/' . $v)
                );
            }
            unset($post['tag_ids'], $post['tag_names']);
        }
        // получаем ключи поста в виде массива
        $post['keys'] = array();
        if (!empty($post['search'])) {
            $keys = explode(', ', $post['search']);
            foreach ($keys as $key) {
                if (preg_match('~^[а-яёА-ЯЁ]+$~u', $key)) {
                    $key = preg_replace('~([а-яё])([А-ЯЁ])([а-яё])~u', '$1 $2$3', $key);
                    $key = preg_replace('~([а-яё])([А-ЯЁ])([А-ЯЁ])([а-яё])~u', '$1 $2 $3$4', $key);
                    $words = explode(' ', $key);
                    $temp = array();
                    foreach ($words as $i => $word) {
                        if ($i) {
                            $temp[] = $this->stringToLower($word);
                        } else {
                            $temp[] = $word;
                        }
                    }
                    $key = implode(' ', $temp);
                }
                $post['keys'][] = array(
                    'key' => $key,
                    'url' => $this->getURL('frontend/blog/search/query/' . rawurlencode($key))
                );
            }
        }
        // получаем похожие посты
        $post['liked'] = $this->getLikedPosts($id);
        // подсвечиваем код
        $post['body'] = $this->highlightCodeBlocks($post['body']);

        return $post;

    }

    /**
     * Возвращает массив всех категорий блога в виде дерева
     */
    public function getCategories() {
        $query = "SELECT
                      `id`, `name`, `parent`
                  FROM
                      `blog_categories`
                  WHERE
                      1
                  ORDER BY
                      `sortorder`";
        $data = $this->database->fetchAll($query);
        // добавляем в массив информацию об URL категорий
        foreach($data as $key => $value) {
            $data[$key]['url'] = $this->getURL('frontend/blog/category/id/' . $value['id']);
        }
        // строим дерево
        $tree = $this->makeTree($data);
        return $tree;
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

    /**
     * Вызвращает массив постов (записей блога), связанных с тегами $ids
     */
    public function getPostsByTags($ids, $start) {
        $ids = implode(',', $ids);
        $query = "SELECT
                      `a`.`id` AS `id`, `a`.`name` AS `name`, `a`.`excerpt` AS `excerpt`,
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
                      INNER JOIN `blog_post_tag` `c` ON `a`.`id` = `c`.`post_id`
                      INNER JOIN `blog_tags` `d` ON `c`.`tag_id` = `d`.`id`
                  WHERE
                      `a`.`visible` = 1 AND `a`.`id` IN
                      (SELECT `g`.`post_id` FROM `blog_post_tag` `g` WHERE `g`.`tag_id` IN (" . $ids . "))
                  GROUP BY
                      1, 2, 3, 4, 5, 6, 7, 8, 9, 10
                  ORDER BY
                      `a`.`added` DESC
                  LIMIT " . $start . ", " . $this->config->pager->frontend->blog->perpage;
        $posts = $this->database->fetchAll($query);
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
                // длина всех тегов в символах, чтобы ограничить кол-во показываемых тегов
                $length = 0;
                foreach ($ids as $k => $v) {
                    $short = (iconv_strlen($names[$k]) > 15) ? iconv_substr($names[$k], 0, 14) . '…' : $names[$k];
                    $posts[$key]['tags'][] = array(
                        'id'    => $v,
                        'name'  => $names[$k],
                        'short' => $short,
                        'url'   => $this->getURL('frontend/blog/tags/ids/' . $v)
                    );
                    $length = $length + iconv_strlen($names[$k]);
                    if ($length > 50) break;
                }
                unset($posts[$key]['tag_ids'], $posts[$key]['tag_names']);
            }
        }
        return $posts;
    }

    /**
     * Возвращает количество постов, которые связаны с тегами $ids
     */
    public function getCountPostsByTags($ids) {
        $ids = implode(',', $ids);
        $query = "SELECT
                      COUNT(DISTINCT(`a`.`id`))
                  FROM
                      `blog_posts` `a`
                      INNER JOIN `blog_categories` `b` ON `a`.`category` = `b`.`id`
                      INNER JOIN `blog_post_tag` `c` ON `a`.`id` = `c`.`post_id`
                      INNER JOIN `blog_tags` `d` ON `c`.`tag_id` = `d`.`id`
                  WHERE
                      `a`.`visible` = 1 AND `a`.`id` IN
                      (SELECT `g`.`post_id` FROM `blog_post_tag` `g` WHERE `g`.`tag_id` IN (" . $ids . "))";
        return $this->database->fetchOne($query);
    }

    /**
     * Вызвращает массив всех тегов блога
     */
    public function getAllTags() {

        $query = "SELECT
                      `a`.`id`, `a`.`name`, COUNT(*) AS `count`,
                      IF(CHAR_LENGTH(`a`.`name`) > 25, CONCAT(LEFT(`a`.`name`, 24), '…'), `a`.`name`) AS `short`
                  FROM
                      `blog_tags` `a`
                      INNER JOIN `blog_post_tag` `b` ON `a`.`id` = `b`.`tag_id`
                      INNER JOIN `blog_posts` `c` ON `b`.`post_id` = `c`.`id`
                      INNER JOIN `blog_categories` `d` ON `c`.`category` = `d`.`id`
                  WHERE
                      `c`.`visible` = 1
                  GROUP BY
                      1, 2
                  ORDER BY
                      `a`.`name`";
        $tags = $this->database->fetchAll($query);
        foreach ($tags as $k => $v) {
            $tags[$k]['url'] = $this->getURL('frontend/blog/tags/ids/' . $v['id']);
        }
        return $tags;

    }

    /**
     * Вызвращает массив тегов блога для боковой колонки
     */
    public function getSideTags() {

        $query = "SELECT
                      `a`.`id` AS `id`, `a`.`name` AS `name`,
                      IF(CHAR_LENGTH(`a`.`name`) > 14, CONCAT(LEFT(`a`.`name`, 13), '…'), `a`.`name`) AS `short`,
                      COUNT(*) AS `count`
                  FROM
                      `blog_tags` `a`
                      INNER JOIN `blog_post_tag` `b` ON `a`.`id` = `b`.`tag_id`
                      INNER JOIN `blog_posts` `c` ON `b`.`post_id` = `c`.`id`
                      INNER JOIN `blog_categories` `d` ON `c`.`category` = `d`.`id`
                  WHERE
                      `c`.`visible` = 1
                  GROUP BY
                      1, 2
                  HAVING
                      COUNT(*) > 15
                  ORDER BY
                      `a`.`name`";
        $tags = $this->database->fetchAll($query);
        foreach ($tags as $k => $v) {
            $tags[$k]['url'] = $this->getURL('frontend/blog/tags/ids/' . $v['id']);
        }
        return $tags;

    }

    /**
     * Вызвращает название тега $id
     */
    public function getTagName($id) {
        $query = "SELECT `name` FROM `blog_tags` WHERE `id` = :id";
        return $this->database->fetchOne($query, array('id' => $id));
    }

    /**
     * Вызвращает массив похожих постов
     */
    private function getLikedPosts($id) {
        $query = "SELECT
                      `b`.`id` AS `id`, `b`.`name` AS `name`, COUNT(*) AS `count`
                  FROM
                      `blog_post_tag` `a`
                      INNER JOIN `blog_posts` `b` ON `a`.`post_id` = `b`.`id`
                      INNER JOIN `blog_categories` `c` ON `b`.`category` = `c`.`id`
                  WHERE
                      `a`.`tag_id` IN
                      (SELECT `d`.`tag_id` FROM `blog_post_tag` `d` WHERE `d`.`post_id` = :id1)
                      AND `b`.`id` <> :id2 AND `b`.`visible` = 1
                  GROUP BY
                      1, 2
                  HAVING
                      COUNT(*) > 1
                  ORDER BY
                      COUNT(*) DESC, `b`.`added` DESC
                  LIMIT
                      7";
        $posts = $this->database->fetchAll($query, array('id1' => $id, 'id2' => $id));
        // добавляем в массив постов блога информацию об URL поста
        foreach($posts as $key => $value) {
            // URL записи (поста) блога
            $posts[$key]['url'] = $this->getURL('frontend/blog/post/id/' . $value['id']);
        }
        return $posts;
    }

    /**
     * Функция возвращает результаты поиска по блогу
     */
    public function getSearchResults($search, $start, $ajax) {

        $search = $this->cleanSearchString($search);
        if (empty($search)) {
            return array();
        }
        $query = $this->getSearchQuery($search);
        if (empty($query)) {
            return array();
        }

        $query = $query . ' LIMIT ' . $start . ', ' . $this->config->pager->frontend->blog->perpage;

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
                $length = 0;
                foreach ($ids as $k => $v) {
                    $short = (iconv_strlen($names[$k]) > 15) ? iconv_substr($names[$k], 0, 14) . '…' : $names[$k];
                    $posts[$key]['tags'][] = array(
                        'id'    => $v,
                        'name'  => $names[$k],
                        'short' => $short,
                        'url'   => $this->getURL('frontend/blog/tags/ids/' . $v)
                    );
                    $length = $length + iconv_strlen($names[$k]);
                    if ($length > 50) break;
                }
                unset($posts[$key]['tag_ids'], $posts[$key]['tag_names']);
            }
        }
        
        if ($ajax) {
            return array_slice($posts, 0, 7);
        }

        return $posts;

    }
    
    /**
     * Функция возвращает количество результатов поиска по блогу
     */
    public function getCountSearchResults($search) {
        $search = $this->cleanSearchString($search);
        if (empty($search)) {
            return 0;
        }
        $query = $this->getCountSearchQuery($search);
        if (empty($query)) {
            return 0;
        }
        return $this->database->fetchOne($query);
    }
    
    /**
     * Функция возвращает SQL-запрос для поиска по каталогу
     */
    private function getSearchQuery($search) {

        if (empty($search)) {
            return '';
        }
        if (iconv_strlen($search) < 2) {
            return '';
        }

        $words = explode(' ', $search);
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
                      GROUP_CONCAT(`d`.`name` ORDER BY `d`.`name`, `d`.`id` SEPARATOR '¤') AS `tag_names`";

        // учитываем каждое слово поискового запроса на основе его длины, т.е. если совпало короткое
        // слово (длиной 1-2 символа), то взнос в релевантность такого совпадения невелик (0.1—0.2);
        // если совпало длинное слово (длиной 4-5 символов), то взнос в релевантность такого совпадения
        // гораздо выше (0.4—0.5); это позволяет немного уменьшить искажения от случайных совпадений
        // коротких слов
        $length = iconv_strlen($words[0]);
        $weight = 0.5;
        if ($length < 5) {
            $weight = 0.1 * $length;
        }
        $query = $query.", (IF( `a`.`search` LIKE '%".$words[0]."%', ".$weight.", 0 )";
        $query = $query." + IF( LOWER(`a`.`search`) REGEXP '[[:<:]]".$words[0]."', 0.05, 0 )";
        $query = $query." + IF( LOWER(`a`.`search`) REGEXP '".$words[0]."[[:>:]]', 0.05, 0 )";
        for ($i = 1; $i < count($words); $i++) {
            $length = iconv_strlen($words[$i]);
            $weight = 0.5;
            if ($length < 5) {
                $weight = 0.1 * $length;
            }
            $query = $query." + IF( `a`.`search` LIKE '%".$words[$i]."%', ".$weight.", 0 )";
            $query = $query." + IF( LOWER(`a`.`search`) REGEXP '[[:<:]]".$words[$i]."', 0.05, 0 )";
            $query = $query." + IF( LOWER(`a`.`search`) REGEXP '".$words[$i]."[[:>:]]', 0.05, 0 )";
        }

        $query = $query.") AS `relevance`";

        $query = $query." FROM
                              `blog_posts` `a`
                              INNER JOIN `blog_categories` `b` ON `a`.`category` = `b`.`id`
                              LEFT JOIN `blog_post_tag` `c` ON `a`.`id` = `c`.`post_id`
                              LEFT JOIN `blog_tags` `d` ON `c`.`tag_id` = `d`.`id`
                          WHERE (";

        /*
         * Условие WHERE SQL-запроса
         */
        $query = $query."`a`.`search` LIKE '%".$words[0]."%'";
        $count = count($words);
        for ($i = 1; $i < $count; $i++) {
            $query = $query." OR `a`.`search` LIKE '%".$words[$i]."%'";
        }
        $query = $query.") AND `a`.`visible` = 1";
        /*
         * Группировка результатов SQL-запроса
         */
        $query = $query." GROUP BY 1, 2, 3, 4, 5, 6, 7";

        /*
         * Сортировка результатов SQL-запроса
         */
        $query = $query." ORDER BY `relevance` DESC, `a`.`added` DESC";

        return $query;

    }
    
    /**
     * Функция возвращает SQL-запрос для получения кол-ва результатов поиска по блогу
     */
    private function getCountSearchQuery($search) {

        if (empty($search)) {
            return '';
        }
        if (iconv_strlen($search) < 2) {
            return '';
        }

        $words = explode(' ', $search);
        $query = "SELECT
                      COUNT(*)
                  FROM
                      `blog_posts` `a`
                      INNER JOIN `blog_categories` `b` ON `a`.`category` = `b`.`id`
                  WHERE (";

        $query = $query."`a`.`search` LIKE '%".$words[0]."%'";
        $count = count($words);
        for ($i = 1; $i < $count; $i++) {
            $query = $query." OR `a`.`search` LIKE '%".$words[$i]."%'";
        }
        $query = $query.") AND `a`.`visible` = 1";

        return $query;

    }

    /**
     * Вспмогательная функция, очищает строку поискового запроса с сайта
     * от всякого мусора
     */
    private function cleanSearchString($search) {
        $search = iconv_substr($search, 0, 64);
        // удаляем все, кроме букв и цифр
        $search = preg_replace('#[^-.$_0-9a-zA-ZА-Яа-яёЁ]#u', ' ', $search);
        // сжимаем двойные пробелы
        $search = preg_replace('#\s+#u', ' ', $search);
        $search = trim($search);
        $search = $this->stringToLower($search);
        return $search;
    }

    /**
     * Вспомогательная функция, преобразует строку в нижний регистр
     */
    private function stringToLower($string) {
        $upper = array(
            'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т',
            'У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я','A','B','C','D','E','F','G',
            'H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'
        );
        $lower = array(
            'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т',
            'у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я','a','b','c','d','e','f','g',
            'h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'
        );
        return str_replace($upper, $lower, $string);
    }


}