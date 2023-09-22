// This is script file

$('.testimonials-container').owlCarousel({
    loop:true,
    autoplay:true,
    autoplayTimeout:6000,
    margin:10,
    nav:true,
    navText:["<i class='fa-solid fa-arrow-left'></i>",
             "<i class='fa-solid fa-arrow-right'></i>"],
    responsive:{
        0:{
            items:1,
            nav:false
        },
        600:{
            items:1,
            nav:true
        },
        768:{
            items:2
        },
    }
})


const toggleBtn = document.querySelector('.toggle_btn');
const toggleBtnIcon = document.querySelector('.toggle_btn i');
const dropDownMenu = document.querySelector('.dropdown_menu');

toggleBtn.onclick = function(){
    dropDownMenu.classList.toggle('open')
    const isOpen = dropDownMenu.classList.contains('open');

    toggleBtnIcon.classList = isOpen
    ?'fa-solid fa-xmark'
    :'fa-solid fa-bars'
} 


 // Variables for the carousel
const slides = document.querySelectorAll('.carousel-slide');
let currentSlide = 0;

// Function to show the current slide and hide the others
function showSlide(index) {
slides.forEach((slide, i) => {
if (i === index) {
slide.style.display = 'flex';
} else {
slide.style.display = 'none';
}
});
}

// Function to advance to the next slide
function nextSlide() {
currentSlide++;
if (currentSlide >= slides.length) {
currentSlide = 0;
}
showSlide(currentSlide);
}

// Automatically advance to the next slide every 5 seconds
setInterval(nextSlide, 5000);

// Initially show the first slide
showSlide(currentSlide);

jQuery(document).ready(function ($) {
var feedbackSlider = $(".feedback-slider");
feedbackSlider.owlCarousel({
items: 1,
nav: true,
dots: true,
autoplay: true,
loop: true,
mouseDrag: true,
touchDrag: true,
navText: [
    "<i class='fa fa-long-arrow-left'></i>",
    "<i class='fa fa-long-arrow-right'></i>"
],
responsive: {
    // breakpoint from 767 up
    767: {
        nav: true,
        dots: false
    }
}
});

feedbackSlider.on("translate.owl.carousel", function () {
$(".feedback-slider-item h3")
    .removeClass("animated fadeIn")
    .css("opacity", "0");
$(".feedback-slider-item img, .feedback-slider-thumb img, .customer-rating")
    .removeClass("animated zoomIn")
    .css("opacity", "0");
});

feedbackSlider.on("translated.owl.carousel", function () {
$(".feedback-slider-item h3").addClass("animated fadeIn").css("opacity", "1");
$(".feedback-slider-item img, .feedback-slider-thumb img, .customer-rating")
    .addClass("animated zoomIn")
    .css("opacity", "1");
});
feedbackSlider.on("changed.owl.carousel", function (property) {
var current = property.item.index;
var prevThumb = $(property.target)
    .find(".owl-item")
    .eq(current)
    .prev()
    .find("img")
    .attr("src");
var nextThumb = $(property.target)
    .find(".owl-item")
    .eq(current)
    .next()
    .find("img")
    .attr("src");
var prevRating = $(property.target)
    .find(".owl-item")
    .eq(current)
    .prev()
    .find("span")
    .attr("data-rating");
var nextRating = $(property.target)
    .find(".owl-item")
    .eq(current)
    .next()
    .find("span")
    .attr("data-rating");
$(".thumb-prev").find("img").attr("src", prevThumb);
$(".thumb-next").find("img").attr("src", nextThumb);
$(".thumb-prev")
    .find("span")
    .next()
    .html(prevRating + '<i class="fa fa-star"></i>');
$(".thumb-next")
    .find("span")
    .next()
    .html(nextRating + '<i class="fa fa-star"></i>');
});
$(".thumb-next").on("click", function () {
feedbackSlider.trigger("next.owl.carousel", [300]);
return false;
});
$(".thumb-prev").on("click", function () {
feedbackSlider.trigger("prev.owl.carousel", [300]);
return false;
});
}); 