<?php
/**
 * Класс Item_Article_Frontend_Controller формирует страницу отдельной статьи,
 * получает данные от модели Article_Frontend_Model, общедоступная часть сайта
 */
class Item_Article_Frontend_Controller extends Article_Frontend_Controller {

    public function __construct($params = null) {
        parent::__construct($params);
    }

    /**
     * Функция получает от модели данные, необходимые для формирования страницы
     * отдельной статьи
     */
    protected function input() {

        // если не передан id статьи или id статьи не число
        if ( ! (isset($this->params['id']) && ctype_digit($this->params['id'])) ) {
            $this->notFoundRecord = true;
            return;
        } else {
            $this->params['id'] = (int)$this->params['id'];
        }

        // получаем от модели данные о статье
        $article = $this->articleFrontendModel->getArticle($this->params['id']);
        // если запрошенная статья не найдена в БД
        if (empty($article)) {
            $this->notFoundRecord = true;
            return;
        }

        /*
         * сначала обращаемся к родительскому классу Article_Frontend_Controller,
         * чтобы установить значения переменных, которые нужны для работы всех
         * его потомков, потом переопределяем эти переменные (если необходимо) и
         * устанавливаем значения перменных, которые нужны для работы только
         * Item_Article_Frontend_Controller
         */
        parent::input();

        $this->title = $article['name'] . '. Категория: ';
        if ($article['parent']) {
            $this->title = $this->title . $article['root_name'] . ' • ' . $article['ctg_name'];
        } else {
            $this->title = $this->title . $article['ctg_name'];
        }

        // формируем хлебные крошки
        $breadcrumbs = array(
            array(
                'name' => 'Главная',
                'url' => $this->articleFrontendModel->getURL('frontend/index/index'),
            ),
            array(
                'name' => 'Статьи',
                'url' => $this->articleFrontendModel->getURL('frontend/article/index'),
            )
        );
        if ($article['parent']) {
            $breadcrumbs[] = array(
                'name' => $article['root_name'],
                'url'  => $this->articleFrontendModel->getURL('frontend/article/category/id/' . $article['root_id']),
            );
        }
        $breadcrumbs[] = array(
            'name' => $article['ctg_name'],
            'url' => $this->articleFrontendModel->getURL('frontend/article/category/id/' . $article['ctg_id']),
        );

        /*
         * массив переменных, которые будут переданы в шаблон center.php
         */
        $this->centerVars = array(
            // хлебные крошки
            'breadcrumbs'     => $breadcrumbs,
            // заголовок статьи
            'name'            => $article['name'],
            // текст статьи
            'body'            => $article['body'],
            // дата публикации
            'date'            => $article['date'],
            // наименование категории
            'categoryName'    => $article['ctg_name'],
            // URL страницы категории
            'categoryURL'     => $this->articleFrontendModel->getURL(
                'frontend/article/category/id/' . $article['ctg_id']
            ),
            // источник статьи
            'source'          => $article['source'],
            // есть или нет корневая категория
            'root'            => (bool)$article['parent'],
        );

        if ($article['parent']) {
            $this->centerVars['rootName'] = $article['root_name'];
            $this->centerVars['rootURL'] = $this->articleFrontendModel->getURL(
                'frontend/article/category/id/' . $article['root_id']
            );
        }
    }

}
