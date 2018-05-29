<article class="postitem">
    <div id="postitem-title">
                <h2><strong><?php echo htmlspecialchars($data['title'], ENT_QUOTES); ?></strong></h2>
     </div>

    <div id="postitem-data">
        <?php echo $data['pubdate']; ?>
    </div>

    <div id="postitem-description">
        <p><strong><?php echo htmlspecialchars($data['description'], ENT_QUOTES); ?></strong></p>
    </div>

    <img src="/public/materials/<?php echo $data['id'];?>.jpg">

    <div id="postitem-text">
        <p><?php echo $data['text']; ?></p>
    </div>
<hr>

</article>



