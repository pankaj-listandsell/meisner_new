$(window).scroll(function() {
  if ($(this).scrollTop() > 50) { // adjust the value as needed
      $('.sticky_header').addClass('sticky');  
  } else {
      $('.sticky_header').removeClass('sticky');  
  }
});

document.querySelector('.anf_dropdown-button').addEventListener('click', function() {
  document.querySelector('.anf_dropdown-content').classList.toggle('show');
});

// Close the dropdown if clicked outside of it
window.onclick = function(event) {
  if (!event.target.matches('.anf_dropdown-button')) {
      var dropdowns = document.getElementsByClassName("anf_dropdown-content");
      for (var i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
              openDropdown.classList.remove('show');
          }
      }
  }
};

$(window).scroll(function() {
  if ($(this).scrollTop() > 100) { // adjust the value as needed
      $('.float-container-btns').addClass('show');
      $('.topbutton').addClass('show');    
  } else {
      $('.float-container-btns').removeClass('show');
      $('.topbutton').removeClass('show');  
  }
});

$(document).ready(function(){

  $('.topbutton').click(function(e) {
    e.preventDefault();
    $('html, body').animate({scrollTop: 0}, 600); // Smooth scroll to top
      return false;
  });

 /*   let currentStep = 0;
    const steps = $(".mess_form-step");
    const progress = $("#mess_progress");
    const progressSteps = $(".mess_progress-step");
  
    function updateProgressBar() {
        progress.css("width", (currentStep / (steps.length - 1)) * 100 + "%");
        progressSteps.each(function(index) {
            if (index <= currentStep) {
                $(this).addClass("mess_progress-step-active");
            } else {
                $(this).removeClass("mess_progress-step-active");
            }
        });
    }
  
    $(".mess_btn-next").click(function() {
        if (currentStep < steps.length - 1) {
            $(steps[currentStep]).removeClass("mess_form-step-active");
            currentStep++;
            $(steps[currentStep]).addClass("mess_form-step-active");
            updateProgressBar();
        }
    });
  
    $(".mess_btn-prev").click(function() {
        if (currentStep > 0) {
            $(steps[currentStep]).removeClass("mess_form-step-active");
            currentStep--;
            $(steps[currentStep]).addClass("mess_form-step-active");
            updateProgressBar();
        }
    });
  
    updateProgressBar();
*/

/*-topbar type writer code--*/

$(document).ready(function(){
  var words = [
      "Kostenlose Besichtigung",
      "Persönlicher Ansprechpartner",
      "Alle Abfallarten",
      "Top Preise",
      "Versichert und Geprüft",
      "Professionell & Zuverlässig",
      "Schnelle Termine"
  ];
  var i = 0;
  var j = 0;
  var currentWord = "";
  var typingSpeed = 150; // Speed of typing (in milliseconds)
  var wordDelay = 2000;  // Time before the next word appears (in milliseconds)

  function typeWriter() {
      if (j < currentWord.length) {
          $('#typewriter').append(currentWord.charAt(j));
          j++;
          setTimeout(typeWriter, typingSpeed);
      } else {
          setTimeout(clearText, wordDelay); // Pause before clearing the word
      }
  }

  function clearText() {
      $('#typewriter').text(''); // Clear the current text
      i = (i + 1) % words.length; // Move to the next word in the array
      currentWord = words[i]; // Update the current word
      j = 0; // Reset the character index
      typeWriter(); // Start typing the next word
  }

  currentWord = words[i];
  typeWriter();
});


 // on click menu open
 $("ul.main-menu li.mega_menu_li > a, ul.main-menu li.anfrage_form > a").on('click', function (e) {
  e.preventDefault(); // Prevent the default link behavior

  var $clickedSubMenu = $(this).closest("li").find(".children-menu");
  // Remove 'show' class from all children-menu elements except the clicked one
  $(".children-menu").not($clickedSubMenu).removeClass("show");

  $(this).closest("li").find(".children-menu").toggleClass("show");
});

$(document).on('click', function (e) {
  var $menu = $('ul.main-menu li .children-menu');
  if ($menu.hasClass('show') && !$(e.target).closest('.main-menu, .children-menu').length) {
      $menu.removeClass('show');
  }
});

// Function to handle scrolling the page
  $(window).on('scroll', function () {
      $('.children-menu').removeClass('show');
  });

document.addEventListener("DOMContentLoaded", function() {
  const form = document.getElementById('mess_form');
  const progress = document.getElementById('mess_progress');
  const steps = document.querySelectorAll('.mess_form-step');
  const stepButtons = document.querySelectorAll('.mess_btn-next, .mess_btn-prev');

  let currentStep = 0;

  function showStep(stepIndex) {
      steps.forEach((step, index) => {
          step.classList.toggle('mess_form-step-active', index === stepIndex);
      });
      updateProgressBar(stepIndex);
  }

  function updateProgressBar(stepIndex) {
      const progressWidth = (stepIndex / (steps.length - 1)) * 100;
      progress.style.width = `${progressWidth}%`;
      document.querySelectorAll('.mess_progress-step').forEach((step, index) => {
          step.classList.toggle('mess_progress-step-active', index <= stepIndex);
      });
  }

  function clearError(step) {
      const errorMessages = step.querySelectorAll('.error-message');
      errorMessages.forEach(message => message.remove());

      const invalidInputs = step.querySelectorAll('.form-control:invalid');
      invalidInputs.forEach(input => {
          input.classList.remove('error');
          const nextSibling = input.nextElementSibling;
          if (nextSibling && nextSibling.classList.contains('error-message')) {
              nextSibling.remove();
          }
      });
  }

  function validateStep(stepIndex) {
      const step = steps[stepIndex];
      clearError(step);

      let isValid = true;

      const inputs = step.querySelectorAll('.form-control');
      inputs.forEach(input => {

          if (input.type === 'date') {
              if (!input.value) {
                  isValid = false;
                  input.classList.add('error');
                  if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('error-message')) {
                      const errorMessage = document.createElement('div');
                      errorMessage.classList.add('error-message');
                      errorMessage.textContent = 'Bitte wählen Sie ein gültiges Datum aus.';
                      input.parentElement.appendChild(errorMessage);
                  }
              }
          } else if (!input.checkValidity()) {
              isValid = false;
              input.classList.add('error');
              if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('error-message')) {
                  const errorMessage = document.createElement('div');
                  errorMessage.classList.add('error-message');
                  errorMessage.textContent = input.validationMessage || 'Bitte füllen Sie dieses Feld aus.';
                  input.parentElement.appendChild(errorMessage);
              }
          }
      });

      return isValid;
  }

  stepButtons.forEach(button => {
      button.addEventListener('click', (e) => {
          const isNext = button.classList.contains('mess_btn-next');
          if (isNext) {
              if (validateStep(currentStep)) {
                  currentStep++;
                  if (currentStep >= steps.length) {
                      currentStep = steps.length - 1;
                  }
                  showStep(currentStep);
              }
          } else {
              currentStep--;
              if (currentStep < 0) {
                  currentStep = 0;
              }
              showStep(currentStep);
          }
      });
  });

  // Show the first step initially
  showStep(currentStep);
});

