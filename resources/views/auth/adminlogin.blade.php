
@extends('layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

@section('content') 


 <section class="main-content-section home w-full m-b-20">
    <div class="main-content-container">


		
	<div class="card-wrappable m-t-150 p-10p m-0-auto w-50">
<div class="panel-heading-ui">
      <h4 class="center">Admin login</h4>
</div>
<div class="panel-body-ui">
@if (session('success'))
<div class="alert-ui alert-danger-ui">
{{ session('success') }}
</div>
@endif

<div id="form">
<form role="form" method="POST" action="{{ route('adminlogin.post') }}" name="FORM"> 

@csrf

  <div class="form-groupy">
  <label for="name"> User name</label>
 	  <div class="form-input-group">    
 <input type="text" required="required" class="input-control" name="username" id="username" placeholder="Enter your username"/>
</div>
@if ($errors->has('username'))
<span class="text-danger">{{ $errors->first('username') }}</span>
@endif
</div>
						  
						  
 <div class="form-groupy">
 <label for="inputpassword"> Password</label> 
<div class="form-input-group"> 
 <input type="password" required="required" class="input-control" name="password" id="password1" placeholder="Enter account Password"  />
</div>
@if ($errors->has('password'))
<span class="text-danger">{{ $errors->first('password') }}</span>
@endif
 </div>  
                          
 <div class="form-groupy flex justify-center"> 
 <button type="submit" name="submit" class="btn-ui btn-ui-lg btn-ui-default b-r-10p w-full" id="LoginAdminbutton" >Log in</button>
                </div> 
                      </form>
                       </div><!--- end of form div-->

</div><!--- end of panel body-->
</div><!--- end of panel-->
	
	


 </div>
    </section>

@endsection
<!--code above is for templating-->