@extends('layoutsadmin.layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

@section('content') 

<div class="container-fluid card-In m-t-150 m-b-50" >
 <div class="row justify-content-center"> 	
        

<div class="col-md-3 col-md-3">

      <!---panel panel_container---->
  <div class="panel panel_container panel_container-default">
<div class="panel_container-heading" id="panel panel_containerhead1">
<h4>Save Logo</h4>
</div>
<div class="panel panel_container-body" id="panel panel_containerbody1">

@if(!isset($DataToEdit['id']) || $DataToEdit['id']==0)
    <form role="form" method="post" action="{{ route('manage-logos.store') }}" name="FORM" enctype="multipart/form-data">
    @else
    <form action="{{ route('manage-logos.update', $DataToEdit['id']) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @method('PUT')
  @endif

    @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->

  
       <div class="form-groupy">
  <label for="name">Brand name</label> 
    <div class="form-input-group">  
<input type="text" required="required" class="input-control" name="title" id="title"  value="{{$DataToEdit['title']}}" />
 </div>
   </div>


   <div class="form-groupy">
    <div class="input_label">Add logo</div>
    <!--upload field one-->
    <span class="btn-upload-1 btn-upload-file-1 btn-ui-black">
    <i class="ion ion-upload left"></i>  
    Select<input type="file" name="input_icon"  id="imagefile" accept="image/*" class="text-bold input-fileup">
    </span>
    <!--/upload field one-->
    <div class="custom-img-previewer" style="background-image: url('{{ asset("storage/content_uploads/icons/".$DataToEdit["iconfile"]) }}'); width:40px;height:40px;">
      <span data-id="{{$DataToEdit['id']}}" data-table="content_info" data-column="iconfile" data-route="remove-image" class="close-img-btn" >×</span>
      <div class="view-file-btn" ><a href='{{ asset("storage/content_uploads/icons/".$DataToEdit["iconfile"]) }}' class="custom-file-opener" target="_blank">open</a></div>
    <div class="img-previewerPopover"></div>
    </div>
    </div>





<div class="form-groupy">
  <div class="form-input-group">
<input type="hidden" required="required" readonly="readonly" value="{{$DataToEdit['id']}}" 
id="id" name="id">
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
<h4>Manage logo</h4>
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
<th>Id</th>
<th>Brand Name</th>
<th>Logo</th>
<th>Status</th>
<th>Update status</th>
<th>Delete</th>
<th>Update</th>
</tr>
</thead>

<tbody id="tablebody">
   
@if(count($DataInfo) > 0)
<!--iterate through an array-->
@foreach($DataInfo as $Info)

<?php
$status = "btn btn-danger btn-xs";
$statustext = "Disabled";
$updateButtonText = "Enable";
if ($Info->ispublished == 1) {
  $status = "btn btn-primary btn-xs";
  $statustext = "Enabled";
  $updateButtonText = "Disable";
}
?>

<tr>
<td>{{$Info->id}}</td>
<td>{{$Info->title}}</td>
<td>
  <div id="custom-img" style="background-image: url('{{ asset("storage/content_uploads/icons/".$Info->iconfile) }}'); width:70px;height:70px;">
<!--<img src="{{ asset('storage/logos_images/'.$Info->filename) }}" width="200px" hight="200px" alt="{{$Info->filename}}" />-->
<!--<img src="/storage/logos_images/{{$Info->filename}}" width="100%" height="100%" alt="{{$Info->filename}}" />-->
  </div>
</td>

<td><button class="{{$status}}">{{$statustext}}</button></td>

<td><a class="btn btn-primary btn-xs" id="link1" href="/manage-logos/{{$Info->id}}">
  <i class="ion ion-android-refresh"></i> {{$updateButtonText}}</a></td>

<td>
<form action="{{ route('manage-logos.destroy', $Info->id) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->
  @method('DELETE')
<button type="submit" name="datasubmit" class="btn btn-danger btn-xs">
<i class="ion ion-android-delete"></i> Delete
</button>
</form>
</td>

<td><a class="btn btn-primary btn-xs" id="link1" href="/manage-logos/{{$Info->id}}/edit"><i class="ion ion-edit"></i> Edit</a></td>
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