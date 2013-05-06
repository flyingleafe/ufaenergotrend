<div class="sky-wrapper">
    <?php echo $this->render('topmenu.html',$this->mime,get_defined_vars()); ?>
    <div class="logo">
        <div class="slogan">Комплексные решения проблем энергосбережения</div>
    </div>
    <div class="container grid">
        <h1 class="sectionhead compact"><span>Блог компании</span></h1>
        <div class="column70">
            <?php if ($USER && $USER->login): ?>
                
                    <div class="post-add-btn toggle-add">
                        <button class="btn add-toggle-trigger"><i class="icon-pencil"></i> Новая запись</button>
                    </div>
                    <div class="post-add-form toggle-add" style="display:none;">
                        <button class="btn add-toggle-trigger"><i class="icon-remove"></i> Закрыть</button>
                        <form action="/newpost" id="new-post" method="POST">
                            <p class="blog-inputwrap">
                                <input type="text" name="title" class="title" placeholder="Заголовок" required>
                            </p>
                            <p class="blog-inputwrap">
                                <input type="text" name="subtitle" class="subtitle" placeholder="Подзаголовок">
                            </p>
                            <div class="content-field-wrap">
                                <textarea name="content" id="new-post-content" cols="30" rows="10" class="content" placeholder="Тело записи..." required></textarea>
                            </div>
                            <button class="btn btn-success" id="new-post-btn"><i class="icon-ok"></i> Опубликовать</button>
                        </form>
                    </div>
                
            <?php endif; ?>
            <script type="x-placeholder" id="post-layout">
                <div class="post-wrapper">
                    <div class="datetime">{%created_at%}</div>
                    <h1 class="post-title"><a href="/blog/{%id%}">{%title%}</a></h1>
                    <h2 class="post-subtitle">{%subtitle%}</h2>
                    <div class="post-content">{%content%}</div>
                </div>
            </script>
            <div id="posts-container">
                <?php if (empty($posts)): ?>
                    
                        <p class="notice">В блоге пока нет ни одной записи.</p>
                    
                    <?php else: ?>
                        <?php foreach (($posts?:array()) as $post): ?>
                            <div class="post-wrapper">
                                <?php if ($USER && $USER->login): ?>
                                    
                                        <div class="controls">
                                            <button class="btn"><i class="icon-edit"></i> Изменить</button>
                                            <button class="btn btn-danger"><i class="icon-remove"></i> Удалить</button>
                                        </div>
                                    
                                <?php endif; ?>
                                <div class="datetime"><?php echo dateParse(strtotime($post['created_at'])); ?></div>
                                <h1 class="post-title"><a href="/blog/<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h1>
                                <h2 class="post-subtitle"><?php echo $post['subtitle']; ?></h2>
                                <div class="post-content"><?php echo Base::instance()->raw(htmlspecialchars_decode($post['content'])); ?></div>
                            </div>
                        <?php endforeach; ?>
                    
                <?php endif; ?>
            </div>
        </div>
        <div class="column30 sidebar">
            <h2>Свежие записи</h2>
            
        </div>
    </div>
</div>
<?php echo $this->render('footer.html',$this->mime,get_defined_vars()); ?>
<script src="/js/plugins.js"></script>
<?php if ($USER && $USER->login): ?>
    
        <script src="/js/wysihtml5-0.3.0.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/bootstrap-wysihtml5.js"></script>
        <script src="/plugin/bootstrap-wysiwyg/locales/bootstrap-wysihtml5.ru-RU.js"></script>
        <script src="/js/blog.js"></script>
    
<?php endif; ?>