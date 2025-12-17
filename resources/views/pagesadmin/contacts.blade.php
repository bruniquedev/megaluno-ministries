@extends('layoutsadmin.layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

@section('content') 

<div class="container-fluid card-In m-t-150 m-b-50" >
 <div class="row justify-content-center"> 	
        	


 <div class="col-md-12 col-md-12">
  <div class="panel_container-heading flex align-items-center flex-grow m-b-10">
<h4 class="m-r-10">Manage contact messages</h4>
<a class="btn-ui btn-ui-primary btn-ui-xs" id="link1" href="{{ route('manage-contacts.index') }}"><i class="ion ion-android-refresh"></i> Refresh</a>
</div>
@if (session('success'))
<div class="alert alert-success" role="alert">
{{ session('success') }}
</div>
@endif

<div class="table-responsive m-t-10">
  <table class="table-container" id="search-table"
      data-sortable-table
    data-sort-url="{{ route('sort.update') }}"
    data-model="content_info"
    data-column="sorted_order">
<thead id="tablehead">
<tr class="thead table-light">
<th>Id</th>
<th>Sender</th>
<th>Email</th>
<th>Phone</th>
<th>Subject</th>
<th>Message</th>
<th>Status</th>
<th>Recieved date</th>
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
$status = "btn-ui btn-ui-danger btn-ui-xs";
$statustext = "unseen";
$updateButtonText = "To seen";
if ($Info->status == 1) {
  $status = "btn-ui btn-ui-primary btn-ui-xs";
  $statustext = "seen";
  $updateButtonText = "To unseen";
}
?>

<tr data-sortable-row
    data-id="{{ $Info->id }}"
    draggable="true">
<td>{{$Info->id}}</td>
<td>{{$Info->title}}</td>
<td>{{$Info->email_address}}</td>
<td>{{$Info->phone_number}}</td>
<td>{{$Info->heading}}</td>
<td>{{$Info->description}}</td>
<td>{{$statustext}}</td>
<td>{{$Info->day_date}}</td>
<td>

<form action="{{ route('manage-contacts.destroy', $Info->id) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->
  @method('DELETE')
<button type="submit" name="datasubmit" class="btn-ui btn-ui-danger btn-ui-xs">
<i class="ion ion-android-delete"></i> Delete
</button>
</form>
</td>

<td><a class="{{$status}}" id="link1" href="/manage-contacts/{{$Info->id}}/edit">
	<i class="ion ion-edit"></i> {{$updateButtonText}}</a></td>
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