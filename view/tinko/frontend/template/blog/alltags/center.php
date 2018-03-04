<?php
/**
 * Список всех тегов блога,
 * файл view/example/backend/template/tag/index/center.php,
 * общедоступная часть сайта
 *
 * Переменные, которые приходят в шаблон:
 * $breadcrumbs - хлебные крошки
 * $action - атрибут action тега form
 * $tags - массив всех тегов блога
 */

defined('ZCMS') or die('Access denied');
?>

<!-- Начало шаблона view/example/backend/template/blog/alltags/center.php -->

<?php if (!empty($breadcrumbs)): // хлебные крошки ?>
    <div id="breadcrumbs">
        <?php foreach ($breadcrumbs as $item): ?>
            <a href="<?php echo $item['url']; ?>"><?php echo $item['name']; ?></a>&nbsp;&gt;
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<h1>Все теги</h1>

<?php if (!empty($tags)): ?>
    <div id="all-tags">
        <ul>
        <?php foreach($tags as $item): ?>
            <li><?php echo $item['name']; ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- Конец шаблона view/example/backend/template/blog/alltags/center.php -->
