<div class="post-wrapper" data-id="<?php echo $post['id']; ?>">
    <?php if (isset($GET['edit']) and $content == 'post'): ?>
        
            <h2>Редактирование записи</h2>
            <button onclick="history.go(-1)" class="btn add-toggle-trigger"><i class="icon-remove"></i> Отмена</button>
            <form action="/updatepost/<?php echo $post['id']; ?>" id="update-post" method="POST">
                <p class="blog-inputwrap">
                    <input type="text" name="title" class="title" placeholder="Заголовок" value="<?php echo $post['title']; ?>" required>
                </p>
                <p class="blog-inputwrap">
                    <input type="text" name="subtitle" class="subtitle" placeholder="Подзаголовок" value="<?php echo $post['subtitle']; ?>">
                </p>
                <div class="content-field-wrap">
                    <textarea name="content" id="new-post-content" cols="30" rows="10" class="content" placeholder="Тело записи..." required>
                        <?php echo $post['content']; ?>
                    </textarea>
                </div>
                <button class="btn btn-success"><i class="icon-ok"></i> Изменить</button>
            </form>
        
        <?php else: ?>
            <?php if ($USER && $USER->login): ?>
                
                    <div class="controls">
                        <a href="/blog/<?php echo $post['id']; ?>?edit=1" class="btn post-edit"><i class="icon-edit"></i> Изменить</a href="/blog/<?php echo $post['id']; ?>?edit=1">
                        <button class="btn btn-danger post-delete"><i class="icon-remove"></i> Удалить</button>
                    </div>
                
            <?php endif; ?>
            <div class="datetime"><?php echo dateParse(strtotime($post['created_at'])); ?></div>
            <h1 class="post-title"><a href="/blog/<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h1>
            <h2 class="post-subtitle"><?php echo $post['subtitle']; ?></h2>
            <div class="post-content"><?php echo Base::instance()->raw(htmlspecialchars_decode($post['content'])); ?></div>
        
    <?php endif; ?>
</div>