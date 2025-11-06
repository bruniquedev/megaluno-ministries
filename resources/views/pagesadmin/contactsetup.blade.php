@extends('layoutsadmin.layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

@section('content') 

<div class="container-fluid card-In m-t-100 m-b-50" >
 <div class="row justify-content-center"> 	
        

<div class="col-md-3 col-md-3">

      <!---panel panel_container---->
  <div class="panel panel_container panel_container-default">
<div class="panel_container-heading" id="panel panel_containerhead1">
<h3>SAVE CONTACT INFO</h3>
</div>
<div class="panel panel_container-body" id="panel panel_containerbody1">

@if(!isset($DataToEdit['id']) || $DataToEdit['id']==0)
    <form role="form" method="post" action="{{ route('manage-contact-setup.store') }}" name="FORM" enctype="multipart/form-data">
    @else
    <form action="{{ route('manage-contact-setup.update', $DataToEdit['id']) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @method('PUT')
  @endif

    @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->


	      <div class="form-groupy">
  <label for="name" id="name">Choose type</label> 
  <div class="form-input-group">  
<select class="input-control" name="type" style="font-weight:bold;">
@if($DataToEdit['detailtype']!="")
  <option value="{{$DataToEdit['detailtype']}}" selected>{{$DataToEdit['detailtype']}}</option>
  @endif
  <option></option>
<option>Address</option>
<option>Tel</option>
<option>WhatsApp number</option>
<option>WhatsApp link</option>
<option>Email</option>
<option>Map</option>
<option>Footer detail</option>
</select>
</div>
   </div>

  
   <div class="form-groupy">
<label for="name" id="MessageLabel">Message info</label>
<div class="form-input-group">
<textarea required="required"  
 class="input-control" name="descriptiontext" id="descriptiontext"  rows="3">
 {{$DataToEdit['descriptiontext']}}</textarea>
</div>
</div>

<div class="form-groupy">
<label for="text">Additional text</label>
<div class="form-input-group">
<input type="text"  value="{{$DataToEdit['addontext']}}"  name="addontext">
</div>
</div>

 <div class="form-groupy">
<label for="Inputlabel">Priority</label>
<div class="form-input-group">
<select name="priority" id="priority" class="input-control select-h" required="required">
<option value="">Select</option>
<option value="1" <?php if($DataToEdit['priority']=="1"){echo" selected ";} ?> >High</option> 
<option value="2" <?php if($DataToEdit['priority']=="2"){echo" selected ";} ?> >Medium</option> 
<option value="0" <?php if($DataToEdit['priority']=="0"){echo" selected ";} ?> >Low</option> 
</select>
</div>
</div>

<div class="form-groupy">
<!--<label for="text">ID</label>-->
<div class="form-input-group">
<input type="hidden" required="required" readonly="readonly" value="{{$DataToEdit['id']}}" 
id="id"  name="id">
</div>
</div> 

   <div class="form-groupy">
  <div class="form-input-group">
 <button type="submit" name="submitbutton" class="btn btn-primary" id="submit_button" >SAVE</button>  </div>       
</div>

</form>

</div><!---end of panel panel_container body---->
</div><!---end of panel panel_container---->


</div>	


 <div class="col-md-9 col-md-9">
<h1>Manage contacts info</h1>
@if (session('success'))
<div class="alert alert-success" role="alert">
{{ session('success') }}
</div>
@endif

<div class="table-responsive">
  <table class="table-container" 
  cellspacing="0" cellpadding="5" style="background: #fff;">
<thead id="tablehead">
<tr class="thead table-light">
<th>ID</th>
<th>TYPE</th>
<th>DESCRIPTION</th>
<th>ADDON TEXT</th>
<th>PRIORITY</th>
<th>Delete</th>
<th>Update</th>
</tr>
</thead>

<tbody id="tablebody">
 

@if(count($DataInfo) > 0)
<!--iterate through an array-->
@foreach($DataInfo as $Info)

<?php  
$valuetext=$Info->descriptiontext;
if($Info->detailtype=="Map" || $Info->detailtype=="WhatsApp link" || $Info->detailtype=="Footer detail"){
$valuetext="Available";
}
$prioritytext="";
if($Info->priority=="1"){$prioritytext="High";}
if($Info->priority=="2"){$prioritytext="Medium";}
if($Info->priority=="0"){$prioritytext="Low";}
?>

<tr>
<td>{{$Info->id}}</td>
<td>{{$Info->detailtype}}</td>
<td>{{$valuetext}}</td>
<td>{{$Info->addontext}}</td>
<td>{{$prioritytext}}</td>
<td>
<form action="{{ route('manage-contact-setup.destroy', $Info->id) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->
  @method('DELETE')
<button type="submit" name="datasubmit" class="btn btn-danger btn-xs">
<i class="ion ion-android-delete"></i> Delete
</button>
</form>
</td>

<td><a class="btn btn-primary btn-xs" id="link1" href="/manage-contact-setup/{{$Info->id}}/edit"><i class="ion ion-edit"></i> Edit</a></td>
</tr>

@endforeach
@endif
 
</tbody>
</table>
</div>


</div>





	   </div><!---end row-->
	    </div>



@endsection
<!--code above is for templating-->