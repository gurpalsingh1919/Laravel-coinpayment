


    /* _____________________________________

     Pre loader
     _____________________________________ */
     $(window).on('load', function() {
      $('.spinner-wrapper').fadeOut('slow');
      $('.spinner-wrapper').remove('slow');
    });

     /* _____________________________________

      Tap on Top
      _____________________________________ */
      $(window).on('scroll', function() {
        if ($(this).scrollTop() > 600) {
          $('.tap-top').fadeIn();
        } else {
          $('.tap-top').fadeOut();
        }
      });

      $('.tap-top').on('click', function() {
        $("html, body").animate({
          scrollTop: 0
        }, 600);
        return false;
      });
 /*----------------------------------------------------
    Scroll reveal animation
    ----------------------------------------------------*/
/*    if (Modernizr.csstransforms3d) {
      window.sr = ScrollReveal();

      sr.reveal('.reveal-0', {
       // duration: 300,
        //delay: 400,
        reset: true,
        easing: 'linear',
        scale: 1
      });
      sr.reveal('.reveal-left', {
        origin: 'left',
        distance: '10px',
        duration: 800,
        delay: 400,
        opacity: 0,
        scale: 0,
        easing: 'linear',
        reset: true
      });
      sr.reveal('.reveal-right', {
         origin: 'right',
            distance: '10px',
            duration: 800,
            delay: 400,
            opacity: 0,
            scale: 0,
            easing: 'linear',
            reset: true
      });
    }*/

     /*----------------------------------------
     About-owlCarousel
     ----------------------------------------*/
   $("#about-slider").owlCarousel({

        autoplay: true,
        loop: true,
        dots: false,
          nav: true,
        navClass: ['owl-prev', 'owl-next'],
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        autoplayHoverPause: true,
        items: 1,
        lazyLoad: true,
        navigation: true,
        responsiveClass: true
    });
/*----------------------------------------
     award-owlCarousel
     ----------------------------------------*/
    $("#partner-slider").owlCarousel({

        autoplay: true,
        loop: true,
        dots: false,
        items: 6,
        lazyLoad: true,
        navigation: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            550: {
                items: 3,
                nav: false
            },
            1000: {
                items: 6,
                nav: false
            }
        }
    });
 /*----------------------------------------
     News-owlCarousel
     ----------------------------------------*/
   $(document).ready(function() {
    $("#news-slider").owlCarousel({
        items : 3,
        loop : true,      
        // itemsDesktop:[1199,3],
        // itemsDesktopSmall:[980,2],
        // itemsMobile : [600,1],
        pagination:false,
        navigationText:false,
         responsiveClass: true,
        responsive: {
            320: {
                items: 1,
                nav: false
            },
            991: {
                items: 2,
            },
            1000: {
              items:3,
            }
        }
    });
});

    $(window).on('load',function(){
        $('#myModal').modal('show');
    });

