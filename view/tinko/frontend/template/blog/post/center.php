<?php
/**
 * Страница отдельного поста блога,
 * файл view/example/frontend/template/blog/post/center.php,
 * общедоступная часть сайта
 *
 * Переменные, которые приходят в шаблон:
 * $breadcrumbs - хлебные крошки
 * name - заголовок поста блога
 * body - текст поста блога в формате html
 * date - дата публикации
 * categoryName - наименование категории
 * $categoryURL - URL страницы категории
 * $tags - теги поста
 */

defined('ZCMS') or die('Access denied');
?>

<!-- Начало шаблона view/example/frontend/template/blog/post/center.php -->

<?php if (!empty($breadcrumbs)): // хлебные крошки ?>
    <div id="breadcrumbs">
        <?php foreach ($breadcrumbs as $item): ?>
            <a href="<?php echo $item['url']; ?>"><?php echo $item['name']; ?></a>&nbsp;&gt;
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<h1><?php echo $name; ?></h1>

<div id="post-item">
    <div>
        <p><?php echo $date; ?></p>
        <?php if (!empty($tags)): ?>
            <p>
                Теги:
                <?php foreach ($tags as $i => $tag): ?>
                    <?php if ($i) echo '•'; ?>
                    <a href="<?php echo $tag['url']; ?>"><?php echo $tag['name']; ?></a>
                <?php endforeach; ?>
            </p>
        <?php endif; ?>
    </div>
    <?php echo $body; ?>
</div>

<!-- Конец шаблона view/example/frontend/template/blog/post/center.php -->
