// Анимации при скролле.
AOS.init(); 


var swiper;

// Слайдер
document.addEventListener('DOMContentLoaded', function() {
    swiper = new Swiper('.swiper', {
        pagination: {
            el: '.swiper-pagination',            
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
});

// меню гамбургер
document.getElementById("burger").addEventListener("click", function() {
    document.querySelector(".header").classList.toggle("open")
});

function remove_class() {
    document.querySelector(".header").classList.remove("open");
}

// анимация при скролле

window.addEventListener('scroll', function() {
    var scrollheight = window.pageYOffset;
    console.log(scrollheight);

    if (scrollheight >= 300) {
        document.querySelector('.slider-gallery').classList.add('animated');
    }
});




var typed = new Typed('.typed', {
    strings: ["Designer", "Developer"],
    typeSpeed: 100,
    backDelay: 1000,
  });
