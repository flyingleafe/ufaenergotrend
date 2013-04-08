$(function() {
    // Mobile client detection
    var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent);

    console.log(isMobile);

    if(isMobile) {
        body.removeClass('screen').addClass('mobile');
    }

    var User = {
        login: getCookie('login'),
        pw: getCookie('pw')
    }

    /////////////////////
    // Top slider code //
    /////////////////////

    function Slider (objs) {
        this.obj = objs;
        this.len = this.obj.length;
        this.cur = 0;
        this.timeout = 6000;

        this.slide = function() {
            var self = this;

            var cur = $(self.obj[self.cur]);
            var p = (self.cur - 1 < 0) ? self.len - 1 : self.cur - 1;
            var prev = $(self.obj[p]);
            cur.addClass('active');
            prev.removeClass('active');

            setTimeout(function() {
                self.cur = (++self.cur % self.len);
                self.slide();
            }, self.timeout);
        }
    }

    if(!isMobile) {
        var blur = $('.blur')
        for(var i=2; i<=4; ++i) {
            blur = blur.add( $('<div class="blur b' + i + '"></div>').insertAfter(blur.last()) );
        }
        var slider = new Slider(blur);
        slider.slide();
    }

    //////////////////////////////////
    // Utility validating functions //
    //////////////////////////////////

    function validateEmail(email) { 
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    function validatePhone(phone) {
        // var re = /^(\+7[-. ]?|8[ .-]?)?(\()?([0-9]{3})(?(2)\))[-. ]?(([0-9]{2})|([0-9]{3}))[-. ]?([0-9]{2})[-. ]?(?(6)([0-9]{2})|([0-9]{3}))$/;
        var re = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
        return re.test(phone);
    }

    ///////////////////////////////
    // Application form handling //
    ///////////////////////////////

    // Describing the states of the form
    var fsm1 = StateMachine.create({
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
    }), 
        // creating a clone of our machine for second form
        fsm2 = $.extend(true, {}, fsm1);

    // Custom easing for beautiful form disappearing :3
    /*$.easing.easeInOutBack = function (x, t, b, c, d, s) {
        if (s == undefined) s = 1.70158; 
        if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
        return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
    }*/

    // Retrieving form elements
    $('#appsubmit, #appsubmit2').each( function() {

        var self = $(this),
            wrapper = self.parent(),
            thankyou = wrapper.siblings('.thankyou'),

            fsm = eval( self.data('fsm') ),

            name = self.find('input.name'),
            namewrap = name.parent(),
            contact = self.find('input.contact'),
            contactwrap = contact.parent(),
            submit = self.find('.submit'),
            indicator = self.find('.indicator'),

            tipfade = 500,
            getTheFuckOutTime = 1000;

        // Finish beautiful functions
        var finish1 = function() {
                thankyou.show();
                wrapper.add(thankyou).animate({
                    top: "+=100%"
                }, getTheFuckOutTime, "easeInOutBack", function() {
                    wrapper.hide()
                });
            },
            finish2 = function() {
                var left = self.parents('.container').children('.left').css('overflow', 'hidden'),
                    right = left.siblings('.right').css('overflow', 'hidden');
                left.animate({
                    width: 0
                }, getTheFuckOutTime / 3, "easeOutCubic", function() {
                    left.children('.inner-first').hide();
                    left.children('.inner-second').show();
                    left.animate({
                        width: "50%"
                    }, getTheFuckOutTime / 3, "easeInCubic", function() {
                        right.animate({
                            width: 0
                        }, getTheFuckOutTime / 3, "easeOutCubic");
                        left.animate({
                            width: "100%"
                        }, getTheFuckOutTime / 3, "easeOutCubic", function() {
                            left.animate({
                                borderRightColor: jQuery.Color("transparent")
                            }, getTheFuckOutTime / 4);
                        })
                    })
                });
            };

        var finish = eval( self.data('finish') );

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

    //////////////////////////////////////////
    // Top menu and reveal events handling  //
    //////////////////////////////////////////
    var opened = false,
        menu = $('.top-menu'),
        sltime = 500,
        $window = $(window),
        rev_fsm = StateMachine.create({
            initial: 'inactive',
            events: [
                { name: 'run', from: 'inactive', to: 'active' },
                { name: 'stop', from: 'active', to: 'inactive' }
            ],
            callbacks: {
                onenteractive: Reveal.addEventListeners,
                onleaveactive: Reveal.removeEventListeners,
                onchangestate: function() { console.log( this.current ) }
            }
        });


    body.scroll(function() {
        var mid = howitworks.offset().top + howitworks.height() / 2,
            quart = howitworks.height() / 4,
            border = header.offset().top + header.height() - 50;

        if ( ($(window).scrollTop() >= border) == !opened) {
            menu.slideToggle(sltime);
            opened = !opened;
        }

        if ( ( body.scrollTop() <= mid - quart) && (body.scrollTop() + $window.height() >= mid + quart) ) {
            if(rev_fsm.can('run')) rev_fsm.run();
        } else {
            if(rev_fsm.can('stop')) rev_fsm.stop();
        }

    });

    /////////////////////////
    // Login form handling //
    /////////////////////////
    var logwrap = menu.find(".loginform"),
        logform = logwrap.find("#login"),
        logtrig = logwrap.find(".trigger"),
        logback = logwrap.find(".back"),
        login_input = logform.find("input.login"),
        pw_input = logform.find("input.pw"),
        submit = logform.find(".submit"),
        sbmTimeout,
        sbmTime = 400;

    function blink() {
        submit.toggleClass('hl');
        sbmTimeout = setTimeout(blink, sbmTime);
    }

    function blinkStop() { clearTimeout(sbmTimeout) }

    logtrig.on('click', function(e) {
        e.preventDefault();
        logwrap.addClass('opened');
        setTimeout(function() {
            logform.add(logtrig).addClass('opened');
        }, 400);
    });
    logback.on('click', function() {
        logform.add(logtrig).removeClass('opened');
        setTimeout(function() {
            logwrap.removeClass('opened');
        }, 700);
    });
    logform.submit(function(e) {
        if(!login_input.val() || !pw_input.val())
            return false;
        submit.addClass('wait');
        blink();
        $.post(
            'login',
            $(this).serialize(),
            function(data) {
                console.log(data);
                if(data.success) {
                    submit.addClass('ok');
                    var period = 60*60*24*7;
                    setCookie('login', data.login, { expires: period });
                    setCookie('pw', data.pw, { expires: period });
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                }
                blinkStop();
            },
            'json'
        );
        return false;
    });

    //////////////////////////////
    // Control buttons handling //
    //////////////////////////////
    var panelOverlay = $(".panel-overlay"),
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
})();

