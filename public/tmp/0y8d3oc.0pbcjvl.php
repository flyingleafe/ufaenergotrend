<div class="sky-wrapper">
    <?php echo $this->render('topmenu.html',$this->mime,get_defined_vars()); ?>
    <div class="logo">
        <div class="slogan">Комплексные решения проблем энергосбережения</div>
    </div>
    <div class="container grid">
        <h1 class="sectionhead compact"><span>Блог компании</span></h1>
        <div class="column70">
            <?php echo $this->render('single-post.html',$this->mime,get_defined_vars()); ?>
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