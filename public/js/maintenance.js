var appform = $('#appsubmit'),
    loginLink = $('#admin-login-link').fancybox(),
    fsm = StateMachine.create({
        initial : 'calm',
        events : [
            { name: 'try', from: 'calm', to: 'validate' },
            { name: 'failboth', from: 'validate', to: 'warn' },
            { name: 'failcontact', from: 'validate', to: 'warn' },
            { name: 'failname', from: 'validate', to: 'warn' },
            { name: 'try', from: 'warn', to: 'warn' },
            { name: 'release', from: 'warn', to: 'warn' },
            { name: 'reset', from: ['warn', 'error'], to: 'calm' },
            { name: 'success', from: 'validate', to: 'proceed' },
            { name: 'fail', from: 'proceed', to: 'error' },
            { name: 'success', from: 'proceed', to: 'ok' },
            { name: 'finish', from: 'ok', to: 'thanks' }
        ]
    });

appform.each( function() {
    var self = $(this),
        wrapper = self.parent(),
        thankyou = wrapper.siblings('.thankyou'),
        appwrap = wrapper.parent(),

        name = self.find('input.name'),
        namewrap = name.parent(),
        contact = self.find('input.contact'),
        contactwrap = contact.parent(),
        submit = self.find('.submit'),
        indicator = self.find('.indicator'),

        tipfade = 500,
        getTheFuckOutTime = 1000,

        finish = function() {
            thankyou.show();
            wrapper.animate({
                top: "+=120%"
            }, getTheFuckOutTime / 2, "easeInOutBack", function() {
                // wrapper.hide();
                thankyou.animate({
                    top: "-=120%"
                }, getTheFuckOutTime / 2, "easeInOutBack");
            });
        };

    name.data('prevval', '');
    contact.data('prevval', '');

    // DOM events handling
    self
        .submit(function (e) {
            return false;
        })
        .keydown(function (e) {
            if( e.keyCode == 13 && fsm.can( 'try' ) ) {    
                fsm.try( submit );
            }                
        })
        .keyup(function (e) {
            if( e.keyCode == 13 && fsm.can( 'release' ) ) {    
                fsm.release( submit );
            }
        });

    contact.add(name).keydown(function (e) {
        var $this = $(this);
        if( ( $this.val() !== $this.data('prevval') ) && fsm.can('reset') ) {
            console.log( $this.val() + ' - ' + $this.data('prevval') );
            fsm.reset();
        }
    });

    submit
        .mousedown(function (e) {
            if( fsm.can( 'try' ) ) {    
                fsm.try( submit );
            }                
        })
        .mouseup(function (e) {
            if( fsm.can( 'release' ) ) {
                fsm.release( submit );
            }
        });

    // State machine callbacks handling
    fsm.ontry = function() { submit.addClass('active') },
    fsm.onrelease = function() { submit.removeClass('active') },
    fsm.onentervalidate = function() {
        var a = validatePhone( contact.val() ) || validateEmail( contact.val() ),
            b = name.val();

        if( !a && !b ) {
            fsm.failboth();
        } else if( !a && b ) {
            fsm.failcontact();
        } else if( !b ) {
            fsm.failname();
        } else {
            fsm.success();
        }
    }
    fsm.onfailcontact = function() { 
        contactwrap.addClass('wrong').children('.tip').fadeIn(tipfade);
        contact.data('prevval', contact.val() );
        console.log(contactwrap);
    },
    fsm.onfailname = function() { 
        namewrap.addClass('wrong').children('.tip').fadeIn(tipfade);
        name.data('prevval', name.val() );
    },
    fsm.onfailboth = function() { 
        fsm.onfailcontact();
        fsm.onfailname();
    },
    fsm.onleavewarn = function() { contactwrap.add(namewrap).removeClass('wrong').children('.tip').fadeOut(700); },
    fsm.onenterproceed = function() {
        submit.addClass('waiting').attr('disabled', 'disabled');

        $.post(
            'newapp',
            self.serialize(),
            function(data) {
                console.log(data);
                if(data.db_saved) {
                    fsm.success();
                } else {
                    fsm.fail();
                }
            },
            'json'
        );
    },

    fsm.onreset = function() { submit.attr("class", "submit") },
    fsm.onenterok = function() {
        submit.addClass("ok");
        var curFsm = fsm;
        setTimeout(function() {
            curFsm.finish();
        }, getTheFuckOutTime);
    },
    fsm.onleaveok = function() {

    }
    fsm.onenterthanks = finish,
    fsm.onchangestate = function() { console.log( this.current ) }
});

function adminLogin(form_el) {
    var form = $(form_el),
        loginInput = form.find('input[name="login"]'),
        passInput = form.find('input[name="pw"]'),
        indicator = form.find('#indicator'),
        error = form.find('#error');

    if(!loginInput.val() || !passInput.val())
        return false;
    indicator.text('⟲');
    $.post(
        'login',
        form.serialize(),
        function(data) {
            console.log(data);
            if(data.success) {
                indicator.text('✔');
                var period = 60*60*24*7;
                setCookie('login', data.login, { expires: period });
                setCookie('pw', data.pw, { expires: period });
                setTimeout(function() {
                    location.reload();
                }, 500);
            } else {
                indicator.text('✖');
                error.show();
            }
        },
        'json'
    );
    return false;
}