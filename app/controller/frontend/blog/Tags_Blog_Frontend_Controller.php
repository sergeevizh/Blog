<?php
/**
 * Класс Tags_Blog_Frontend_Controller формирует страницу со списком
 * всех постов блога для выбранных тегов, получает данные от модели
 * Blog_Frontend_Model, общедоступная часть сайта
 */
class Tags_Blog_Frontend_Controller extends Blog_Frontend_Controller {

    public function __construct($params = null) {
        parent::__construct($params);
    }

    /**
     * Функция получает от модели данные, необходимые для формирования страницы:
     * навание тега (тегов) + список постов, связанных с этим тегом (тегами)
     */
    protected function input() {

        // если не переданы идентификаторы тегов
        if ( ! (isset($this->params['ids']))) {
            $this->notFoundRecord = true;
            return;
        }

        // если список идентификаторов имеет некорректный формат
        if ( ! preg_match('~^\d+(-\d+)*$~', $this->params['ids'])) {
            $this->notFoundRecord = true;
            return;
        }

        $ids = explode('-', $this->params['ids']);

        // получаем от модели информацию о тегах
        $tags = array();
        foreach ($ids as $id) {
            $tag = $this->blogFrontendModel->getTagName($id);
            // если запрошенный тег не найден в БД
            if (empty($tag)) {
                $this->notFoundRecord = true;
                return;
            }
            $tags[] = $tag;
        }

        /*
         * обращаемся к родительскому классу Blog_Frontend_Controller, чтобы
         * установить значения переменных, которые нужны для работы всех его
         * потомков, потом переопределяем эти переменные (если необходимо) и
         * устанавливаем значения перменных, которые нужны для работы только
         * Tags_Blog_Frontend_Controller
         */
        parent::input();

        $this->title = 'Теги: ' . implode(', ', $tags) . '. Все посты блога.';

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
            array(
                'name' => 'Все теги',
                'url'  => $this->blogFrontendModel->getURL('frontend/blog/alltags')
            ),
        );

        /*
         * постраничная навигация
         */
        $page = 1;
        if (isset($this->params['page']) && ctype_digit($this->params['page'])) {
            $page = (int)$this->params['page'];
        }
        // общее кол-во постов в категории
        $totalPosts = $this->blogFrontendModel->getCountPostsByTags($ids);
        // URL ссылки на эту страницу
        $thisPageURL = $this->blogFrontendModel->getURL('frontend/blog/tags/ids/' . $this->params['ids']);
        $temp = new Pager(
            $thisPageURL,                                   // URL этой страницы
            $page,                                          // текущая страница
            $totalPosts,                                    // общее кол-во постов в категории
            $this->config->pager->frontend->blog->perpage,  // постов на страницу
            $this->config->pager->frontend->blog->leftright // кол-во ссылок слева и справа
        );
        $pager = $temp->getNavigation();
        if (false === $pager) { // недопустимое значение $page (за границей диапазона)
            $this->notFoundRecord = true;
            return;
        }
        // стартовая позиция для SQL-запроса
        $start = ($page - 1) * $this->config->pager->frontend->blog->perpage;

        /*
         * получаем от модели массив постов
         */
        $posts = $this->blogFrontendModel->getPostsByTags($ids, $start);

        /*
         * массив переменных, которые будут переданы в шаблон center.php
         */
        $this->centerVars = array(
            // хлебные крошки
            'breadcrumbs' => $breadcrumbs,
            // названия тегов
            'tags'        => $tags,
            // массив постов
            'posts'       => $posts,
            // постраничная навигация
            'pager'       => $pager,
        );

    }

}
