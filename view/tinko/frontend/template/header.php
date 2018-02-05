<?php
/**
 * Шапка сайта, файл view/example/frontend/template/header.php,
 * общедоступная часть сайта
 *
 * Переменные, доступные в шаблоне:
 * $indexURL - URL ссылки на главную страницу сайта
 */

defined('ZCMS') or die('Access denied');
?>

<!-- Начало шаблона view/example/frontend/template/header.php -->

<div id="top-logo">
    <a href="<?php echo $indexURL; ?>"></a>
    <div>
        <span>Торговый Дом</span>
        <strong><span>Т</span>ИНКО</strong>
    </div>
</div>

<!-- Конец шаблона view/example/frontend/template/header.php -->
