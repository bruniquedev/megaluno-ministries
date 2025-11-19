
//initialise tabs
 /*if(document.getElementsByClassName('light-box-launch')!=null){
window.addEventListener(
    "load",
    Initialise_lightbox_launchers,
    false
);
}*/
/*function Initialise_lightbox_launchers() {

  var light_launches = document.getElementsByClassName("light-box-launch");
  for (var i = 0; i < light_launches.length; i++) {

    light_launches[i].addEventListener('click', ((index) => {       
        return function() {
          //open
          openLightModal(this);
         // console.log(index);
        }
      })(i)
    )
  }

}*/

/*
solution to  prevent multiple clicks i call Initialise function to add event listeners()
 whenever i add an element into the dom by javascript, because i want the newly added 
 element to get initialised by the  event too
To address the challenge of initializing newly added elements with the event,
 you can delegate the event handling to a parent element that is already
  present in the DOM. By doing so, the newly added elements will automatically
   inherit the event listeners from their parent, and you won't have to reinitialize
    the event listeners for each new element.
*/
// Event delegation for dom added events
document.addEventListener('click', function(event) {
  var target = event.target;



/////////////targeting  for preview//////
  //if(target.classList.contains("light-box-preview-product")) {
   if(target.closest(".light-box-preview")) {
 var element = target.closest(".light-box-preview");

 //console.log(element);

     

      openLightModal(element);

  }
   /////////////targeting for preview//////



  });




function openLightModal(elem) {

var images = elem.getAttribute("data-images");
var text_desc = elem.getAttribute("data-desc");
var captionText = document.getElementById("light-caption");

var parentElement_slides = document.getElementById('light-slides-contents');
var parentElement_columns = document.getElementById('light-columns-contents');
//console.log(images);
var images_array = images.split(',');
var counter=1;

     var elem1 = document.createElement('span');
    elem1.setAttribute('class', 'm-r-10 m-l-10');
    elem1.innerHTML=text_desc;
   captionText.innerHTML="";
   //inserts elements at the end in the parent
    captionText.appendChild(elem1);




for(var i = 0; i < images_array.length; i++) {
   // Trim the excess whitespace.
   images_array[i] = images_array[i].replace(/^\s*/, "").replace(/\s*$/, "");
   // Add additional code here, such as:
   //console.log(images_array[i]);
//creating elements


    var newElement1 = document.createElement('div');
    newElement1.setAttribute('class', 'light-slide');

     var newElement2 = document.createElement('div');
    newElement2.setAttribute('class', 'light-numbertext');
    newElement2.innerHTML =counter+"/"+images_array.length;

        var newElement3 = document.createElement('img');
    newElement3.setAttribute('src', images_array[i]);
    newElement3.setAttribute('alt', text_desc);
    
    newElement1.appendChild(newElement2);//put inside this newElement1
     newElement1.appendChild(newElement3);//put inside this newElement1
      parentElement_slides.appendChild(newElement1);

      //thumbnails at the end
  var newElement4 = document.createElement('div');
    newElement4.setAttribute('class', 'light-column');

       var newElement5 = document.createElement('img');
       newElement5.setAttribute('class', 'light-demo light-cursor');
    newElement5.setAttribute('src', images_array[i]);
    newElement5.setAttribute('alt', text_desc);
    newElement5.setAttribute('style', 'width:100%');
     newElement5.setAttribute('onclick', 'currentLightSlide('+counter+')');

     newElement4.appendChild(newElement5);//put inside this newElement4

 parentElement_columns.appendChild(newElement4);//inserts elements at the end in the parent

counter++;
}
showLightSlides(counter);
  //currentLightSlide(1)
  document.getElementById("light-box-Modal").style.display = "block";
}

function closeLightModal() {

 document.getElementById('light-slides-contents').innerHTML="";
document.getElementById('light-columns-contents').innerHTML="";
  document.getElementById("light-box-Modal").style.display = "none";
}

var lightslideIndex = 1;
//showLightSlides(lightslideIndex);

function LightplusSlides(index) {
  previewLightSlides(index++);
}

function currentLightSlide(n) {
  showLightSlides(lightslideIndex = n);
}

function showLightSlides(n) {
  var i;
  var slides = document.getElementsByClassName("light-slide");
  var dots = document.getElementsByClassName("light-demo");
  var captionText = document.getElementById("light-caption");
  if (n > slides.length) {lightslideIndex = 1}
  if (n < 1) {lightslideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" light-active", "");
  }
  slides[lightslideIndex-1].style.display = "block";
  dots[lightslideIndex-1].className += " light-active";
  //captionText.innerHTML = dots[lightslideIndex-1].alt;
}

function previewLightSlides(index) {
  let slides = document.getElementsByClassName("light-box-preview");
  console.log("index = "+ index);
  if(slides){
     if (index >= slides.length) {lightslideIndex = 0}
  if (index <= 1) {lightslideIndex = index-1}

console.log(lightslideIndex);

  let slide = document.getElementsByClassName("light-box-preview")[lightslideIndex];

   openLightModal(slide);
 }

}