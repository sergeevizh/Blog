<?php
/**
 * Класс Blog_Backend_Model для работы с блогом, взаимодействует
 * с базой данных, административная часть сайта
 */
class Blog_Backend_Model extends Backend_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Возвращает массив записей (постов) блога в категории с
     * уникальным идентификатором $id
     */
    public function getCategoryPosts($id, $start) {
        $query = "SELECT
                      `id`, `name,
                      DATE_FORMAT(`added`, '%d.%m.%Y') AS `date`,
                      DATE_FORMAT(`added`, '%H:%i:%s') AS `time`
                  FROM
                      `blog_posts`
                  WHERE
                      `category` = :id
                  ORDER BY
                      `added` DESC
                  LIMIT " . $start . ", " . $this->config->pager->backend->blog->perpage;
        return $this->database->fetchAll($query, array('id' => $id));
    }

    /**
     * Возвращает количество записей (постов) блога в категории с
     * уникальным идентификатором $id
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
     * Возвращает массив всех записей (постов) блога
     */
    public function getAllPosts($start = 0) {
        $query = "SELECT
                      `a`.`id` AS `id`, `a`.`name` AS `name`,
                      DATE_FORMAT(`a`.`added`, '%d.%m.%Y') AS `date`,
                      DATE_FORMAT(`a`.`added`, '%H:%i:%s') AS `time`,
                      `b`.`id` AS `ctg_id`, `b`.`name` AS `ctg_name`
                  FROM
                      `blog_posts` `a` INNER JOIN `blog_categories` `b` ON `a`.`category` = `b`.`id`
                  WHERE
                      1
                  ORDER BY
                      `added` DESC
                  LIMIT " . $start . ", " . $this->config->pager->backend->blog->perpage;
        $posts = $this->database->fetchAll($query);
        // добавляем в массив URL ссылок для редактирования и удаления
        foreach($posts as $key => $value) {
            $posts[$key]['url'] = array(
                'edit'   => $this->getURL('backend/blog/editpost/id/' . $value['id']),
                'remove' => $this->getURL('backend/blog/rmvpost/id/' . $value['id'])
            );
        }
        return $posts;
    }

    /**
     * Возвращает общее количество записей (постов) блога
     */
    public function getCountAllPosts() {
        $query = "SELECT
                      COUNT(*)
                  FROM
                      `blog_posts`
                  WHERE
                      1";
        return $this->database->fetchOne($query);
    }

    /**
     * Возвращает запись (пост) блога с уникальным идентификатором $id
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
                      `blog_posts` `a` INNER JOIN `blog_categories` `b`
                      ON `a`.`category` = `b`.`id`
                  WHERE
                      `a`.`id` = :id";
        return $this->database->fetch($query, array('id' => $id));
    }

    /**
     * Функция добавляет новую запись (пост) блога
     */
    public function addPost($data) {

        // теги блога
        $tags = $data['tags'];
        unset($data['tags']);

        // дата публикации
        $tmp           = explode( '.', $data['date'] );
        $data['added'] = $tmp[2].'-'.$tmp[1].'-'.$tmp[0].' '.$data['time']; // дата и время
        unset($data['date']);
        unset($data['time']);

        // добавляем пост
        $query = "INSERT INTO `blog_posts`
                  (
                      `category`,
                      `name`,
                      `keywords`,
                      `description`,
                      `excerpt`,
                      `body`,
                      `added`
                  )
                  VALUES
                  (
                      :category,
                      :name,
                      :keywords,
                      :description,
                      :excerpt,
                      :body,
                      :added
                  )";
        $this->database->execute($query, $data);
        $id = $this->database->lastInsertId();

        // теги блога
        if (!empty($tags)) {
            foreach($tags as $tag) {
                $query = "INSERT INTO `blog_post_tag`
                          (
                              `post_id`,
                              `tag_id`
                          )
                          VALUES
                          (
                              :post_id,
                              :tag_id
                          )";
                $this->database->execute(
                    $query,
                    array(
                        'post_id' => $id,
                        'tag_id'  => $tag
                    )
                );
            }
        }

        // загружаем файл изображения
        $this->uploadImage($id);

        // загружаем файлы поста
        $this->uploadFiles($id);

    }

    /**
     * Функция обновляет запись (пост) блога
     */
    public function updatePost($data) {

        // теги блога
        $tags = $data['tags'];
        unset($data['tags']);

        // дата публикации
        $tmp           = explode( '.', $data['date'] );
        $data['added'] = $tmp[2].'-'.$tmp[1].'-'.$tmp[0].' '.$data['time']; // дата и время
        unset($data['date']);
        unset($data['time']);

        // обновляем пост
        $query = "UPDATE
                      `blog_posts`
                  SET
                      `category`    = :category,
                      `name`        = :name,
                      `keywords`    = :keywords,
                      `description` = :description,
                      `excerpt`     = :excerpt,
                      `body`        = :body,
                      `added`       = :added
                  WHERE
                      `id` = :id";
        $this->database->execute($query, $data);

        // теги блога
        $query = "DELETE FROM `blog_post_tag` WHERE `post_id` = :id";
        $this->database->execute($query, array('id' => $data['id']));
        if (!empty($tags)) {
            foreach($tags as $tag) {
                $query = "INSERT INTO `blog_post_tag`
                          (
                              `post_id`,
                              `tag_id`
                          )
                          VALUES
                          (
                              :post_id,
                              :tag_id
                          )";
                $this->database->execute(
                    $query,
                    array(
                        'post_id' => $data['id'],
                        'tag_id'  => $tag
                    )
                );
            }
        }

        // загружаем файл изображения
        $this->uploadImage($data['id']);

    }

    /**
     * Функция загружает файл изображения для записи (поста) блога с
     * уникальным идентификатором $id
     */
    private function uploadImage($id) {

        // удаляем изображение, загруженное ранее
        if (isset($_POST['remove_image'])) {
            if (is_file('files/blog/thumb/' . $id . '.jpg')) {
                unlink('files/blog/thumb/' . $id . '.jpg');
            }
        }

        // проверяем, пришел ли файл изображения
        if ( ! empty($_FILES['image']['name'])) {
            // проверяем, что при загрузке не произошло ошибок
            if (0 == $_FILES['image']['error']) {
                // если файл загружен успешно, то проверяем - изображение?
                $mimetypes = array('image/jpeg', 'image/pjpeg', 'image/gif', 'image/png', 'image/x-png');
                if (in_array($_FILES['image']['type'], $mimetypes)) {
                    // изменяем размер изображения
                    $this->resizeImage(
                        $_FILES['image']['tmp_name'],
                        'files/blog/thumb/' . $id . '.jpg',
                        100,
                        100,
                        'jpg'
                    );
                }
            }
        }

    }

    /**
     * Функция загружает новые файлы и удаляет старые для поста
     * с уникальным идентификатором $id
     */
    private function uploadFiles($id) {

        // создаем директорию для хранения файлов поста
        if (!is_dir('files/blog/' . $id)) {
            mkdir('files/blog/' . $id);
        }

        // удаляем файлы, загруженные ранее
        if (isset($_POST['remove_files'])) {
            foreach ($_POST['remove_files'] as $name) {
                if (is_file('files/blog/' . $id . '/' . $name)) {
                    unlink('files/blog/' . $id . '/' . $name);
                }
            }
        }

        // загружаем новые файлы
        $mimeTypes = array(
            'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png', 'image/x-png', 'image/bmp',
            'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'application/zip', 'application/x-zip-compressed', 'application/pdf');
        $exts = array(
            'jpg', 'jpeg', 'gif', 'png', 'bmp', 'doc', 'docx',
            'xls', 'xlsx', 'ppt', 'pptx', 'zip', 'pdf'
        );
        $count = count($_FILES['files']['name']);
        // цикл по всем загруженным файлам
        for ($i = 0; $i < $count; $i++) {
            $ext = pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
            // недопустимое расширение файла
            if ( ! in_array($ext, $exts)) {
                continue;
            }
            // недопустимый mime-тип файла
            if ( ! in_array($_FILES['files']['type'][$i], $mimeTypes) ) {
                continue;
            }
            // загружаем файл
            move_uploaded_file(
                $_FILES['files']['tmp_name'][$i],
                'files/blog/' . $id . '/' . $_FILES['files']['name'][$i]
            );
        }

    }

    /**
     * Функция для удаления записи (поста) блога с уникальным идентификатором $id
     */
    public function removePost($id) {
        // удаляем запись в таблице `blog_posts` БД
        $query = "DELETE FROM
                      `blog_posts`
                  WHERE
                      `id` = :id";
        $this->database->execute($query, array('id' => $id));
        // удаляем изображение
        if (is_file('files/blog/thumb/' . $id . '.jpg')) {
            unlink('files/blog/thumb/' . $id . '.jpg');
        }
        // удаляем файлы и директорию
        $dir = 'files/blog/' . $id;
        if (is_dir($dir)) {
            $items = scandir($dir);
            foreach ($items as $item) {
                if ($item == '.' || $item == '..') {
                    continue;
                }
                if (is_dir($dir . '/' . $item)) {
                    $files = scandir($dir . '/' . $item);
                    foreach($files as $file) {
                        if ($file == '.' || $file == '..') {
                            continue;
                        }
                        unlink($dir . '/' . $item . '/' . $file);
                    }
                    rmdir($dir . '/' . $item);
                } else {
                    unlink($dir . '/' . $item);
                }
            }
            rmdir($dir);
        }
    }

    /**
     * Функция возвращает массив всех тегов блога
     */
    public function getAllTags() {
        $query = "SELECT
                      `id`, `name`
                  FROM
                      `blog_tags`
                  WHERE
                      1
                  ORDER BY
                      `name`";
        return $this->database->fetchAll($query);
    }

    /**
     * Функция возвращает массив идентификаторов тегов поста $id
     */
    public function getPostTags($id) {
        $query = "SELECT
                      `a`.`id`
                  FROM
                      `blog_tags` `a` INNER JOIN `blog_post_tag` `b`
                      ON `a`.`id` = `b`.`tag_id`
                  WHERE
                      `b`.`post_id` = :id
                  ORDER BY
                      `a`.`name`";
        $items = $this->database->fetchAll($query, array('id' => $id));
        $ids = array();
        foreach ($items as $item) {
            $ids[] = $item['id'];
        }
        return $ids;
    }

    /**
     * Возвращает массив категорий записей (постов) блога для контроллера,
     * отвечающего за вывод всех категорий
     */
    public function getAllCategories() {
        $query = "SELECT
                      `id`, `name`, `parent`
                  FROM
                      `blog_categories`
                  WHERE
                      1
                  ORDER BY
                      `sortorder`";
        $data = $this->database->fetchAll($query);
        // добавляем в массив URL ссылок для редактирования и удаления
        foreach($data as $key => $value) {
            $data[$key]['url'] = array(
                'up'     => $this->getURL('backend/blog/ctgup/id/' . $value['id']),
                'down'   => $this->getURL('backend/blog/ctgdown/id/' . $value['id']),
                'edit'   => $this->getURL('backend/blog/editctg/id/' . $value['id']),
                'remove' => $this->getURL('backend/blog/rmvctg/id/' . $value['id'])
            );
        }
        // строим дерево
        $tree = $this->makeTree($data);
        return $tree;
    }

    /**
     * Возвращает массив категорий верхнего уровня, для контроллера,
     * отвечающего за добавление/редактирование категорий
     */
    public function getRootCategories() {
        $query = "SELECT
                      `id`, `name`, `parent`
                  FROM
                      `blog_categories`
                  WHERE
                      `parent` = 0
                  ORDER BY
                      `sortorder`";
        $data = $this->database->fetchAll($query);
        // строим дерево
        $tree = $this->makeTree($data);
        return $tree;
    }

    /**
     * Возвращает массив категорий для контроллеров, отвечающих за добавление
     * и редактирование записи (поста) блога, для возможности выбора родителя
     */
    public function getCategories() {
        $query = "SELECT
                      `id`, `parent`, `name`
                  FROM
                      `blog_categories`
                  WHERE
                      1
                  ORDER BY
                      `sortorder`";
        $data = $this->database->fetchAll($query);
        // строим дерево
        $tree = $this->makeTree($data);
        return $tree;
    }

    /**
     * Функция возвращает информацию о категории с уникальным идентификатором $id
     */
    public function getCategory($id) {
        $query = "SELECT
                      `parent`, `name`, `keywords`, `description`
                  FROM
                      `blog_categories`
                  WHERE
                      `id` = :id";
        return $this->database->fetch($query, array('id' => $id));
    }

    /**
     * Функция добавляет новую категорию блога
     */
    public function addCategory($data) {
        // порядок сортировки
        $query = "SELECT
                      IFNULL(MAX(`sortorder`), 0)
                  FROM
                      `blog_categories`
                  WHERE
                      `parent` = :parent";
        $data['sortorder'] = $this->database->fetchOne($query, array('parent' => $data['parent'])) + 1;

        // добавляем новую категорию блога
        $query = "INSERT INTO `blog_categories`
                  (
                      `parent`,
                      `name`,
                      `keywords`,
                      `description`,
                      `sortorder`
                  )
                  VALUES
                  (
                      :parent,
                      :name,
                      :keywords,
                      :description,
                      :sortorder
                  )";
        $this->database->execute($query, $data);
    }

    /**
     * Функция обновляет категорию блога
     */
    public function updateCategory($data) {
        // получаем идентификатор родителя
        $oldParent = $this->getCategoryParent($data['id']);
        // если был изменен родитель категории
        if ($oldParent != $data['parent']) {
            // добавляем категорию в конец списка дочерних элементов нового родителя
            $query = "SELECT
                          IFNULL(MAX(`sortorder`), 0)
                      FROM
                          `blog_categories`
                      WHERE
                          `parent` = :parent";
            $data['sortorder'] = $this->database->fetchOne($query, array('parent' => $data['parent'])) + 1;
            $query = "UPDATE
                          `blog_categories`
                      SET
                          `parent`      = :parent,
                          `name`        = :name,
                          `keywords`    = :keywords,
                          `description` = :description,
                          `sortorder`   = :sortorder
                      WHERE
                          `id` = :id";
            $this->database->execute($query, $data);
            // изменяем порядок сортировки категорий, которые были с обновленной
            // категорией на одном уровне до того, как она поменял родителя
            $query = "SELECT
                          `id`
                      FROM
                          `blog_categories`
                      WHERE
                          `parent` = :parent
                      ORDER BY
                          `sortorder`";
            $childs = $this->database->fetchAll($query, array('parent' => $oldParent));
            $sortorder = 1;
            foreach ($childs as $child) {
                $query = "UPDATE
                              `blog_categories`
                          SET
                              `sortorder` = :sortorder
                          WHERE
                              `id` = :id";
                $this->database->execute($query, array('sortorder' => $sortorder, 'id' => $child['id']));
                $sortorder++;
            }
        } else {
            unset($data['parent']);
            $query = "UPDATE
                          `blog_categories`
                      SET
                          `name`        = :name,
                          `keywords`    = :keywords,
                          `description` = :description
                      WHERE
                          `id` = :id";
            $this->database->execute($query, $data);
        }
    }

    /**
     * Функция опускает категорию вниз в списке
     */
    public function moveCategoryDown($id) {
        $id_item_down = $id;
        // порядок следования категории, которая опускается вниз
        $query = "SELECT
                      `sortorder`, `parent`
                  FROM
                      `blog_categories`
                  WHERE
                      `id` = :id_item_down";
        $res = $this->database->fetch($query, array('id_item_down' => $id_item_down));
        $order_down = $res['sortorder'];
        $parent = $res['parent'];
        // порядок следования и id категории, которая находится ниже и будет поднята
        // вверх, поменявшись местами с категорией, которая опускается вниз
        $query = "SELECT
                      `id`, `sortorder`
                  FROM
                      `blog_categories`
                  WHERE
                      `parent` = :parent AND `sortorder` > :order_down
                  ORDER BY
                      `sortorder`
                  LIMIT
                      1";
        $res = $this->database->fetch(
            $query,
            array(
                'parent' => $parent,
                'order_down' => $order_down
            )
        );
        if (is_array($res)) {
            $id_item_up = $res['id'];
            $order_up = $res['sortorder'];
            // меняем местами категории
            $query = "UPDATE
                          `blog_categories`
                      SET
                          `sortorder` = :order_down
                      WHERE
                          `id` = :id_item_up";
            $this->database->execute(
                $query,
                array(
                    'order_down' => $order_down,
                    'id_item_up' => $id_item_up
                )
            );
            $query = "UPDATE
                          `blog_categories`
                      SET
                          `sortorder` = :order_up
                      WHERE
                          `id` = :id_item_down";
            $this->database->execute(
                $query,
                array(
                    'order_up' => $order_up,
                    'id_item_down' => $id_item_down
                )
            );
        }
    }

    /**
     * Функция поднимает категорию вверх в списке
     */
    public function moveCategoryUp($id) {
        $id_item_up = $id;
        // порядок следования категории, которая поднимается вверх
        $query = "SELECT
                      `sortorder`, `parent`
                  FROM
                      `blog_categories`
                  WHERE
                      `id` = :id_item_up";
        $res = $this->database->fetch($query, array('id_item_up' => $id_item_up));
        $order_up = $res['sortorder'];
        $parent = $res['parent'];
        // порядок следования и id категории, которая находится выше и будет опущена
        // вниз, поменявшись местами с категорией, которая поднимается вверх
        $query = "SELECT
                      `id`, `sortorder`
                  FROM
                      `blog_categories`
                  WHERE
                      `parent` = :parent AND `sortorder` < :order_up
                  ORDER BY
                      `sortorder` DESC
                  LIMIT
                      1";
        $res = $this->database->fetch(
            $query,
            array(
                'parent' => $parent,
                'order_up' => $order_up
            )
        );
        if (is_array($res)) {
            $id_item_down = $res['id'];
            $order_down = $res['sortorder'];
            // меняем местами категории
            $query = "UPDATE
                          `blog_categories`
                      SET
                          `sortorder` = :order_down
                      WHERE
                          `id` = :id_item_up";
            $this->database->execute(
                $query,
                array(
                    'order_down' => $order_down,
                    'id_item_up' => $id_item_up
                )
            );
            $query = "UPDATE
                          `blog_categories`
                      SET
                          `sortorder` = :order_up
                      WHERE
                          `id` = :id_item_down";
            $this->database->execute(
                $query,
                array(
                    'order_up' => $order_up,
                    'id_item_down' => $id_item_down
                )
            );
        }
    }

    /**
     * Функция удаляет категорию блога
     */
    public function removeCategory($id) {

        // проверяем, что не существует постов в этой категории
        $query = "SELECT
                      1
                  FROM
                      `blog_posts`
                  WHERE
                      `category` = :id
                  LIMIT
                      1";
        $res = $this->database->fetchOne($query, array('id' => $id));
        if ($res) {
            return false;
        }

        // удаляем запись в таблице `blog_categories` БД
        $parent = $this->getCategoryParent($id);
        $query = "DELETE FROM
                      `blog_categories`
                  WHERE
                      `id` = :id";
        $this->database->execute($query, array('id' => $id));

        // изменяем порядок сортировки категорий, которые с удаленной на одном уровне
        $query = "SELECT `id` FROM `blog_categories` WHERE `parent` = :parent ORDER BY `sortorder`";
        $childs = $this->database->fetchAll($query, array('parent' => $parent));
        if (count($childs) > 0) {
            $sortorder = 1;
            foreach ($childs as $child) {
                $query = "UPDATE `blog_categories` SET `sortorder` = :sortorder WHERE `id` = :id";
                $this->database->execute($query, array('sortorder' => $sortorder, 'id' => $child['id']));
                $sortorder++;
            }
        }

        return true;

    }

    /**
     * Функция возвращает идентификатор родителя для категории $if
     */
    private function getCategoryParent($id) {
        $query = "SELECT
                      `parent`
                  FROM
                      `blog_categories`
                  WHERE
                      `id` = :id";
        return $this->database->fetchOne($query, array('id' => $id));
    }

}