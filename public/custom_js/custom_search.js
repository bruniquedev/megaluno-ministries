//searches using the first td only
 function SearchTableByOneColumn(input_class,td_index,table_class,show_count_class) {
  var input, filter, table, tr, td, i, txtValue;
   var count=0;
  input = document.getElementsByClassName(input_class)[0];
  filter = input.value.toUpperCase();
  table = document.getElementsByClassName(table_class)[0];
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[td_index];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        count++;
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }

  document.getElementsByClassName(show_count_class)[0].textContent=count +" record(s)";
}



//perform searches on all the columns
 function searchTableByMultipleColumns(input_class,table_class,show_count_class) {
    var input, filter, found, table, tr, td, i, j;
    var count=0;
    input = document.getElementsByClassName(input_class)[0];
    filter = input.value.toUpperCase();
    table = document.getElementsByClassName(table_class)[0];
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++){
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++){
            if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                found = true;

            }
        }
        if (found) {
            count++;
            tr[i].style.display = "";
            found = false;
        } else {
            tr[i].style.display = "none";
        }
    }

    document.getElementsByClassName(show_count_class)[0].textContent=count +" record(s)";
}





/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
 function HideAndShowdropdown() {
  document.getElementById("customDropdown").classList.toggle("show-custom-dropdown");
}



 function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("DropdownsearchInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("customDropdown");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}



//hide suggestion box after selecting
 function SelectTextToInput(val) {
$("#DropdownsearchInput").val(val);
 // document.getElementById("customDropdown").classList.toggle("show-custom-dropdown");
//$("#customDropdown").hide();
}



 function SearchTableByOneColumnBetweenDates(td_index,fromDate_class,toDate_class,table_class,show_count_class) {
  var input_fromDate, input_toDate, filter, table, tr, td, i, txtValue;
  var count=0;
  
   input_fromDate = document.getElementsByClassName(fromDate_class)[0].value;
 var input_toDate = document.getElementsByClassName(toDate_class)[0].value;
  table = document.getElementsByClassName(table_class)[0];
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[td_index];
    if (td) {
      txtValue = td.textContent || td.innerText;

      var f_Date = new Date(input_fromDate).toLocaleDateString();
     var t_Date = new Date(input_toDate).toLocaleDateString();
     var ch_Date = new Date(txtValue).toLocaleDateString();
/*
     var fromDate =f_Date.split("/");
     var toDate = t_Date.split("/");
     var checkDate = ch_Date.split("/");
      
     console.log(fromDate);
     console.log(toDate);
     console.log(checkDate);
    */
//new Date(year, month, day, hours, minutes, seconds, milliseconds)
//var from_Date = new Date(fromDate[2], fromDate[1]-1 , fromDate[2]);
//var to_Date = new Date(toDate[1], toDate[2] , toDate[3]);
//var check_Date = new Date(checkDate[1], checkDate[2] , checkDate[3]);

//console.log(check_Date +" >= " +from_Date +" && "+ check_Date+ "<="+ to_Date);
  //console.log(new Date(ch_Date) +" >= " +new Date(f_Date) +" && "+ new Date(ch_Date)+ "<="+ new Date(t_Date));
      if((new Date(ch_Date)  >=  new Date(f_Date)  &&  new Date(ch_Date) <= new Date(t_Date)) || ch_Date==f_Date){
        count++;
        tr[i].style.display = "";
       

      } else {
        tr[i].style.display = "none";
      }

    }       
  }
document.getElementsByClassName(show_count_class)[0].textContent=count +" record(s)";
   //console.log(count);
}


