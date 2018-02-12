<?php
/**
 * Форма для редактирования тега блога,
 * файл view/example/backend/template/tag/edit/center.php,
 * административная часть сайта
 *
 * Переменные, которые приходят в шаблон:
 * $breadcrumbs - хлебные крошки
 * $action - содержимое атрибута action тега form
 * $id - уникальный идентификатор страницы
 * $name - заголовок страницы
 * $title - название страницы
 * $sefurl - ЧПУ (SEF) страницы
 * $pages - список всех страниц (для возможности выбора родителя)
 * $parent - id родительской страницы
 * $keywords - содержимое мета-тега keywords
 * $description - содержимое мета-тега description
 * $body - текст страницы в формате html
 * $savedFormData - сохраненные данные формы. Если при заполнении формы были допущены ошибки, мы должны
 * снова предъявить форму, заполненную уже отредактированными данными и вывести сообщение об ошибках.
 * $errorMessage - массив сообщений об ошибках, допущенных при заполнении формы
 */

defined('ZCMS') or die('Access denied');
?>

<!-- Начало шаблона view/example/backend/template/tag/edit/center.php -->

<?php if (!empty($breadcrumbs)): // хлебные крошки ?>
    <div id="breadcrumbs">
        <?php foreach ($breadcrumbs as $item): ?>
            <a href="<?php echo $item['url']; ?>"><?php echo $item['name']; ?></a>&nbsp;&gt;
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<h1>Редактирование тега блога</h1>

<?php if (!empty($errorMessage)): ?>
    <div class="error-message">
        <ul>
        <?php foreach($errorMessage as $message): ?>
            <li><?php echo $message; ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php
    $name = htmlspecialchars($name);

    if (isset($savedFormData)) {
        $name = htmlspecialchars($savedFormData['name']);
    }
?>

<form action="<?php echo $action; ?>" method="post" id="add-edit-tag">
    <div>
        <div>Название тега:</div>
        <div><input type="text" name="name" maxlength="100" value="<?php echo $name; ?>" /></div>
    </div>
    <div>
        <div></div>
        <div><input type="submit" name="submit" value="Сохранить" /></div>
    </div>
</form>

<!-- Конец шаблона view/example/backend/template/tag/edit/center.php -->
