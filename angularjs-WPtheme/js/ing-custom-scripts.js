function hideElements(clsName){
    var elementObj = document.getElementsByClassName('"'+clsName+'"');
    var i;
    for (i = 0; i < elementObj.length; i++) {
       
        elementObj[i].style.display = "none";

    }
 }


$(document).ready(function(e) {

  // $(".event-section").hide();
    $('nav').addClass('original').fadeIn('slow');

    $(window).scroll(function() {

        if ($('.menu-toggle-btn').css('display') == "none") {


            var orgElementPos = $('nav').offset();
            orgElementTop = orgElementPos.top;

            if ($(window).scrollTop() >= ($('nav').height())) {
                stickyfixedMenu();
                
            } else if ($(window).scrollTop() < ($('nav').height())) {
                // not scrolled past the menu; only show the original menu.
                stcikyMenuReset();
            }


        }



    });



    $("#nav-menu-item-10 a, .brand-container").click("click", function(){

       // alert("reload");
        location.reload(true);
 
     });



    $(".menu-toggle-btn").click(function() {
        if ($(".menu-toggle-btn").css('display') == 'block') {
            $(".menu-container").toggle("slow");
        }
    })


    $(".top-main-menu li li a").click(function(event) {
        if ($(".menu-toggle-btn").css('display') == 'block') {
            $(".menu-container").slideUp();
        }
    });


    $("body").delegate(".btn-toolbar", "click", function() {

        $("#toolbar-options").slideDown("slow");

    });


    $(window).scroll(function() {

        if ($(window).scrollTop() >= (600)) {

            $(".row-fluid .span3").css({ "visibility" : "visible" }).addClass("animated fadeInLeft");
           
        }
        if ($(window).scrollTop() >= (1200)) {
            $(".event-section").css({ "visibility": "visible" }).show("fast");
        $(".event-list-box:nth-child(odd)").css({ "visibility": "visible" }).delay(500).addClass('animated fadeInLeft');
        $(".event-list-box:nth-child(even)").css({ "visibility": "visible" }).delay(500).addClass('animated fadeInRight');
        }

    });


    $(window).on("resize", function(event) {

        var w = $(this).width();
        if (w > 985) {
            $(this).scrollTop = 0;
            stcikyMenuReset();

        }
    })


     function stickyfixedMenu() {

        $('nav').removeAttr('style');
        $('.menu-container').removeAttr('style');
        $('.top-main-menu > li').removeAttr('style');
        $('nav').removeClass('original');
       
        $('nav').addClass('fixed').animate({height:'50px'},{ queue:false, duration:1200 });;
       /* $('.menu-container').parent('nav').css('height', '50px');*/
        $('.menu-container').parent('nav').css('line-height', '50px');
        $('.menu-container').css('height', '50px');
        $('.menu-container').css('line-height', '50px');
        $('.top-main-menu').css('margin-top', '0px');
        $('.brand-container').css('width', '110px');
        $('.brand-container').css('height', '50px');
        $('.top-main-menu li').css('height', '40px');
        $('.top-main-menu li').css('line-height', '40px');
        $('.top-main-menu li a').css('height', '40px');
        $('.top-main-menu li a').css('line-height', '40px');
        $('#thiner_top_right_sidebar').css('height', '40px');
        $('#thiner_top_right_sidebar').css('line-height', '40px');
        $('#thiner_top_right_sidebar').css('margin-top', '0px');
       

    }

    function stcikyMenuReset() {


      
       
        $('nav').removeAttr('style');
        $('.menu-container').removeAttr('style');
        $('.brand-container').removeAttr('style');
        $('nav').removeClass('fixed');
    
        $('nav').addClass('original').animate({height:'100px'},{ queue:false, duration:1200 });
        $('.top-main-menu').css('margin-top', '5px');
        $('.top-main-menu > li').css('height', '80px');
        $('.top-main-menu > li').css('line-height', '80px');
        $('.top-main-menu > li > a').css('height', '80px');
        $('.top-main-menu > li > a').css('line-height', '80px');
        $('#thiner_top_right_sidebar').css('height', '80px');
        $('#thiner_top_right_sidebar').css('line-height', '80px');
        $('#thiner_top_right_sidebar').css('margin-top', '0px');
        
    }




});