@extends('layoutsadmin.layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

@section('content') 

<div class="container-fluid card-In m-t-150 m-b-50" >
 <div class="row justify-content-center"> 	
        

<div class="col-md-3 col-md-3">

      <!---panel panel_container---->
  <div class="panel panel_container panel_container-default">
<div class="panel_container-heading flex align-items-center flex-grow">
<h4 class="m-r-10">Save Admins Info</h4>
<a class="btn-ui btn-ui-primary btn-ui-xs" id="link1" href="{{ route('manage-socialmedia.index') }}"><i class="ion ion-android-add-circle"></i> Create</a>
</div>
<div class="panel panel_container-body" id="panel panel_containerbody1">

   @if(!isset($DataToEdit['id']) || $DataToEdit['id']==0)
    <form role="form" method="post" action="{{ route('manage-admins.store') }}" name="FORM" enctype="multipart/form-data" onsubmit="return validate();">
    @else
    <form action="{{ route('manage-admins.update', $DataToEdit['id']) }}" method="post" name="FORM" enctype="multipart/form-data" onsubmit="return validate();">
  @method('PUT')
  @endif

    @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->



   <div class="form-groupy">
<label for="text">Full name :</label>
<div class="form-input-group">
<input type="text" required="required" class="input-control " value="{{$DataToEdit['name']}}"  
id="fullname" name="fullname"  >
</div>
</div> 

   <div class="form-groupy">
<label for="text">Email :</label>
<div class="form-input-group">
<input type="email" required="required" class="input-control " value="{{$DataToEdit['email']}}"  id="email" name="email"  >
</div>
</div> 

   <div class="form-groupy">
<label for="text">Contact number :</label>
<div class="form-input-group">
<input type="number" required="required" class="input-control " value="{{$DataToEdit['mobile']}}"  id="contact" name="contact"  >
</div>
</div> 

   <div class="form-groupy">
<label for="text">Location :</label>
<div class="form-input-group">
<input type="text" required="required" class="input-control " value="{{$DataToEdit['location']}}"  id="location" name="location"  >
</div>
</div> 

   <div class="form-groupy">
<label for="text">User name :</label>
<div class="form-input-group">
<input type="text" required="required"  class="input-control " value="{{$DataToEdit['username']}}"  id="username" name="username"    />
</div>
</div> 

  
        <div class="form-groupy">
  <label for="name" id="name">User  type</label> 
  <div class="form-input-group">  
<select required="required"  class="selectpicker input-control " data-live-search="true" name="admintype">
 @if($DataToEdit['admintype']!="")
  <option value="{{$DataToEdit['admintype']}}" selected>{{$DataToEdit['admintype']}}</option>
  @endif
  <option></option>
<option>Super admin</option>
<option>User admin</option>
</select>
</div>
   </div>


 <div class="form-groupy">
 <label for="inputpassword" id="passwordlabel"> Password</label> 
 <div class="form-input-group">
 <input type="password"  class="input-control " name="password" id="password" placeholder="create your password">
</div>
 </div>  

  <div class="form-groupy">
 <label for="inputpassword" id="passwordlabel">Confirm password</label> 
 <div class="form-input-group">
 <input type="password"  class="input-control " name="confirmpassword" id="confirmpassword" placeholder="Re-type password">
</div>
<label id="ConfirmNewpassword_error" style="width:100%; font-weight:bold; color: #fff;" ></label>
 </div> 



   <div class="form-groupy">
<!--<label for="text">ID</label>-->
<div class="form-input-group">
<input type="hidden" required="required" readonly="readonly" value="{{$DataToEdit['id']}}"
 id="id" class="" name="id"  >
</div>
</div> 

      
   <div class="form-groupy">
    <div class="form-input-group">
 <button type="submit" name="submitbutton" class="btn btn-primary" id="submit_button" >SAVE</button>
 </div>         
</div>

</form>
</div><!---end of panel panel_container body---->
</div><!---end of panel panel_container---->


</div>	


 <div class="col-md-9 col-md-9">
<h4>Manage admins info</h4>
@if (session('success'))
<div class="alert alert-success" role="alert">
{{ session('success') }}
</div>
@endif

<div class="table-responsive">
  <table class="table-container" id="search-table"
      data-sortable-table
    data-sort-url="{{ route('sort.update') }}"
    data-model="admin"
    data-column="sorted_order">
<thead id="tablehead">
<tr class="thead table-light">
<th>Id</th>
<th>Name</th>
<th>Email</th>
<th>Username</th>
<th>Contact</th>
<th>Location</th>
<th>Admin type</th>
<th>Created_date</th>
<th>Status</th>
<th>Delete</th>
<th>Update</th>
<th>Sort</th>
</tr>
</thead>

<tbody id="tablebody">

@if(count($DataInfo) > 0)
<!--iterate through an array-->
@foreach($DataInfo as $Info)

<tr data-sortable-row
    data-id="{{ $Info->id }}"
    draggable="true">
<td>{{$Info->id}}</td>
<td>{{$Info->name}}</td>
<td>{{$Info->email}}</td>
<td>{{$Info->username}}</td>
<td>{{$Info->mobile}}</td>
<td>{{$Info->location}}</td>
<td>{{$Info->admintype}}</td>
<td>{{$Info->regdate}}</td>
<td>{{$Info->status}}</td>
<td>
<form action="{{ route('manage-admins.destroy', $Info->id) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->
  @method('DELETE')
<button type="submit" name="datasubmit" class="btn btn-danger btn-xs">
<i class="ion ion-android-delete"></i> Delete
</button>
</form>
</td>

<td><a class="btn btn-primary btn-xs" id="link1" href="/manage-admins/{{$Info->id}}/edit"><i class="ion ion-edit"></i> Edit</a></td>
<td class="drag-handle" draggable="true">⋮⋮</td>
</tr>

@endforeach
@endif  
 
</tbody>
</table>
</div>


</div>





	   </div><!---end row-->
	    </div>


<Script type="text/JavaScript">
    
  //getting all input types
  //getting all input types

  var password = document.forms["FORM"]["password"];
  var ConfirmNewpassword = document.forms["FORM"]["confirmpassword"];
       //setting up event listeners

  //geting all error display objects
  var ConfirmNewpassword_error = document.getElementById("ConfirmNewpassword_error");
  //setting up event listeners
  ConfirmNewpassword.addEventListener("blur" ,ConfirmNewpasswordVerify ,true); 
     
  //validate function
  
  function validate(){
  
  
    if(ConfirmNewpassword.value != password.value){
  
  ConfirmNewpassword.style.border="1px solid red";
  ConfirmNewpassword_error.style.color="red";
  ConfirmNewpassword_error.textContent ="Confirm password and password mismatch";
  ConfirmNewpassword.focus();
  return false;
  
  }
  

  
  }

//event handler functions
       

    
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