$(document).ready(function() {

    // Toggle Menu Bar
    $(".header-menu-bar").on("click", function() {
        $(".header-menu").toggleClass("showing");
    });

    // Toggle Main Search Form
    $(".header-search").on("click", function() {
        $('#main-search-form').toggleClass("header-search-showing");
        if($('#main-search-form').hasClass("header-search-showing")){
            $('body').css('overflow', 'hidden');
        }else{
            $('body').css('overflow', 'auto');
        }
        
    });

    $("#main-search-form").on("click", function() {
        $("#main-search-form").toggleClass("header-search-showing");
        if(!$('#main-search-form').hasClass("header-search-showing")){
            $('body').css('overflow', 'auto');
        }
    });
    $(".input-group").on("click", function(event) {
        event.stopPropagation();
    })

    // Toast Message
    if ($("#msg:has(li)").length) {
        var msg = document.getElementById("msg");
        msg.classList.add("show");
        setTimeout(function() { msg.className = msg.className.replace("show", ""); }, 4000);
    }

    // Close toast message
    $('#msg .ti-close').click(function() {
        $('#msg').removeClass('show');
    })

    // Sticky Header
    window.onscroll = function() { myFunction() };

    var header = document.getElementsByClassName("header-sticky-wrapper")[0];
    var sticky = header.offsetTop;

    function myFunction() {
        if (window.pageYOffset > sticky * 3) {
            header.classList.add("sticky");
            header.classList.add("nav-scrolled");
        } else {
            header.classList.remove("sticky");
            header.classList.remove("nav-scrolled");
        }
    }

    // Back to top button
    $('#back-to-top-btn').click(function() {
        $("html, body").animate({ scrollTop: 0 }, 700);
    })

    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('#back-to-top-btn').fadeIn();
        } else {
            $('#back-to-top-btn').fadeOut();
        }
    });


})