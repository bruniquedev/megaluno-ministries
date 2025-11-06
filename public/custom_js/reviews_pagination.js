function initializePagination(containerId, recordsPerPage) {
  var current_page = 1;
  var l = document.querySelectorAll(`#${containerId} .single-review`).length;

  function prevPage() {
    if (current_page > 1) {
      current_page--;
      changePage(current_page);
    }
  }

  function nextPage() {
    if (current_page < numPages()) {
      current_page++;
      changePage(current_page);
    }
  }

  function changePage(page) {
    var btn_next = document.querySelector(`#${containerId} .btn_next_review`);
    var btn_prev = document.querySelector(`#${containerId} .btn_prev_review`);
    var listing_table = document.querySelectorAll(`#${containerId} .single-review`);
    var page_span = document.querySelector(`#${containerId} .page_review`);

    if (!page_span) return;

    // Validate page
    if (page < 1) page = 1;
    if (page > numPages()) page = numPages();

    for (var i = 0; i < l; i++) {
      listing_table[i].style.display = "none";
    }

    for (var i = (page - 1) * recordsPerPage; i < page * recordsPerPage; i++) {
      if (listing_table[i]) {
        listing_table[i].style.display = "block";
      } else {
        continue;
      }
    }

    page_span.innerHTML = page + "/" + numPages();

    btn_prev.style.visibility = page === 1 ? "hidden" : "visible";
    btn_next.style.visibility = page === numPages() ? "hidden" : "visible";
  }

  function numPages() {
    return Math.ceil(l / recordsPerPage);
  }

  // Attach event listeners to the buttons
  var prevButton = document.querySelector(`#${containerId} .btn_prev_review`);
  var nextButton = document.querySelector(`#${containerId} .btn_next_review`);

  if (prevButton) {
    prevButton.addEventListener("click", prevPage);
  }

  if (nextButton) {
    nextButton.addEventListener("click", nextPage);
  }

  // Initial page setup
  changePage(current_page);

  // Expose public methods or properties
  return {
    changePage: changePage,
    numPages: numPages
  };
}

// Usage
 if(document.getElementsByClassName('reviews-container')[0]!=null){
 var reviews_container = document.querySelectorAll(".reviews-container");
  for (var i = 0; i < reviews_container.length; i++) {
var ContentContainer = reviews_container[i];
 var target_id = ContentContainer.getAttribute("id");
 var target_maxItemsToShow = ContentContainer.getAttribute("data-items");

//console.log("target_id "+ target_id);
//console.log("target_maxItemsToShow "+ target_maxItemsToShow);

if(target_maxItemsToShow==null || target_maxItemsToShow==0 || isNaN(target_maxItemsToShow)){
target_maxItemsToShow=2;
}
if(target_id==null){
console.log("Id of the content is required on reviews-container class element");
}

//return;
initializePagination(target_id,target_maxItemsToShow);

 }

}