

//Animate on Scroll
AOS.init({
  duration: 1200,
})


// SlIK SLIDER

//Slik slider init
$('.slider-testimonials-1').slick({
   slidesToShow: 1,
   slidesToScroll: 1,
   arrows: false,
   dots: true,
   fade: true,
   autoplay: true,
   //adaptiveHeight: true,
   autoplaySpeed: 2000
  });
  var navBtn = $('.navbar-toggler');
  var nav = $('#navbar-main');
  var collapseNav = $('.navbar-collapse');

  $(navBtn).on('click', function(){
    nav.addClass('bg-light');
    nav.removeClass('bg-transparent');
    nav.addClass('shadow-sm');
  }).off('click', function(){
    nav.removeClass('bg-light');
    nav.removeClass('shadow-sm');
    nav.addClass('bg-transparent');
  })

  $(window).scroll(function() {

    var top = 60;

    if ($(window).scrollTop() >= top) {

        nav.addClass('bg-light');
        nav.removeClass('bg-transparent');
        nav.addClass('shadow-sm');

    } else {

        nav.removeClass('bg-light');
        nav.removeClass('shadow-sm');
        nav.addClass('bg-transparent');
        if ($(collapseNav).hasClass('show')){
          $(navBtn).trigger('click')
        }


    }
  });
