@extends('layoutsadmin.layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

@section('content') 

<div class="container card-In m-t-150 m-b-50" >
 <div class="row justify-content-center"> 	
        

<div class="col-md-3 col-md-3">

      <!---panel panel_container---->
  <div class="panel panel_container panel_container-default">
<div class="panel_container-heading" id="panel panel_containerhead1">
<h4>Save Gallery Image</h4>
</div>
<div class="panel panel_container-body" id="panel panel_containerbody1">

@if(!isset($DataToEdit['id']) || $DataToEdit['id']==0)
    <form role="form" method="post" action="{{ route('manage-gallery.store') }}" name="FORM" enctype="multipart/form-data">
    @else
    <form action="{{ route('manage-gallery.update', $DataToEdit['id']) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @method('PUT')
  @endif

    @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->

    <div class="form-groupy">
      <label for="text">Title </label>
      <div class="form-input-group">
      <textarea class="form-control input_box_borderless" rows="2" name="title"><?php echo $DataToEdit['title']; ?></textarea>
   </div>
   </div>
            
    <div class="form-groupy">
      <label for="text">Description </label>
      <div class="form-input-group">
      <textarea class="form-control input_box_borderless" rows="2" name="description"><?php echo $DataToEdit['description']; ?></textarea>
    </div>
    </div>

    <div class="form-groupy">
    <div class="input_label">Add image</div>
    <!--upload field one-->
    <span class="btn-upload-1 btn-upload-file-1 btn-ui-black">
    <i class="ion ion-upload left"></i>  
    Select<input type="file" name="input_file"  id="imagefile" accept="image/*" class="text-bold input-fileup">
    </span>
    <!--/upload field one-->
    <div class="custom-img-previewer" style="background-image: url('{{ asset("storage/content_uploads/thumbnails/".$DataToEdit["filename"]) }}'); width:40px;height:40px;">
      <span data-id="{{$DataToEdit['id']}}" data-table="content_info" data-column="filename" data-route="remove-image" class="close-img-btn" >×</span>
      <div class="view-file-btn" ><a href='{{ asset("storage/content_uploads/thumbnails/".$DataToEdit["filename"]) }}' class="custom-file-opener" target="_blank">open</a></div>
    <div class="img-previewerPopover"></div>
    </div>
    </div>




<div class="form-groupy">
<!--<label for="text">ID</label>-->
<div class="form-input-group">
<input type="hidden" required="required" readonly="readonly" value="{{$DataToEdit['id']}}" id="id" class="input-control" name="id">
</div>
</div> 

   <div class="form-groupy text-align-right">
      <div class="form-input-group justify-right">  
 <button type="submit" name="submitbutton" class="btn btn-ui btn-primary" id="submit_button" >SAVE</button>
 </div>         
</div>

</form>

</div><!---end of panel panel_container body---->
</div><!---end of panel panel_container---->


</div>	


 <div class="col-md-9 col-md-9">
<h4>Manage gallery</h4>
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
<th>Title</th>
<th>Description</th>
<th>Type</th>
<th>Image</th>
<th>Delete</th>
<th>Update</th>
</tr>
</thead>

<tbody id="tablebody">
  
 <?php
if(count($DataInfo) >0){
  foreach($DataInfo as $Info){

?>
<tr>
<td><?php echo $Info->id; ?></td>
<td><?php echo $Info->title; ?></td>
<td><?php echo $Info->description; ?></td>
<td><?php echo $Info->page_area_type; ?></td>
<td>  <div id="custom-img" style="background-image: url('{{ asset("storage/content_uploads/thumbnails/".$Info->filename) }}'); width:40px;height:40px;"></div></td>


<td><a href="/manage-gallery/{{$Info->id}}/edit" class="btn-ui btn-ui-primary btn-xs"  title="Edit info"><span class="ion ion-edit"></span> edit</a></td>
<td>
<form action="{{ route('manage-gallery.destroy', $Info->id) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->
  @method('DELETE')
<button type="submit" name="datasubmit" class="btn-ui btn-ui-danger btn-xs">
<i class="ion ion-android-delete"></i>Delete
</button>
</form>
</td>
</tr>

<?php
}
}
 ?>
 
 
</tbody>
</table>
</div>


</div>





	   </div><!---end row-->
	    </div>



@endsection
<!--code above is for templating-->