@extends('layoutsadmin.layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

@section('content') 

<div class="container-fluid card-In m-t-100 m-b-50" >
 <div class="row justify-content-center">   
 <div class="col-md-12 col-md-12">
<h1>Services</h1>
@if (session('success'))
<div class="alert alert-success" role="alert">
{{ session('success') }}
</div>
@endif


<input type="text" id="searchInput" class="searchInput form-control input_box" onkeyup="searchTableByMultipleColumns()" placeholder="Search table..." title="Type in a keyword">
<div class="table-responsive">
  <table class="table-container" id="search-table"
  cellspacing="0" cellpadding="5" style="background: #fff;">
<thead id="tablehead">
<tr class="thead table-light">
<th>No.</th>
<th>Name</th>
<th>Heading</th>
<th>Image</th>
<th>View more</th>
<th>Delete</th>
</tr>
</thead>

<tbody id="tablebody">
 <?php

if(count($DataInfo) >0){
  
  foreach($DataInfo as $Info){

     $id=$Info->id; 
     $name=$Info->name; 
     $heading=$Info->heading; 
     $filename=$Info->filename; 
?>
<tr>
<td><?php echo $id; ?></td>
<td><?php echo $name; ?></td>
<td><?php echo $heading; ?></td>
<td>  <div id="custom-img" style="background-image: url('{{ asset("storage/service_images/".$filename) }}'); width:40px;height:40px;"></div></td>


<td><a href="/manage-services/{{$id}}/edit" class="btn btn-primary btn-xs" title="Edit service"><span class="ion ion-edit"></span> edit</a></td>
<td>
<form action="{{ route('manage-services.destroy', $id) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->
  @method('DELETE')
<button type="submit" name="datasubmit" class="btn btn-danger btn-xs">
<i class="ion ion-android-delete"></i> Delete
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