if ($('.service-sec-8 .last_rm').height() > 500) {
  // Add class if height is greater than 500px
  $('.service-sec-8 .last_rm').addClass('big_content');
}

$('.ls_rm_btn a').click(function(e) {
  e.preventDefault();
  var content = $('.last_rm');
  var button = $(this); // `this` refers to the clicked button

  if (content.height() === 500) {
      // Expand the content and change the button text
      content.css({"height": "100%", "-webkit-mask-image": "none"});
      button.text('Weniger lesen 🠙'); // Change the button text
  } else {
      // Collapse the content and change the button text
      content.css({"height": "500px", "-webkit-mask-image": "linear-gradient(to bottom,#000 71%,rgba(0,0,0,0))"});
      button.text('Mehr lesen 🠆'); // Change the button text
  }
});

  $('.section1 #myBtn').click(function() {
    var content = $('.read_m_content');
    var button = $(this); // `this` refers to the clicked button

    if (content.height() === 218) {
        // Expand the content and change the button text
        content.css({"height": "100%", "-webkit-mask-image": "none"});
        button.text('Weniger lesen ➞'); // Change the button text
    } else {
        // Collapse the content and change the button text
        content.css({"height": "218px", "-webkit-mask-image": "linear-gradient(to bottom,#000 71%,rgba(0,0,0,0))"});
        button.text('Mehr lesen ➞'); // Change the button text
    }
});

