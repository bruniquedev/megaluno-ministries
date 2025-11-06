@extends('layoutsadmin.layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

@section('content') 

<div class="container-fluid card-In m-t-100 m-b-50" >
 <div class="row justify-content-center"> 	
        	


 <div class="col-md-12 col-md-12">
<h1>Manage visitors contacts</h1>
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
<th>Sender</th>
<th>Email</th>
<th>Phone</th>
<th>Subject</th>
<th>Message</th>
<th>Status</th>
<th>Recieved date</th>
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
$statustext = "unseen";
$updateButtonText = "To seen";
if ($Info->seenstatus == 1) {
  $status = "btn btn-primary btn-xs";
  $statustext = "seen";
  $updateButtonText = "To unseen";
}
?>

<tr>
<td>{{$Info->id}}</td>
<td>{{$Info->sendername}}</td>
<td>{{$Info->sendermail}}</td>
<td>{{$Info->phonenumber}}</td>
<td>{{$Info->subject}}</td>
<td>{{$Info->messagetext}}</td>
<td>{{$statustext}}</td>
<td>{{$Info->messagedate}}</td>
<td>

<form action="{{ route('manage-contacts.destroy', $Info->id) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->
  @method('DELETE')
<button type="submit" name="datasubmit" class="btn btn-danger btn-xs">
<i class="ion ion-android-delete"></i> Delete
</button>
</form>
</td>

<td><a class="{{$status}}" id="link1" href="/manage-contacts/{{$Info->id}}/edit">
	<i class="ion ion-edit"></i> {{$updateButtonText}}</a></td>
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