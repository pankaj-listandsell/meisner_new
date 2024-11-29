document.querySelectorAll(".accordion-item").forEach((item) => {
  item.querySelector(".accordion-item-header").addEventListener("click", () => {
    item.classList.toggle("open");
  });
});

document.querySelectorAll(".active").forEach((item) => {
    item.classList.toggle("open");
});


$(".service-slider").slick({
  infinite: true,
  autoplay: true,
  slidesToShow: 3,
  slidesToScroll: 3,
  autoplaySpeed: 4000,
  responsive: [
    {
      breakpoint: 1300,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 900,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }

  ]
});


$(".slider-2").slick({
  infinite: true,
  autoplay: true,
  dots: true,
  slidesToShow: 3,
  slidesToScroll: 3,
  autoplaySpeed: 4000,
  responsive: [
    {
      breakpoint: 1300,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 900,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }

  ]
});


$(".slider-top").slick({
  infinite: true,
  autoplay: true,
  dots: true,
  slidesToShow: 5,
  slidesToScroll: 3,
  autoplaySpeed: 4000,
  responsive: [
    {
      breakpoint: 1300,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 900,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 550,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }


  ]
});

$(".testimonial-btn1").on('click', function(event){
  $(".slick-prev").onclick();
});



function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Mehr lesen";
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Weniger lesen";
    moreText.style.display = "inline";
  }
}

function myFunction2() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more2");
  var btnText = document.getElementById("myBtn2");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Mehr lesen &#10142;";
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Weniger lesen &#129045;";
    moreText.style.display = "inline";
  }
}


/*--test-slide--*/

let active2 = !1;

if (document.querySelector('.wrapper-comp .scroller')) {
    document.querySelector('.wrapper-comp .scroller').addEventListener('mousedown', function() {
        active2 = !0;
        document.querySelector('.wrapper-comp .scroller').classList.add('scrolling')
    });
    document.body.addEventListener('mouseup', function() {
        active2 = !1;
        document.querySelector('.wrapper-comp .scroller').classList.remove('scrolling')
    });
    document.body.addEventListener('mouseleave', function() {
        active2 = !1;
        document.querySelector('.wrapper-comp .scroller').classList.remove('scrolling')
    });
    document.body.addEventListener('mousemove', function(e) {
        if (!active2)
            return;
        let x = e.pageX;
        x -= document.querySelector('.wrapper-comp').getBoundingClientRect().left;
        scrollIt(x)
    })
    function scrollIt(x) {
        let transform = Math.max(0, (Math.min(x, document.querySelector('.wrapper-comp').offsetWidth)));
        document.querySelector('.wrapper-comp .after').style.width = transform + "px";
        document.querySelector('.wrapper-comp .scroller').style.left = transform - 42 + "px"
    }
    scrollIt(150);
    document.querySelector('.wrapper-comp .scroller').addEventListener('touchstart', function() {
        active2 = !0;
        document.querySelector('.wrapper-comp .scroller').classList.add('scrolling')
    });
    document.body.addEventListener('touchend', function() {
        active2 = !1;
        document.querySelector('.wrapper-comp .scroller').classList.remove('scrolling')
    });
    document.body.addEventListener('touchcancel', function() {
        active2 = !1;
        document.querySelector('.wrapper-comp .scroller').classList.remove('scrolling')
    });
    document.body.addEventListener('touchmove', function(e) {
        if (!active2)
            return;
        let x = e.changedTouches[0].pageX;
        x -= document.querySelector('.wrapper-comp').getBoundingClientRect().left;
        scrollIt(x)
    })
} else {
    console.log('not found')
}

$(document).ready(function(){
var d = new Date();
document.getElementById("yearFooter").innerHTML = d.getFullYear();
});

// on click menu open
$(".header-3 li a").on('click', function (e) {
  e.preventDefault(); // Prevent the default link behavior
  console.log("clicked");

  var $clickedSubMenu = $(this).closest("li").find(".ul-service");
  // Remove 'show' class from all children-menu elements except the clicked one
  $(".ul-service").not($clickedSubMenu).removeClass("show");

  $(this).closest("li").find(".ul-service").toggleClass("show");
});

$(document).on('click', function (e) {
  var $menu = $('.header-3 li a');
  if ($menu.hasClass('show') && !$(e.target).closest('.ul-service').length) {
      $menu.removeClass('show');
  }
});


/*-mobile-menu-*/

function opencallb() {
  $("#ruckruf").removeClass("rd-show");
}

function closeCallb(){
  $("#ruckruf").addClass("rd-show");
}





/*--mobile menu--*/
let menu = document.querySelector('.mobile-menu');
menu.addEventListener('click', openMenu);
function openMenu() {
    document.getElementById("mymenu").style.width = "100%"
}
function closeMenu() {
    document.getElementById("mymenu").style.width = "0%"
}
let closeList = document.querySelectorAll('.menu-list.mobile li')
for (let x of closeList) {
    x.addEventListener('click', closeMenu)
}
let service = document.querySelector('.service-list');
service.addEventListener('click', openServiceMenu);
function openServiceMenu() {
    document.getElementById("mynav").style.width = "100%"
}
function closeServiceMenu() {
    document.getElementById("mynav").style.width = "0%"
}
var prevScrollpos = window.pageYOffset;
function mobileHeader() {
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
        document.getElementById("mobile-header").style.top = "0"
    } else if (window.pageYOffset > 150) {
        document.getElementById("mobile-header").style.top = "-80px"
    }
    prevScrollpos = currentScrollPos
}
var modal = document.getElementById("Gutenmodalpopup");
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none"
    }
}



var header = document.querySelector(".middlebar");
var stickydesk = header.offsetTop;
function stickyheaderdesktop() {
    if (window.pageYOffset >= stickydesk) {
        header.classList.add("sticky")
    } else {
        header.classList.remove("sticky")
    }
}

var mobile_header = document.querySelector("#mobile-header");
var stickymobile = mobile_header.offsetTop + 15;
function stickyheadermobile() {
    if (window.pageYOffset >= stickymobile) {
        mobile_header.classList.add("sticky")
    } else {
        mobile_header.classList.remove("sticky")
    }
}

let top_btn = document.querySelector(".topbutton");
function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      alert("work");
        top_btn.style.display = "block"
    } else {
        top_btn.style.display = "none"
    }
}


window.onscroll = function() {
  scrollFunction();
  stickyheaderdesktop();
  stickyheadermobile()
}