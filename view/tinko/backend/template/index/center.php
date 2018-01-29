<?php
/**
 * Главная старница административной части сайта
 * файл view/example/backend/template/admin/index/center.php
 *
 * Переменные, которые приходят в шаблон:
 * $lastPosts - массив последних заказов в магазине
 * $lastArticles - массив последних новостей
 */

defined('ZCMS') or die('Access denied');
?>

<!-- view/example/backend/template/admin/index/center.php -->

<h1>Панель управления</h1>

<h2>Последние записи</h2>
<div id="all-blog-posts">
    <ul>
        <?php foreach($lastPosts as $item) : ?>
            <li>
                <div><?php echo $item['name']; ?></div>
                <div>
                    <a href="<?php echo $item['url']['edit']; ?>" title="Редактировать">Ред.</a>
                    <a href="<?php echo $item['url']['remove']; ?>" title="Удалить">Удл.</a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<h2>Последние статьи</h2>
<div id="all-blog-posts">
    <ul>
        <?php foreach($lastArticles as $item) : ?>
            <li>
                <div><?php echo $item['name']; ?></div>
                <div>
                    <a href="<?php echo $item['url']['edit']; ?>" title="Редактировать">Ред.</a>
                    <a href="<?php echo $item['url']['remove']; ?>" title="Удалить">Удл.</a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
