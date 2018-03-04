<?php
/**
 * Класс Alltags_Blog_Frontend_Controller формирует страницу со списком
 * всех тегов блога, получает данные от модели Blog_Frontend_Model,
 * общедоступная часть сайта
 */
class Alltags_Blog_Frontend_Controller extends Blog_Frontend_Controller {

    public function __construct($params = null) {
        parent::__construct($params);
    }

    /**
     * Функция получает от модели данные, необходимые для формирования страницы
     * со списком всех тегов блога
     */
    protected function input() {

        /*
         * сначала обращаемся к родительскому классу Blog_Frontend_Controller,
         * чтобы установить значения переменных, которые нужны для работы всех
         * его потомков, потом переопределяем эти переменные (если необходимо) и
         * устанавливаем значения перменных, которые нужны для работы только
         * Alltags_Blog_Frontend_Controller
         */
        parent::input();

        // если данные формы были отправлены: пользователь выбрал теги
        if ($this->isPostMethod()) {
            // перенапровляем пользователя на страницу выбранных тегов
            if (isset($_POST['tags']) && is_array($_POST['tags'])) {
                // проверяем, что получены корректные данные
                $ids = array();
                foreach($_POST['tags'] as $id) {
                    if (ctype_digit($id)) {
                        $ids[] = $id;
                    }
                }
                if (!empty($ids)) { // данные корректные, перенаправляем на страницу выбранных тегов
                    $this->redirect($this->blogFrontendModel->getURL('frontend/blog/tags' . implode('-', $ids)));
                } else { // данные не корректные, перенаправляем на эту же страницу
                    $this->redirect($this->blogFrontendModel->getURL('frontend/blog/alltags'));
                }
            } else { // теги не выбраны, перенаправляем на эту же страницу
                $this->redirect($this->blogFrontendModel->getURL('frontend/blog/alltags'));
            }
        }

        $this->title = 'Все теги блога. ' . $this->title;

        // формируем хлебные крошки
        $breadcrumbs = array(
            array(
                'name' => 'Главная',
                'url'  => $this->blogFrontendModel->getURL('frontend/index/index')
            ),
            array(
                'name' => 'Блог',
                'url'  => $this->blogFrontendModel->getURL('frontend/blog/index')
            ),
        );

        // получаем от модели массив всех тегов блога
        $tags = $this->blogFrontendModel->getAllTags();

        /*
         * массив переменных, которые будут переданы в шаблон center.php
         */
        $this->centerVars = array(
            // хлебные крошки
            'breadcrumbs' => $breadcrumbs,
            // атрибут action тега form
            'action'      => $this->blogFrontendModel->getURL('frontend/blog/alltags'),
            // массив всех тегов блога
            'tags'        => $tags,
        );

    }

}
