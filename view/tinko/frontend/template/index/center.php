<?php
/**
 * Главная страница сайта, файл view/example/frontend/template/index/center.php,
 * общедоступная часть сайта
 *
 * Переменные, которые приходят в шаблон:
 * $name - заголовок h1
 * $posts - массив последних постов блога
 * $articles - массив последних опубликованных статей
 */

defined('ZCMS') or die('Access denied');
?>

<!-- Начало шаблона view/example/frontend/template/index/center.php -->

<h1><?php echo $name; ?></h1>

<?php if (!empty($posts)): ?>
    <h2>Последние записи</h2>
    <div class="news-list" id="company-news">
    <?php foreach($posts as $item): ?>
        <div>
            <div>
                <a href="<?php echo $item['url']['item']; ?>">
                    <img src="<?php echo $item['url']['image']; ?>" alt="" />
                </a>
            </div>
            <div>
                <div class="news-date">
                    <?php echo $item['date']; ?>
                </div>
                <div class="news-heading">
                    <h3>
                        <a href="<?php echo $item['url']['item']; ?>"><?php echo $item['name']; ?></a>
                    </h3>
                </div>
                <div class="news-excerpt">
                    <?php echo $item['excerpt']; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (!empty($articles)): ?>
    <h2>Последние статьи</h2>
    <div class="news-list" id="general-news">
    <?php foreach($articles as $item): ?>
        <div>
            <div>
                <a href="<?php echo $item['url']['item']; ?>">
                    <img src="<?php echo $item['url']['image']; ?>" alt="" />
                </a>
            </div>
            <div>
                <div class="news-date">
                    <?php echo $item['date']; ?>
                </div>
                <div class="news-heading">
                    <h3>
                        <a href="<?php echo $item['url']['item']; ?>"><?php echo $item['name']; ?></a>
                    </h3>
                </div>
                <div class="news-excerpt">
                    <?php echo $item['excerpt']; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
<?php endif; ?>

<!-- Конец шаблона view/example/frontend/template/index/center.php -->



