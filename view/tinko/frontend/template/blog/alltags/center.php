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
    <form action="<?php echo $action; ?>" method="post" id="all-tags">
        <ul>
        <?php foreach($tags as $item): ?>
            <li>
                <input type="checkbox" name="tags[]" value="<?php echo $item['id']; ?>" />
                <a href="<?php echo $item['url']; ?>" title="<?php echo htmlspecialchars($item['name']); ?>"><?php echo $item['short']; ?></a>
                <span>(<?php echo $item['count']; ?>)</span>
            </li>
        <?php endforeach; ?>
        </ul>
        <input type="submit" name="submit" value="Показать отмеченные" />
    </form>
<?php endif; ?>

<!-- Конец шаблона view/example/backend/template/blog/alltags/center.php -->
