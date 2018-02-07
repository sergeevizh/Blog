<?php
/**
 * Класс Remove_Tag_Backend_Controller отвечает за удаление тега блога,
 * взаимодействует с моделью tag_Backend_Model, административная часть сайта
 */
class Remove_Tag_Backend_Controller extends Tag_Backend_Controller {

    public function __construct($params = null) {
        parent::__construct($params);
    }

    /**
     * Функция получает от модели данные, необходимые для формирования страницы.
     * В данном случае страницу нам формировать не нужно, и от модели ничего получать
     * не надо. Только удаление тега и редирект.
     */
    protected function input() {
        // если передан id тега и id тега целое положительное число
        if (isset($this->params['id']) && ctype_digit($this->params['id'])) {
            $this->params['id'] = (int)$this->params['id'];
            $this->tagBackendModel->removeTag($this->params['id']);
        }
        $this->redirect($this->tagBackendModel->getURL('backend/tag/index'));
    }
}