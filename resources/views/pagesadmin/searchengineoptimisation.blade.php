@extends('layoutsadmin.layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

@section('content') 

<div class="container-fluid card-In m-t-150 m-b-50" >
 <div class="row justify-content-center">   
        

<div class="col-md-3 col-md-3">

      <!---panel panel_container---->
  <div class="panel panel_container panel_container-default">
<div class="panel_container-heading flex align-items-center flex-grow">
<h4 class="m-r-10">Save Seo Data</h4>
<a class="btn-ui btn-ui-primary btn-ui-xs" id="link1" href="{{ route('manage-socialmedia.index') }}"><i class="ion ion-android-add-circle"></i> Create</a>
</div>
<div class="panel panel_container-body" id="panel panel_containerbody1">

@if(!isset($DataToEdit['id']) || $DataToEdit['id']==0)
    <form role="form" method="post" action="{{ route('manage-seo.store') }}" name="FORM" enctype="multipart/form-data">
    @else
    <form action="{{ route('manage-seo.update', $DataToEdit['id']) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @method('PUT')
  @endif

    @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->


      <div class="form-groupy">
  <label for="name" id="name">Choose page</label> 
  <div class="form-input-group">   
<select required="required"  class="selectpicker input-control " data-live-search="true" name="author">
@if($DataToEdit['author']!="")
  <option value="{{$DataToEdit['author']}}" selected>{{$DataToEdit['author']}}</option>
  @endif
<option value=""></option>


{{--@if(count($Services_info) > 0)
@foreach($Services_info as $ServicesInfo)
<option value="{{$ServicesInfo->title}}">{{$ServicesInfo->title}}-{{$ServicesInfo->page_area_type}}</option>
@endforeach
@endif--}}


@if(count($Sermons_info) > 0)
@foreach($Sermons_info as $SermonsInfo)
<option value="{{$SermonsInfo->title}}">{{$SermonsInfo->title}}-{{$SermonsInfo->page_area_type}}</option>
@endforeach
@endif

{{--@if(count($Projects_info) > 0)
@foreach($Projects_info as $ProjectsInfo)
<option value="{{$ProjectsInfo->title}}">{{$ProjectsInfo->title}}-{{$ProjectsInfo->page_area_type}}</option>
@endforeach
@endif--}}

{{--@if(count($Programes_info) > 0)
@foreach($Programes_info as $ProgramesInfo)
<option value="{{$ProgramesInfo->title}}">{{$ProgramesInfo->title}}-{{$ProgramesInfo->page_area_type}}</option>
@endforeach
@endif--}}

{{--@if(count($Activity_info) > 0)
@foreach($Activity_info as $ActivityInfo)
<option value="{{$ActivityInfo->title}}">{{$ActivityInfo->title}}-{{$ActivityInfo->page_area_type}}</option>
@endforeach
@endif--}}

@if(count($Ministries_info) > 0)
@foreach($Ministries_info as $MinistriesInfo)
<option value="{{$MinistriesInfo->title}}">{{$MinistriesInfo->title}}-{{$MinistriesInfo->page_area_type}}</option>
@endforeach
@endif

@if(count($Involvements_info) > 0)
@foreach($Involvements_info as $InvolvementsInfo)
<option value="{{$InvolvementsInfo->title}}">{{$InvolvementsInfo->title}}-{{$InvolvementsInfo->page_area_type}}</option>
@endforeach
@endif

@if(count($Event_info) > 0)
@foreach($Event_info as $EventInfo)
<option value="{{$EventInfo->title}}">{{$EventInfo->title}}-{{$EventInfo->page_area_type}}</option>
@endforeach
@endif

<option value="Home">Home</option>
<option value="About">About</option>
<option value="Contact us">Contact us</option>
<option value="Gallery">Gallery</option>
<option value="Events">Events</option>
<option value="Ministry">Ministry</option>
<option value="Involvement">Involvement</option>
<option value="Sermon">Sermon</option>
<option value="Donation">Donation</option>
<option value="Testimonials">Testimonials</option>
</select>
</div>
   </div>
   


         <div class="form-groupy">
  <label for="name" id="name">Add page title</label>
   <div class="form-input-group"> 
<textarea required="required" class="input-control " name="title" id="title"  rows="2" >{{$DataToEdit['title']}}</textarea></div></div>
  
       <div class="form-groupy">
  <label for="name" id="name">Meta description</label>
  <div class="form-input-group">    
<textarea required="required" class="input-control " name="descriptiontext" id="descriptiontext" 
  rows="2" >{{$DataToEdit['descriptiontext']}}</textarea></div></div>


        <div class="form-groupy">
  <label for="name" id="name">Meta keywords</label>
  <div class="form-input-group">    
<textarea required="required" class="input-control " name="keywordstext" id="keywordstext" rows="2" >{{$DataToEdit['keywordstext']}}</textarea></div></div>




   <div class="form-groupy">
<!--<label for="text">ID</label>-->
<div class="form-input-group"> 
<input type="hidden" required="required" readonly="readonly" value="{{$DataToEdit['id']}}"  id="id" class="" name="id" />
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
<h4>Manage SEO data</h4>
@if (session('success'))
<div class="alert alert-success" role="alert">
{{ session('success') }}
</div>
@endif

<div class="table-responsive">
  <table class="table-container" id="search-table"
      data-sortable-table
    data-sort-url="{{ route('sort.update') }}"
    data-model="seo"
    data-column="sorted_order">
<thead id="tablehead">
<tr class="thead table-light">
<th>Id</th>
<th>title</th>
<th>Page</th>
<th>Meta description</th>
<th>Meta keywords</th>
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
<td>{{$Info->title}}</td>
<td>{{$Info->author}}</td>   
<td>{{$Info->descriptiontext}}</td>
<td>{{$Info->keywordstext}}</td>
<td>
<form action="{{ route('manage-seo.destroy', $Info->id) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->
  @method('DELETE')
<button type="submit" name="datasubmit" class="btn btn-danger btn-xs">
<i class="ion ion-android-delete"></i> Delete
</button>
</form>
</td>

<td><a class="btn btn-primary btn-xs" id="link1" href="/manage-seo/{{$Info->id}}/edit"><i class="ion ion-edit"></i> Edit</a></td>
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