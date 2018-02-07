<?php
/**
 * Абстрактный класс Backend_Controller, родительский для всех контроллеров
 * административной части сайта
 */
abstract class Backend_Controller extends Base_Controller {

    /**
     * администратор сайта авторизован?
     */
    protected $authAdmin = false;

    /**
     * экземпляр класса модели для работы с администратором сайта
     */
    protected $adminBackendModel;

    /**
     * экземпляр класса модели для работы со статьями
     */
    protected $articleBackendModel;

    /**
     * экземпляр класса модели для работы с блогом
     */
    protected $blogBackendModel;

    /**
     * экземпляр класса модели для работы с главной страницей
     * административной части сайта
     */
    protected $indexBackendModel;

    /**
     * экземпляр класса модели для работы с главным меню
     * общедоступной части сайта
     */
    protected $menuBackendModel;

    /**
     * экземпляр класса модели для работы со страницами
     */
    protected $pageBackendModel;

    /**
     * экземпляр класса модели для работы с картой сайта
     */
    protected $sitemapBackendModel;


    public function __construct($params = null) {

        parent::__construct($params);

        // экземпляр класса модели для работы с администратором сайта
        $this->adminBackendModel =
            isset($this->register->adminBackendModel) ? $this->register->adminBackendModel : new Admin_Backend_Model();

        // экземпляр класса модели для работы со статьями
        $this->articleBackendModel =
            isset($this->register->articleBackendModel) ? $this->register->articleBackendModel : new Article_Backend_Model();

        // экземпляр класса модели для работы с блогом
        $this->blogBackendModel =
            isset($this->register->blogBackendModel) ? $this->register->blogBackendModel : new Blog_Backend_Model();

        // экземпляр класса модели для работы с главной страницей админки
        $this->indexBackendModel =
            isset($this->register->indexBackendModel) ? $this->register->indexBackendModel : new Index_Backend_Model();

        // экземпляр класса модели для работы с главным меню общедоступной части сайта
        $this->menuBackendModel =
            isset($this->register->menuBackendModel) ? $this->register->menuBackendModel : new Menu_Backend_Model();

        // экземпляр класса модели для работы со страницами
        $this->pageBackendModel =
            isset($this->register->pageBackendModel) ? $this->register->pageBackendModel : new Page_Backend_Model();

        // экземпляр класса модели для работы с картой сайта
        $this->sitemapBackendModel =
            isset($this->register->sitemapBackendModel) ? $this->register->sitemapBackendModel : new Sitemap_Backend_Model();

        // администратор сайта авторизован?
        $this->authAdmin = $this->adminBackendModel->isAuthAdmin();

        // если администратор не авторизован, перенаправляем на страницу авторизации
        if ( ! $this->authAdmin) {
            $this->redirect($this->adminBackendModel->getURL('backend/admin/login'));
        }

    }

    /**
     * Функция получает из настроек и от моделей данные, необходимые для
     * работы всех потомков класса Backend_Controller
     */
    protected function input() {

        /*
         * сначала обращаемся к родительскому классу Base_Controller, чтобы
         * установить значения переменных, которые нужны для работы всех его
         * потомков, потом переопределяем эти переменные (если необходимо) и
         * устанавливаем значения перменных, которые нужны для работы всех
         * потомков Backend_Controller
         */
        parent::input();

        /*
         * устанавливаем значения по умолчанию для всех переменных, необходимых
         * для формирования страниц административной части сайта, потом
         * переопределяем их значения в дочерних классах, если необходимо
         */
        $this->title = 'Панель управления';

        /*
         * переменные, которые будет переданы в шаблон главного меню, файл
         * menu.php, административная часть сайта
         */
        $this->menuVars = array(
            array(
                'name' => 'Главная',
                'url'  => $this->indexBackendModel->getURL('backend/index/index')
            ),
            array(
                'name' => 'Блог',
                'url'  => $this->blogBackendModel->getURL('backend/blog/index')
            ),
            array(
                'name' => 'Теги',
                'url'  => $this->tagBackendModel->getURL('backend/tag/index')
            ),
            array(
                'name' => 'Статьи',
                'url'  => $this->articleBackendModel->getURL('backend/article/index')
            ),
            array(
                'name' => 'Страницы',
                'url'  => $this->pageBackendModel->getURL('backend/page/index')
            ),
            array(
                'name' => 'Меню',
                'url'  => $this->menuBackendModel->getURL('backend/menu/index')
            ),
            array(
                'name' => 'Карта',
                'url'  => $this->sitemapBackendModel->getURL('backend/sitemap/index')
            ),
        );

        $this->headerVars = array(
            'logoutUrl' => $this->adminBackendModel->getURL('backend/admin/logout'),
        );

    }

    /**
     * Функция формирует html-код отдельных частей страницы (меню,
     * основной контент, левая и правая колонка, подвал сайта и т.п.)
     */
    protected function output() {

        // получаем html-код тега <head>
        $this->headContent = $this->render(
            $this->headTemplateFile,
            array(
                'title'    => $this->title,
                'cssFiles' => $this->cssFiles,
                'jsFiles'  => $this->jsFiles,
            )
        );

        // получаем html-код шапки сайта
        $this->headerContent = $this->render(
            $this->headerTemplateFile,
            $this->headerVars
        );

        // получаем html-код главного меню
        $this->menuContent = $this->render(
            $this->menuTemplateFile,
            array('menu' => $this->menuVars)
        );

        // получаем html-код центральной колонки (основной контент)
        $this->centerContent = $this->render(
            $this->centerTemplateFile,
            $this->centerVars
        );

        // получаем html-код подвала страницы
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