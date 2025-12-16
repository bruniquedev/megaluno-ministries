@extends('layoutsadmin.layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

@section('content') 

<div class="container-fluid card-In m-t-150 m-b-50" >
 <div class="row justify-content-center"> 	
        

<div class="col-md-3 col-md-3">

      <!---panel panel_container---->
  <div class="panel panel_container panel_container-default">
<div class="panel_container-heading flex align-items-center flex-grow">
<h4 class="m-r-10">Save Testimonials</h4>
<a class="btn-ui btn-ui-primary btn-ui-xs" id="link1" href="{{ route('manage-testimonials.index') }}"><i class="ion ion-android-add-circle"></i> Create</a>
</div>
<div class="panel panel_container-body" id="panel panel_containerbody1">

@php
  //var_dump($DataToEdit);
@endphp

@if(!isset($DataToEdit['id']) || $DataToEdit['id']==0)
    <form role="form" method="post" action="{{ route('manage-testimonials.store') }}" name="FORM" enctype="multipart/form-data">
    @else
    <form action="{{ route('manage-testimonials.update', $DataToEdit['id']) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @method('PUT')
  @endif

    @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->

          <div class="form-groupy">
  <label for="name" id="name">Full name</label>
  <div class="form-input-group">    
<input type="text" required="required" class="input-control" name="name" 
 value="{{$DataToEdit['heading']}}"  />
</div>
   </div>

             <div class="form-groupy">
  <label for="name" id="name">Job/Title</label>
  <div class="form-input-group">    
<input type="text" required="required" class="input-control" name="jobtitle" 
id="jobtitle" value="{{$DataToEdit['title']}}"  />
</div>
   </div>
  
       <div class="form-groupy">
  <label for="name" id="name">Email</label>
  <div class="form-input-group">    
<input type="text"  class="input-control" name="email" value="{{$DataToEdit['email_address']}}" />
</div>
   </div>


   <div class="form-groupy">
<label for="name" id="MessageLabel">Message</label>
<div class="form-input-group"> 
<textarea required="required"  
 class="input-control" name="descriptiontext" id="descriptiontext"  rows="2">{{$DataToEdit['description']}}</textarea>
</div>
</div>

<div class="form-groupy">
  <label for="name" id="name" style="color:#000;">On 1 of 5 rate us</label> 
  <div class="form-input-group">   
<select class="input-control" name="ratings" required>
  @if($DataToEdit['ratings']!="")
  <option value="{{$DataToEdit['ratings']}}" selected>{{$DataToEdit['ratings']}} star(s)</option>
  @endif
<option value="">select here to rate us</option>
<option value="1">1 star</option>
<option value="2">2 stars</option>
<option value="3">3 stars</option>
<option value="4">4 stars</option>
<option value="5">5 star</option>
</select>
</div>
   </div>

<div class="form-groupy">
<!--<label for="text">ID</label>-->
<div class="form-input-group"> 
<input type="hidden" required="required" readonly="readonly"  id="id" class="input_box" name="id" value="{{$DataToEdit['id']}}" />
</div>
</div> 


   <div class="form-groupy">
<div class="form-input-group"> 
 <button type="submit" name="submittestimonybutton" class="btn btn-primary" id="submit_button" >SAVE</button> 
 </div>        
</div>

</form>

</div><!---end of panel panel_container body---->
</div><!---end of panel panel_container---->


</div>	


 <div class="col-md-9 col-md-9">
<h4>Manage testimonials</h4>
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
<th>Name</th>
<th>Job</th>
<th>Email</th>
<th>Message</th>
<th>Ratings</th>
<th>Delete</th>
<th>Update</th>
<th>Status</th>
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
<td>{{$Info->heading}}</td>
<td>{{$Info->title}}</td>
<td>{{$Info->email_address}}</td>
<td>{{$Info->description}}</td>
<td>{{$Info->ratings}}</td>
<td>
<form action="{{ route('manage-testimonials.destroy', $Info->id) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->
  @method('DELETE')
<button type="submit" name="datasubmit" class="btn-ui btn-ui-danger btn-ui-xs">
<i class="ion ion-android-delete"></i> Delete
</button>
</form>
</td>

<td><a class="btn-ui btn-ui-primary btn-ui-xs" id="link1" href="/manage-testimonials/{{$Info->id}}/edit"><i class="ion ion-edit"></i> Edit</a></td>

<?php
$buttonstatus="btn-ui btn-ui-primary btn-ui-xs";
$statusText="Accept";
if($Info->ispublished==1){
$buttonstatus="btn-ui btn-ui-danger btn-ui-xs";
$statusText="Deny";
}

?>
<td><a class="<?php echo $buttonstatus; ?>" id="link1" href="/update-testimonialstatus/{{$Info->id}}"><i class="ion ion-edit"></i> <?php echo $statusText; ?></a></td>
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