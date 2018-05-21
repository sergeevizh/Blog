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

<div>
    <div>Категории блога</div>
    <div>
    <?php if (!empty($blogCategories)): ?>
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
    <?php endif; ?>
    </div>
</div>

<div>
    <div>Облако тегов</div>
    <div>
    <?php if (!empty($blogTags)): ?>
        <ul class="tags">
        <?php foreach($blogTags as $item): ?>
            <li>
                <a href="<?php echo $item['url'] ?>"><?php echo $item['name']; ?></a>&nbsp;(<?php echo $item['count']; ?>)
            </li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    </div>
</div>

<div>
    <div>Категории статей</div>
    <div>
    <?php if (!empty($articleCategories)): ?>
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
    <?php endif; ?>
    </div>
</div>
<!--
<div>
    <div>Вы уже смотрели</div>
    <div>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
    </div>
</div>
-->
<!-- Конец шаблона view/example/frontend/template/right.php -->
