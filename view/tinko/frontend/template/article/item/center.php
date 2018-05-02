<?php
/**
 * Страница отдельной статьи, общедоступная часть сайта,
 * файл view/example/frontend/template/article/item/center.php
 *
 * Переменные, которые приходят в шаблон:
 * $breadcrumbs - хлебные крошки
 * $name - заголовок статьи
 * $body - текст статьи
 * $date - дата публикации статьи
 * $categoryName - наименование категории статьи
 * $categoryURL - URL категории статьи
 * $root - есть или нет корневая категория статьи
 * $rootName - наименование корневой категории статьи
 * $rootURL - URL корневой категории статьи
 * $source - источник статьи
 */

defined('ZCMS') or die('Access denied');
?>

<!-- Начало шаблона view/example/frontend/template/article/item/center.php -->

<?php if (!empty($breadcrumbs)): // хлебные крошки ?>
    <div id="breadcrumbs">
        <?php foreach ($breadcrumbs as $item): ?>
            <a href="<?php echo $item['url']; ?>"><?php echo $item['name']; ?></a>&nbsp;&gt;
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<h1><?php echo $name; ?></h1>

<div id="article-item">
    <div>
        <p><?php echo $date; ?></p>
        <p>
            Категория:
            <?php if ($root): ?>
                <a href="<?php echo $rootURL; ?>"><?php echo $rootName; ?></a> •
            <?php endif; ?>
            <a href="<?php echo $categoryURL; ?>"><?php echo $categoryName; ?></a>
        </p>
    </div>
    <?php echo $body; ?>
    <?php if (!empty($source)): ?>
        <p><em><a href="<?php echo $source; ?>" target="_blank">Источник</a></em></p>
    <?php endif; ?>
</div>

<!-- Конец шаблона view/example/frontend/template/article/item/center.php -->
