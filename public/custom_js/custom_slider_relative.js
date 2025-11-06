let myIndex = 0;
let carouselTimeout;
const slides = document.getElementsByClassName("mySlides");
const sliderDots = document.getElementsByClassName("slider-indicator-dot");
const delay = 6000;

function carousel() {
    if (slides.length === 0) return;

    hideSlides();
    myIndex++;

    if (myIndex > slides.length) {
        myIndex = 1;
        setCurrentDot(myIndex);
    }

    showSlide(myIndex - 1);

    carouselTimeout = setTimeout(() => {
        carousel();
    }, delay);
}

function hideSlides() {
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
}

function showSlide(index) {
    hideSlides();
    slides[index].style.display = "block";
    setCurrentDot(index);
}

function showControls() {
    clearTimeout(carouselTimeout);

    const leftControl = document.getElementsByClassName("slider_left_button")[0];
    const rightControl = document.getElementsByClassName("slider_right_button")[0];

    leftControl.style.display = "block";
    leftControl.style.transform = "translate(10px)";
    leftControl.style.transition = "0.5s";

    rightControl.style.display = "block";
    rightControl.style.transform = "translate(-10px)";
    rightControl.style.transition = "0.5s";
}

function hideControls() {
    const leftControl = document.getElementsByClassName("slider_left_button")[0];
    const rightControl = document.getElementsByClassName("slider_right_button")[0];

    leftControl.style.display = "none";
    leftControl.style.transform = "translate(0px)";
    leftControl.style.transition = "0.5s";

    rightControl.style.display = "none";
    rightControl.style.transform = "translate(0px)";
    rightControl.style.transition = "0.5s";

    carouselTimeout = setTimeout(() => {
        carousel();
    }, delay);
}

function previous() {
    clearTimeout(carouselTimeout);
    myIndex--;

    if (myIndex > slides.length) {
        myIndex = 1;
    }

    if (myIndex < 1) {
        myIndex = slides.length;
    }

    showSlide(myIndex - 1);
}

function next() {
    clearTimeout(carouselTimeout);
    myIndex++;

    if (myIndex > slides.length) {
        myIndex = 1;
    }

    showSlide(myIndex - 1);
}

function setCurrentDot(index) {
    for (let i = 0; i < sliderDots.length; i++) {
        sliderDots[i].className = sliderDots[i].className.replace(" active-slide", "");
    }

    sliderDots[index].className += " active-slide";
}

// Event listeners for controls
const previousBtn = document.getElementsByClassName("slider_left_button")[0];
const nextBtn = document.getElementsByClassName("slider_right_button")[0];

if (previousBtn && nextBtn) {
    previousBtn.addEventListener("click", previous);
    nextBtn.addEventListener("click", next);
}

// Event listeners for dots
for (let i = 0; i < sliderDots.length; i++) {
    sliderDots[i].addEventListener('click', function () {
        const index = this.getAttribute('data-index');
        showSlide(index);
        setCurrentDot(index);
    }, false);
}

// Start the carousel
carousel();
