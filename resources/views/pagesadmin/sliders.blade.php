@extends('layoutsadmin.layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

@section('content') 

<div class="container-fluid card-In m-t-150 m-b-50" >
 <div class="row justify-content-center"> 	
        

<div class="col-md-3 col-md-3">

      <!---panel panel_container---->
  <div class="panel panel_container panel_container-default">
<div class="panel_container-heading flex align-items-center flex-grow">
<h4 class="m-r-10">Save Slider Image</h4>
<a class="btn-ui btn-ui-primary btn-ui-xs" id="link1" href="{{ route('manage-sliders.index') }}"><i class="ion ion-android-add-circle"></i> Create</a>
</div>
<div class="panel panel_container-body" id="panel panel_containerbody1">

@if(!isset($DataToEdit['id']) || $DataToEdit['id']==0)
    <form role="form" method="post" action="{{ route('manage-sliders.store') }}" name="FORM" enctype="multipart/form-data">
    @else
    <form action="{{ route('manage-sliders.update', $DataToEdit['id']) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @method('PUT')
  @endif

    @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->

    <div class="form-groupy">
<label for="name">Heading text</label>
 <div class="form-input-group"> 
<textarea required="required"  
 class="input-control" name="headingtext" id="headingtext"  rows="2">{{$DataToEdit['heading']}}</textarea>
</div>
</div>
  
    <div class="form-groupy">
<label for="name">Description text</label>
 <div class="form-input-group"> 
<textarea required="required"  
 class="input-control" name="descriptiontext" id="descriptiontext"  rows="3">{{$DataToEdit['description']}}</textarea>
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
<label for="text">Create a button text (optional)</label>
 <div class="form-input-group"> 
<input type="text"   value="{{$DataToEdit['title']}}" id="buttontext" class="input" name="buttontext">
</div>
</div>

    <div class="form-groupy">   
<label for="name">Create a button link (optional)</label>
 <div class="form-input-group"> 
<textarea   
 class="input-control" name="buttonlink" id="buttonlink"  rows="2"
  style=" font-weight:bold;">{{$DataToEdit['link_redirect']}}</textarea>
</div>
</div>

<div class="form-groupy">
 <div class="form-input-group"> 
<input type="hidden" required="required" readonly="readonly" value="{{$DataToEdit['id']}}" id="id" class="input_box" name="id">
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
<h4>Manage slider</h4>
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
<th>Heading</th>
<th>Description</th>
<th>Button text</th>
<th>Button Link</th>
<th>Image</th>
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
<td>{{$Info->heading}}</td>
<td>{{$Info->description}}</td>
<td>{{$Info->title}}</td>
<td>{{$Info->link_redirect}}</td>
<td>
<div id="custom-img" style="background-image: url('{{ asset("storage/content_uploads/thumbnails/".$Info->filename) }}');"></div>
<!--<img src="{{ asset('storage/slider_images/'.$Info->filename) }}" width="200px" hight="200px" alt="{{$Info->filename}}" />-->
<!--<img src="/storage/slider_images/{{$Info->filename}}" width="100%" height="100%" alt="{{$Info->filename}}" />-->
</td>
<td>
<form action="{{ route('manage-sliders.destroy', $Info->id) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->
  @method('DELETE')
<button type="submit" name="datasubmit" class="btn btn-danger btn-xs">
<i class="ion ion-android-delete"></i> Delete
</button>
</form>
</td>

<td><a class="btn btn-primary btn-xs" id="link1" href="/manage-sliders/{{$Info->id}}/edit"><i class="ion ion-edit"></i> Edit</a></td>
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