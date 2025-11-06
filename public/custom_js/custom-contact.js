	
	
 //<!-- jquery textarea word limiting--> 

 
 $(document).ready(function(){
 
 $('#message').keyup(function(){
 
 CharLimit(this, 160);
 
 });
 });
 
 function CharLimit(input, maxChar){
 
 var len = $(input).val().length;
 
 $('#charleft').text(maxChar-len);
 
 if(len >= maxChar){
 
    $(input).val($(input).val().substring(0,maxChar));
 }
 
 }
 
 
 
 
 
 //<!---for contact---->
 
 // alert();
function User_contactMessage_request(event) {
    
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


var fullname =document.forms["FORM_CONTACT"]["Name"].value;
var email=document.forms["FORM_CONTACT"]["email"].value;
var phonenumber =document.forms["FORM_CONTACT"]["phonenumber"].value;
var subject=document.forms["FORM_CONTACT"]["subject"].value;
var message=document.forms["FORM_CONTACT"]["message"].value;

 //console.log(message+" "+ email+" "+subject );

if(email.length <=0 || subject.length <=0 || message.length <=0){
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
 