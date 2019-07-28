<?php
/**
 * Правая колонка, файл view/example/frontend/template/right.php,
 * общедоступная часть сайта
 *
 * Переменные, доступные в шаблоне:
 * blogCategories - массив категорий блога
 * articleCategories - массив категорий статей
 */

defined('ZCMS') or die('Access denied');
?>

<!-- Начало шаблона view/example/frontend/template/right.php -->

<?php if (!empty($blogCategories)): ?>
<div>
    <div>Категории блога</div>
    <div>
        <ul>
        <?php foreach($blogCategories as $item): ?>
            <li>
                <a href="<?php echo $item['url'] ?>"><?php echo $item['name']; ?></a>
                <?php if (isset($item['childs'])): ?>
                    <ul>
                    <?php foreach($item['childs'] as $value): ?>
                        <li><a href="<?php echo $value['url'] ?>"><?php echo $value['name']; ?></a></li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php endif; ?>

<?php if (!empty($popularPosts)): ?>
<div>
    <div>Популярные записи</div>
    <div>
        <ul class="side-popular">
        <?php foreach($popularPosts as $item): ?>
            <li>
                <a href="<?php echo $item['url'] ?>"><?php echo $item['name']; ?></a>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php endif; ?>

<?php if (!empty($blogTags)): ?>
<div>
    <div>Облако тегов</div>
    <div>
        <ul class="side-tags">
        <?php foreach($blogTags as $item): ?>
            <li>
                <a href="<?php echo $item['url'] ?>" title="<?php echo htmlspecialchars($item['name']); ?>"><?php echo $item['short']; ?></a>&nbsp;(<?php echo $item['count']; ?>)
            </li>
        <?php endforeach; ?>
        </ul>
        <a href="<?php echo $allTagsURL; ?>" class="all-tags">Все теги</a>
    </div>
</div>
<?php endif; ?>

<?php if (!empty($articleCategories)): ?>
<div>
    <div>Категории статей</div>
    <div>
        <ul>
        <?php foreach($articleCategories as $item): ?>
            <li>
                <a href="<?php echo $item['url'] ?>"><?php echo $item['name']; ?></a>
                <?php if (isset($item['childs'])): ?>
                    <ul>
                    <?php foreach($item['childs'] as $value): ?>
                        <li><a href="<?php echo $value['url'] ?>"><?php echo $value['name']; ?></a></li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php endif; ?>

<!-- Конец шаблона view/example/frontend/template/right.php -->
