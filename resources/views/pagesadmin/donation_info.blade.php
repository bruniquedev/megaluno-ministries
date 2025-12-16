@extends('layoutsadmin.layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

@section('content') 

<div class="container card-In m-t-150 m-b-50" >
 <div class="row justify-content-center">   
 <div class="col-md-12 col-md-12">
  <div class="panel_container-heading flex align-items-center flex-grow">
<h4 class="m-r-10">Donation info</h4>
<a class="btn-ui btn-ui-primary btn-ui-xs" id="link1" href="{{ route('manage-socialmedia.index') }}"><i class="ion ion-android-add-circle"></i> Create</a>
</div>
@if (session('success'))
<div class="alert alert-success" role="alert">
{{ session('success') }}
</div>
@endif


<input type="text" id="searchInput" class="searchInput form-control input_box" onkeyup="searchTableByMultipleColumns()" placeholder="Search table..." title="Type in a keyword">
<div class="table-responsive">
  <table class="table-container" id="search-table"
      data-sortable-table
    data-sort-url="{{ route('sort.update') }}"
    data-model="content_info"
    data-column="sorted_order">
<thead id="tablehead">
<tr class="thead table-light">
<th>id</th>
<th>Title</th>
<th>Type</th>
<th>Featured Image</th>
<th>edit</th>
<th>Delete</th>
<th>Sort</th>
</tr>
</thead>

<tbody id="tablebody">
 <?php
if(count($DataInfo) >0){
  foreach($DataInfo as $Info){

?>
<tr data-sortable-row
    data-id="{{ $Info->id }}"
    draggable="true">
<td><?php echo $Info->id; ?></td>
<td><?php echo $Info->title; ?></td>
<td><?php echo $Info->page_area_type; ?></td>
<td>  <div id="custom-img" style="background-image: url('{{ asset("storage/content_uploads/thumbnails/".$Info->filename) }}'); width:40px;height:40px;"></div></td>


<td><a href="/manage-donations/{{$Info->id}}/edit" class="btn-ui btn-ui-primary btn-xs"  title="Edit info"><span class="ion ion-edit"></span> edit</a></td>
<td>
<form action="{{ route('manage-donations.destroy', $Info->id) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->
  @method('DELETE')
<button type="submit" name="datasubmit" class="btn-ui btn-ui-danger btn-xs">
<i class="ion ion-android-delete"></i>Delete
</button>
</form>
</td>
<td class="drag-handle" draggable="true">⋮⋮</td>
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