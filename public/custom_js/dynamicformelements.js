window.addEventListener('load', function() {
InitialiseCreateDynamicTable();

      });

function InitialiseCreateDynamicTable(){


function createDynamicTable(tableElement) {
    const tbody = tableElement.querySelector('tbody');

    // Add event listener to the checkbox in the thead
const checkAllCheckbox = tableElement.querySelector('.dynam-checkAll');
if(checkAllCheckbox){
checkAllCheckbox.addEventListener('change', () => {
    const tbodyCheckboxes = tbody.querySelectorAll('td input[type="checkbox"]');
    tbodyCheckboxes.forEach(checkbox => {
        checkbox.checked = checkAllCheckbox.checked; // Set the checked state of each checkbox in tbody
        markRowAsChecked(checkbox);
    });
});
   }


   // Update order numbers for existing rows after the page is loaded
    updateOrderNumbers();

    function addRow() {
        const inputObjects = JSON.parse(tbody.getAttribute('data-inputs'));

        const newRow = document.createElement('tr');

        // Create a checkbox as the first cell in the row
        const checkboxCell = document.createElement('td');
        const checkbox = document.createElement('input');
        checkbox.setAttribute('type', 'checkbox');
        checkbox.addEventListener('change', () => {
        markRowAsChecked(checkbox);
        });
        const inputHidden = document.createElement('input');
        inputHidden.setAttribute('type', 'hidden');
        inputHidden.setAttribute('name', tbody.getAttribute('data-idname')+"[]");
        inputHidden.setAttribute('value', '0');
        const inputOrderSortHidden = document.createElement('input');
        inputOrderSortHidden.classList.add("ordersortinput");
        inputOrderSortHidden.setAttribute('type', 'hidden');
        inputOrderSortHidden.setAttribute('name', tbody.getAttribute('data-ordersortname')+"[]");
        inputOrderSortHidden.setAttribute('value', '0');
        checkboxCell.appendChild(checkbox);
        checkboxCell.appendChild(inputHidden);
        checkboxCell.appendChild(inputOrderSortHidden);
        newRow.appendChild(checkboxCell);

        // Create cells for other inputs
        inputObjects.forEach(inputObj => {
            const cell = document.createElement('td');
            const input = createInput(inputObj);
            cell.appendChild(input);
            newRow.appendChild(cell);
        });

        // Create a cell for the remove button
    const removeButtonCell = document.createElement('td');
    const removeButton = document.createElement('button');
         removeButton.setAttribute('type','button');
         removeButton.classList.add("btn-ui", "btn-ui-xs", "btn-ui-danger");
          //removeButton.textContent = 'Remove';
    var removeIcon = document.createElement("i");
        removeIcon.classList.add("ion", "ion-android-delete");
        removeButton.appendChild(removeIcon);
    removeButton.addEventListener('click', () => {
        removeRow(newRow);
    });
    removeButtonCell.appendChild(removeButton);
    newRow.appendChild(removeButtonCell);

        // Insert new row after the checked row, if any
        const checkedRow = tbody.querySelector('tr.checked');
        if (checkedRow) {
            checkedRow.parentNode.insertBefore(newRow, checkedRow.nextSibling);
        } else {
            tbody.appendChild(newRow);
        }

        updateOrderNumbers();
    }

function createInput(inputObj) {
    const inputTypes = ['text', 'textarea', 'select', 'date', 'time', 'email', 'number', 'file', 'CaptureCam'];

    if (!inputTypes.includes(inputObj.type)) {
        console.error(`Unsupported input type: ${inputObj.type}`);
        return null; // Return null for unsupported input types
    }

    // For text, textarea, date, time, email, and number types, files
    if (['text', 'textarea', 'date', 'time', 'email', 'number', 'file'].includes(inputObj.type)) {
        const input = document.createElement(inputObj.type === 'textarea' ? 'textarea' : 'input'); // Create input or textarea element
        if (inputObj.type !== 'textarea') {
            input.setAttribute('type', inputObj.type); // Set input type attribute
        }
        Object.entries(inputObj.attributes).forEach(([attr, value]) => { // Iterate over attributes
            input.setAttribute(attr, value); // Set each attribute on the input element
        });

          if(inputObj.type === 'file')
        return createFileUploadElementsContainer(input); // Return the created input element
         else
        return createElementsContainers(input); // Return the created input element
    }

    // For capture camera only
    if (inputObj.type === 'CaptureCam') {
        const input = document.createElement('a'); // Create (a) anchor tag
        Object.entries(inputObj.attributes).forEach(([attr, value]) => { // Iterate over attributes
            input.setAttribute(attr, value); // Set each attribute on the input element
        });
        return createCapturebuttonElements(input); // Return the created input element
    }

    // For select inputs
    if (inputObj.type === 'select') {
        const input = document.createElement('select'); // Create select element
        Object.entries(inputObj.attributes).forEach(([attr, value]) => { // Iterate over attributes
            if (attr === 'options') { // Handle options separately
                value.forEach(option => { // Iterate over options
                    const optionElement = document.createElement('option'); // Create option element
                    optionElement.setAttribute('value', option.value); // Set value attribute
                    optionElement.textContent = option.text; // Set text content
                    input.appendChild(optionElement); // Append option to select
                });
            } else {
                input.setAttribute(attr, value); // Set other attributes
            }
        });
        return createElementsContainers(input); // Return the created input element
    }

    }
    
    function createElementsContainers(input) {
        // Create the form group container
        var formGroup = document.createElement("div");
        formGroup.classList.add("form-groupy");

        // Create the label for the text input
        var label = document.createElement("label");
        label.setAttribute("for", input.getAttribute('label'));
        label.textContent = input.getAttribute('label');

        // Create the div for the form input group
        var formInputGroup = document.createElement("div");
        formInputGroup.classList.add("form-input-group");

        // Create the text input element
      
        // Append elements to their respective parents
        formInputGroup.appendChild(input);
        formGroup.appendChild(label);
        formGroup.appendChild(formInputGroup);

        // Append the form group to the document body
        //document.body.appendChild(formInputGroup);
        return formGroup;//// Return the created element
    }
    
     function createFileUploadElementsContainer(fileInput) {


        // Create the form group container
        var formGroup = document.createElement("div");
        formGroup.classList.add("form-groupy");

        // Create the input label
        var inputLabel = document.createElement("div");
        inputLabel.classList.add("input_label");
        inputLabel.textContent = fileInput.getAttribute('label');

        // Create the label for the file input
        var fileInputSpan = document.createElement("span");
        fileInputSpan.classList.add("btn-upload-1", "btn-upload-file-1", "btn-ui-black");

        // Create the upload icon
        var uploadIcon = document.createElement("i");
        uploadIcon.classList.add("ion", "ion-upload", "left");

        // Create the text for the label
        var labelText = document.createTextNode("Select");

         //create  a previewer
        var customImgDiv = document.createElement("div");
        customImgDiv.setAttribute("class", "custom-img-previewer");
        customImgDiv.style.width = "40px";
        customImgDiv.style.height = "40px";

        //create  a previewer close btn
        var imgCloseBtn = document.createElement("span");
            imgCloseBtn.classList.add("close-img-btn");
            imgCloseBtn.setAttribute("data-id", "0");
            imgCloseBtn.setAttribute("data-table", "no");
            imgCloseBtn.setAttribute("data-column", "no");
            imgCloseBtn.setAttribute("data-route", "no");
            imgCloseBtn.textContent="x";

             //create  an open link div
        var openlinkDiv = document.createElement("div");
        openlinkDiv.setAttribute("class", "view-file-btn");
        var openlink = document.createElement("a");
        openlink.setAttribute("href", "javascript:void(0);");
        openlink.setAttribute("class", "custom-file-opener");
        openlink.setAttribute("target", "_blank");
        openlink.textContent="open";

            //create  a large previewer
        var previewLargeImgDiv = document.createElement("div");
        previewLargeImgDiv.setAttribute("class", "img-previewerPopover");

        // Create the file input element

        // Append elements to their respective parents
        fileInputSpan.appendChild(uploadIcon);
        fileInputSpan.appendChild(labelText);
        fileInputSpan.appendChild(fileInput);
        customImgDiv.appendChild(imgCloseBtn);
        openlinkDiv.appendChild(openlink);
        customImgDiv.appendChild(openlinkDiv);
        customImgDiv.appendChild(previewLargeImgDiv);
        formGroup.appendChild(inputLabel);
        formGroup.appendChild(fileInputSpan);
        formGroup.appendChild(customImgDiv);

        // Append the form group to the document body
       // document.body.appendChild(formGroup);
         return formGroup;//// Return the created element
    }

     function createCapturebuttonElements(linkbtn) {

         // Create the outer div with class "flex"
        var flexDiv = document.createElement("div");
        flexDiv.classList.add("flex");

        // Create the form group container
        var formGroup = document.createElement("div");
        formGroup.classList.add("form-groupy", "capturebtn-w", "m-b-0");

        // Create the input label
        var inputLabel = document.createElement("div");
        inputLabel.classList.add("input_label");
        inputLabel.textContent = linkbtn.getAttribute('label');

        // Create the hidden input field for capturing cv
        var hiddenInput = document.createElement("input");
        hiddenInput.setAttribute("type", "hidden");
        hiddenInput.setAttribute("name", linkbtn.getAttribute('data-hiddeninputid')+"[]");
        hiddenInput.setAttribute("id", linkbtn.getAttribute('data-hiddeninputid'));
        hiddenInput.classList.add("input-control");

        // Append elements to their respective parents
        linkbtn.textContent = "launch camera";
        formGroup.appendChild(inputLabel);
        formGroup.appendChild(linkbtn);
        formGroup.appendChild(hiddenInput);

         // Create the div for custom image with class "cv-img"
        var customImgDiv = document.createElement("div");
        customImgDiv.setAttribute("class", "custom-img-previewer");
        customImgDiv.classList.add(linkbtn.getAttribute('data-output'));
        customImgDiv.style.width = "60px";
        customImgDiv.style.height = "50px";

         //create  a previewer close btn
        var imgCloseBtn = document.createElement("span");
            imgCloseBtn.classList.add("close-img-btn");
            imgCloseBtn.setAttribute("data-id", "0");
            imgCloseBtn.setAttribute("data-table", "no");
            imgCloseBtn.setAttribute("data-column", "no");
            imgCloseBtn.setAttribute("data-route", "no");
            imgCloseBtn.textContent="x";
            customImgDiv.appendChild(imgCloseBtn);

                //create  an open link div
        var openlinkDiv = document.createElement("div");
        openlinkDiv.setAttribute("class", "view-file-btn");
        var openlink = document.createElement("a");
        openlink.setAttribute("href", "javascript:void(0);");
        openlink.setAttribute("class", "custom-file-opener");
        openlink.setAttribute("target", "_blank");
         openlink.textContent="open";
          openlinkDiv.appendChild(openlink);
        customImgDiv.appendChild(openlinkDiv);

            //create  a large previewer
        var previewLargeImgDiv = document.createElement("div");
        previewLargeImgDiv.setAttribute("class", "img-previewerPopover");
        customImgDiv.appendChild(previewLargeImgDiv);

        // Append the form-groupy and custom image divs to the flex div

        flexDiv.appendChild(formGroup);
        flexDiv.appendChild(customImgDiv);

        // Append the form group to the document body
        //document.body.appendChild(flexDiv);
        return flexDiv;//// Return the created element
    }



    function removeRow(row) {
        //console.log(row);
        row.parentNode.removeChild(row);
        updateOrderNumbers();
    }

    function updateOrderNumbers() {
    const orderInputs = tbody.querySelectorAll('tr');
    orderInputs.forEach((row, index) => {
        const orderInput = row.querySelector('.ordersortinput');
        if (orderInput) {
            orderInput.value = index + 1; // Start order number from 1
        }
    });
}


   function deleteCheckedRows() {
    const checkedCheckboxes = tbody.querySelectorAll('td input[type="checkbox"]:checked');
    checkedCheckboxes.forEach(checkbox => {
            const row = checkbox.closest('tr'); // Find the closest parent tr element
            if (row){
                row.remove(); // Remove the row
            } 
    });
    updateOrderNumbers();
}


    function markRowAsChecked(checkbox) {
    const row = checkbox.closest('tr'); // Find the closest parent tr element
    if (row) {
        row.classList.toggle('checked', checkbox.checked); // Toggle the checked class based on checkbox.checked
    }
    }

    // Add event listener to existing rows
const existingRows = tbody.querySelectorAll('tr');
existingRows.forEach(row => {
    const checkbox = row.querySelector('td input[type="checkbox"]');
    checkbox.addEventListener('change', () => {
        markRowAsChecked(checkbox);
    });
});

    return {
        addRow,
        deleteCheckedRows,
        removeRow
    };
}

// Initialize dynamic tables
const dynamicTables = document.querySelectorAll('.dynam-table');
dynamicTables.forEach(table => {
    const addRowBtnId = table.getAttribute('addRowBtnTarget');
    const removeRowsBtnId = table.getAttribute('RemoveRowsBtnTarget');
    const addRowBtn = document.getElementById(addRowBtnId);
    const removeRowsBtn = document.getElementById(removeRowsBtnId);
    const dynamicTable = createDynamicTable(table);
    addRowBtn.addEventListener('click', dynamicTable.addRow);
    removeRowsBtn.addEventListener('click', dynamicTable.deleteCheckedRows);

     // Add event listener to existing rows
    const existingRows = table.querySelectorAll('tbody tr');
    existingRows.forEach(row => {
        const removeButton = row.querySelector('.btn-ui-danger');
        removeButton.addEventListener('click', () => {
            dynamicTable.removeRow(row);
        });
        });
       });



///js to help preview a file in alarge format//////////////////
document.addEventListener("mouseover", async function (e) {
    const previewer = e.target.closest(".custom-img-previewer");
    if (!previewer) return;

    const pop = previewer.querySelector(".img-previewerPopover");

    // Extract background-image URL
    const bg = window.getComputedStyle(previewer).backgroundImage;

    if (!bg || bg === "none") {
        pop.innerHTML = `<div style="padding:10px;font-size:12px;color:#666;">No preview available</div>`;
        pop.style.display = "block";
        return;
    }

    // Extract URL, works for blob: and normal URLs
    const url = bg.slice(5, -2);

    // --- New part: determine if blob is an image ---
    let isImage = false;

    if (url.startsWith("blob:")) {
        try {
            const res = await fetch(url);
            const blob = await res.blob();
            isImage = blob.type.startsWith("image/");
        } catch (error) {
            isImage = false;
        }
    } else {
        // Normal file: check by extension
        const ext = url.split('.').pop().toLowerCase();
        const allowed = ["jpg", "jpeg", "png", "gif", "bmp", "webp"];
        isImage = allowed.includes(ext);
    }

    // --- Display preview ---
    if (isImage) {
        pop.innerHTML = `<img src="${url}" alt="preview">`;
    } else {
        pop.innerHTML = `
            <div style="padding:10px;font-size:12px;">
                <a href="${url}" target="_blank" style="color:#007bff;text-decoration:underline;">
                    Open file
                </a>
            </div>`;
    }

    pop.style.display = "block";
});


document.addEventListener("mouseout", function (e) {
    const previewer = e.target.closest(".custom-img-previewer");
    if (!previewer) return;

    const pop = previewer.querySelector(".img-previewerPopover");
    pop.style.display = "none";
});

///end js to help preview a file in alarge format//////////////////




//js to select a file and append it to thumbnail previewer without interrupting normal file selection
document.addEventListener("change", function (event) {
    if (!event.target.matches(".input-fileup")) return;

    const fileInput = event.target;
    const file = fileInput.files[0];
    const previewer = fileInput.closest(".form-groupy").querySelector(".custom-img-previewer");

    // Clear old preview
    //previewer.innerHTML = "";

    if (!file) return;

    if (file.type.startsWith("image/")) {
        // Create thumbnail
        const url = URL.createObjectURL(file);

        previewer.style.backgroundImage = `url('${url}')`;

    } else {
        // Not an image → show default message
      
    }
});
//end js to select a file and append it to thumbnail previewer without interrupting normal file selection


//js to clear select a file and delete it from the folder
document.addEventListener("click", function (event) {
    if (!event.target.matches(".close-img-btn")) return;
    const fileDeleteBtn = event.target;
    const previewer = event.target.closest(".custom-img-previewer");

    const container_elem = event.target.closest(".form-groupy");
    const fileInput = container_elem.querySelector(".input-fileup");


     let id = fileDeleteBtn.getAttribute('data-id');
    let table = fileDeleteBtn.getAttribute('data-table');
    let column = fileDeleteBtn.getAttribute('data-column');
    let route = fileDeleteBtn.getAttribute('data-route');
     
      previewer.style.backgroundImage = `url('')`;
    fileInput.value= null;

    //console.log(fileInput);
   // console.log(id);
    //console.log(table);
    //console.log(column);
   // console.log(route);


if(parseInt(id) > 0){

const requestData = JSON.stringify({ id: id, table: table, column: column });
 //console.log(requestData);
var url ="/"+route;
      ajax_request(url,'',requestData, function (response){
    if(response.length <=0) return;
        var datareturned = JSON.parse(response);
    //console.log(datareturned);

if(datareturned.status==1){
//do something
    console.log(datareturned.message);
}else{
console.log(datareturned.message);
}

});

}

});
//end js to clear select a file and delete it from the folder


//re usable ajax function with call back
 function ajax_request($route,result,data,fn) {
//console.log(data);
     
// Retrieve the CSRF token from the meta tag
var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var xhr = new XMLHttpRequest();
 xhr.open('POST',$route, true);
xhr.setRequestHeader('X-CSRF-Token', csrfToken);
xhr.setRequestHeader('Content-Type', 'application/json');
xhr.send(data);// Send the request
xhr.onreadystatechange = function() {
  if (xhr.readyState === 4 && xhr.status === 200) {
    var response = xhr.responseText;
        if(fn){ fn(response); }   
            
  }
};
    xhr.onerror = function() {
    // Network-level error occurred
        console.log("Network error occurred, please try again..");
     };
}
//end reusable ajax function with call back



}