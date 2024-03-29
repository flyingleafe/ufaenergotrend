<header>
    <div class="blur b1 active"></div>
    <div class="container">
        <div class="logo">
            <div class="slogan">Комплексные решения проблем энергосбережения</div>
        </div>
        <div class="thankyou">
            <h1>Спасибо за заявку!</h1>
            <div class="dot-divide"></div>
            <p>Очень скоро мы свяжемся с вами и обсудим детали контракта.</p>
        </div>
        <div class="appform">
            <h1>Оставить заявку</h1>
            <form method="post" action="/newapp" id="appsubmit" data-fsm="fsm1" data-finish="finish1">
                <div class="inputwrap">
                    <span class="tip">Введите имя или название</span>
                    <input type="text" name="name" class="name" placeholder="Имя или название фирмы">
                </div>
                <div class="inputwrap">
                    <span class="tip">Введите корректный e-mail или номер телефона</span>
                    <input type="text" name="contact" placeholder="Телефон или e-mail" class="contact"><button class="submit">a</button>
                </div>
            </form>
        </div>
        <div class="clearfix"></div>
    </div>
</header>
<?php echo $this->render('topmenu.html',$this->mime,get_defined_vars()); ?>
<div class="whatwedo">
    <div class="pad"></div>
    <div class="container">
        <div class="sectionhead"><span>Чем мы занимаемся?</span></div>
        <section>
            <p class="first">Мы повышаем энергоэффективность вашего предприятия <strong>без капитальных затрат</strong> с вашей стороны.</p>
            <div class="ir chart"></div>
            <div class="clearfix"></div>
        </section>
        <section>
            <div class="ir free-lamp"></div>
            <p class="second">Мы модернизируем вашу энергосистему <strong>за свой счет</strong>.</p>
            <div class="clearfix"></div>
        </section>
    </div>
</div>
<div class="howitworks">
    <div class="reveal">
        <div class="slides">
            <section>
                <h1 class="sectionhead"><span>Как это работает?</span></h1>
                <p class="big">Это работает благодаря <strong>энергосервисному контракту</strong></p>
                <div class="dot-divide"></div>
                <p class="notice">Переключайтесь между слайдами, используя клавиши <big>&uarr;, &darr;, &larr;, &rarr;</big> или стрелки по бокам.</p>
            </section>
            <section>
                <section class="clearfix">
                    <h1 class="sectionhead compact"><span>Что такое энергосервисный контракт?</span></h1>
                    <div class="column50 fragment">
                        <img src="http://dummyimage.com/140x200/c9c9c9/09090a.png" alt="" class="side-pic">
                        <p>
                            Допустим, вашему предприятию необходимо заменить старое и неэнергоэффективное оборудование на новое, <strong>но у вас нет на это средств</strong>.
                        </p>
                    </div>
                    <div class="column50 fragment">
                        <img src="http://dummyimage.com/140x200/c9c9c9/09090a.png" alt="" class="side-pic">
                        <p>
                            На помощь приходит ООО "Уфаэнерготренд". <br>
                            Мы устанавливаем новое оборудование <strong>самостоятельно</strong> и <strong>за свой счет</strong>.
                        </p>
                    </div>
                    <div class="bottom fragment">
                        <img src="http://dummyimage.com/140x200/c9c9c9/09090a.png" alt="" class="side-pic">
                        <p>
                            Вы оплачиваете наши услуги <strong>из тех средств, что сэкономили на энергии</strong>.
                        </p>
                    </div>
                </section>
                <section>
                    <h1 class="sectionhead"><span>И еще раз!</span></h1>
                    <p>еще больше слайдов!</p>
                </section>
            </section>
        </div>
    </div>
</div>
<div class="whywe">
    <div class="container">
        <h1 class="sectionhead"><span>Почему мы?</span></h1>
        <p class="big">У нас есть огромный практический опыт работы в сфере энергетики</p>
        <div class="dot-divide"></div>
        <p class="big">Наша команда - гениальные финансисты</p>
        <div class="dot-divide"></div>
        <p class="big">Мы напрямую работаем с поставщиками оборудования</p>
    </div>
</div>

<!--
<div class="feedback">
    <div class="container">
        <section>
            <h1 class="sectionhead">Наши клиенты</h1>
            <div class="dot-divide"></div>
            <p class="big">Как для малых, так и для крупных предприятий слово "Уфаэнерготренд" ассоциируется с удобством, надежностью и качеством.</p>
        </section>
    </div>
</div>
-->

<div class="conclusion">
    <div class="container">
        <div class="left">
            <div class="inner-first">
                <h1>Станьте нашим партнером прямо сейчас</h1>
                <div class="dot-divide white"></div>
                <p class="big">Оставьте свои контактные данные в форме справа, и очень скоро мы свяжемся с вами.</p>
            </div>
            <div class="inner-second">
                <h1>Спасибо за заявку!</h1>
                <div class="dot-divide white"></div>
                <p class="big">Надеемся на успешное сотрудничество!</p>
            </div>
        </div>
        <div class="right">
            <div class="appform-bot">
                <form method="post" action="/" id="appsubmit2" data-fsm="fsm2" data-finish="finish2">
                    <div class="inputwrap">
                        <span class="tip">Введите имя или название</span>
                        <input type="text" name="name" class="name" placeholder="Имя или название фирмы">
                    </div>
                    <div class="inputwrap">
                        <span class="tip">Введите корректный e-mail или номер телефона</span>
                        <input type="text" name="contact" placeholder="Телефон или e-mail" class="contact" /><button class="submit">a</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<?php echo $this->render('footer.html',$this->mime,get_defined_vars()); ?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.3.min.js"><\/script>')</script>
<script src="js/vendor/jquery.color.js"></script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
<script src="lib/js/head.min.js"></script>
<script src="js/reveal.js"></script>

<script>

    // Full list of configuration options available here:
    // https://github.com/hakimel/reveal.js#configuration
    Reveal.initialize({
        controls: true,
        progress: true,
        history: false,
        center: true,

        theme: Reveal.getQueryHash().theme, // available themes are in /css/theme
        transition: Reveal.getQueryHash().transition || 'default', // default/cube/page/concave/zoom/linear/none

        // Optional libraries used to extend on reveal.js
        dependencies: [
            { src: 'lib/js/classList.js', condition: function() { return !document.body.classList; } },
            { src: 'plugin/markdown/showdown.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
            { src: 'plugin/markdown/markdown.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
            { src: 'plugin/zoom-js/zoom.js', async: true, condition: function() { return !!document.body.classList; } },
            { src: 'plugin/notes/notes.js', async: true, condition: function() { return !!document.body.classList; } }
            // { src: 'plugin/remotes/remotes.js', async: true, condition: function() { return !!document.body.classList; } }
        ]
    });

    Reveal.removeEventListeners();

</script>