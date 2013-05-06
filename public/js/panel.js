var User = {
    login: getCookie('login'),
    pw: getCookie('pw')
}

//////////////////////////////
// Control buttons handling //
//////////////////////////////
var logwrap = $('.top-menu .loginform'),
    panelOverlay = $(".panel-overlay"),
    panel = panelOverlay.children('.panel'),
    close = panel.find('.close'),
    tabs = panel.find('.tab'),
    sections = panel.find('section'),
    controls = {
        logout: logwrap.find(".control.logout"),
        settings: logwrap.find(".control.settings")
    };
// tabs && sections init
tabs.first().addClass('active');
sections.first().addClass('active');

controls.logout.click(function(e) {
    deleteCookie('login');
    deleteCookie('pw');
    location.reload();        
});
controls.settings.click(function(e) {
    panelOverlay.addClass('active');
});
close.click(function(e) {
    panelOverlay.removeClass('active');
});
tabs.click(function(e) {
    var self = $(this),
        id = self.attr('href');
    tabs.add(sections).filter('.active').removeClass('active');
    self.addClass('active');
    sections.filter(id).addClass('active');
    return false;
});

///////////////////
// Notifications //
///////////////////



//////////////////////
// Ajax admin forms //
//////////////////////
var changepass  = $('#changepass'),
    adduser     = $('#useradd');

changepass.submit(function(e) {
    e.preventDefault();
    var data = $(this).serialize();

    $.post('passchange/' + User.login, data, function(data) {
        if ( data.success ) {
            setCookie('pw', data.newpass);
            setTimeout(function() {
                location.reload();
            }, 500);
        }
    }, 'json');
});
adduser.submit(function(e) {
    e.preventDefault();
    var data = $(this).serialize();
    console.log($(this));
    $.post('adduser', data, function(data) {
        if ( data.success ) {
            // do smth
        } else {
            // do smth else
        }
    }, 'json');
})