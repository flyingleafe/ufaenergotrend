<nav class="top-menu">
    <ul>
        <?php if ($content !== 'main'): ?>
                
                    <li><a href="/">Главная</a></li>        
                
            <?php endif; ?>
        <?php foreach ((array_keys($pagenames)?:array()) as $name): ?>
            <?php if ($content !== $name and $name !== 'post'): ?>
                
                    <li><a href="<?php echo '/'.$name; ?> "><?php echo $pagenames[$name]; ?></a></li>        
                
            <?php endif; ?>
        <?php endforeach; ?>
       <!--  <li><a href="/blog">Блог</a></li>
       <li><a href="/about">О компании</a></li>
       <li><a href="/contacts">Контакты</a></li> -->
        <div class="clearfix"></div>
    </ul>
    <?php if ($USER && $USER->login): ?>
        
            <div class="loginform opened">
                <span class="hello">Здравствуйте, <strong><?php echo $USER->login; ?></strong>.</span>
                <a href="#settings" class="control settings" title="Управление сайтом"></a>
                <a href="#logout" class="control logout" title="Выйти"></a>               
            </div>
        
        <?php else: ?>
            <div class="loginform">
                <a href="#login" class="trigger">войти</a>
                <form action="/login" id="login">
                    <span class="back">назад</span>
                    <div class="lgwrap login">
                        <input type="text" name="login" class="login" placeholder="Логин">
                    </div>
                    <div class="lgwrap pw">
                        <input type="password" name="pw" class="pw" placeholder="Пароль"><button class="submit">↩</button>
                    </div>
                </form>
            </div>
        
    <?php endif; ?>    
    <div class="clearfix"></div>
</nav>