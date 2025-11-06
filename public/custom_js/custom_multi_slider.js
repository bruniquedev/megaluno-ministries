function createMultiSlider(containerId,IntervalSeconds) {
  var right = 0;
  var maxMargin;
  var jumpMargin = 150;
  let multicarouseltimeout;

  function initializeMultiSlider() {
    if (document.getElementById(containerId) === null) return;

var boxwidth = document.querySelector(`#${containerId} .container-multislider`).offsetWidth;
var displaywidth = document.querySelector(`#${containerId} .row-multislider`).offsetWidth;
var children = document.querySelectorAll(`#${containerId} .row-multislider-container > .container-multislider`).length;
var outerboxwidth = children * boxwidth + (children * 10);
    document.querySelector(`#${containerId} .row-multislider-container`).style.width = "100%";
    maxMargin = outerboxwidth-displaywidth;
    //console.log("boxwidth : "+boxwidth + " displaywidth : "+displaywidth + " children : "+children + " outerboxwidth : "+outerboxwidth + " maxMargin : "+maxMargin);
    var rowcont = document.querySelector(`#${containerId} .row-multislider-container`);
    if (right <= -maxMargin) {
      right = 0; //reset back to 0
      //console.log(right + " right <= -maxMargin " + maxMargin);
    }else{
      right -= jumpMargin;
      //console.log(right + " right > -maxMargin " + maxMargin);
    }
  
    if(IntervalSeconds > 0){
    rowcont.style.marginLeft = right + "px";
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

  function slideLeft() {
    clearTimeout(multicarouseltimeout);
    var rowcont = document.querySelector(`#${containerId} .row-multislider-container`);
    if (right <= -maxMargin) {
      right = 0; //reset back to 0
    } else {
      right -= jumpMargin;
    }
    rowcont.style.marginLeft = right + "px";
  }

  function slideRight() {
    clearTimeout(multicarouseltimeout);
    var rowcont = document.querySelector(`#${containerId} .row-multislider-container`);
    if (right == 0) {
      right = -jumpMargin;
    } else if (right >= maxMargin) {
    } else {
      right += jumpMargin;
    }
    rowcont.style.marginLeft = right + "px";
  }

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
    leftControlBtn.addEventListener('click', slideRight);
    rightControlBtn.addEventListener('click', slideLeft);
  }



  // Initial call to start the slider
  initializeMultiSlider();

  // Expose public methods or properties
  return {
    initializeMultiSlider: initializeMultiSlider,
    showMultiSliderControls: showMultiSliderControls,
    hideMultiSliderControls: hideMultiSliderControls,
    slideLeft: slideLeft,
    slideRight: slideRight,
  };
}

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
console.log("Id of the multi carousel is required on multi-carousel class element");
}

//console.log("target_id "+ target_id);
//console.log("target_seconds "+ target_seconds);

createMultiSlider(target_id,target_seconds);

 }

}
