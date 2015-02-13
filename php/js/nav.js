$(document).ready(function() {
    var s = $("#archive_nav");
    var pos = s.position();                   
    $(window).scroll(function() {
        var windowpos = $(window).scrollTop();
        if (windowpos >= pos.top) {
            s.addClass("stickdiv ");
        } else {
            s.removeClass("stickdiv ");
        }
    });
});
