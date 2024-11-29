/**This file is created for writing custom javascript */

// console.log('custom.js');

$(window).scroll(function(){
    var sticky = $('.bravo_header'),
        scroll = $(window).scrollTop();
  
    if (scroll >= 100){
        sticky.addClass('header--sticky');
    } 
    else{
        sticky.removeClass('header--sticky');
    } 
});

$(document).ready(function(){
    if($('.page-template-content').length>0 || $('.bravo-contact-block').length>0){
        $('.bravo_header').addClass('p-abs');
    }else{
        if($('.bravo_header').hasClass('p-abs')){
            $('.bravo_header').removeClass('p-abs');
        }
    }
});

const currentYear = new Date().getFullYear();
$('.currentYear').html(currentYear);