//searchbetween text and some dates
 function SearchTableByOneColumnBetweenDatesAndText(td_index,input_class,fromDate_class,toDate_class,table_class,show_count_class) {
  var input_fromDate, input_toDate,input_searchtext, table, tr, td,td2, i,j, found, 
  txtValue,txtValue2;
  var count=0;
  input_fromDate = document.getElementsByClassName(fromDate_class)[0].value;
  input_toDate = document.getElementsByClassName(toDate_class)[0].value;
  input_searchtext = document.getElementsByClassName(input_class)[0].value.toUpperCase();

  table = document.getElementsByClassName(table_class)[0];
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[td_index]; // from a specific td
   // console.log("i : "+ i);
////////////////////for a text from any td///////////////
    td2 = tr[i].getElementsByTagName("td");
    for (j = 0; j < td2.length; j++) {
      //console.log("j : "+j);
      //console.log(td2[j].innerHTML.toUpperCase() +" = "+input_searchtext);
            if (td2[j].innerHTML.toUpperCase().indexOf(input_searchtext) > -1) {
        found = j; //get the index of text from the search input
           //console.log("j : "+j);
            }
        } 
        //////////////////////////
    if(found){    
//console.log(td2[found]);
    if (td){
      txtValue = td.textContent || td.innerText;
      txtValue2 = td2[found].textContent || td2[found].innerText;
      // console.log(txtValue2);
      var f_Date = new Date(input_fromDate).toLocaleDateString();
     var t_Date = new Date(input_toDate).toLocaleDateString();
     var ch_Date = new Date(txtValue).toLocaleDateString();
      if((new Date(ch_Date)  >=  new Date(f_Date)  &&  new Date(ch_Date) <= new Date(t_Date)) &&
        txtValue2.toUpperCase().indexOf(input_searchtext) > -1){
        count++;
        tr[i].style.display = "";
       
      } else {
        tr[i].style.display = "none";
      }

    }  //end td  
    }//end found


  }
document.getElementsByClassName(show_count_class)[0].textContent=count +" record(s)";
   //console.log(count);
}





//searchbetween category and text and some dates
 function SearchTableByOneColumnBetweenDatesAndCategory(selectboxId,textboxid,fromDate_class,toDate_class,table_class,show_count_class) {
  var input_fromDate, input_toDate, input_searchtext, searchtext_box, table, tr, td, td2, td_checkdate, i, j, found, found_searchtxt, 
  txtValue, txtValue2, txtValue3, datevalue, td_index, td_check_index, Elementid, Elementid2;
  var count=0;
  input_fromDate = document.getElementsByClassName(fromDate_class)[0].value;
  input_toDate = document.getElementsByClassName(toDate_class)[0].value;
  Elementid= document.getElementsByClassName(selectboxId)[0];
  input_searchtext = Elementid.value;

//for searchbox //including select and text search
  Elementid2= document.getElementsByClassName(textboxid)[0];
  if(Elementid2!=null){
  searchtext_box = Elementid2.value.toLowerCase();
    }


    var selectedOption = Elementid.options[Elementid.selectedIndex];
  var columnspositions = selectedOption.getAttribute("data-tableindexs");
  if(columnspositions==null){
   return;
  }

  var indexs =columnspositions.split(",");
  //console.log(indexs);
  td_index =indexs[0];
  td_check_index =indexs[1];
  
  //console.log("td_check_index : "+td_check_index);
  table = document.getElementsByClassName(table_class)[0];
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[td_index]; // from a specific td
    td_checkdate = tr[i].getElementsByTagName("td")[td_check_index]; // from a specific td
    //console.log("i : "+ i);
    //console.log("td : "+ td.textContent);
////////////////////for a text from any td///////////////
    td2 = tr[i].getElementsByTagName("td");
    for (j = 0; j < td2.length; j++) {
      //console.log("j : "+j);
      //console.log(td2[j].innerHTML +" = "+input_searchtext);
        // console.log(td2[j].innerHTML +" = "+searchtext_box);
            if (td2[j].innerHTML.indexOf(input_searchtext) > -1) {
        found = j; //get the index of text from the search input
           //console.log("j : "+j);
        //console.log(td2[j].innerHTML +" == "+input_searchtext);
            }
         if (td2[j].innerHTML.toLowerCase().indexOf(searchtext_box) > -1) {
        found_searchtxt = j; //get the index of text from the search input
           //console.log("j : "+j);
       // console.log(td2[j].innerHTML.toLowerCase() +" == "+searchtext_box);
            }
        } 
        //////////////////////////
    if(found){    
//console.log(td2[found].textContent);
    if (td){
      txtValue = td.textContent || td.innerText;
      txtValue2 = td2[found].textContent || td2[found].innerText;
      datevalue = td_checkdate.textContent || td_checkdate.innerText;
      

      //detect if search textbox value is found and not empty or not
      txtValue3="";
      if(found_searchtxt){
      txtValue3 = td2[found_searchtxt].textContent || td2[found_searchtxt].innerText;
         }
      
      //console.log("txtValue : "+txtValue);
      //console.log("txtValue2 : "+txtValue2);
      //console.log("txtValue3 : "+txtValue3);
      // console.log("datevalue : "+datevalue);
      var f_Date = new Date(input_fromDate).toLocaleDateString();
     var t_Date = new Date(input_toDate).toLocaleDateString();
     var ch_Date = new Date(datevalue).toLocaleDateString();

       
    if((new Date(ch_Date)  >=  new Date(f_Date)  &&  new Date(ch_Date) <= new Date(t_Date)) &&
        txtValue2.indexOf(input_searchtext) > -1 &&  txtValue3.toLowerCase().indexOf(searchtext_box.toLowerCase()) > -1
        && searchtext_box!=""){
        //above checks for date ranges, searchtext and select text when searchtext not empty or blank
        //console.log("//above checks for date ranges, searchtext and select text when searchtext not empty or blank");
     //console.log("txtValue3 : "+txtValue3);
        count++;
        tr[i].style.display = "";
     }else if((new Date(ch_Date)  >=  new Date(f_Date)  &&  new Date(ch_Date) <= new Date(t_Date)) &&
        txtValue2.indexOf(input_searchtext) > -1 && searchtext_box==""){
        //above checks for date ranges and select text when searchtext is empty
        //console.log("//above checks for date ranges and select text when searchtext is empty");
        count++;
        tr[i].style.display = "";
       }else if(txtValue2.indexOf(input_searchtext) > -1 && input_fromDate=="" && input_toDate=="" && searchtext_box==""){ 
        //above checks for  select text only when  input_fromDate and input_toDate and searchtext_box is null
        //console.log("//above checks for  select text only when  input_fromDate and input_toDate and searchtext_box is null");
        count++;
        tr[i].style.display = "";
       }else if(txtValue2.indexOf(input_searchtext) > -1 && txtValue3.toLowerCase().indexOf(searchtext_box.toLowerCase()) > -1 && 
       input_fromDate=="" && input_toDate==""){ 
        //above checks for  select text and search text only when  input_fromDate and input_toDate  is null
        //console.log("//above checks for  select text and search text only when  input_fromDate and input_toDate  is null");
        count++;
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }  //end td  
    }else{  
    tr[i].style.display = "none";
    }//end found


  }
document.getElementsByClassName(show_count_class)[0].textContent=count +" record(s)";
   //console.log(count);
}


