$(document).ready(function () {
    $(".on-hover").removeClass("on-hover");

});
$(document).ready(function () {
    $("#menu-button").click(function () {
        $("#main-menu").slideToggle();
        document.getElementById("button-anim").beginElement();
    });
});

$(window).on("resize", function () {

    var win = $(this);
    if (win.width() > 600) {
        $("#main-menu").removeAttr("style");
    }
});