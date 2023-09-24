</main>
<footer class="footer">
  <div class="footer__addr">
    <h1 class="footer__logo">Luxe</h1>
        
    <h2>Contact</h2>
    
    <address>
      10308 Nakuru. Kenya 22193-10212<br>
          
      <a class="footer__btn" href="mailto:example@gmail.com">Email Us</a>
    </address>
  </div>
  
  <ul class="footer__nav">
    <li class="nav__item">
      <h2 class="nav__title">Media</h2>

      <ul class="nav__ul">
        <li>
          <a href="#">Online</a>
        </li>

        <li>
          <a href="#">Print</a>
        </li>
            
        <li>
          <a href="#">Alternative Ads</a>
        </li>
      </ul>
    </li>
    
    <li class="nav__item nav__item--extra">
      <h2 class="nav__title">Our Products</h2>
      
      <ul class="nav__ul nav__ul--extra">
        <li>
          <a href="#">Hair Products</a>
        </li>
        
        <li>
          <a href="#">Hair Extensions</a>
        </li>
        
        <li>
          <a href="#">Brazilian Wig</a>
        </li>
        
        <li>
          <a href="#">Manicure</a>
        </li>
        
        <li>
          <a href="#">Pedicure</a>
        </li>
        
        <li>
          <a href="#">IoT</a>
        </li>
      </ul>
    </li>
    
    <li class="nav__item">
      <h2 class="nav__title">Legal</h2>
      
      <ul class="nav__ul">
        <li>
          <a href="#">Privacy Policy</a>
        </li>
        
        <li>
          <a href="#">Terms of Use</a>
        </li>
        
        <li>
          <a href="#">Sitemap</a>
        </li>
      </ul>
    </li>
  </ul>
  
  <div class="legal">
    <p>&copy; 2023 Matagaro. All rights reserved.</p>
    
    <div class="legal__links">
      <span>Made with <span class="heart">♥</span> remotely from Anywhere</span>
    </div>
  </div>
</footer>








    <script>
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
}); //end ready



    </script>
    <!--   *****   JQuery Link   *****   -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<!--   *****   Owl Carousel js Link  *****  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!--   *****   Link To Custom Script File   *****   -->
<script type="text/javascript" src="script.js"></script>

</body>
</html>