<div class="post-wrapper" data-id="<?php echo $post['id']; ?>">
    <?php if ($USER && $USER->login): ?>
        
            <div class="controls">
                <button class="btn post-edit"><i class="icon-edit"></i> Изменить</button>
                <button class="btn btn-danger post-delete"><i class="icon-remove"></i> Удалить</button>
            </div>
        
    <?php endif; ?>
    <div class="datetime"><?php echo dateParse(strtotime($post['created_at'])); ?></div>
    <h1 class="post-title"><a href="/blog/<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h1>
    <h2 class="post-subtitle"><?php echo $post['subtitle']; ?></h2>
    <div class="post-content"><?php echo Base::instance()->raw(htmlspecialchars_decode($post['content'])); ?></div>
</div>