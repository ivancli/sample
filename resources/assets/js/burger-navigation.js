$( document ).ready(function() {

    $(".ninja-btn, .panel-overlay, .panel li a").click(function() {
        $('html').addClass('nav-open');
        $(".ninja-btn, .panel-overlay, .panel").toggleClass("active");
        /* Check panel overlay */
        if ($(".panel-overlay").hasClass("active")) {
            $(".panel-overlay").fadeIn();
        } else {
            $(".panel-overlay").fadeOut();
        }
    });

});


$( document ).on("load resize", function() {
    var menuHeightOffset = $(".panel").find("ul").height() / 2;

    $(".panel").find("ul").css({
        "margin-top": -menuHeightOffset
    });
});
