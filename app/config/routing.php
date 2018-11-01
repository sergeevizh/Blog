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
        // список постов блога для выбранных тегов
        '~^frontend/blog/tags/ids/(\d+(?:-\d+)*)$~i' =>
        'blog/tags/$1',
        // список постов блога для выбранных тегов, постраничная навигация
        '~^frontend/blog/tags/ids/(\d+(?:-\d+)*)/page/(\d+)$~i' =>
        'blog/tags/$1/page/$2',
        // список всех тегов блога
        '~^frontend/blog/alltags$~i' =>
        'blog/alltags',
        // страница поиска по блогу
        '~^frontend/blog/search$~i'=>
        'blog/search',
        // страница результатов поиска по блогу
        '~^frontend/blog/search/query/([a-z0-9%_.-]+)$~i' =>
        'blog/search/query/$1',
        // страница результатов поиска по блогу, постраничная навигация
        '~^frontend/blog/search/query/([a-z0-9%_.-]+)/page/(\d+)$~i' =>
        'blog/search/query/$1/page/$2',
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
         * обратная связь
         */
        '~^frontend/feedback/index$~i' =>
        'feedback',
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
        // список постов блога для выбранных тегов
        '~^blog/tags/(\d+(?:-\d+)*)$~i' =>
        'frontend/blog/tags/ids/$1',
        // список постов блога для выбранных тегов, постраничная навигация
        '~^blog/tags/(\d+(?:-\d+)*)/page/(\d+)$$~i' =>
        'frontend/blog/tags/ids/$1/page/$2',
        // список всег тегов блога
        '~^blog/alltags$~i' =>
        'frontend/blog/alltags',
        // страница поиска по блогу
        '~^blog/search$~i' =>
        'frontend/blog/search',
        // страница результатов поиска по блогу
        '~^blog/search/query/([a-z0-9%_.-]+)$~i' =>
        'frontend/blog/search/query/$1',
        // страница результатов поиска по блогу, постраничная навигация
        '~^blog/search/query/([a-z0-9%_.-]+)/page/(\d+)$~i' =>
        'frontend/blog/search/query/$1/page/$2',
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
         * обратная связь
         */
        '~^feedback$~i' =>
        'frontend/feedback/index',
        /*
         * карта сайта
         */
        '~^sitemap$~i' =>
        'frontend/sitemap/index',
    )
);