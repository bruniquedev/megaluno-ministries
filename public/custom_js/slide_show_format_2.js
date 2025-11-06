var slideIndex = 0;
let slidertimeout;
var slider_delay = 6000;// setTimeout to run after 6seconds

 if(document.getElementById('slideshow-container_G')!=null){
showSlides(slideIndex);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides_G");
  var dots = document.getElementsByClassName("dot_G");
 
   if (typeof n === 'number'){//check if it's a number
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = 1}    
  //if (n < 1) {slideIndex = slides.length}
}else{
  //it's not a number
    slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}  
}

  //console.log("slideIndex : "+slideIndex);
  //console.log("n : "+n);

  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active_G", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active_G";


// animation will start after page load
slidertimeout = setTimeout(() => {
    showSlides();//call this function to run after 6seconds(6000)
}, slider_delay);

}

function plusSlides(n) {
   //stop transition to nxt
clearTimeout(slidertimeout);
  showSlides(slideIndex += n);
}

function currentSlide(n) {
     //stop transition to nxt
clearTimeout(slidertimeout);
  showSlides(slideIndex = n);
}

/*onmouseover
onmouseout*/

 if(document.getElementById('slideshow-container_G')!=null){
 document.getElementById("slideshow-container_G").addEventListener('mouseover', function (){
   //console.log("onmouseover");
  clearTimeout(slidertimeout);
  }, false);
/*document.getElementById("slideshow-container_G").addEventListener('mouseout', function (){
   //console.log("onmouseout");
  showSlides();
  }, false);*/
}