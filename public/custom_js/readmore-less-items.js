function ReadMoreToggle(containerId, maxItemsToShow) {
  var container = document.getElementById(containerId);
  var items = container.getElementsByClassName('item');
    var button = container.querySelector('.read-more-less-btn');

  var showAll = false;

  // Initialize styles
  container.style.overflow = 'hidden';

  // Apply styles to items
  for (var i = 0; i < items.length; i++) {
    items[i].style.display = 'none';
    if (i < maxItemsToShow) {
      items[i].style.display = 'block';
    }
  }

  // Create and append the "Read More" button
  button.textContent = 'Read More';
  container.parentNode.insertBefore(button, container.nextSibling);

  // Toggle function
  function toggleContentMoreLess() {
    showAll = !showAll;

    for (var i = 0; i < items.length; i++) {
      items[i].style.display = showAll ? 'block' : (i < maxItemsToShow ? 'block' : 'none');
    }

    button.textContent = showAll ? 'Read Less' : 'Read More';
  }

  // Attach click event to the button
  button.addEventListener('click', toggleContentMoreLess);

  // Expose a function to toggle content externally if needed
  this.toggleContentMoreLess = toggleContentMoreLess;
}


// Usage
 if(document.getElementsByClassName('read-more-less')[0]!=null){
 var read_content = document.querySelectorAll(".read-more-less");
  for (var i = 0; i < read_content.length; i++) {
var ContentContainer = read_content[i];
 var target_id = ContentContainer.getAttribute("id");
 var target_maxItemsToShow = ContentContainer.getAttribute("data-items");

//console.log("target_id "+ target_id);
//console.log("target_maxItemsToShow "+ target_maxItemsToShow);

if(target_maxItemsToShow==null || target_maxItemsToShow==0 || isNaN(target_maxItemsToShow)){
target_maxItemsToShow=2;
}
if(target_id==null){
console.log("Id of the content is required on read-more-less class element");
}

//return;
ReadMoreToggle(target_id,target_maxItemsToShow);

 }

}