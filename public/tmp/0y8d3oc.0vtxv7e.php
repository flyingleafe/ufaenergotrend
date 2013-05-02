<div class="sky-wrapper">
    <?php echo $this->render('topmenu.html',$this->mime,get_defined_vars()); ?>
    <div class="logo">
        <div class="slogan">Комплексные решения проблем энергосбережения</div>
    </div>
    <div class="container grid">
        <h1 class="sectionhead compact"><span>Блог компании</span></h1>
        <div class="column70">
            Здесь будут записи блога.
        </div>
        <div class="column30">
            А здесь окажется сайдбар.
        </div>
    </div>
</div>
<?php echo $this->render('footer.html',$this->mime,get_defined_vars()); ?>