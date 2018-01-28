<?php
/**
 * Класс Index_Index_Frontend_Controller фомирует главную страницу
 * общедоступной части сайта
 */
class Index_Index_Frontend_Controller extends Index_Frontend_Controller {

    public function __construct($params = null) {
        parent::__construct($params);
    }

    /**
     * Функция получает от модели данные, необходимые для формирования главной
     * страницы сайта
     */
    protected function input() {

        /*
         * сначала обращаемся к родительскому классу Frontend_Controller, чтобы
         * установить значения переменных, которые нужны для работы всех его
         * потомков, потом переопределяем эти переменные (если необходимо) и
         * устанавливаем значения перменных, которые нужны для работы только
         * Index_Index_Frontend_Controller
         */
        parent::input();

        /*
         * получаем от модели все данные для формирования главной страницы сайта
         */

        // массив последних постов блога
        $posts = $this->indexFrontendModel->getLastPosts();
        // массив последних опубликованных статей
        $articles = $this->indexFrontendModel->getLastArticles();

        /*
         * переменные, которые будут переданы в шаблон center.php
         */
        $this->centerVars = array(
            // заголовок h1 главной страницы
            'name'        => 'Записки программиста',
            // массив последних постов блога
            'posts'    => $posts,
            // массив последних опубликованных статей
            'articles' => $articles,
        );

    }

}
