
$("#toggle-btn").on("click", function(e) {
        e.preventDefault(),
        $(window).outerWidth() > 1194 ? ($(".side-navbar").toggleClass("shrink"),
        $(".page").toggleClass("active")) : ($(".side-navbar").toggleClass("shrink"),
        $(".page").toggleClass("active"))
    })
 
 $()