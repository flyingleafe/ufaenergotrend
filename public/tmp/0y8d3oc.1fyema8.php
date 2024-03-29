<div class="panel-overlay">
    <div class="panel">
        <div class="menu">
            <ul>
                <li><a class="tab" href="#passchange">Изменить пароль</a></li>
                <li><a class="tab" href="#adduser">Добавить администраторов</a></li>
                <li><a class="tab" href=""></a></li>
                <li><a class="tab" href=""></a></li>
                <li><a class="tab" href=""></a></li>
                <div class="clearfix"></div>
            </ul>
            <span class="close" title="Закрыть">x</span>
            <div class="clearfix"></div>
        </div>
        <div class="content">
            <section id="passchange">
                <h2>Изменение пароля</h2>
                <form action="/passchange" id="changepass" class="panelform" method="post">
                    <input type="password" class="ui-input" name="oldpass" placeholder="Текущий пароль">
                    <hr>
                    <input type="password" class="ui-input" name="newpass" placeholder="Новый пароль">
                    <input type="password" class="ui-input" name="newpass-confirm" placeholder="Новый пароль еще раз">
                    <button class="ui-submit">изменить</button>
                </form>
                <div class="clearfix"></div>
            </section>
            <section id="adduser">
                <h1>Добавление пользователей</h1>
                <form action="/adduser" id="useradd" class="panelform" method="post">
                    <input type="text" name="login" class="ui-input" placeholder="Имя нового пользователя">
                    <input type="password" name="pw" class="ui-input" placeholder="Его пароль">
                    <button class="ui-submit">добавить</button>
                </form>
                <div class="info">
                    <h3>Добавленные пользователи</h3>
                    <ul>
                        <?php foreach (($users?:array()) as $user): ?>
                            <li><?php echo $user['login']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </section>
            <section></section>
            <section></section>
            <section></section>
        </div>
    </div>
</div>
<script src="/js/panel.js" type="text/javascript"></script>