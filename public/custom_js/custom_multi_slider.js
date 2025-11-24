function createMultiSlider(containerId,IntervalSeconds) {
  let multicarouseltimeout;
  const sliderContainerToSwipe = document.querySelector(`#${containerId} .row-multislider-container`);
  let startX = 0;
let scrollStart = 0;
let isDragging = false;
let scrollLeft;

  function initializeMultiSlider() {
    if (document.getElementById(containerId) === null) return;
  
    if(IntervalSeconds > 0){
    moveNext();
    multicarouseltimeout = setTimeout(initializeMultiSlider, IntervalSeconds); 
     }

  }

  function showMultiSliderControls() {
    clearTimeout(multicarouseltimeout);

    var leftcontrol = document.querySelector(`#${containerId} .left-controlbtn`);
    leftcontrol.style.display = "block";
    leftcontrol.style.transform = "translate(10px)";
    leftcontrol.style.transition = "0.5s";
    var rightcontrol = document.querySelector(`#${containerId} .right-controlbtn`);
    rightcontrol.style.display = "block";
    rightcontrol.style.transform = "translate(-10px)";
    rightcontrol.style.transition = "0.5s";
  }

  function hideMultiSliderControls() {
    var leftcontrol = document.querySelector(`#${containerId} .left-controlbtn`);
    leftcontrol.style.display = "none";
    leftcontrol.style.transform = "translate(0px)";
    leftcontrol.style.transition = "0.5s";
    var rightcontrol = document.querySelector(`#${containerId} .right-controlbtn`);
    rightcontrol.style.display = "none";
    rightcontrol.style.transform = "translate(0px)";
    rightcontrol.style.transition = "0.5s";
     
     if(IntervalSeconds > 0){
    multicarouseltimeout = setTimeout(initializeMultiSlider, IntervalSeconds);
       }
  }


function moveNext() {
    if(IntervalSeconds > 0){
   clearTimeout(multicarouseltimeout);
      }
  const item = sliderContainerToSwipe.querySelector('.container-multislider');
  const itemWidth = item.offsetWidth;
  const visibleWidth = sliderContainerToSwipe.offsetWidth;
  const maxScroll = sliderContainerToSwipe.scrollWidth - visibleWidth;
  const scrolledLeft = sliderContainerToSwipe.scrollLeft;
  const scrollWidth = sliderContainerToSwipe.scrollWidth;
  const remainingScroll = scrollWidth - (scrolledLeft + visibleWidth);

  // Scroll by 1 item width, but don't exceed maxScroll
  sliderContainerToSwipe.scrollLeft = Math.min(
    sliderContainerToSwipe.scrollLeft + itemWidth,
    maxScroll
  );

 if (remainingScroll <= 5) {
    // Loop to beginning
    sliderContainerToSwipe.scrollLeft = 0;
  }

//console.log("maxScroll : " + maxScroll);
//console.log("remainingScroll : "+ remainingScroll);

}

function movePrev() {
   clearTimeout(multicarouseltimeout);
  const item = sliderContainerToSwipe.querySelector('.container-multislider');
  const itemWidth = item.offsetWidth;

  // Scroll back by 1 item width, but not less than 0
  sliderContainerToSwipe.scrollLeft = Math.max(
    sliderContainerToSwipe.scrollLeft - itemWidth,
    0
  );
}



//normal view swiping for desktops
sliderContainerToSwipe.addEventListener('mousedown', (e) => {
  isDragging = true;
  sliderContainerToSwipe.classList.add('dragging');
  startX = e.pageX - sliderContainerToSwipe.offsetLeft;
  scrollLeft = sliderContainerToSwipe.scrollLeft;
});

sliderContainerToSwipe.addEventListener('mouseleave', () => {
  isDragging = false;
  sliderContainerToSwipe.classList.remove('dragging');
});

sliderContainerToSwipe.addEventListener('mouseup', () => {
  isDragging = false;
  sliderContainerToSwipe.classList.remove('dragging');
});

sliderContainerToSwipe.addEventListener('mousemove', (e) => {
  if (!isDragging) return;
  e.preventDefault();
  const x = e.pageX - sliderContainerToSwipe.offsetLeft;
  const walk = (x - startX) * 1; // You can adjust speed multiplier
  sliderContainerToSwipe.scrollLeft = scrollLeft - walk;
});


//This is Mobile basic type of swiping and works well
/*
sliderContainerToSwipe.addEventListener('touchstart', (e) => {
  startX = e.touches[0].clientX;
  scrollStart = sliderContainerToSwipe.scrollLeft;
}, { passive: true });

sliderContainerToSwipe.addEventListener('touchend', (e) => {
  const endX = e.changedTouches[0].clientX;
  const diff = startX - endX;
  const itemWidth = sliderContainerToSwipe.querySelector('.container-multislider').offsetWidth + 10; // including margin

  if (Math.abs(diff) > 50) {
    if (diff > 0) {
      // swipe left
      sliderContainerToSwipe.scrollLeft = scrollStart + itemWidth;
    } else {
      // swipe right
      sliderContainerToSwipe.scrollLeft = scrollStart - itemWidth;
    }
  }
});*/

//Another type of swipping to support mobile where on finger move item moves along:
sliderContainerToSwipe.addEventListener('touchstart', (e) => {
  isDragging = true;
  startX = e.touches[0].pageX - sliderContainerToSwipe.offsetLeft;
  scrollLeft = sliderContainerToSwipe.scrollLeft;
});

sliderContainerToSwipe.addEventListener('touchend', () => {
  isDragging = false;
});

sliderContainerToSwipe.addEventListener('touchmove', (e) => {
  if (!isDragging) return;
  const x = e.touches[0].pageX - sliderContainerToSwipe.offsetLeft;
  const walk = (x - startX) * 1;
  sliderContainerToSwipe.scrollLeft = scrollLeft - walk;
});




  // Event listeners for mouseover and mouseout
  var multiCarousel = document.getElementById(containerId);
  if (multiCarousel !== null) {
    multiCarousel.addEventListener("mouseover", showMultiSliderControls);
    multiCarousel.addEventListener("mouseout", hideMultiSliderControls);
  }


   // Attach event listeners to the buttons
  var leftControlBtn = document.querySelector(`#${containerId} .left-controlbtn`);
  var rightControlBtn = document.querySelector(`#${containerId} .right-controlbtn`);

  if (leftControlBtn && rightControlBtn) {
    leftControlBtn.addEventListener('click', movePrev);
    rightControlBtn.addEventListener('click', moveNext);
  }




  // Initial call to start the slider
  initializeMultiSlider();

  // Expose public methods or properties
  return {
    initializeMultiSlider: initializeMultiSlider,
    showMultiSliderControls: showMultiSliderControls,
    hideMultiSliderControls: hideMultiSliderControls,
    moveNext: moveNext,
    movePrev: movePrev,

  };
}


document.addEventListener('DOMContentLoaded', function() {
// Usage
 if(document.getElementsByClassName('multi-carousel')[0]!=null){
 var multicarousels = document.querySelectorAll(".multi-carousel");
  for (var i = 0; i < multicarousels.length; i++) {
var multicarouselContainer = multicarousels[i];
 var target_id = multicarouselContainer.getAttribute("id");
 var target_seconds = parseInt(multicarouselContainer.getAttribute("data-seconds")) * 1000;

if(target_seconds==null || target_seconds==0 || isNaN(target_seconds)){
target_seconds=0;
}
if(target_id==null){
//console.log("Id of the multi carousel is required on multi-carousel class element");
}

//console.log("target_id "+ target_id);
//console.log("target_seconds "+ target_seconds);

createMultiSlider(target_id,target_seconds);

 }
//console.log("Multi-slider is visible");
}

});