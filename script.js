// This is script file




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


// cart

// product details


const allHoverImages = document.querySelectorAll('.hover-container div img');
const imgContainer = document.querySelector('.dtl-img-container');

window.addEventListener('DOMContentLoaded', () => {
    allHoverImages[0].parentElement.classList.add('active');
});

allHoverImages.forEach((image) => {
    image.addEventListener('mouseover', () =>{
        console.log('Mouseover event triggered');
        imgContainer.querySelector('img').src = image.src;
        resetActiveImg();
        image.parentElement.classList.add('active');
    });
});

function resetActiveImg(){
    allHoverImages.forEach((img) => {
        img.parentElement.classList.remove('active');
    });
}