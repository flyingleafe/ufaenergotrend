$(function() {
    // Mobile client detection
    var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent);

    console.log(isMobile);

    if(isMobile) {
        body.removeClass('screen').addClass('mobile');
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

    ///////////////////////
    // Fragment autoplay //
    ///////////////////////
    var frtm = null,
        frdelay = 1000;
    function autoshow() {
        clearTimeout(frtm);
        frtm = setTimeout(Reveal.nextFragment, frdelay);
    }
    Reveal.addEventListener( 'slidechanged', autoshow );
    Reveal.addEventListener( 'fragmentshown', autoshow ); 
})();
