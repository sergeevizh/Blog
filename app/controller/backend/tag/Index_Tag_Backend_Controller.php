<?php
/**
 * Класс Index_Tag_Backend_Controller формирует страницу со списком всех
 * тегов блога, получает данные от модели Tag_Backend_Model
 */
class Index_Tag_Backend_Controller extends Tag_Backend_Controller {

    public function __construct($params = null) {
        parent::__construct($params);
    }

    /**
     * Функция получает от модели данные, необходимые для формирования страницы
     * со списком всех тегов блога
     */
    protected function input() {

        /*
         * сначала обращаемся к родительскому классу Tag_Backend_Controller,
         * чтобы установить значения переменных, которые нужны для работы всех
         * его потомков, потом переопределяем эти переменные (если необходимо)
         * и устанавливаем значения перменных, которые нужны для работы только
         * Index_Tag_Backend_Controller
         */
        parent::input();

        $this->title = 'Теги блога. ' . $this->title;

        // формируем хлебные крошки
        $breadcrumbs = array(
            array(
                'name' => 'Главная',
                'url'  => $this->tagBackendModel->getURL('backend/index/index')
            ),
        );

        // получаем от модели массив всех тегов блога
        $tags = $this->tagBackendModel->getTags();

        /*
         * массив переменных, которые будут переданы в шаблон center.php
         */
        $this->centerVars = array(
            // хлебные крошки
            'breadcrumbs' => $breadcrumbs,
            // URL ссылки на страницу с формой для добавления тега
            'addTagURL'  => $this->tagBackendModel->getURL('backend/tag/add'),
            // массив всех тегов блога
            'tags'       => $tags,
        );

    }

}