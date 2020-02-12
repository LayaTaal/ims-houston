let slideInterval;
const toggleConrols = document.querySelectorAll('.zinnfinity-toggle-control');

function getSlides() {
  // Get slider container
  const slider = document.querySelector('.zinnfinity-slider');
  const slides = slider.querySelectorAll('.zinnfinity-slider__slide');
  const toggleControls = slider
    .querySelector('.zinnfinity-slider__toggle-slides')
    .querySelectorAll('span');
  let activeSlide;

  // Get index of active slide
  slides.forEach((slide, index) => {
    if (slide.classList.contains('active')) {
      activeSlide = index;
    }
  });

  // Return active slide index
  return {
    slides,
    toggleControls,
    activeSlide,
  };
}

function previousSlide() {
  // Contains an object containing an array of slide DOM elements and the active slide index
  const slider = getSlides();
  const { slides, activeSlide, toggleControls } = slider;

  // Reset the active slide to the last slide, otherwise go to the previous slide
  if (activeSlide === 0) {
    slides[activeSlide].classList.remove('active');
    slides[slides.length - 1].classList.add('active');

    toggleControls[activeSlide].classList.remove('active');
    toggleControls[0].classList.add('active');
  } else {
    slides[activeSlide].classList.remove('active');
    slides[activeSlide - 1].classList.add('active');

    toggleControls[activeSlide].classList.remove('active');
    toggleControls[activeSlide - 1].classList.add('active');
  }
}

function nextSlide() {
  // Contains an object containing an array of slide DOM elements and the active slide index
  const slider = getSlides();
  const { slides, activeSlide, toggleControls } = slider;

  // Reset the active slide to the first slide, otherwise go to the next slide
  if (activeSlide === slides.length - 1) {
    slides[activeSlide].classList.remove('active');
    slides[0].classList.add('active');

    toggleControls[activeSlide].classList.remove('active');
    toggleControls[0].classList.add('active');
  } else {
    slides[activeSlide].classList.remove('active');
    slides[activeSlide + 1].classList.add('active');

    toggleControls[activeSlide].classList.remove('active');
    toggleControls[activeSlide + 1].classList.add('active');
  }
}

console.log(toggleConrols);
toggleConrols.forEach((control, slideIndex) => {
  control.addEventListener('click', () => {
    clearInterval(slideInterval);

    // Contains an object containing an array of slide DOM elements and the active slide index
    const slider = getSlides();
    const { slides, activeSlide, toggleControls } = slider;

    slides[activeSlide].classList.remove('active');
    slides[slideIndex].classList.add('active');

    toggleControls[activeSlide].classList.remove('active');
    toggleControls[slideIndex].classList.add('active');
  });
});

function playSlides() {
  slideInterval = setInterval(nextSlide, 3000);
}

window.onload = function() {
  const slider = document.querySelector('.zinnfinity-slider');
  const slides = slider.querySelectorAll('.zinnfinity-slider__slide');
  const toggleControls = slider.querySelector(
    '.zinnfinity-slider__toggle-slides'
  );

  slides[0].classList.add('active');
  toggleControls.querySelectorAll('span')[0].classList.add('active');

  // Start animation
  playSlides();
};
