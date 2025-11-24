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

        // Create the file input element

        // Append elements to their respective parents
        fileInputSpan.appendChild(uploadIcon);
        fileInputSpan.appendChild(labelText);
        fileInputSpan.appendChild(fileInput);
        formGroup.appendChild(inputLabel);
        formGroup.appendChild(fileInputSpan);

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
        customImgDiv.setAttribute("id", "custom-img");
        customImgDiv.classList.add(linkbtn.getAttribute('data-output'));
        customImgDiv.style.width = "60px";
        customImgDiv.style.height = "50px";

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


}