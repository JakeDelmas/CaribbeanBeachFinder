var slideIndex = 1;
function makeSlider(beachname) {
    showSlides(slideIndex, beachname);
}

function plusSlides(n, beachname) {
  showSlides(slideIndex += n, beachname);
}

function currentSlide(n, beachname) {
  showSlides(slideIndex = n, beachname);
}

function showSlides(n, beachname) {
  var i;
  var slides = document.getElementsByClassName(beachname);
    console.log(slides.length);
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1} 
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none"; 
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block"; 
  dots[slideIndex-1].className += " active";
}