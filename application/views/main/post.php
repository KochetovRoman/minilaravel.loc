<article class="post">
    <?php if (empty($list)):  ?>
        <h3>Список постов пуст</h3>
    <?php else: ?>
        <?php foreach ($list as $val): ?>
            <div id="post-title">
                <h3><?php echo htmlspecialchars($val['title'], ENT_QUOTES); ?></h3>
                <p id="post-data"><?php echo $val['pubdate']; ?></p>
            </div>
            <div id="post-description">
                <p><?php echo htmlspecialchars($val['description'], ENT_QUOTES); ?></p>
            </div>
            <div id="post-meta">
                <a href="postitem/<?php echo $val['id']; ?>" id="full-post">Читать далее</a>
                <a href="" id="post-comment">Комментариев (0)</a>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php endif; ?>

</article>

<?php echo $pagination; ?>