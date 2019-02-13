<?php
/**
 * Класс Xhr_Search_Blog_Frontend_Controller формирует ответ на запрос XmlHttpRequest
 * в формате HTML, получает данные от модели Blog_Frontend_Model, общедоступная часть
 * сайта. Ответ содержит результаты поиска по записям блога.
 */
class Xhr_Search_Blog_Frontend_Controller extends Blog_Frontend_Controller {

    /**
     * результаты поиска по блогу
     */
    private $output;


    public function __construct($params = null) {
        if ( ! $this->isPostMethod()) {
            header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
            die();
        }
        parent::__construct($params);
    }

    public function request() {

        // получаем от модели массив результатов поиска
        $results = $this->blogFrontendModel->getSearchResults($_POST['query'], 0, true);

        // формируем HTML результатов поиска
        $this->output = $this->render(
            $this->config->site->theme . '/frontend/template/blog/search/ajax.php',
            array(
                'results' => $results,
            )
        );
    }

    public function getContentLength() {
        return strlen($this->output);
    }

    public function sendHeaders() {
        header('Content-type: text/html; charset=utf-8');
        header('Content-Length: ' . $this->getContentLength());
    }

    public function getPageContent() {
        return $this->output;
    }

}