$('.sec5_read_more_btn').click(function(e) {
e.preventDefault();
  var content = $('.sec5_readmore');
  var button = $(this); // `this` refers to the clicked button

  if (content.height() === 256) {
      // Expand the content and change the button text
      content.css({"height": "auto", "-webkit-mask-image": "none"});
      button.text('Weniger lesen ➞'); // Change the button text
  } else {
      // Collapse the content and change the button text
      content.css({"height": "256px", "-webkit-mask-image": "linear-gradient(to bottom,#000 71%,rgba(0,0,0,0))"});
      button.text('Mehr lesen ➞'); // Change the button text
  }
});

$('.sec5-info_read_more_btn').click(function(e) {
  e.preventDefault();
    var content = $('.sec5-info_readmore');
    var button = $(this); // `this` refers to the clicked button
  
    if (content.height() === 253) {
        // Expand the content and change the button text
        content.css({"height": "100%", "-webkit-mask-image": "none"});
        button.text('Weniger lesen ➞'); // Change the button text
    } else {
        // Collapse the content and change the button text
        content.css({"height": "253px !important", "-webkit-mask-image": "linear-gradient(to bottom,#000 71%,rgba(0,0,0,0))"});
        button.text('Mehr lesen ➞'); // Change the button text
    }
  });

});

document.querySelectorAll(".accordion-item").forEach((item) => {
  item.querySelector(".accordion-item-header").addEventListener("click", () => {
    item.classList.toggle("open");
  });
});

document.querySelectorAll(".active").forEach((item) => {
    item.classList.toggle("open");
});


$(".before-after-slider #slider").on("input change", (e)=>{
  const sliderPos = e.target.value;
  // Update the width of the foreground image
  $('.foreground-img').css('width', `${sliderPos}%`)
  // Update the position of the slider button
  $('.before-after-slider .slider-button').css('left', `calc(${sliderPos}% - 28px)`)
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
        dots: true,
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
        slidesToShow: 5,
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
        slidesToShow: 2,
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




/*-mobile-menu-*/

function opencallb() {
  $("#ruckruf").removeClass("rd-show");
}

function closeCallb(){
  $("#ruckruf").addClass("rd-show");
}


$(document).ready(function() {
  var hasShownPopup = false; // To prevent the popup from appearing multiple times
  var popupShownBefore = localStorage.getItem('popupShown'); // Check if popup was shown before
  var popupEligible = false; // Flag to track when popup can be shown

  // After 10 seconds, allow the popup to be shown when mouse moves to the top
  setTimeout(function() {
      popupEligible = true; // Set eligibility for showing the popup after 10 seconds
  }, 5000);

  // Mousemove event listener
  $(document).on("mousemove", function(e) {
      // Check if mouse is near the top of the window, popup is allowed, and hasn't been shown yet
      if (e.clientY < 20 && !hasShownPopup && popupEligible && !popupShownBefore) {
          hasShownPopup = true; // Set flag to true to avoid showing again
          localStorage.setItem('popupShown', true); // Store status in local storage to avoid repeat popups
          opencallp(); // Function to show the popup
      }
  });
});


function opencallp() {
  $("#popup-f").removeClass("rd-show");
}


function closeCallp(){
  $("#popup-f").addClass("rd-show");
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




// Get the button
let topButt = document.querySelector('.topbutton');

// Show the button when the user scrolls down 20px from the top
window.onscroll = function() {
    scrollFunction();
};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        topButt.style.display = "block";
    } else {
        topButt.style.display = "none";
    }
}

// Scroll back to the top when the button is clicked
function scrollToTop() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}