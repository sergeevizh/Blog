<?php
defined('ZCMS') or die('Access denied');

/*
 * JS файлы, подключаемые к странице;
 * см. файл app/config/config.php
 */
$js = array(
    'frontend' => array(                         // общедоступная часть сайта
        'base'            => array(              // js-файлы, подключаемые ко всем страницам
            'jquery-2.1.1.min.js',
            'jquery.cookie.js',
            'jquery.form.min.js',
            'center.js',
            'common.js',
        ),
        'index'           => array(              // главная страница сайта
            'index.js',
            'tabs.js',
        ),
        'blog'            => array(              // блог
            'fancybox/jquery.mousewheel-3.0.6.pack.js',
            'fancybox/jquery.fancybox.pack.js',
            'lightbox.js',
        ),
        'wished'          => 'wished.js',        // избранное (отложенные товары)
        'page-40'         => array(              // для страницы «Контакты»
            'tabs.js',
            'fancybox/jquery.mousewheel-3.0.6.pack.js',
            'fancybox/jquery.fancybox.pack.js',
            'lightbox.js'
        ),
        'page-39'         => array(              // для страницы «О компании»
            'fancybox/jquery.mousewheel-3.0.6.pack.js',
            'fancybox/jquery.fancybox.pack.js',
            'lightbox.js',
        ),
        'page-41'         => array(              // для страницы «Доставка»
            'tabs.js',
            'http://api-maps.yandex.ru/2.0-stable/?load=package.full&lang=ru-RU',
            'page/offices-map-route.js',
            'page/delivery-map.js',
        ),
        'page-51'         => array(              // для страницы «Партнеры»
            'fancybox/jquery.mousewheel-3.0.6.pack.js',
            'fancybox/jquery.fancybox.pack.js',
            'lightbox.js',
        ),
        'page-52'         => array(              // для страницы «Библиотека»
            'page/library.js',
        ),
        'page-55'         => array(              // для страницы «Новый сайт»
            'fancybox/jquery.mousewheel-3.0.6.pack.js',
            'fancybox/jquery.fancybox.pack.js',
            'lightbox.js',
        ),
        /*
         * ПРИМЕР ПОДКЛЮЧЕНИЯ ФАЙЛОВ, НЕ УДАЛЯТЬ!
         * 'base' => array(                // js-файлы, подключаемые ко всем страницам сайта
         *     'jquery.min.js',
         *     'common.js',
         * ),
         * 'index' => 'jquery.slider.js',  // только для главной страницы сайта, формируемой Index_Index_Frontend_Controller
         * 'page' => 'page.js',            // для страниц, которые формирует Index_Page_Frontend_Controller
         * 'catalog' => 'catalog.js',      // для страниц, которые формируют все дочерние классы Catalog_Frontend_Controller
         * 'catalog-product' => array(     // только для страниц, которые формирует Product_Catalog_Frontend_Controller
         *     'product.js',
         *     'jquery.lightbox.js',
         * ),
         */
    ),
    'backend' => array(                          // административная часть сайта
        'base'      => array(
            'jquery-2.1.1.min.js',
            'common.js',
        ),
        'article'   => array(
            'insert-at-caret.js',
            'article.js',
        ),
        'blog'      => array(
            'insert-at-caret.js',
            'blog.js',
        ),
        'menu'      => 'menu.js',
        'page'      => array(
            'insert-at-caret.js',
            'page.js',
        ),
    ),
);