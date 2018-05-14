<?php
/**
 * Главная страница сайта, файл view/example/frontend/template/index/center.php,
 * общедоступная часть сайта
 *
 * Переменные, которые приходят в шаблон:
 * $name - заголовок h1
 * $posts - массив последних постов блога
 * $articles - массив последних опубликованных статей
 *
 * $posts = Array (
 *   [0] => Array (
 *     [id] => 7
 *     [name] => Снижение цен на IP и HDcctv оборудование EverFocus
 *     [excerpt] => Уважаемые покупатели! C 26 ноября вы сможете приобрести IP и HDcctv оборудование EverFocus...
 *     [date] => 29.11.2014
 *     [time] => 15:22:35
 *     [ctg_id] => 2
 *     [ctg_name] => Команды
 *     [root_id] => 1
 *     [root_name] => Linux
 *     [url] => Array (
 *       [post] => http://www.host.ru/blog/post/7
 *       [image] => http://www.host.ru/files/blog/thumb/7.jpg
 *       [category] => http://www.host.ru/blog/category/2
 *       [root] => http://www.host.ru/blog/category/1
 *     )
 *     [tags] => Array (
 *       ..........
 *     )
 *   )
 *   [1] => Array (
 *     [id] => 6
 *     [name] => Моноблок речевого оповещения Соната-К-120М с внешним микрофоном
 *     [excerpt] => Представляем усовершенствованную модель моноблока речевого оповещения Соната-К-120М...
 *     [date] => 29.11.2014
 *     [time] => 15:10:28
 *     [ctg_id] => 2
 *     [ctg_name] => Команды
 *     [root_id] => 1
 *     [root_name] => Linux
 *     [url] => Array (
 *       [post] => http://www.host.ru/blog/post/6
 *       [image] => http://www.host.ru/files/blog/thumb/6.jpg
 *       [category] => http://www.host.ru/blog/category/2
 *       [root] => http://www.host.ru/blog/category/1
 *     )
 *     [tags] => Array (
 *       ..........
 *     )
 *   )
 *   [2] => Array (
 *     .....
 *   )
 * )
 */

defined('ZCMS') or die('Access denied');
?>

<!-- Начало шаблона view/example/frontend/template/index/center.php -->

<!-- <h1><?php echo $name; ?></h1> -->

<?php if (!empty($posts)): ?>
    <h2>Последние записи</h2>
    <div id="posts-list">
    <?php foreach($posts as $item): ?>
        <div>
            <div>
                <a href="<?php echo $item['url']['post']; ?>">
                    <img src="<?php echo $item['url']['image']; ?>" alt="" />
                </a>
            </div>
            <div>
                <div class="post-date">
                    <?php echo $item['date']; ?>
                </div>
                <div class="post-heading">
                    <h3><a href="<?php echo $item['url']['post']; ?>"><?php echo $item['name']; ?></a></h3>
                </div>
                <div class="post-excerpt">
                    <?php echo $item['excerpt']; ?>
                </div>
                <div class="post-ctg-tags">
                    <div>
                        Категория:
                        <?php if (!empty($item['url']['root'])): ?>
                            <a href="<?php echo $item['url']['root']; ?>"><?php echo $item['root_name']; ?></a> •
                        <?php endif; ?>
                        <a href="<?php echo $item['url']['category']; ?>"><?php echo $item['ctg_name']; ?></a>
                    </div>
                    <div>
                        <?php if (!empty($item['tags'])): ?>
                            Теги:
                            <?php foreach ($item['tags'] as $i => $tag): ?>
                                <?php if ($i) echo '•'; ?>
                                <a href="<?php echo $tag['url']; ?>" title="<?php echo htmlspecialchars($tag['name']); ?>"><?php echo $tag['short']; ?></a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (!empty($articles)): ?>
    <h2>Последние статьи</h2>
    <div id="articles-list">
    <?php foreach($articles as $item): ?>
        <div>
            <div>
                <a href="<?php echo $item['url']['item']; ?>">
                    <img src="<?php echo $item['url']['image']; ?>" alt="" />
                </a>
            </div>
            <div>
                <div class="article-date">
                    <?php echo $item['date']; ?>
                </div>
                <div class="article-heading">
                    <h3><a href="<?php echo $item['url']['item']; ?>"><?php echo $item['name']; ?></a></h3>
                </div>
                <div class="article-excerpt">
                    <?php echo $item['excerpt']; ?>
                </div>
                <div class="article-category">
                    Категория:
                    <?php if (!empty($item['url']['root'])): ?>
                        <a href="<?php echo $item['url']['root']; ?>"><?php echo $item['root_name']; ?></a> •
                    <?php endif; ?>
                    <a href="<?php echo $item['url']['category']; ?>"><?php echo $item['ctg_name']; ?></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
<?php endif; ?>

<!-- Конец шаблона view/example/frontend/template/index/center.php -->



