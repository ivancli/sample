$(function() {
    var navbar_initialized = false;

    var burger_menu = $('nav').hasClass('navbar-burger') ? true : false;

    var window_width = $(window).width();

    var ModNavBar = {
        misc:{
            navbar_menu_visible: 0
        },
        initRightMenu: function () {
            if(!navbar_initialized) {

                $nav = $('nav');
                $nav.addClass('navbar-burger');

                $navbar = $nav.find('.navbar-collapse').first().clone(true);
                $navbar.css('min-height', window.screen.height);

                ul_content = '';

                $navbar.children('ul').each(function () {
                    content_buff = $(this).html();
                    ul_content = ul_content + content_buff;
                });

                ul_content = '<ul class="nav navbar-nav">' + ul_content + '</ul>';
                $navbar.html(ul_content);

                $('body').append($navbar);

                background_image = $navbar.data('nav-image');

                $toggle = $('.navbar-toggle');

                $navbar.removeClass('default-navbar');
                $navbar.find('a').removeClass('btn btn-round btn-default');
                $navbar.find('button').removeClass('btn-round btn-fill btn-info btn-primary btn-success btn-danger btn-warning btn-neutral');
                $navbar.find('button').addClass('btn-simple btn-block');

                $link = $navbar.find('a');

                $link.click(function (e) {
                    var scroll_target = $(this).data('id');
                    var scroll_trigger = $(this).data('scroll');

                    if (scroll_trigger == true && scroll_target !== undefined) {
                        e.preventDefault();

                        $('html, body').animate({
                            scrollTop: $(scroll_target).offset().top - 50
                        }, 1000);
                    }

                });


                $toggle.click(function () {

                    if (ModNavBar.misc.navbar_menu_visible == 1) {
                        $('html').removeClass('nav-open');
                        ModNavBar.misc.navbar_menu_visible = 0;
                        $('#bodyClick').remove();
                        setTimeout(function () {
                            $toggle.removeClass('toggled');
                        }, 550);

                    } else {
                        setTimeout(function () {
                            $toggle.addClass('toggled');
                        }, 580);

                        div = '<div id="bodyClick"></div>';
                        $(div).appendTo("body").click(function () {
                            $('html').removeClass('nav-open');
                            ModNavBar.misc.navbar_menu_visible = 0;
                            $('#bodyClick').remove();
                            setTimeout(function () {
                                $toggle.removeClass('toggled');
                            }, 550);
                        });

                        $('html').addClass('nav-open');
                        ModNavBar.misc.navbar_menu_visible = 1;

                    }
                });
                navbar_initialized = true;
            }
        }
    };

    if(window_width < 979 || burger_menu) {
        ModNavBar.initRightMenu();
    }
});