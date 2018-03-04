<?php
/**
 * Список всех тегов блога,
 * файл view/example/backend/template/tag/index/center.php,
 * административная часть сайта
 *
 * Переменные, которые приходят в шаблон:
 * $breadcrumbs - хлебные крошки
 * $addTagURL - URL ссылки на страницу с формой добавления нового тега
 * $tags - массив всех тегов блога
 */

defined('ZCMS') or die('Access denied');
?>

<!-- Начало шаблона view/example/backend/template/tag/index/center.php -->

<?php if (!empty($breadcrumbs)): // хлебные крошки ?>
    <div id="breadcrumbs">
        <?php foreach ($breadcrumbs as $item): ?>
            <a href="<?php echo $item['url']; ?>"><?php echo $item['name']; ?></a>&nbsp;&gt;
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<h1>Страницы</h1>

<p><a href="<?php echo $addTagURL; ?>">Добавить новый тег</a></p>

<?php if (!empty($tags)): ?>
    <div id="all-tags">
        <ul>
        <?php foreach($tags as $item): ?>
            <li>
                <div>
                    <div><?php echo $item['name']; ?></div>
                    <div>
                        <a href="<?php echo $item['url']['edit']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a>
                        <a href="<?php echo $item['url']['remove']; ?>" title="Удалить"><i class="fa fa-trash-o"></i></a>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- Конец шаблона view/example/backend/template/tag/index/center.php -->
