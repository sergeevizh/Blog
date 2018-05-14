<?php
/**
 * Форма для редактирования поста блога,
 * файл view/example/backend/template/blog/editpost/center.php,
 * административная часть сайта
 *
 * Переменные, которые приходят в шаблон:
 * $breadcrumbs - хлебные крошки
 * $action - содержимое атрибута action тега form
 * $id - уникальный идентификатор поста
 * $name - заголовок поста
 * $categories - массив всех категорий
 * $category - id категории
 * $keywords - содержимое мета-тега keywords
 * $description - содержимое мета-тега description
 * $excerpt - анонс поста
 * $body - текст поста блога
 * allTags - массив всех тегов
 * $tags - массив постов блога
 * $date - дата публикации
 * $time - время публикации
 * $savedFormData - сохраненные данные формы. Если при заполнении формы были
 * допущены ошибки, мы должны снова предъявить форму, заполненную уже
 * отредактированными данными и вывести сообщение об ошибках.
 * $errorMessage - массив сообщений об ошибках, допущенных при заполнении формы
 */

defined('ZCMS') or die('Access denied');
?>

<!-- Начало шаблона view/example/backend/template/blog/editpost/center.php -->

<?php if (!empty($breadcrumbs)): // хлебные крошки ?>
    <div id="breadcrumbs">
        <?php foreach ($breadcrumbs as $item): ?>
            <a href="<?php echo $item['url']; ?>"><?php echo $item['name']; ?></a>&nbsp;&gt;
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<h1>Редактирование записи</h1>

<?php if (!empty($errorMessage)): ?>
    <ul>
    <?php foreach ($errorMessage as $message): ?>
        <li><?php echo $message; ?></li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php
    $name        = htmlspecialchars($name);
    $keywords    = htmlspecialchars($keywords);
    $description = htmlspecialchars($description);
    $excerpt     = htmlspecialchars($excerpt);
    $body        = htmlspecialchars($body);
    $date        = htmlspecialchars($date);
    $time        = htmlspecialchars($time);

    if (isset($savedFormData)) {
        $name        = htmlspecialchars($savedFormData['name']);
        $category    = $savedFormData['category'];
        $keywords    = htmlspecialchars($savedFormData['keywords']);
        $description = htmlspecialchars($savedFormData['description']);
        $excerpt     = htmlspecialchars($savedFormData['excerpt']);
        $body        = htmlspecialchars($savedFormData['body']);
        $tags        = $savedFormData['tags'];
        $date        = htmlspecialchars($savedFormData['date']);
        $time        = htmlspecialchars($savedFormData['time']);
        $visible     = $savedFormData['visible'];
    }
?>

<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="add-edit-post">
    <div>
        <div>Заголовок</div>
        <div><input type="text" name="name" maxlength="250" value="<?php echo $name; ?>" /></div>
    </div>
    <div>
        <div>Категория</div>
        <div>
            <select name="category">
            <option value="0">Выберите</option>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $item): ?>
                    <option value="<?php echo $item['id']; ?>"<?php if ($item['id'] == $category) echo 'selected="selected"'; ?>>
                        <?php echo $item['name']; ?>
                    </option>
                    <?php if (isset($item['childs'])): ?>
                        <?php foreach($item['childs'] as $child): ?>
                            <option value="<?php echo $child['id']; ?>"<?php if ($child['id'] == $category) echo 'selected="selected"'; ?>>
                                &nbsp;&nbsp;&nbsp;<?php echo $child['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            </select>
        </div>
    </div>
    <div>
        <div>Ключевые слова (meta)</div>
        <div><input type="text" name="keywords" maxlength="250" value="<?php echo $keywords; ?>" /></div>
    </div>
    <div>
        <div>Описание (meta)</div>
        <div><input type="text" name="description" maxlength="250" value="<?php echo $description; ?>" /></div>
    </div>
    <div>
        <div>Изображение</div>
        <div>
            <input type="file" name="image" />
            <?php if (is_file('files/blog/thumb/' . $id . '.jpg')): ?>
                <input type="checkbox" name="remove_image" value="1" /> удалить
                <a href="/files/blog/thumb/<?php echo $id; ?>.jpg" class="zoom">изображение</a>
            <?php endif; ?>
        </div>
    </div>
    <div>
        <div>Анонс</div>
        <div><textarea name="excerpt"><?php echo $excerpt; ?></textarea></div>
    </div>
    <div>
        <div>Текст (содержание)</div>
        <div><textarea name="body"><?php echo $body; ?></textarea></div>
    </div>
    <div>
        <div>Теги</div>
        <div>
        <?php if (!empty($allTags)): ?>
            <ul>
            <?php foreach ($allTags as $item): ?>
                <li>
                    <input type="checkbox" name="tags[]" value="<?php echo $item['id']; ?>" <?php echo in_array($item['id'], $tags) ? 'checked="checked"' : ''; ?> />
                    <span title="<?php echo htmlspecialchars($item['name']); ?>"><?php echo htmlspecialchars($item['short']); ?></span>
                </li>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        </div>
    </div>
    <div>
        <div>Дата и время</div>
        <div>
            <input type="text" name="date" value="<?php echo $date; ?>" />
            <input type="text" name="time" value="<?php echo $time; ?>" />
            <label>
                <input type="checkbox" name="visible" value="1" <?php echo $visible ? 'checked="checked"' : ''; ?> />
                <span>доступность</span>
            </label>
        </div>
    </div>
    <div id="new-files">
        <div>Загрузить файл(ы)</div>
        <div>
            <div>
                <input type="file" name="files[]" />
                <span>Добавить</span>
                <span>Удалить</span>
            </div>
        </div>
    </div>
    <?php if (!empty($files)): ?>
        <div id="old-files">
            <div>Уже загружены</div>
            <div>
                <?php foreach ($files as $file): ?>
                    <div>
                        <a href="/files/blog/<?php echo $id . '/' . $file; ?>" target="_blank"><?php echo $file; ?></a>
                        <span>вставить</span>
                        <input type="checkbox" name="remove_files[]" value="<?php echo $file; ?>" /> удалить
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
    <div>
        <div></div>
        <div><input type="submit" name="submit" value="Сохранить" /></div>
    </div>
</form>

<!-- Конец шаблона view/example/backend/template/blog/editpost/center.php -->
