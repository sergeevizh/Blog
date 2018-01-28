<?php
/**
 * Абстрактный класс Frontend_Controller, родительский для всех контроллеров
 * общедоступной части сайта
 */
abstract class Frontend_Controller extends Base_Controller {

    /**
     * мета-тег robots, управляет индексацией страницы
     */
    protected $robots = true;

    /**
     * канонический URL, для роботов поисковых систем
     */
    protected $canonicalURL = false;

    /**
     * экземпляр класса модели для работы с главной страницей сайта
     */
    protected $indexFrontendModel;

    /**
     * экземпляр класса модели для работы с главным меню сайта
     */
    protected $menuFrontendModel;

    /**
     * экземпляр класса модели для работы со страницами сайта
     */
    protected $pageFrontendModel;

    /**
     * экземпляр класса модели для работы с картой сайта
     */
    protected $sitemapFrontendModel;


    public function __construct($params = null) {

        parent::__construct($params);

        // экземпляр класса модели для работы с главной страницей сайта
        $this->indexFrontendModel =
            isset($this->register->indexFrontendModel) ? $this->register->indexFrontendModel : new Index_Frontend_Model();

        // экземпляр класса модели для работы с главным меню
        $this->menuFrontendModel =
            isset($this->register->menuFrontendModel) ? $this->register->menuFrontendModel : new Menu_Frontend_Model();

        // экземпляр класса модели для работы со страницами сайта
        $this->pageFrontendModel =
            isset($this->register->pageFrontendModel) ? $this->register->pageFrontendModel : new Page_Frontend_Model();

        // экземпляр класса модели для работы с картой сайта
        $this->sitemapFrontendModel =
            isset($this->register->sitemapFrontendModel) ? $this->register->sitemapFrontendModel : new Sitemap_Frontend_Model();

    }

    /**
     * Функция получает из настроек и от моделей данные, необходимые для
     * работы всех потомков класса Frontend_Controller
     */
    protected function input() {

        /*
         * сначала обращаемся к родительскому классу Base_Controller, чтобы
         * установить значения переменных, которые нужны для работы всех его
         * потомков, потом переопределяем эти переменные (если необходимо) и
         * устанавливаем значения перменных, которые нужны для работы всех
         * потомков Frontend_Controller
         */
        parent::input();

        // получаем из настроек значения по умолчанию для мета-тегов
        $this->title       = $this->config->meta->default->title;
        $this->keywords    = $this->config->meta->default->keywords;
        $this->description = $this->config->meta->default->description;

        /*
         * массив переменных, которые будут переданы в шаблон head.php
         */
        // этот массив еще будет дополнен элементами, см. комментарий
        // в методе Frontend_Controller::output()
        $this->headVars = array(
            'cssFiles'    => $this->cssFiles,
            'jsFiles'     => $this->jsFiles,
        );

        /*
         * массив переменных, которые будут переданы в шаблон header.php
         */
        $this->headerVars = array(
            // URL ссылки на главную страницу сайта
            'indexUrl'     => $this->indexFrontendModel->getURL('frontend/index/index'),
        );

        /*
         * массив переменных, которые будут переданы в шаблон menu.php
         */
        $this->menuVars = array(
            // главное меню сайта
            'menu' => $this->menuFrontendModel->getMenu()
        );


        /*
         * массив переменных, которые будут переданы в шаблон left.php
         */
        $this->leftVars = array();

        /*
         * массив переменных, которые будут переданы в шаблон right.php
         */
        $this->rightVars = array();

        /*
         * массив переменных, которые будут переданы в шаблон footer.php
         */
        $this->footerVars = array(
            'siteMapUrl' => $this->sitemapFrontendModel->getURL('frontend/sitemap/index')
        );

    }

    /**
     * Функция формирует html-код отдельных частей страницы:
     * шапка, главное меню, центральная колонка, левая и правая
     * колонки, подвал и т.п.
     */
    protected function output() {

        // переменные $this->title, $this->keywords, $this->description и $this->robots,
        // которые будут переданы в шаблон head.php, могут быть изменены в методе input()
        // дочерних классов, поэтому помещаем их в массив $this->headVars только здесь,
        // а не в методе Frontend_Controller::input()
        $this->headVars['title']        = $this->title;
        $this->headVars['keywords']     = $this->keywords;
        $this->headVars['description']  = $this->description;
        $this->headVars['robots']       = $this->robots;
        $this->headVars['canonicalURL'] = $this->canonicalURL;

        /*
         * получаем html-код тега <head>
         */
        $this->headContent = $this->render(
            $this->headTemplateFile,
            $this->headVars
        );

        /*
         * получаем html-код шапки сайта
         */
        $this->headerContent = $this->render(
            $this->headerTemplateFile,
            $this->headerVars
        );

        /*
         * получаем html-код меню
         */
        $this->menuContent = $this->render(
            $this->menuTemplateFile,
            $this->menuVars
        );

        /*
         * получаем html-код центральной колонки
         */
        $this->centerContent = $this->render(
            $this->centerTemplateFile,
            $this->centerVars
        );

        /*
         * получаем html-код левой колонки
         */
        $this->leftContent = $this->render(
            $this->leftTemplateFile,
            $this->leftVars
        );

        /*
         * получаем html-код правой колонки
         */
        $this->rightContent = $this->render(
            $this->rightTemplateFile,
            $this->rightVars
        );

        /*
         * получаем html-код подвала страницы
         */
        $this->footerContent = $this->render(
            $this->footerTemplateFile,
            $this->footerVars
        );

        /*
         * html-код отдельных частей страницы получен, теперь формируем
         * всю страницу целиком
         */
        $this->pageContent = $this->render(
            $this->wrapperTemplateFile,
            array(
                'headContent'   => $this->headContent,
                'headerContent' => $this->headerContent,
                'menuContent'   => $this->menuContent,
                'centerContent' => $this->centerContent,
                'leftContent'   => $this->leftContent,
                'rightContent'  => $this->rightContent,
                'footerContent' => $this->footerContent
            )
        );

    }

}