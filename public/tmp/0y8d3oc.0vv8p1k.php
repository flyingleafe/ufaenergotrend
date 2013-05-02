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
            <section class="clearfix">
                <h1 class="sectionhead compact"><span>Что такое энергосервисный контракт?</span></h1>
                <div class="clearfix">
                    <div class="column50">
                        <div class="well fragment">Мы реализуем энергоэффективный проект за свой счет</div>
                    </div>
                    <div class="column50">
                        <div class="well fragment">
                            <div class="rarr"></div>
                            Вы платите из экономии в результате энергосбережения
                        </div>
                    </div>
                </div>
                <div class="column50">
                    <div class="index fragment">
                        <div class="side-img lamp"></div>
                        <div class="term"><span>Модернизация систем освещения</span></div>
                        <div class="count"><p class="note">Экономия энергии до</p> 70%</div>
                    </div>
                    <div class="index fragment">
                        <div class="side-img fire"></div>
                        <div class="term"><span>Модернизация систем отопления</span></div>
                        <div class="count"><p class="note">Экономия энергии до</p> 70%</div>
                    </div>
                </div>
                <div class="column50 fragment">
                    <div class="explain">
                        <p><strong>Результат для клиента:</strong></p>
                        <ul>
                            <li>Снижение затрат на энергию</li>
                            <li>Новое энергооборудование без инвестиций</li>
                        </ul>
                    </div>
                </div>
            </section>
            <section>
                <h1 class="sectionhead compact"><span>Схема финансирования</span></h1>
                <div class="column50">
                    <div class="well fragment">Энергосервисная компания финансирует и реализует проект «под ключ»</div>
                </div>
                <div class="column50">
                    <div class="well fragment">
                        <div class="rarr"></div>
                        Клиент осуществляет платежи из суммы экономии от энергосбережения
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="scheme">
                    <table class="fragment">
                        <tr>
                            <td colspan="2" class="top">
                                <img class="icon" src="/img/brand.png" alt='ООО "Уфаэнерготренд"' title='ООО "Уфаэнерготренд"'>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img class="icon" src="/img/user.png" alt="Клиент">
                                Клиент
                            </td>
                            <td class="sec">
                                <img class="icon" src="/img/tools.png" alt="Клиент" style="margin-bottom: 0.5em;">
                                <div class="in-bl">Поставщики и<br>подрядчики</div>
                            </td>
                        </tr>
                    </table>
                    <div class="fragment">
                        <div class="fly tip n1" style="top: 9em; left: 2em">Энергосервисный контракт</div>
                        <img class="fly" style="top: 6em; left: 12em" src="/img/carr-left.png" alt="">
                    </div>
                    <div class="fragment">
                        <div class="fly tip n2" style="top: 9em; right: 2em">Финансирование работ</div>
                        <img class="fly" style="top: 5.5em; right: 12em" src="/img/carr-right.png" alt="">
                    </div>
                    <div class="fragment">
                        <div class="fly tip n3" style="left: 44%; bottom: 0.7em">Реализация проекта</div>
                        <img class="fly" style="bottom: 0.7em; left: 43%" src="/img/carr-bot.png" alt="">
                    </div>
                    <div class="fragment">
                        <div class="fly tip n4" style="left: 40%; top: 40%; width: 13em;">Оплата за проведение энергоэффективного мероприятия</div>
                        <img class="fly" style="top: 6em; left: 12em" src="/img/carr-left2.png" alt="">
                    </div>
                </div>
            </section>
            <section data-state="wideslide">
                <h1 class="sectionhead" style="margin-bottom: 0.3em;"><span>Пример проекта</span></h1>
                <p>Что произойдет, если вы подпишете энергосервисный контракт с нами прямо сейчас.</p>
                <div class="container fragment" style="margin-top: 3em;" data-fragment-index="1">
                    <div class="timeline">
                        <div class="column33 period">
                            &larr; раньше
                        </div>
                        <div class="column33 period">
                            <div class="corner fragment" data-fragment-index="3">
                                <span class="mark">Подписание контракта с ООО "Уфаэнерготренд"</span>
                            </div>
                            3 года после подписания контракта
                        </div>
                        <div class="column33 period">
                            в дальнейшем &rarr;
                        </div>
                        <div class="ticks" id="ticks">
                            <div class="tick"></div>
                            <div class="tick"></div>
                            <div class="tick"></div>
                            <div class="tick"></div>
                            <div class="tick"></div>
                            <div class="tick"></div>
                            <div class="tick"></div>
                            <div class="tick"></div>
                        </div>
                    </div>
                    <div class="periods">
                        <div class="column33 period">
                            <table class="diagram fragment" data-fragment-index="2">
                                <tr>
                                    <td class="bar">
                                        <div class="red"></div>
                                        <p><big>10</big> млн. руб.</p>
                                    </td>
                                    <td class="amount">Ваши затраты на энергию</td>
                                </tr>
                            </table>
                        </div>
                        <div class="column33 period">
                            <table class="diagram fragment" data-fragment-index="4">
                                <tr>
                                    <td class="bar">
                                        <div class="green"></div>
                                        <p><big>1</big> млн. руб.</p>
                                    </td>
                                    <td class="amount">Ваша доля экономии</td>
                                </tr>
                                <tr style="height: 40%;">
                                    <td class="bar">
                                        <div class="yellow"></div>
                                        <p><big>4</big> млн. руб.</p>
                                    </td>
                                    <td class="amount">Выплаты энергосервисной компании.</td>
                                </tr>
                                <tr style="height: 50%;">
                                    <td class="bar">
                                        <div class="red"></div>
                                        <p><big>5</big> млн. руб.</p>
                                    </td>
                                    <td class="amount">Ваши затраты на энергию</td>
                                </tr>
                            </table>
                            <p class="notice fragment" data-fragment-index="5">Вы экономите <strong>1 млн. рублей ежегодно</strong> в течение трех лет.</p>
                        </div>
                        <div class="column33 period">
                            <table class="diagram fragment" data-fragment-index="6">
                                <tr>
                                    <td class="bar">
                                        <div class="green"></div>
                                        <p><big>5</big> млн. руб.</p>
                                    </td>
                                    <td class="amount">Ваша доля экономии</td>
                                </tr>
                                <tr style="height: 50%;">
                                    <td class="bar">
                                        <div class="red"></div>
                                        <p><big>5</big> млн. руб.</p>
                                    </td>
                                    <td class="amount">Ваши затраты на энергию</td>
                                </tr>
                            </table>
                            <p class="notice fragment" data-fragment-index="7">Вы экономите <strong>5 млн. руб. ежегодно</strong> в дальнейшем.<br>&nbsp;</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<div class="whywe">
    <div class="container">
        <h1 class="sectionhead"><span>Почему мы?</span></h1>
        <p class="big">Мы обладаем огромным практическим опытом работы в сфере энергетики</p>
        <div class="dot-divide"></div>
        <p class="big">Мы работаем в тесном контакте с финансово-кредитными организациями и поставщиками оборудования</p>
        <!-- <div class="dot-divide"></div>
        <p class="big">Мы напрямую работаем с поставщиками оборудования</p> -->
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

<script src="js/vendor/jquery.color.js"></script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
<script src="lib/js/head.min.js"></script>
<script src="js/reveal.js"></script>

<script>

    // Full list of configuration options available here:
    // https://github.com/hakimel/reveal.js#configuration
    Reveal.initialize({
        width: 1200,
        controls: true,
        progress: true,
        history: false,
        center: true,

        theme: Reveal.getQueryHash().theme, // available themes are in /css/theme
        transition: Reveal.getQueryHash().transition || 'default', // default/cube/page/concave/zoom/linear/none

        // Optional libraries used to extend on reveal.js
        dependencies: [
            { src: 'lib/js/classList.js', condition: function() { return !document.body.classList; } },
        ]
    });

    Reveal.removeEventListeners();

    $('#ticks').children().each(function (i) {
        $(this).html('<span>201' + (i+1) + '</span>');
    });

</script>