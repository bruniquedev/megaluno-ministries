 if(document.getElementsByClassName('packages-btn')[0]!=null){
 var bookbtns = document.getElementsByClassName('packages-btn');
         for(var i = 0; i < bookbtns.length; i++){
 bookbtns[i].addEventListener('click', function (){
    let packageid = this.getAttribute('data-packageid');
    let packagename = this.getAttribute('data-package');
    document.getElementById('selectedpackageid').value = packageid;
    document.getElementsByClassName('packagename-input')[0].value = packagename;
     }, false);
      }
      }
 
 // alert();
function User_booking_request(event) {
    
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

    event.preventDefault();
    loader(1);
    // alert();
    var form = event.target;
    var fd = new FormData(event.target);
    //console.log(fd);


var fullname =document.forms["FORM_BOOKNOW"]["Name"].value;
var email=document.forms["FORM_BOOKNOW"]["email"].value;
var phonenumber =document.forms["FORM_BOOKNOW"]["phonenumber"].value;
var packagename=document.forms["FORM_BOOKNOW"]["packagename"].value;
var message=document.forms["FORM_BOOKNOW"]["message"].value;

 //console.log(message+" "+ email+" "+subject );

if(email.length <=0 || packagename.length <=0 || phonenumber.length <=0){
loader();
 show_mypopup("<p class='color-danger'>Please fill all the required fields and send again.</p>", 1);
}else{
    // var fd = event;
    $.ajax({
        url: form.getAttribute("action"),
        dataType: "json",
        type: "POST",
        data: fd,
        contentType: false,
        processData: false,
 success: function (data) {
        console.log(data);

         if(data.status_message=="false"){
                 show_mypopup(data.message, 1);
            }else{
    show_mypopup(data.message, 1);      
            }



        form.reset();
            loader();

    },
    error: function (xhr) {
        console.log(xhr.responseText);
        loader();
    }

    });


}

}
 