@extends('layoutsadmin.layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

@section('content') 

<div class="container card-In m-t-150 m-b-50" >
 <div class="row justify-content-center"> 	
        

<div class="col-md-3 col-md-3">

      <!---panel panel_container---->
  <div class="panel panel_container panel_container-default">
<div class="panel_container-heading flex align-items-center flex-grow m-b-10">
<h4 class="m-r-10">Save Contact Info</h4>
<a class="btn-ui btn-ui-primary btn-ui-xs" id="link1" href="{{ route('manage-contact-setup.index') }}"><i class="ion ion-android-add-circle"></i> Create</a>
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
  <label for="name">Choose type</label> 
  <div class="form-input-group">  
<select class="input-control" name="type">
@if($DataToEdit['detail_type']!="")
  <option value="{{$DataToEdit['detail_type']}}" selected>{{$DataToEdit['detail_type']}}</option>
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
<label for="name">Detail type info</label>
<div class="form-input-group">
<textarea required="required"  
 class="input-control" name="descriptiontext" id="descriptiontext"  rows="3">
 {{$DataToEdit['description']}}</textarea>
</div>
</div>

<div class="form-groupy">
<label for="text">Additional text</label>
<div class="form-input-group">
<input type="text"  value="{{$DataToEdit['title']}}"  name="addontext">
</div>
</div>

 <div class="form-groupy">
<label for="Inputlabel">Priority</label>
<div class="form-input-group">
<select name="priority" id="priority" class="input-control select-h" required="required">
<option value="">Select</option>
<option value="1" <?php if($DataToEdit['status']=="1"){echo" selected ";} ?> >High</option> 
<option value="2" <?php if($DataToEdit['status']=="2"){echo" selected ";} ?> >Medium</option> 
<option value="0" <?php if($DataToEdit['status']=="0"){echo" selected ";} ?> >Low</option> 
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
<h4>Manage contacts info</h4>
@if (session('success'))
<div class="alert alert-success" role="alert">
{{ session('success') }}
</div>
@endif

<div class="table-responsive">
  <table class="table-container" id="search-table"
      data-sortable-table
    data-sort-url="{{ route('sort.update') }}"
    data-model="content_info"
    data-column="sorted_order">
<thead id="tablehead">
<tr class="thead table-light">
<th>Id</th>
<th>Type</th>
<th>Description</th>
<th>Addon Text</th>
<th>Priority</th>
<th>Delete</th>
<th>Update</th>
<th>Sort</th>
</tr>
</thead>

<tbody id="tablebody">
 

@if(count($DataInfo) > 0)
<!--iterate through an array-->
@foreach($DataInfo as $Info)

<?php  
$valuetext=$Info->description;
if($Info->detail_type=="Map" || $Info->detail_type=="WhatsApp link" || $Info->detail_type=="Footer detail"){
$valuetext="Available";
}
$prioritytext="";
if($Info->status=="1"){$prioritytext="High";}
if($Info->status=="2"){$prioritytext="Medium";}
if($Info->status=="0"){$prioritytext="Low";}
?>

<tr data-sortable-row
    data-id="{{ $Info->id }}"
    draggable="true">
<td>{{$Info->id}}</td>
<td>{{$Info->detail_type}}</td>
<td>{{$valuetext}}</td>
<td>{{$Info->title}}</td>
<td>{{$prioritytext}}</td>
<td>
<form action="{{ route('manage-contact-setup.destroy', $Info->id) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->
  @method('DELETE')
<button type="submit" name="datasubmit" class="btn-ui btn-ui-danger btn-ui-xs">
<i class="ion ion-android-delete"></i> Delete
</button>
</form>
</td>

<td><a class="btn btn-primary btn-xs" id="link1" href="/manage-contact-setup/{{$Info->id}}/edit"><i class="ion ion-edit"></i> Edit</a></td>
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



@endsection
<!--code above is for templating-->