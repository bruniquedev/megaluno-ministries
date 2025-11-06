//check all and un check all
   $("#checkandUncheck").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 });