@extends('layoutsadmin.layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

@section('content') 

<div class="container-fluid card-In m-t-100 m-b-50" >
 <div class="row justify-content-center"> 	
        

<div class="col-md-3 col-md-3">

      <!---panel panel_container---->
  <div class="panel panel_container panel_container-default">
<div class="panel_container-heading" id="panel panel_containerhead1">
<h3>SAVE GALLERY IMAGE</h3>
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
            <div class="input_label">Add image</div>
                   <!--upload field one-->
   <span class="btn-upload-1 btn-upload-file-1 btn-ui-black">
        <i class="ion ion-upload left"></i>  
        Select<input type="file" name="imagefile"  id="imagefile" class="text-bold">
    </span>
       <!--/upload field one-->
</div>

  
    <div class="form-groupy">
<label for="name" id="MessageLabel">Description</label>
<div class="form-input-group">
<textarea required="required"  
 class="input-control" name="descriptiontext" id="descriptiontext"  rows="2">{{$DataToEdit['text']}}</textarea>
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
<h1>Manage gallery</h1>
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
<th>Description</th>
<th>IMAGE</th>
<th>Delete</th>
<th>Update</th>
</tr>
</thead>

<tbody id="tablebody">
  

@if(count($DataInfo) > 0)
<!--iterate through an array-->
@foreach($DataInfo as $Info)

<tr>
<td>{{$Info->id}}</td>
<td>
<div id="custom-img" style="background-image: url('{{ asset("storage/gallery_images/thumbnails/".$Info->filename) }}'); height:50px; width: 50px;"></div>
<!--<img src="{{ asset('storage/slider_images/'.$Info->filename) }}" width="200px" hight="200px" alt="{{$Info->filename}}" />-->
<!--<img src="/storage/slider_images/{{$Info->filename}}" width="100%" height="100%" alt="{{$Info->filename}}" />-->
</td>
<td>{{$Info->text}}</td>

<td>
<form action="{{ route('manage-gallery.destroy', $Info->id) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->
  @method('DELETE')
<button type="submit" name="datasubmit" class="btn btn-ui btn-danger btn-xs">
<i class="ion ion-android-delete"></i> Delete
</button>
</form>
</td>

<td><a class="btn btn-ui btn-primary btn-xs" id="link1" href="/manage-gallery/{{$Info->id}}/edit"><i class="ion ion-edit"></i> Edit</a></td>
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