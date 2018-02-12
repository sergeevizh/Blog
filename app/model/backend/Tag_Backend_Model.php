<?php
/**
 * Класс Tag_Backend_Model для работы с тегами блога,
 * взаимодействует с базой данных, административная часть сайта
 */
class Tag_Backend_Model extends Backend_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Функция возвращает данные о теге блога с уникальным идентификатором $id
     */
    public function getTag($id) {
        $query = "SELECT
                      `name`
                  FROM
                      `blog_tags`
                  WHERE
                      `id` = :id";
        return $this->database->fetch($query, array('id' => $id));
    }

    /**
     * Функция возвращает массив всех тегов блога
     */
    public function getTags() {
        $query = "SELECT
                      `id`, `name`
                  FROM
                      `blog_tags`
                  WHERE
                      1
                  ORDER BY
                      `name`";
        $data = $this->database->fetchAll($query);
        // добавляем в массив URL ссылок для редактирования, удаления, перемещения вверх/вниз
        foreach($data as $key => $value) {
            $data[$key]['url'] = array(
                'edit'   => $this->getURL('backend/tag/edit/id/' . $value['id']),
                'remove' => $this->getURL('backend/tag/remove/id/' . $value['id'])
            );
        }
        return $data;
    }

    /**
     * Функция добавляет новый тег блога
     */
    public function addTag($data) {
        $query = "INSERT INTO `blog_tags`
                    (
                        `name`
                    )
                    VALUES
                    (
                        :name
                    )";
        $this->database->execute($query, $data);
    }

    /**
     * Функция обновляет тег блога
     */
    public function updateTag($data) {
        $query = "UPDATE
                      `blog_tags`
                  SET
                      `name` = :name
                  WHERE
                      `id` = :id";
        $this->database->execute($query, $data);
    }

    /**
     * Функция удаляет тег блога
     */
    public function removeTag($id) {
        // удаляем тег блога
        $query = "DELETE FROM `blog_tags` WHERE `id` = :id";
        $this->database->execute($query, array('id' => $id));
        // удаляем привязку постов к этому тегу
        $query = "DELETE FROM `blog_post_tag` WHERE `tag_id` = :id";
        $this->database->execute($query, array('id' => $id));
    }

}
