<?php
defined('ZCMS') or die('Access denied');

/*
 * CSS файлы, подключаемые к странице;
 * см. файл app/config/config.php
 */
$css = array(
    'frontend'            => array(          // общедоступная часть сайта
        'base'            => array(          // CSS-файлы, подключаемые ко всем страницам
            'reset.css',
            'common.css',
            'awesome/font-awesome.min.css',
        ),
        'index'           => array(          // главная страница сайта
            'index.css',
            'tabs.css',
        ),
        'article'         => 'article.css',  // статьи
        'blog'            => array(          // блог
            'blog.css',
            'fancybox/jquery.fancybox.css',
        ),
        'sitemap'         => 'sitemap.css',   // карта сайта
        'page'         => array(              // для страниц
            'tabs.css',
            'page/contacts.css',
            'fancybox/jquery.fancybox.css',
        ),
        /*
         * ПРИМЕР ПОДКЛЮЧЕНИЯ ФАЙЛОВ, НЕ УДАЛЯТЬ!
         * 'base' => array(                // css-файлы, подключаемые ко всем страницам сайта
         *     'reset.css',
         *     'common.css',
         * ),
         * 'index' => 'jquery.slider.css', // только для главной страницы, формируемой Index_Index_Frontend_Controller
         * 'page' => 'page.css',           // для страниц, которые формирует Index_Page_Frontend_Controller
         * 'catalog' => 'catalog.css',     // для страниц, которые все формируют дочерние классы Catalog_Frontend_Controller
         * 'catalog-product' => array(     // только для страниц, которые формирует Product_Catalog_Frontend_Controller
         *     'product.css',
         *     'jquery.lightbox.css',
         * ),
         *
         * Здесь важно понимать, что у некоторых абстактных классов есть только один дочерний класс,
         * например: Page_Frontend_Controller и Index_Page_Frontend_Controller. А у других абстрактных
         * классов есть несколько дочерних классов, например: Catalog_Frontend_Controller и
         * 1. Index_Catalog_Frontend_Controller
         * 2. Product_Catalog_Frontend_Controller
         * 3. Category_Catalog_Frontend_Controller
         * 4. Maker_Catalog_Frontend_Controller
         *
         * Запись вида
         * 'catalog' => 'catalog.css', // для всех страниц каталога
         * 'catalog-index' => 'catalog-index.css' // только для главной страницы каталога
         * имеет смысл, а запись вида
         * 'page' => 'page.css'
         * 'page-index' => 'lightbox.css'
         * не будет ошибочной, но сбивает с толку, поэтому лучше так:
         * 'page' => array(
         *     'page.css',
         *     'lightbox.css'
         * )
         */
    ),
    'backend' => array(                      // административная часть сайта
        'base'      => array(
            'reset.css',
            'common.css',
            'awesome/font-awesome.min.css',
        ),
        'index'     => array(
            'blog.css',
        ),
        'admin'     => 'admin.css',
        'article'   => 'article.css',
        'blog'      => array (
            'blog.css',
            'tabs.css',
        ),
        'tag'       => 'tag.css',
        'menu'      => 'menu.css',
        'page'      => 'page.css',
        'sitemap'   => 'sitemap.css',
        'start'     => 'start.css',
    ),
);