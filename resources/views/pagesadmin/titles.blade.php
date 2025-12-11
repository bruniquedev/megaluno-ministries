@extends('layoutsadmin.layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

@section('content') 

<div class="container-fluid card-In m-t-150 m-b-50" >
 <div class="row justify-content-center">   
        

<div class="col-md-3 col-md-3">

      <!---panel panel_container---->
  <div class="panel panel_container panel_container-default">
<div class="panel_container-heading flex align-items-center flex-grow">
<h4 class="m-r-10">Save Pages Titles</h4>
<a class="btn-ui btn-ui-primary btn-ui-xs" id="link1" href="{{ route('manage-socialmedia.index') }}"><i class="ion ion-android-add-circle"></i> Create</a>
</div>
<div class="panel panel_container-body" id="panel panel_containerbody1">

@if(!isset($DataToEdit['id']) || $DataToEdit['id']==0)
    <form role="form" method="post" action="{{ route('manage-titles.store') }}" name="FORM" enctype="multipart/form-data">
    @else
    <form action="{{ route('manage-titles.update', $DataToEdit['id']) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @method('PUT')
  @endif

    @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->



    <div class="form-groupy">
  <label for="name" id="name">Choose page</label> 
  <div class="form-input-group">   
<select required="required"  class=" input-control" name="title">
@if($DataToEdit['title']!="")
  <option value="{{$DataToEdit['title']}}" selected>{{$DataToEdit['title']}}</option>
  @endif
<option value=""></option>
<option value="testimonial">testimonial</option>
@if(count($DataPages) > 0)
@foreach($DataPages as $TitleInfo)
<option value="{{$TitleInfo->page_area_type}}">{{$TitleInfo->page_area_type}}</option>
@endforeach
@endif
</select>
</div>
   </div>
  
       <div class="form-groupy">
  <label for="name" id="name">Heading</label> 
    <div class="form-input-group">  
<input type="text" required="required" class="input-control" name="heading" id="heading" value="{{$DataToEdit['heading']}}" />
</div>
   </div>


    <div class="form-groupy">
<label for="name" id="MessageLabel">Description</label>
  <div class="form-input-group">
<textarea required="required"  
 class="input-control" name="description" id="description"  rows="5">
 {{$DataToEdit['description']}}</textarea>
</div>
</div>





<div class="form-groupy">
  <div class="form-input-group">
<input type="hidden" required="required" readonly="readonly" value="{{$DataToEdit['id']}}" 
id="id"  name="id">
</div>
</div> 

   <div class="form-groupy">
     <div class="form-input-group">
 <button type="submit" name="submitbutton" class="btn btn-primary" id="submit_button" >SAVE</button>    </div>     
</div>

</form>

</div><!---end of panel panel_container body---->
</div><!---end of panel panel_container---->


</div>  


 <div class="col-md-9 col-md-9">
<h4>Manage Pages Titles</h4>
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
<th>Title area</th>
<th>Heading</th>
<th>Description</th>
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
<td>{{$Info->title}}</td>
<td>{{$Info->heading}}</td>
<td>{{$Info->description}}</td>
<td>
<form action="{{ route('manage-titles.destroy', $Info->id) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->
  @method('DELETE')
<button type="submit" name="datasubmit" class="btn btn-danger btn-xs">
<i class="ion ion-android-delete"></i> Delete
</button>
</form>
</td>

<td><a class="btn btn-primary btn-xs" id="link1" href="/manage-titles/{{$Info->id}}/edit"><i class="ion ion-edit"></i> Edit</a></td>
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