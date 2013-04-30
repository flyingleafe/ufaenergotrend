<div class="sky-wrapper">
    <?php echo $this->render('topmenu.html',$this->mime,get_defined_vars()); ?>
    <div class="logo">
        <div class="slogan">Комплексные решения проблем энергосбережения</div>
    </div>
    <div class="container grid">
        <h1 class="sectionhead"><span>Контактная информация</span></h1>
        <div class="column50">
            <p class="contact addr">450014, г. Уфа, ул. Дагестанская, д.14</p>
            <p class="contact phone">8(347)266-81-04</p>
            <p class="contact email"><a href="mailto:post@ufaenergotrend.ru">post@ufaenergotrend.ru</a></p>
        </div>
        <div class="column50">
            <div id="map" class="yandex-map"></div>
        </div>
    </div>
</div>

<?php echo $this->render('footer.html',$this->mime,get_defined_vars()); ?>

<script type="text/javascript" charset="utf-8" src="//api-maps.yandex.ru/services/constructor/1.0/js/?sid=AoEsNgaunvAne6ae0DlQCC0fcRZ8wnSt&height=420&id=map"></script>