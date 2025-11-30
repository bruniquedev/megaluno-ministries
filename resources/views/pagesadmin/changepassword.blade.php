@extends('layoutsadmin.layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

@section('content') 

<div class="container card-In m-t-150 m-b-50" >
 <div class="row justify-content-center"> 	
        
 <div class="col-md-12 col-md-12">

@if (session('success'))
<div class="alert alert-success" role="alert">
{{ session('success') }}
</div>
@endif



        <!---panel panel_container---->
  <div class="panel panel_container panel_container-default">
<div class="panel_container-heading" id="panel panel_containerhead1">
<h4 class="text-center">Change password</h4>
</div>
<div class="panel panel_container-body" id="panel panel_containerbody1">
<?php $username=""; ?>
@if($DataInfo['id']==0)
    <form role="form" method="post" action="{{ route('manage-changepassword.store') }}" name="FORM" enctype="multipart/form-data" onsubmit="return validate();">
       <?php //var_dump($DataInfo); ?>
    @else
     <?php //var_dump($DataInfo); ?>
    <?php  $username=$DataInfo['username']; ?>
    <form action="{{ route('manage-changepassword.update', $DataInfo['id']) }}" method="post" name="FORM" enctype="multipart/form-data" onsubmit="return validate();">
  @method('PUT')
  @endif


    @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->
    
  <div class="form-groupy">
  <label for="name" id="usernamelabel"> User name</label> 
    <div class="form-input-group">  
  <input type="text" readonly="readonly" required="required" value="{{$username}}" class="input-control" name="username" id="username" placeholder="User name"  />
     </div>
                          </div>
                 

  <div class="form-groupy">
 <label for="inputpassword" id="Newpasswordlabel">New Password</label>
   <div class="form-input-group">   
 <input type="password" required="required" class="input-control" name="Newpassword" id="Newpassword"  placeholder=" new Password" />
</div>
 </div>
 
   <div class="form-groupy">
 <label for="inputpassword" id="ConfirmNewpasswordlabel">Confirm New Password</label> 
   <div class="form-input-group">  
 <input type="password" required="required" class="input-control" name="ConfirmNewpassword" id="ConfirmNewpassword" placeholder=" confirm new Password" />
</div>
 <label id="ConfirmNewpassword_error" ></label>
 </div>
                          
 <div class="form-groupy">
    <div class="form-input-group">
 <button type="submit" name="adminUpdatebutton" class="btn btn-default" id="submit_button" >Update password</button>
                  </div>
                             </div> 

</form>

</div><!---end of panel panel_container body---->
</div><!---end of panel panel_container---->





</div>
	   </div><!---end row-->
	    </div>



 <script type="text/JavaScript">

  //getting all input types

  var Newpassword = document.forms["FORM"]["Newpassword"];
  var ConfirmNewpassword = document.forms["FORM"]["ConfirmNewpassword"];
	     //setting up event listeners
  ConfirmNewpassword.addEventListener("blur" ,ConfirmNewpasswordVerify ,true);   
	   
	  //validate function
  
  function validate(){

  if(ConfirmNewpassword.value != Newpassword.value){
  
  ConfirmNewpassword.style.border="1px solid red";
  ConfirmNewpassword_error.style.color="red";
  ConfirmNewpassword_error.textContent ="Confirm password does not match with new password";
  ConfirmNewpassword.focus();
  return false;
  
  }
  
  }
  
  
  //event handler functions 
	   function ConfirmNewpasswordVerify(){

  if(ConfirmNewpassword.value !=""){
  
  ConfirmNewpassword.style.border="1px solid green";
  ConfirmNewpassword_error.innerHTML ="";
  return true;
  
  }
  
}


</script>








@endsection
<!--code above is for templating-->