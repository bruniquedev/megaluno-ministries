// Event delegation for dom added events
document.addEventListener('click', function(event) {
  //console.log("clicked for the model");
  var target = event.target;
  if(target.classList.contains("popup-light-btn") || target.closest(".popup-light-btn")) {
  let target_modal = target.getAttribute("data-target") || target.closest(".popup-light-btn").getAttribute("data-target");;
//console.log(target_modal);
     document.querySelector(target_modal).classList.add("show");
  
  }

   if(target.classList.contains("close-popup-light") || target.closest(".close-popup-light")) {
 var targetId = target.closest(".popup-light-overlay").attributes["id"].value;
closeThiscustom_modal(0,targetId);
}

});


//function to close all models
function closeThiscustom_modal(action = 0,target){
window.setTimeout(function () {
document.querySelector("#"+target).classList.remove("show");
}, 300);
}