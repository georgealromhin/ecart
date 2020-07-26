var t = $(window).height() / 2;
$(window).on("scroll", function() { $(this).scrollTop() > t ? $("#back_to_top").css("display", "flex") : $("#back_to_top").css("display", "none") }), $("#back_to_top").on("click", function() { $("html, body").animate({ scrollTop: 0 }, 300) })

function openNav() {
    document.getElementById("main-sidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("main-sidebar").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
}