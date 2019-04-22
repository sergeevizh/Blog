<?php
/**
 * Форма обратной связи, файл view/example/frontend/template/feedback/center.php,
 * общедоступная часть сайта
 *
 * Переменные, которые приходят в шаблон:
 * $breadcrumbs - хлебные крошки
 * $action - атрибут action тега form
 * $success - доступна только в том случае, если данные формы успешно отправлены
 */

defined('ZCMS') or die('Access denied');
?>

<!-- Начало шаблона view/example/frontend/template/feedback/center.php -->

<?php if (!empty($breadcrumbs)): // хлебные крошки ?>
    <div id="breadcrumbs">
        <?php foreach ($breadcrumbs as $item): ?>
            <a href="<?php echo $item['url']; ?>"><?php echo $item['name']; ?></a>&nbsp;&gt;
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<h1>Обратная связь</h1>

<?php if (isset($success)): ?>
    <p>Спасибо, Ваше сообщение успешно отправлено.</p>
    <?php return; ?>
<?php endif; ?>

<?php if (!empty($errorMessage)): ?>
    <div class="error-message">
        <ul>
        <?php foreach($errorMessage as $message): ?>
            <li><?= $message; ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php
    $name    = '';
    $email   = '';
    $message = '';

    if (isset($savedFormData)) {
        $name    = htmlspecialchars($savedFormData['name']);
        $email   = htmlspecialchars($savedFormData['email']);
        $message = htmlspecialchars($savedFormData['message']);
    }
?>

<form action="<?= $action; ?>" method="post" id="feedback">
    <div>
        <div>Имя</div>
        <div><input type="text" name="name" maxlength="50" value="<?= $name; ?>" /></div>
    </div>
    <div>
        <div>E-mail</div>
        <div><input type="text" name="email" maxlength="50" value="<?= $email; ?>" /></div>
    </div>
    <div>
        <div>Сообщение</div>
        <div><textarea name="message"><?= $message; ?></textarea></div>
    </div>
    <div>
        <div></div>
        <div><input type="submit" name="submit" value="Отправить" /></div>
    </div>
</form>

<!-- Конец шаблона view/example/frontend/template/feedback/center.php -->

