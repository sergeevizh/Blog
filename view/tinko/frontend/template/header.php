<?php
/**
 * Шапка сайта, файл view/example/frontend/template/header.php,
 * общедоступная часть сайта
 *
 * Переменные, доступные в шаблоне:
 * $indexURL - URL ссылки на главную страницу сайта
 * $action - атрибут action формы поиска
 */

defined('ZCMS') or die('Access denied');
?>

<!-- Начало шаблона view/example/frontend/template/header.php -->

<div>
    <span>Узелки</span>
    <span>на память</span>
</div>
<div>
    <form action="<?= $action; ?>" method="POST">
        <input type="text" name="query" value="" maxlength="64" placeholder="Поиск по блогу" />
        <input type="submit" name="submit" value="" />
    </form>
</div>

<!-- Конец шаблона view/example/frontend/template/header.php -->
