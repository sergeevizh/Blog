<?php
defined('ZCMS') or die('Access denied');

// см. файл app/config/config.php
$pager = array(                // постраничная навигация
    'frontend' => array(       // общедоступная часть сайта
        'article'   => array(
            'perpage'   => 6,  // статей на страницу
            'leftright' => 2,  // кол-во ссылок слева и справа
        ),
        'blog'      => array(
            'perpage'   => 10, // постов на страницу
            'leftright' => 2,  // кол-во ссылок слева и справа
        ),
    ),
    'backend' => array(        // административная часть сайта
        'article'  => array(
            'perpage'   => 20, // статей на страницу
            'leftright' => 2,  // кол-во ссылок слева и справа
        ),
        'blog'     => array(
            'perpage'   => 20, // постов на страницу
            'leftright' => 2,  // кол-во ссылок слева и справа
        ),
    )
);