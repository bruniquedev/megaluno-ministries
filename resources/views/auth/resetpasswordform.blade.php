
@extends('layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

@section('content') 

<div class="container" style="margin-top:20px;">
 <div class="row justify-content-center"> 	
		<div class="col-md-3 col-md-3">
			</div>
		
		<div class="col-md-5 col-md-5">
		
	<div class="panel panel-default" id="panedefault">
<div class="panel-heading" id="panehead">
      <h4 class="text-center">Reset password</h4>
</div>
<div class="panel-body" id="panelbody1">
@if (session('success'))
<div class="alert alert-danger" role="alert">
{{ session('success') }}
</div>
@endif

<div id="form">
<form role="form" method="POST" action="{{ route('submituserresetpassword.post') }}" name="FORM"> 

@csrf
<input type="hidden" name="token" value="{{ $token }}">


	<div class="form-group">
 <label for="inputpassword" id="passwordlabel" > New password</label> 
<div class="input-group-addon" id=""><i class="ion ion-ios-keypad-outline"></i>
 <input type="password" required="required" class="form-control" name="password" id="password" placeholder="New password" style="font-weight:bold;" autofocus />
@if ($errors->has('password'))
<label class="text-danger">{{ $errors->first('password') }}</label>
@endif
</div> 
 </div>  	  
				
<!--
	confirmed
The field under validation must have a matching field of foo_confirmation. For example, if the field under validation is password, a matching password_confirmation field must be present in the input.
-->

 <div class="form-group">
 <label for="inputpassword" id="passwordlabel" >Confirm new password</label> 
<div class="input-group-addon" id=""><i class="ion ion-ios-keypad-outline"></i>
 <input type="password" required="required" class="form-control" name="password_confirmation" id="confirm_password" placeholder="Confirm new password" style="font-weight:bold;" autofocus />
@if ($errors->has('password_confirmation'))
<label class="text-danger">{{ $errors->first('password_confirmation') }}</label>
@endif
</div> 
 </div>  
                          
 <div class="form-group">
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
 <button type="submit" name="submit" class="btn btn-primary" >Reset</button>
    

                             </div> 
                      </form>
                       </div><!--- end of form div-->

</div><!--- end of panel body-->
</div><!--- end of panel-->
	
	
			</div><!--- end of column-->
		
		
		<div class="col-md-4 col-md-4">
			</div>
		
		
	   </div><!---end row-->
	    </div>



@endsection
<!--code above is for templating-->