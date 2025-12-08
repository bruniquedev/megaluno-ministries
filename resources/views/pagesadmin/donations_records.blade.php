@extends('layoutsadmin.layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

@section('content') 

<div class="container card-In m-t-150 m-b-50" >
 <div class="row justify-content-center"> 	
        	


 <div class="col-md-12 col-md-12">
  <div class="panel_container-heading flex align-items-center flex-grow">
<h4 class="m-r-10">Manage Donors & Donations</h4>
<a class="btn-ui btn-ui-primary btn-ui-xs" id="link1" href="{{ route('manage-socialmedia.index') }}"><i class="ion ion-android-add-circle"></i> Create</a>
</div>
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
<th>Reference</th>
<th>Amount</th>
<th>Donor name</th>
<th>Email</th>
<th>Phone</th>
<th>Details</th>
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
if ($Info->donationstatus == 1) {
  $status = "btn btn-primary btn-xs";
  $statustext = "seen";
  $updateButtonText = "To unseen";
}
?>

<tr>
<td>{{$Info->id}}</td>
<td>{{$Info->reference}}</td>
<td>{{$Info->amount}}</td>
<td>{{$Info->donorname}}</td>
<td>{{$Info->donoremail}}</td>
<td>{{$Info->donorphonenumber}}</td>
<td>{{$Info->addondetails}}</td>
<td>{{$statustext}}</td>
<td>{{$Info->createddate}}</td>
<td>

<form action="{{ route('users-donations.destroydonation', $Info->id) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->
  @method('DELETE')
<button type="submit" name="datasubmit" class="btn btn-danger btn-xs">
<i class="ion ion-android-delete"></i> Delete
</button>
</form>
</td>

<td><a class="{{$status}}" id="link1" href="/users-donations/{{$Info->id}}/edit">
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