//searchbetween category and text and some dates
 function SearchTableByOneColumnBetweenTwoColumnDatesAndCategory(selectboxId,textboxid,fromDate_class,toDate_class,table_class,show_count_class) {
  var input_fromDate, input_toDate, input_searchtext, searchtext_box, table, tr, td, td2, td_checkdate, i, j, found, found_searchtxt,
  txtValue, txtValue2, txtValue3, startdatevalue, enddatevalue, td_check_startdate, td_check_enddate,
  td_index , td_check_index1, td_check_index2, td_check_index3, Elementid , Elementid2;
  var count=0;
  input_fromDate = document.getElementsByClassName(fromDate_class)[0].value;
  input_toDate = document.getElementsByClassName(toDate_class)[0].value;
  Elementid= document.getElementsByClassName(selectboxId)[0];
  input_searchtext = Elementid.value;

  //for searchbox //including select and text search
  Elementid2= document.getElementsByClassName(textboxid)[0];
  if(Elementid2!=null){
  searchtext_box = Elementid2.value.toLowerCase();
    }

 var selectedOption = Elementid.options[Elementid.selectedIndex];
  var columnspositions = selectedOption.getAttribute("data-tableindexs");
  if(columnspositions==null){
   return;
  }

  var indexs =columnspositions.split(",");
  //console.log(indexs);
  td_index =indexs[0];
  td_check_index1 =indexs[1];
  td_check_index2 =indexs[2] || indexs[1];//short if statement to check array of key exist
  td_check_index3 =indexs[3] || indexs[1];//short if statement to check array of key exist fall to 1


  //console.log(input_searchtext);
  table = document.getElementsByClassName(table_class)[0];
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[td_index]; // from a specific td
    td_check_startdate = tr[i].getElementsByTagName("td")[td_check_index1]; // from a specific td
    td_check_enddate = tr[i].getElementsByTagName("td")[td_check_index2]; // from a specific td

    //console.log("i : "+ i);
    //console.log("td : "+ td.textContent);
////////////////////for a text from any td///////////////
    td2 = tr[i].getElementsByTagName("td");
    for (j = 0; j < td2.length; j++) {
      //console.log("j : "+j);
      //console.log(td2[j].innerHTML +" = "+input_searchtext);
            if (td2[j].innerHTML.indexOf(input_searchtext) > -1) {
        found = j; //get the index of text from the search input
           //console.log("j : "+j);
       // console.log(td2[j].innerHTML +" == "+input_searchtext);
            }
        if (td2[j].innerHTML.toLowerCase().indexOf(searchtext_box) > -1) {
        found_searchtxt = j; //get the index of text from the search input
           //console.log("j : "+j);
       // console.log(td2[j].innerHTML.toLowerCase() +" == "+searchtext_box);
            }
        } 
        //////////////////////////
    if(found){    
//console.log(td2[found]);
    if (td){
      txtValue = td.textContent || td.innerText;
      txtValue2 = td2[found].textContent || td2[found].innerText;
      startdatevalue = td_check_startdate.textContent || td_check_startdate.innerText;
      enddatevalue = td_check_enddate.textContent || td_check_enddate.innerText;
       
       //detect if search textbox value is found and not empty or not
      txtValue3="";
      if(found_searchtxt){
      txtValue3 = td2[found_searchtxt].textContent || td2[found_searchtxt].innerText;
         }

      //console.log("txtValue : "+txtValue);
     //console.log("txtValue2 : "+txtValue2);
    //console.log("startdatevalue : "+startdatevalue);
    //console.log("enddatevalue : "+enddatevalue);
    //console.log("txtValue3 : "+txtValue3);
      var f_Date = new Date(input_fromDate).toLocaleDateString();
     var t_Date = new Date(input_toDate).toLocaleDateString();
     var ch_startDate = new Date(startdatevalue).toLocaleDateString();
     var ch_endDate = new Date(enddatevalue).toLocaleDateString();

    if((new Date(ch_startDate)  >=  new Date(f_Date)  &&  new Date(ch_endDate) <= new Date(t_Date)) &&
        txtValue2.indexOf(input_searchtext) > -1 &&  txtValue3.toLowerCase().indexOf(searchtext_box.toLowerCase()) > -1
        && searchtext_box!=""){
     //above checks for date ranges, searchtext and select text when searchtext not empty or blank
        //console.log("//above checks for date ranges, searchtext and select text when searchtext not empty or blank");
        count++;
        tr[i].style.display = "";

     }else if((new Date(ch_startDate)  >=  new Date(f_Date)  &&  new Date(ch_endDate) <= new Date(t_Date)) &&
        txtValue2.indexOf(input_searchtext) > -1 && searchtext_box==""){
        //above checks for date ranges and select text when searchtext is empty
        //console.log("//above checks for date ranges and select text when searchtext is empty");
        count++;
        tr[i].style.display = "";

    }else if(txtValue2.indexOf(input_searchtext) > -1 && input_fromDate=="" && input_toDate=="" && searchtext_box==""){ 
    //above checks for  select text only when  input_fromDate and input_toDate and searchtext_box is null
        //console.log("//above checks for  select text only when  input_fromDate and input_toDate and searchtext_box is null");
        count++;
        tr[i].style.display = "";
    }else if(txtValue2.indexOf(input_searchtext) > -1 && txtValue3.toLowerCase().indexOf(searchtext_box.toLowerCase()) > -1
        && input_fromDate=="" && input_toDate==""){ 
    //above checks for  select text and search text only when  input_fromDate and input_toDate  is null
        //console.log("//above checks for  select text and search text only when  input_fromDate and input_toDate  is null");
        count++;
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }  //end td  
    }else{  
    tr[i].style.display = "none";
    }//end found


  }
document.getElementsByClassName(show_count_class)[0].textContent=count +" record(s)";
   //console.log(count);
}


  //sort rows by descending or ascending order for only numeric values
