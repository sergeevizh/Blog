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
                <a href="<?php echo $item['url']; ?>"><?php echo $item['name']; ?></a>
            </li>
        <?php endforeach; ?>
        </ul>
        <input type="submit" name="submit" value="Показать отмеченные" />
    </form>
<?php endif; ?>

<?php
if ( ! empty($pager)): /* постраничная навигация */ ?>
    <ul class="pager"> <!-- постраничная навигация -->
    <?php if (isset($pager['first'])): ?>
        <li>
            <a href="<?php echo $pager['first']['url']; /* первая страница */ ?>" class="first-page"></a>
        </li>
    <?php endif; ?>
    <?php if (isset($pager['prev'])): ?>
        <li>
            <a href="<?php echo $pager['prev']['url']; /* предыдущая страница */ ?>" class="prev-page"></a>
        </li>
    <?php endif; ?>
    <?php if (isset($pager['left'])): ?>
        <?php foreach ($pager['left'] as $left) : ?>
            <li>
                <a href="<?php echo $left['url']; ?>"><?php echo $left['num']; ?></a>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>

        <li>
            <span><?php echo $pager['current']['num']; /* текущая страница */ ?></span>
        </li>

    <?php if (isset($pager['right'])): ?>
        <?php foreach ($pager['right'] as $right) : ?>
            <li>
                <a href="<?php echo $right['url']; ?>"><?php echo $right['num']; ?></a>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if (isset($pager['next'])): ?>
        <li>
            <a href="<?php echo $pager['next']['url']; /* следующая страница */ ?>" class="next-page"></a>
        </li>
    <?php endif; ?>
    <?php if (isset($pager['last'])): ?>
        <li>
            <a href="<?php echo $pager['last']['url']; /* последняя страница */ ?>" class="last-page"></a>
        </li>
    <?php endif; ?>
    </ul>
<?php endif; ?>

<!-- Конец шаблона view/example/backend/template/blog/alltags/center.php -->
