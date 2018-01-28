<?php
/**
 * Класс Index_Index_Backend_Controller формирует главную страницу административной
 * части сайта
 */
class Index_Index_Backend_Controller extends Backend_Controller {

    public function __construct($params = null) {
        parent::__construct($params);
    }

    /**
     * Функция получает от модели данные, необходимые для формирования
     * главной страницы административной части сайта
     */
    protected function input() {

        /*
         * сначала обращаемся к родительскому классу Backend_Controller, чтобы
         * установить значения переменных, которые нужны для работы всех его
         * потомков, потом переопределяем эти переменные (если необходимо) и
         * устанавливаем значения перменных, которые нужны для работы только
         * Index_Backend_Controller
         */
        parent::input();

        // получаем от модели массив последних постов блога
        $lastPosts = $this->blogBackendModel->getAllPosts();
        
        // получаем от модели массив последних статей
        $lastArticles = $this->articleBackendModel->getAllArticles();

        /*
         * переменные, которые будут переданы в шаблон center.php
         */
        $this->centerVars = array(
            'lastPosts'     => $lastPosts,    // массив последних постов
            'lastArticles'  => $lastArticles, // массив последних статей
        );

    }

}