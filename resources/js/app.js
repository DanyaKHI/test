import './bootstrap';
$(document).ready(function (){
    $('.drop').hide();
})

$('.menu_catalog').children('.main_drop').click(function (){
   $(this).parent('.menu_catalog').children('.drop').toggle(500);

   if ($(this).css('background-color') === 'rgba(255, 255, 255, 0.1)') {
       $(this).css('background-color', 'rgba(255, 255, 255, 0)');
   }
   else{
       $(this).css('background-color', 'rgba(255, 255, 255, 0.1)');
   }

    if ($(this).css('font-weight') === '400') {
        $(this).css('font-weight', '700');
    }
    else{
        $(this).css('font-weight', '400');
    }

   $(this).children('img').fadeOut(500, function (){
       if ($(this).attr('src') === '/photo/Arrow_down.svg'){
           $(this).attr('src','/photo/Arrow_right.svg').fadeIn(250);
       }
       else{
           $(this).attr('src','/photo/Arrow_down.svg').fadeIn(250);
       }
   })
});

$('.to_menu').click(function (){
    $('.menu').  slideToggle(0);
})



