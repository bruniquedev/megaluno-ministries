@extends('layoutsadmin.layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

@section('content') 

<div class="container-fluid card-In m-t-100 m-b-50" >
 <div class="row justify-content-center">   
        

<div class="col-md-3 col-md-3">

      <!---panel panel_container---->
  <div class="panel panel_container panel_container-default">
<div class="panel_container-heading" id="panel panel_containerhead1">
<h3>SAVE AREAS SERVED</h3>
</div>
<div class="panel panel_container-body" id="panel panel_containerbody1">

@if(!isset($DataToEdit['id']) || $DataToEdit['id']==0)
    <form role="form" method="post" action="{{ route('manage-areasserved.store') }}" name="FORM" enctype="multipart/form-data">
    @else
    <form action="{{ route('manage-areasserved.update', $DataToEdit['id']) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @method('PUT')
  @endif

    @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->


  <div class="form-groupy">
<label for="text">Area name</label>
<div class="form-input-group">
<input type="text" required="required" value="{{$DataToEdit['headingtext']}}"  id="headingtext" class="form-control input_box" name="headingtext"   />
</div>
</div> 


  
       <div class="form-groupy">
  <label for="name" id="name">Area description text here</label>
  <div class="form-input-group">   
<textarea required="required" class="form-control input_box" name="descriptiontext" id="descriptiontext" 
  rows="6" >{{$DataToEdit['descriptiontext']}}</textarea>
</div>
</div>


         <div class="form-groupy">
  <label for="name" id="name">Paste area map code here</label> 
  <div class="form-input-group">  
<textarea required="required" class="form-control input_box" name="areamapcode" id="areamapcode" rows="6" >{{$DataToEdit['areamapcode']}}</textarea>
</div>
</div>



   <div class="form-groupy">
<!--<label for="text">ID</label>-->
<div class="form-input-group">
<input type="hidden" required="required" readonly="readonly" value="{{$DataToEdit['id']}}"  id="id" class="input_box" name="id"/>
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
<h1>Manage Areas served data</h1>
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
<th>Area name</th>
<th>Description</th>
<th>Area map code</th>
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
<td>{{$Info->headingtext}}</td>
<td>{{$Info->descriptiontext}}</td>   
<td><?php if($Info->areamapcode !=""){ echo "Available"; } ?></td>
<td>
<form action="{{ route('manage-areasserved.destroy', $Info->id) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->
  @method('DELETE')
<button type="submit" name="datasubmit" class="btn btn-danger btn-xs">
<i class="ion ion-android-delete"></i> Delete
</button>
</form>
</td>

<td><a class="btn btn-primary btn-xs" id="link1" href="/manage-areasserved/{{$Info->id}}/edit"><i class="ion ion-edit"></i> Edit</a></td>
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