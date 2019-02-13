<?php if (!empty($results)): ?>
    <span></span>
    <?php foreach($results as $item): ?>
        <div><a href="<?php echo $item['url']['post']; ?>"><?php echo $item['name']; ?></a></div>
    <?php endforeach; ?>
<?php endif; ?>