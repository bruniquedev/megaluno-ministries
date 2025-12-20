@extends('layoutsadmin.layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

@section('content') 

<div class="container-fluid card-In m-t-150 m-b-50" >
 <div class="row justify-content-center"> 

<div class="col-md-2 col-md-2">


  <table class="table-container" 
  cellspacing="0" cellpadding="5" style="background: #fff;">
  <h4 id="heading4" align="center"> Summary Views : <?php echo $CountTotalofVisits; ?> </h4>
<thead id="tablehead">
<tr class="thead table-light">
<th scope="col">Pages</th>
<th scope="col">Totals</th>  
</tr>
</thead>
<tbody id="tablebody">
@if(count($getTotalofVisitsdata) > 0)
<!--iterate through an array-->
@foreach($getTotalofVisitsdata as $TotalInfo)
<tr>
<td>{{$TotalInfo->page}}</td>
<td>{{$TotalInfo->totalvisit}}</td>
</tr>   
@endforeach
@endif 
</tbody>
</table>


 </div>       
 <div class="col-md-10 col-md-10">

<h4>Visitors tracking</h4>
@if (session('success'))
<div class="alert alert-success" role="alert">
{{ session('success') }}
</div>
@endif

<form action="{{ route('manage-visitors.destroy', 0) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->
  @method('DELETE')
<button type="submit" name="datasubmit" class="btn btn-danger btn-xs">Reset data
</button>
</form>

  <table class="table-container"
  id="search-table"
      data-sortable-table
    data-sort-url="{{ route('sort.update') }}"
    data-model="pageview"
    data-column="sorted_order" 
  cellspacing="0" cellpadding="5" style="background: #fff;">
<h4 id="heading4" align="center">Today total visitors : <span class="usersbadge"><?php echo $TodayTotalCountvisitors;?></span></h4>
<h4 id="heading4" align="center">Total visitors : <?php echo $Countvisitorsdata; ?></h4>
<thead id="tablehead">
<tr class="thead table-light">
 <th scope="col">VISITOR ID</th>
      <th scope="col">IP ADDRESS</th>
      <th scope="col">PAGES</th>
      <th scope="col">COUNTRYCODE</th>
      <th scope="col">COUNTRY</th>
      <th scope="col">CITY</th>
      <th scope="col">LATITUDE</th>
      <th scope="col">LONGITUDE</th>
      <th scope="col">DATE</th>
      <th scope="col">Sort</th>
</tr>
</thead>

<tbody id="tablebody">
@if(count($getUserIpsdata) > 0)
<!--iterate through an array-->
@foreach($getUserIpsdata as $Info)
<tr data-sortable-row
    data-id="{{ $Info->id }}">
<td>{{$Info->id}}</td>
<td>{{$Info->userip}}</td>
<td>{{$Info->page}}</td>
<td>{{$Info->countrycode}}</td>
<td>{{$Info->country}}</td>
<td>{{$Info->city}}</td>
<td>{{$Info->latitude}}</td>
<td>{{$Info->longitude}}</td>
<td>{{$Info->visitdate}}</td>
<td class="drag-handle" draggable="true">⋮⋮</td>
</tr>   
@endforeach
@endif 
    
</tbody>
</table>







</div>
	   </div><!---end row-->
	    </div>



@endsection
<!--code above is for templating-->