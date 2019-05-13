<?php
/**
 * Класс Search_Blog_Frontend_Controller формирует страницу поиска по блогу,
 * получает данные от модели Blog_Frontend_Model, общедоступная часть сайта
 */
class Search_Blog_Frontend_Controller extends Blog_Frontend_Controller {

    public function __construct($params = null) {
        parent::__construct($params);
        $this->robots = false;
    }

    /**
     * Функция получает от модели данные, необходимые для формирования страницы
     * результатов поиска по каталогу
     */
    protected function input() {

        /*
         * сначала обращаемся к родительскому классу Blog_Frontend_Controller,
         * чтобы установить значения переменных, которые нужны для работы всех
         * его потомков, потом переопределяем эти переменные (если необходимо)
         * и устанавливаем значения перменных, которые нужны для работы только
         * Search_Blog_Frontend_Controller
         */
        parent::input();

        /*
         * если данные формы были отправлены, перенаправляем пользователя на эту
         * же страницу, только поисковый запрос (например «ABC-123») будет частью
         * URL страницы: www.server.com/blog/search/query/ABC-123
         */
        if ($this->isPostMethod()) {
            if ( ! empty($_POST['query'])) {
                /*
                 * если строка поиска содержит «/» (слэш), например «ABC-123/45»,
                 * то $_SERVER['REQUEST_URI'] = /blog/search/query/ABC-123/45,
                 * и роутер не сможет правильно разобрать $_SERVER['REQUEST_URI'];
                 * см. файл app/include/Router.php
                 */
                $query = trim(iconv_substr(str_replace('/', '|', $_POST['query']), 0, 64));
                $temp = 'frontend/blog/search/query/' . rawurlencode($query);
                $this->redirect($this->blogFrontendModel->getURL($temp));
            } else {
                // пустой поисковый запрос, просто показываем страницу поиска по блогу
                $this->redirect($this->blogFrontendModel->getURL('frontend/blog/search'));
            }
        }

        $this->title = 'Поиск по блогу';

        $this->keywords = 'поиск ' . $this->keywords;
        $this->description = 'Поиск по блогу. ' . $this->description;

        // формируем хлебные крошки
        $breadcrumbs = array(
            array(
                'name' => 'Главная',
                'url'  => $this->blogFrontendModel->getURL('frontend/index/index')
            ),
            array(
                'name' => 'Блог',
                'url'  => $this->blogFrontendModel->getURL('frontend/blog/index')
            )
        );

        /*
         * массив переменных, которые будут переданы в шаблон center.php, если поисковый запрос пустой
         */
        if (empty($this->params['query'])) {
            $this->centerVars['action'] = $this->blogFrontendModel->getURL('frontend/blog/search');
            $this->centerVars['breadcrumbs'] = $breadcrumbs;
            return;
        }

        /*
         * постраничная навигация
         */
        $page = 1;
        if (isset($this->params['page']) && ctype_digit($this->params['page'])) { // текущая страница
            $page = (int)$this->params['page'];
        }
        // общее кол-во результатов поиска
        $totalProducts = $this->blogFrontendModel->getCountSearchResults($this->params['query']);
        // URL ссылки на эту страницу
        $thisPageUrl = $this->blogFrontendModel->getURL(
            'frontend/blog/search/query/' . rawurlencode($this->params['query'])
        );
        $temp = new Pager(
            $thisPageUrl,                                   // URL этой страницы
            $page,                                          // текущая страница
            $totalProducts,                                 // общее кол-во результатов поиска
            $this->config->pager->frontend->blog->perpage,  // кол-во постов на странице
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
         * см. причины такой замены в комментариях выше, в начале метода
         */
        $this->params['query'] = str_replace('|', '/', $this->params['query']);

        // получаем от модели массив результатов поиска
        $posts = $this->blogFrontendModel->getSearchResults(
            $this->params['query'],
            $start,
            false
        );

        /*
         * массив переменных, которые будут переданы в шаблон center.php
         */
        $this->centerVars = array(
            // хлебные крошки
            'breadcrumbs' => $breadcrumbs,
            // атрибут action тега form
            'action'      => $this->blogFrontendModel->getURL('frontend/blog/search'),
            // поисковый запрос
            'query'       => $this->params['query'],
            // массив результатов поиска
            'posts'       => $posts,
            // постраничная навигация
            'pager'       => $pager,
            // текущая страница
            'page'        => $page,
        );

    }

}
