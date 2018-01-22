<?php
defined('ZCMS') or die('Access denied');

// см. файл app/config/config.php
$routing = array( // поддержка ЧПУ (SEF) для общедоступной части сайта
    'enable'  => true,
    'cap2sef' => array( // Controller/Action/Params => Search Engines Friendly
        /*
         * главная страница сайта
         */
        '~^frontend/index/index$~i' =>
        '',

        /*
         * блог
         */
        // главная страница блога
        '~^frontend/blog/index$~i' =>
        'blog',
        // главная страница блога, постраничная навигация
        '~^frontend/blog/index/page/(\d+)$~i' =>
        'blog/page/$1',
        // отдельный пост блога
        '~^frontend/blog/post/id/(\d+)$~i' =>
        'blog/item/$1',
        // список постов блога выбранной категории
        '~^frontend/blog/category/id/(\d+)$~i' =>
        'blog/category/$1',
        // список постов блога выбранной категории, постраничная навигация
        '~^frontend/blog/category/id/(\d+)/page/(\d+)$~i' =>
        'blog/category/$1/page/$2',

        /*
         * статьи
         */
        // список всех статей
        '~^frontend/article/index$~i' =>
        'articles',
        // список всех статей, постраничная навигация
        '~^frontend/article/index/page/(\d+)$~i' =>
        'articles/page/$1',
        // отдельная статья
        '~^frontend/article/item/id/(\d+)$~i' =>
        'articles/item/$1',
        // список статей выбранной категории
        '~^frontend/article/category/id/(\d+)$~i' =>
        'articles/category/$1',
        // список статей выбранной категории, постраничная навигация
        '~^frontend/article/category/id/(\d+)/page/(\d+)$~i' =>
        'articles/category/$1/page/$2',

        /*
         * карта сайта
         */
        '~^frontend/sitemap/index$~i' =>
        'sitemap',
    ),

    'sef2cap' => array( // Search Engines Friendly => Controller/Action/Params
        /*
         * главная страница сайта
         */
        '~^$~' =>
        'frontend/index/index',

        /*
         * блог
         */
        // главная страница блога
        '~^blog$~i' =>
        'frontend/blog/index',
        // главная страница блога, постраничная навигация
        '~^blog/page/(\d+)$~i' =>
        'frontend/blog/index/page/$1',
        // отдельный пост блога
        '~^blog/item/(\d+)$~i' =>
        'frontend/blog/post/id/$1',
        // список постов блога выбранной категории
        '~^blog/category/(\d+)$~i' =>
        'frontend/blog/category/id/$1',
        // список постов блога выбранной категории, постраничная навигация
        '~^blog/category/(\d+)/page/(\d+)$~i' =>
        'frontend/blog/category/id/$1/page/$2',

        /*
         * статьи
         */
        // список всех статей
        '~^articles$~i' =>
        'frontend/article/index',
        // список всех статей, постраничная навигация
        '~^articles/page/(\d+)$~i' =>
        'frontend/article/index/page/$1',
        // отдельная статья
        '~^articles/item/(\d+)$~i' =>
        'frontend/article/item/id/$1',
        // список статей выбранной категории
        '~^articles/category/(\d+)$~i' =>
        'frontend/article/category/id/$1',
        // список статей выбранной категории, постраничная навигация
        '~^articles/category/(\d+)/page/(\d+)$~i' =>
        'frontend/article/category/id/$1/page/$2',

        /*
         * карта сайта
         */
        '~^sitemap$~i' =>
        'frontend/sitemap/index',
    )
);