function sortTableBynumeric(sortOrder,columnIndex,table_class,sorted_asc,sorted_desc) {
  const table = document.getElementsByClassName(table_class)[0];
  const rows = Array.from(table.getElementsByTagName('tr'));

    let ascending = document.getElementsByClassName(sorted_asc);
let descending = document.getElementsByClassName(sorted_desc);

  rows.sort(function (a, b) {
    var cellA = a.getElementsByTagName('td')[columnIndex].textContent.trim();
    var cellB = b.getElementsByTagName('td')[columnIndex].textContent.trim();

    if (sortOrder === 'desc') {
      descending[0].classList.add("active");//Add class to descending icon
      ascending[0].classList.remove("active");//remove class from ascending icon
      return parseInt(cellB) - parseInt(cellA);
    } else {
      descending[0].classList.remove("active");//remove class from descending icon
      ascending[0].classList.add("active");//add class to ascending icon
      return parseInt(cellA) - parseInt(cellB);
    }
  });

  for (var i = 0; i < rows.length; i++) {
    table.appendChild(rows[i]);
  }
}

  //sort rows by descending or ascending order by numbers or strings or date
function sortTableByNumberStringDate(sortOrder,columnIndex,table_class,sorted_asc,sorted_desc) {

  const table = document.getElementsByClassName(table_class)[0];
  const rows = Array.from(table.getElementsByTagName('tr'));
  
  let ascending = document.getElementsByClassName(sorted_asc);
let descending = document.getElementsByClassName(sorted_desc);


  rows.sort(function (a, b) {
    var cellA = a.getElementsByTagName('td')[columnIndex].textContent.trim();
    var cellB = b.getElementsByTagName('td')[columnIndex].textContent.trim();

    // Check if the values are numeric, string, or date
    var isNumericA = !isNaN(cellA);
    var isNumericB = !isNaN(cellB);
    var isDateA = !isNaN(Date.parse(cellA));
    var isDateB = !isNaN(Date.parse(cellB));

    if (sortOrder === 'desc') {

      descending[0].classList.add("active");//Add class to descending icon
      ascending[0].classList.remove("active");//remove class from ascending icon

      if (isNumericA && isNumericB) {
        return parseFloat(cellB) - parseFloat(cellA);
      } else if (isDateA && isDateB) {
        return new Date(cellB) - new Date(cellA);
      } else if (!isNumericA && !isNumericB && !isDateA && !isDateB) {
        return cellB.localeCompare(cellA);
      } else if (isNumericA || isDateA) {
        return 1;
      } else {
        return -1;
      }
    } else {

      ascending[0].classList.add("active");//Add class to ascending icon
      descending[0].classList.remove("active");//remove class from descending icon

      if (isNumericA && isNumericB) {
        return parseFloat(cellA) - parseFloat(cellB);
      } else if (isDateA && isDateB) {
        return new Date(cellA) - new Date(cellB);
      } else if (!isNumericA && !isNumericB && !isDateA && !isDateB) {
        return cellA.localeCompare(cellB);
      } else if (isNumericA || isDateA) {
        return -1;
      } else {
        return 1;
      }
    }
  });

  for (var i = 0; i < rows.length; i++) {
    table.appendChild(rows[i]);
  }
}










/*
During minification process
function being eliminated as dead code and remove
If you want the function to be a globally-visible symbol, 
you'll have to explicitly assign it to a property of the window object:
*/

window.SearchTableByOneColumn =SearchTableByOneColumn;
window.searchTableByMultipleColumns =searchTableByMultipleColumns;
window.HideAndShowdropdown =HideAndShowdropdown;
window.filterFunction =filterFunction;
window.SelectTextToInput =SelectTextToInput;
window.SearchTableByOneColumnBetweenDates =SearchTableByOneColumnBetweenDates;
window.SearchTableByOneColumnBetweenDatesAndText =SearchTableByOneColumnBetweenDatesAndText;
window.SearchTableByOneColumnBetweenDatesAndCategory =SearchTableByOneColumnBetweenDatesAndCategory;
window.SearchTableByOneColumnBetweenTwoColumnDatesAndCategory=SearchTableByOneColumnBetweenTwoColumnDatesAndCategory;
window.sortTableBynumeric;
window.sortTableByNumberStringDate;